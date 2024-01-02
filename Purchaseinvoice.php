<?php
class Purchaseinvoice extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->common_model->check_login();
		//$this->load->model('purchaseorder_model');
		$this->load->model('purchaseinvoice_model');
	}
	public function purchaseInvoicepage(){
		$data['page_name']='Purchase Invoice';
		$data['sub_page']='purchaseinvoice/PurchaseInvoicepage';
		$config['base_url'] = base_url()."purchaseinvoice/purchaseInvoicepage"; 
		$customer_id=$this->session->userdata('customer_id');
		$config['total_rows'] = $this->common_model->getTotalRecords('tbl_purchase_invoice_stk',array('fromCustomerId'=>$customer_id));
		$config['per_page'] = PAGINATION_COUNT; 
		$config=$this->common_model->paginationStyle($config);
		$this->pagination->initialize($config); 
		$lmt=0;
		$lmt=$this->uri->segment(3);
		$lmt=mysqli_real_escape_string($this->db->conn_id,$lmt);
		$data['lmt']=$lmt;
		$data['purchase_invoice'] = $this->purchaseinvoice_model->GetPurchaseInvoiceList($config['per_page'],$lmt,$customer_id);
		$this->load->view('user_index',$data);
    }
    public function viewPurchaseInvoice($id){
    	$id=$this->common_model->decode($id);
    	// $this->common_model->CommentsLog();
    	$customer_id=$this->session->userdata('customer_id');
    	$data['page_name']='View Purchase Invoice';
		$data['sub_page']='purchaseinvoice/viewpurchaseinvoice';
		$data['purchase_invoice']=$this->purchaseinvoice_model->getPurchaseInvoice($id,$customer_id);
		if(empty($data['purchase_invoice'])){
			$this->session->set_flashdata('error','Invalid Request');
            redirect(base_url().'purchaseinvoice/purchaseinvoicepage');
		}
		if(!empty($data['purchase_invoice'])){
			
			$data['purchase_invoice_details']=$this->purchaseinvoice_model->getPurchaseInvoicedetails($id);
			$data['purchase_invoice_items']=$this->purchaseinvoice_model->getPurchaseInvoiceitems($id);
			$total_data=$this->purchaseinvoice_model->getPurchaseInvoicetotal($id);
			$data['total_amount']=$total_data->total_amount;
			$data['total_discount']=$total_data->total_discount;
			$data['total_BV']=$total_data->total_BV;
			$data['total_gross']=$total_data->total_gross;
			$data['total_netamount']=$total_data->total_netamount;
		}
		$this->load->view('user_index',$data);
    }
	public function purchaseinvoicereport(){
		$customer_id=$this->session->userdata('customer_id');
		$data['page_name']='List Purchase Invoice';
		$data['sub_page']='purchaseinvoice/purchaseinvoicereport';
		$config['base_url'] = base_url()."purchaseinvoice/purchaseinvoicereport"; 
		$config['total_rows'] = $this->common_model->getTotalRecords('tbl_purchase_invoice_stk',array('fromCustomerId'=>$customer_id));
		$config['per_page'] = PAGINATION_COUNT; 
		$config=$this->common_model->paginationStyle($config);
		$this->pagination->initialize($config); 
		$lmt=0;
		$lmt=$this->uri->segment(3);
		//$lmt=mysqli_real_escape_string($this->db->conn_id,$lmt);
		$data['lmt']=$lmt;
		$data['customer']=$this->common_model->getActiveCustomer();
		$data['purchase_invoice'] = $this->purchaseinvoice_model->getPurchaseInvoice($config['per_page'],$lmt,$customer_id);
		$this->load->view('user_index',$data);
    }
    public function generatePurchaseInvoiceReport(){
        $date=$this->security->xss_clean($this->input->post('date'));
        $to_date=$this->security->xss_clean($this->input->post('to_date'));
        $stockist=$this->security->xss_clean($this->input->post('stockist'));
        if(empty($date) | empty($to_date) | empty($stockist)){
            $this->session->set_flashdata('warning', 'Some fields are empty');
            redirect(base_url().'purchaseinvoice/purchaseinvoicereport');
        }
        $config['base_url'] = base_url()."purchaseinvoice/purchaseinvoicereport"; 
        $config['total_rows'] = $this->common_model->getTotalRecords('tbl_purchase_invoice_stk',array());
        $config['per_page'] = PAGINATION_COUNT; 
        $config=$this->common_model->paginationStyle($config);
        $this->pagination->initialize($config); 
        $lmt=0;
        $lmt=$this->uri->segment(3);
       // $lmt=mysqli_real_escape_string($this->db->conn_id,$lmt);
        $data['invoice_details']=$this->purchaseinvoice_model->getPurchaseInvoiceListReport($config['per_page'],$lmt,$date,$to_date,$stockist);
        $data['page_name']='Purchase Invoice report';
        $data['sub_page']='purchaseinvoice/purchaseinvoicereport';
        $data['customer']=$this->common_model->getActiveCustomer();
        $data['from_date']=$date;
        $data['to_date']=$to_date;
        $data['stockist']=$stockist;
        $this->load->view('user_index',$data);
    }
    public function downloadExcelPurchaseInvoice(){
        $date=$this->security->xss_clean($this->input->post('search_from_date'));
        $to_date=$this->security->xss_clean($this->input->post('search_to_date'));
        $stockist=$this->security->xss_clean($this->input->post('search_stockist_id'));
        if(empty($date) | empty($to_date) | empty($stockist)){
            $this->session->set_flashdata('warning', 'Some fields are empty');
            redirect(base_url().'purchaseinvoice/purchaseinvoicereport');
        }

        $purchaseInvoiceList=$this->purchaseinvoice_model->purchaseInvoiceExcelDownload($date,$to_date,$stockist);
        if(empty($purchaseInvoiceList)){
            $this->session->set_flashdata('warning','No data To Display');
            redirect(base_url().'purchaseinvoice/purchaseinvoicereport');
        }
        if(!empty($purchaseInvoiceList)){
            foreach($purchaseInvoiceList as $PINV){
                $perBV['Purchase Invoice Date']=date('d-m-Y',strtotime($PINV->invoiceDate));
                $perBV['Purchase Invoice Number']=$PINV->PoRefNo;
               
                $perBV['Stockist Name']=$PINV->fromCustomerName;
                $perBV['Stockist Code']=$PINV->fromCustomerCode;
                $perBV['Tax Type']=$PINV->TaxType;
                $perBV['Batch Number']=$PINV->BatchNo;
                $perBV['Available Quantity']=$PINV->availQty;
                $perBV['DP Price']=$PINV->DPprice;
                $perBV['Quantity']=$PINV->quantity;
                $perBV['Discount']=$PINV->discount;
                $perBV['Amount Without Tax']=$PINV->AmountWithoutTax;
                $perBV['Expiry Date']=$PINV->ExpiryDate;

                $perBV['Total MRP Amount']=$PINV->MRP;
                $perBV['Total BV']=$PINV->TotalBV;
                $perBV['Total Gross Amount']=$PINV->GrossAmount;
                

                $per_ata[]=$perBV;
                
            }
            $data=$per_ata;
            $filename=$date.'-'.$to_date.'-'.$stockist."Purchase-invoice-report";
            $export=$this->common_model->ExcelExport($filename,$data);
        }
    }

}