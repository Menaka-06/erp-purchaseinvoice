<?php
class Purchaseinvoice_model extends CI_Model{
    public function __construct(){
		parent::__construct();
	}

    public function createPurchaseInvoice($saleInvoiceID,$grnId,$customer_id){
        $saleInvoice=$this->getSaleInvoiceSTK($saleInvoiceID);
        $saleInvoiceItems=$this->getSaleInvoiceItemsSTK($saleInvoiceID);
        $saleInvoiceDetails=$this->getSaleInvoiceDetailsSTK($saleInvoiceID);
        $saleInvoiceAccounts=$this->getSaleInvoiceAccountsSTK($saleInvoiceID);
        $GRNdetails=$this->getGRNDetails($grnId);
        $invNum=$this->generateCustomerInvoice($customer_id);
        $purchaseInv=array(
            'purchaseInvoiceNum'=>$invNum,
            'SOID'=>$saleInvoice->SOID,
            'SoRefNo'=>$saleInvoice->SoRefNo,
            'POID'=>$GRNdetails->PoId,
            'PoRefNo'=>$GRNdetails->PoNum,
            'SiId'=>$saleInvoice->id,
            'SiRefNo'=>$saleInvoice->saleInvoiceNum,
            'GRNId'=>$GRNdetails->id,
            'GRNNo'=>$GRNdetails->GrnNumber,
            'fromCustomerId'=>$saleInvoice->toCustomerId,
            'fromCustomerName'=>$saleInvoice->toCustomerName,
            'fromCustomerCode'=>$saleInvoice->toCustomerCode,
            'toCustomerId'=>$saleInvoice->fromCustomerId,
            'toCustomerName'=>$saleInvoice->fromCustomerName,
            'toCustomerCode'=>$saleInvoice->fromCustomerCode,
            'invoiceDate'=>date('Y-m-d'),
            'promoCode'=>$saleInvoice->promoCode,
            'VechileNo'=>$saleInvoice->VechileNo,
            'noOfBoxes'=>$saleInvoice->noOfBoxes,
            'status'=>'Approved',
            'TransportationMode'=>$saleInvoice->TransportationMode,
            'TaxType'=>$saleInvoice->TaxType,
            'saleTag'=>'PUR-INV',
            'Tag'=>'PUR-INV',
            'FocStatus'=>$saleInvoice->FocStatus,
            'createdAt'=>date('Y-m-d H:i:s'),
            'createdBy'=>$this->session->userdata('user_id'),
        );
        $purchaseInvoiceId=$this->insertPurchaseInvoice($purchaseInv);
        $PIDetails=array(
            'purchaseInvoiceId'=>$purchaseInvoiceId,
            'billingAddress'=>$saleInvoiceDetails->billingAddress,
            'productCount'=>$saleInvoiceDetails->productCount,
            'terms'=>$saleInvoiceDetails->terms,
            'remarks'=>$saleInvoiceDetails->remarks,
            'foc'=>$saleInvoiceDetails->foc,
            'credits'=>$saleInvoiceDetails->credits,
            'debits'=>$saleInvoiceDetails->debits,
            'totalMRPAmount'=>$saleInvoiceDetails->totalMRPAmount,
            'totalBV'=>$saleInvoiceDetails->totalBV,
            'totalGrossAmount'=>$saleInvoiceDetails->totalGrossAmount,
            'totalDiscountAmount'=>$saleInvoiceDetails->totalDiscountAmount,
            'totalDamageDiscountAmount'=>$saleInvoiceDetails->totalDamageDiscountAmount,
            'totalTaxAmount'=>$saleInvoiceDetails->totalTaxAmount,
            'shippingCharges'=>$saleInvoiceDetails->shippingCharges,
            'shippingTax'=>$saleInvoiceDetails->shippingTax,
            'totalNetAmount'=>$saleInvoiceDetails->totalNetAmount,
        );
        $this->insertPurchaseInvoiceDetails($PIDetails);

        if(!empty($saleInvoiceItems)){
            foreach($saleInvoiceItems as $SII){
                $PIItem=array(
                    'purchaseInvoiceId'=>$purchaseInvoiceId,
                    'productId'=>$SII->productId,
                    'MRP'=>$SII->MRP,
                    'HSNCode'=>$SII->HSNCode,
                    'BatchNo'=>$SII->BatchNo,
                    'availQty'=>$SII->availQty,
                    'ExpiryDate'=>$SII->ExpiryDate,
                    'DPprice'=>$SII->DPprice,
                    'BV'=>$SII->BV,
                    'quantity'=>$SII->quantity,
                    'mrpGrossAmount'=>$SII->mrpGrossAmount,
                    'discount'=>$SII->discount,
                    'damageDiscount'=>$SII->damageDiscount,
                    'TotalBV'=>$SII->TotalBV,
                    'AmountWithoutTax'=>$SII->AmountWithoutTax,
                    'GrossAmount'=>$SII->GrossAmount,
                    'CgstPercent'=>$SII->CgstPercent,
                    'CgstAmount'=>$SII->CgstAmount,
                    'SgstPercent'=>$SII->SgstPercent,
                    'SgstAmount'=>$SII->SgstAmount,
                    'IgstPercent'=>$SII->IgstPercent,
                    'IgstAmount'=>$SII->IgstAmount,
                );
                $this->insertPurchaseInvoiceItems($PIItem);
            }
        }

        if(!empty($saleInvoiceAccounts)){
            foreach($saleInvoiceAccounts as $SIA){
                $piAcc=array(
                    'purchaseInvoiceNo'=>$purchaseInvoiceId,
                    'PaymentType'=>$SIA->PaymentType,
                    'Amount'=>$SIA->Amount,
                    'ReferencNo'=>$SIA->ReferencNo,
                );
                $this->insertPurchaseInvoiceAccounts($piAcc);
            }
        }
        $this->customerPurchaseInvoiceIncrement($customer_id);

    }

