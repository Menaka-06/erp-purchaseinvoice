<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0"><?php echo $page_name;?></h4>

                <div class="page-title-right d-none">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                        <li class="breadcrumb-item active">Horizontal</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Purchase Invoice Details</h4>
                        <div class="flex-shrink-0">
                            <a href="<?php echo base_url();?>purchaseinvoice/purchaseInvoicepage" class="btn btn-dark btn-sm bg-gradient waves-effect waves-light text-uppercase"> <i data-feather="arrow-left"></i> Back</a>
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-xxl-2 col-md-2">
                                    <div>
                                        <label for="category_name" class="form-label required">Invoice Date</label>
                                        <input type="text" class="form-control" readonly value="<?php if(!empty($purchase_invoice->invoiceDate)){ echo $purchase_invoice->invoiceDate;}?>">
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-xxl-2 col-md-2">
                                    <div>
                                        <label for="category_name" class="form-label required">Purchase Invoice No</label>
                                        <input type="text" class="form-control" readonly value="<?php if(!empty($purchase_invoice->PoRefNo)){ echo $purchase_invoice->PoRefNo;}?>">
                                    </div>
                                </div>
                                <!--end col-->

                               
                                <div class="col-xxl-4 col-md-4">
                                    <div>
                                        <label for="category_name" class="form-label required">Stockist Name</label>
                                        <input type="text" class="form-control" readonly value="<?php if(!empty($purchase_invoice->fromCustomerName)){ echo $purchase_invoice->fromCustomerName;}?>">
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-xxl-2 col-md-2">
                                    <div>
                                        <label for="category_name" class="form-label required">Stockist Code</label>
                                        <input type="text" class="form-control" readonly value="<?php if(!empty($purchase_invoice->fromCustomerCode)){ echo $purchase_invoice->fromCustomerCode;}?>">
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-xxl-2 col-md-2">
                                    <div>
                                        <label for="category_name" class="form-label required">Status</label>
                                        <input type="text" class="form-control" readonly value="<?php if(!empty($purchase_invoice->status)){ echo $purchase_invoice->status;}?>">
                                    </div>
                                </div>
                                <!--end col-->

                                

                                <div class="col-xxl-2 col-md-2">
                                    <div>
                                        <label for="category_name" class="form-label required">Transportation Mode</label>
                                        <input type="text" class="form-control" readonly value="<?php if(!empty($purchase_invoice->TransportationMode)){ echo $purchase_invoice->TransportationMode;}?>">
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-xxl-2 col-md-2">
                                    <div>
                                        <label for="category_name" class="form-label required">Tax Type</label>
                                        <input type="text" class="form-control" readonly value="<?php if(!empty($purchase_invoice->TaxType)){ echo $purchase_invoice->TaxType;}?>">
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-xxl-2 col-md-2">
                                    <div>
                                        <label for="category_name" class="form-label required">No of Products</label>
                                        <input type="text" class="form-control" readonly value="<?php if(!empty($purchase_invoice->noOfBoxes)){ echo $purchase_invoice->noOfBoxes;}?>">
                                    </div>
                                </div>
                                <!--end col-->

                                
                                <!--end col-->
                                
                            </div>
                            <!--end row-->
                        </div>
                    </div>

                    
                    </div>
                </div>
            </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">

                    <h4 class="card-title mb-0 flex-grow-1">Address Details</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="margin-bottom: 15px;">
                                            <label for="bill_address" class="form-label">Billing Address</label>
                                            <textarea class="form-control" readonly ><?php if(!empty($purchase_invoice_details->billingAddress)){ echo  strip_tags($this->common_model->format_address($purchase_invoice_details->billingAddress));}?></textarea>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="table-responsive">
                                    <input type="hidden" name="last_table_count" id="last_table_count" value="0">
                                    <table class="table table-hover align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">S.No</th>
                                                <th scope="col">Item</th>
                                                <th scope="col">Sku</th>
                                                <th scope="col">BV</th>
                                                <th scope="col">MRP</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Total MRP Price</th>
                                                <th scope="col">Total BV</th>
                                                <th scope="col">Discount</th>
                                                <th scope="col">Gross Amount</th>
                                                <th scope="col">CGST (%)</th>
                                                <th scope="col">SGST (%)</th>
                                                <th scope="col">IGST (%)</th>
                                                <th scope="col">Amount with Tax</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;if(!empty($purchase_invoice_items)){ foreach($purchase_invoice_items as $PI){?>
                                           <tr>
                                               <td><?php echo $i;?></td>
                                               <td><?php echo $this->common_model->getProductNameByID($PI->purchaseInvoiceId); ?></td>
                                               <td><?php echo $this->common_model->getProductSKUByID($PI->purchaseInvoiceId); ?></td>
                                               <td><?php if(!empty($PI->BV)){ echo $PI->BV;}?></td>
                                               <td><?php if(!empty($PI->MRP)){ echo $PI->MRP;}?></td>
                                               <td><?php if(!empty($PI->quantity)){ echo $PI->quantity;}?></td>
                                               <td><?php if(!empty($PI->mrpGrossAmount)){ echo $PI->mrpGrossAmount;}?></td>
                                               <td><?php if(!empty($PI->TotalBV)){ echo $PI->TotalBV;}?></td>
                                               <td><?php if(!empty($PI->discount)){ echo $PI->discount;}else{ echo '0';}?></td>
                                               
                                               <td><?php if(!empty($PI->GrossAmount)){ echo $PI->GrossAmount;}?></td>
                                               <td><?php if(!empty($PI->CgstPercent)){ echo $PI->CgstPercent;}else{ echo '0';}?></td>
                                               <td><?php if(!empty($PI->SgstPercent)){ echo $PI->SgstPercent;}else{ echo '0';}?></td>
                                               <td><?php if(!empty($PI->IgstPercent)){ echo $PI->IgstPercent;}else{ echo '0';}?></td>
                                               <td><?php if(!empty($PI->AmountWithoutTax)){ echo $PI->AmountWithoutTax;}?></td>

                                           </tr>
                                       <?php $i++; } } ?>
                                        </tbody>
                                    </table>
                                   
                                </div>
                            </div>
                            <!--end col-->

                        </div>
                        <!--end row-->
                    </div>

                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="row mb-1">
                        <div class="col-md-10 invoicecontainer">
                            <p>Total MRP :</p>
                        </div>
                        <div class="col-md-2">
                           
                            <label class="form-label inptctrl" id="total_discount_amount"><?php if(!empty($total_amount)){ echo $total_amount;}else{ echo '0'; } ?></label>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-10 invoicecontainer">
                            <p>Total Discount Amount :</p>
                        </div>
                        <div class="col-md-2">
                           
                            <label class="form-label inptctrl" id="total_discount_amount"><?php if(!empty($total_discount)){ echo $total_discount;}else{ echo '0'; } ?></label>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-10 invoicecontainer">

                            <p>Total BV :</p>
                        </div>
                        <div class="col-md-2">
                            
                            <label class="form-label inptctrl" id="overall_bv_val"><?php if(!empty($total_BV)){ echo $total_BV;}else{ echo '0'; } ?></label>
                        </div>
                    </div>
                    <!-- end of row -->
                    <div class="row mb-1">
                        <div class="col-md-10 invoicecontainer">

                            <p>Total Gross Amount :</p>
                        </div>
                        <div class="col-md-2">
                            
                            <label class="form-label inptctrl" id="total_gross_amount"><?php if(!empty($total_gross)){ echo $total_gross;}else{ echo '0'; } ?></label>
                        </div>
                    </div>
                    <!-- end of row -->

                    
                    <!-- end of row -->

                    <div class="row mb-1">
                        <div class="col-md-10 invoicecontainer">
                            <p>Total Tax Amount :</p>
                        </div>
                        <div class="col-md-2">
                           
                            <label class="form-label inptctrl" id="total_tax_amount"><?php if(!empty($total_netamount)){ echo $total_netamount;}else{ echo '0'; } ?></label>
                        </div>
                    </div>
                    <!-- end of row -->
                    
                    <!-- end of row -->

                </div>
            </div>
        </div>
    </div>
    

</div>
<!-- container-fluid -->