    public function getSaleInvoiceSTK($id){
        return $this->db->where('id',$id)->get('tbl_sales_invoice_stk')->row();
    }

    public function getSaleInvoiceItemsSTK($id){
        return $this->db->where('saleInvoiceId',$id)->get('tbl_sales_invoice_stk_items')->result();
    }

    public function getSaleInvoiceDetailsSTK($id){
        return $this->db->where('saleInvoiceId',$id)->get('tbl_sales_invoice_stk_details')->row();
    }

    public function getSaleInvoiceAccountsSTK($id){
        return $this->db->where('salesInvoiceNo',$id)->get('tbl_sales_invoice_stk_accounts')->result();
    }

    public function insertPurchaseInvoiceAccounts($data){
        return $this->db->insert('tbl_purchase_invoice_stk_accounts',$data);
    }

    public function insertPurchaseInvoiceDetails($data){
        return $this->db->insert('tbl_purchase_invoice_stk_details',$data);
    }

    public function insertPurchaseInvoiceItems($data){
        return $this->db->insert('tbl_purchase_invoice_stk_items',$data);
    }

    public function insertPurchaseInvoice($data){
        $this->db->insert('tbl_purchase_invoice_stk',$data);
        return $this->db->insert_id();
    }

    public function getGRNDetails($id){
		return $this->db->where('id',$id)->get('tbl_goods_received_notes')->row();
	}

    public function generateCustomerInvoice($customer_id){
		$pad_len=INVOICE_PREFIX_LENGTH;
		$input=$this->getPurchaseInvoiceLastCount($customer_id);
		$prefix='';
		$prefix_data=$this->customerPurchaseInvoicePrefix($customer_id);
		if(!empty($prefix_data)){$prefix=$prefix_data;}
	    if (is_string($prefix))
	        return sprintf("%s%s", $prefix, str_pad($input, $pad_len, "0", STR_PAD_LEFT));

	    return str_pad($input, $pad_len, "0", STR_PAD_LEFT);
	}

	public function customerPurchaseInvoiceIncrement($customer_id){
		$len=0;
		$count=$this->getPurchaseInvoiceLastCount($customer_id);
		if(!empty($count)){
			$len=$count;
		}
		$len++;
		$update=array('lastPurchaseInvId'=>$len);
		$this->updateCustomer($customer_id,$update);
	}

	public function getPurchaseInvoiceLastCount($customer_id){
		$customer_code="";
		$resp=$this->db->where('id',$customer_id)->get('tbl_customers')->row();
		if(!empty($resp)){$customer_code=$resp->lastPurchaseInvId;}
		return $customer_code;
	}

	public function updateCustomer($id,$data){
		return $this->db->where('id',$id)->set($data)->update('tbl_customers');
	}
	public function customerPurchaseInvoicePrefix($customer_id){
		$customer_code="";
		$resp=$this->db->where('id',$customer_id)->get('tbl_customers')->row();
		if(!empty($resp)){$customer_code=$resp->purchaseInvoicePrefix;}
		return $customer_code;
	}
    public function GetPurchaseInvoiceList($limit,$start,$customer_id){
        $this->db->select('PI.*,PID.totalNetAmount')->from('tbl_purchase_invoice_stk as PI');
        $this->db->join('tbl_purchase_invoice_stk_details as PID','PI.id=PID.purchaseInvoiceId');
        $this->db->where('PI.fromCustomerId',$customer_id);
        $this->db->limit($limit,$start);
        $this->db->order_by('PI.id','desc');
        return $this->db->get()->result();
    }
    public function getPurchaseInvoice($id,$customer_id){
        return $this->db->where(array('id'=>$id,'SOID'=>$customer_id))->get('tbl_purchase_invoice_stk')->row();
    }
     public function getPurchaseInvoicedetails($id){
        return $this->db->where(array('purchaseInvoiceId'=>$id))->get('tbl_purchase_invoice_stk_details')->row();
    }
    public function getPurchaseInvoiceitems($id){
        return $this->db->where(array('purchaseInvoiceId'=>$id))->get('tbl_purchase_invoice_stk_items')->result();
    }
    public function getPurchaseInvoicetotal($id){
         $this->db->select('PI.*,sum(PI.mrpGrossAmount) as total_amount,sum(PI.discount) as total_discount,sum(PI.BV) as total_BV,sum(PI.GrossAmount) as total_gross,sum(PI.AmountWithoutTax) as total_netamount')->from('tbl_purchase_invoice_stk_items as PI','purchaseInvoiceId',$id);
         $res=$this->db->get()->row();
        return $res;
    }
public function getPurchaseInvoiceListReport($limit,$start,$from_date,$to_date,$stockist){
        $this->db->select('PI.*,PIItem.*')->from('tbl_purchase_invoice_stk as PI');
        $this->db->join('tbl_purchase_invoice_stk_items as PIItem','PI.id=PIItem.purchaseInvoiceId');
        if(!empty($from_date)){
            $this->db->where('PI.invoiceDate >=',$from_date);
        }
        if(!empty($to_date)){
            $this->db->where('PI.invoiceDate <=',$to_date);
        }
        if(!empty($stockist)){
            $this->db->where('PI.fromCustomerId',$stockist);
        }
        $this->db->limit($limit,$start);
        $this->db->order_by('PI.id','desc');
        $res=$this->db->get()->result();
        return $res;
    }
    public function purchaseInvoiceExcelDownload($from_date,$to_date,$stockist){
        $this->db->select('PI.*,PIItem.*')->from('tbl_purchase_invoice_stk as PI');
        $this->db->join('tbl_purchase_invoice_stk_items as PIItem','PI.id=PIItem.purchaseInvoiceId');
        if(!empty($from_date)){
            $this->db->where('PI.invoiceDate >=',$from_date);
        }
        if(!empty($to_date)){
            $this->db->where('PI.invoiceDate <=',$to_date);
        }
        if(!empty($stockist)){
            $this->db->where('PI.fromCustomerId',$stockist);
        }
        $this->db->order_by('PI.id','desc');
        $res=$this->db->get()->result();
        return $res;
    }

}