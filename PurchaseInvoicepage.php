<div class="container-fluid mt-4">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Purchase Invoice</h4>

                <div class="page-title-right">
                    <?php //if($this->rbac->display_operation('materialcategory','addMaterialCategory')){?>
                    <!-- <a href="<?php echo base_url();?>purchaseorder/addpurchaseinvoice" class="btn btn-secondary btn-sm btn-gradient waves-effect waves-light" ><span><i data-feather="plus"></i> Add Purchase Invoice</span></a> -->
                    <?php //} ?>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Search Purchase Invoice</h4>
                    <div class="flex-shrink-0 d-none">
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="live-preview">
                        <form action="#" method="post">
                        <div class="row gy-4">
                        <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div>
                                    <label for="category_name" class="form-label ">Invoice Number</label>
                                    <input type="text" class="form-control" id="category_name"  name="category_name">
                                    <span class="text-danger small" id="category_name_error"></span>
                                </div>
                            </div>
                            
                            <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div>
                                    <label for="category_name" class="form-label ">GR Number</label>
                                    <input type="text" class="form-control" id="category_name"  name="category_name">
                                    <span class="text-danger small" id="category_name_error"></span>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div>
                                    <label for="category_name" class="form-label ">PO Number</label>
                                    <input type="text" class="form-control" id="category_name"  name="category_name">
                                    <span class="text-danger small" id="category_name_error"></span>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div>
                                    <label for="category_name" class="form-label ">From Date</label>
                                    <input type="date" class="form-control" id="date"  name="date">
                                    <span class="text-danger small" id="category_name_error"></span>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div>
                                    <label for="category_name" class="form-label ">To Date</label>
                                    <input type="date" class="form-control" id="date"  name="date">
                                    <span class="text-danger small" id="category_name_error"></span>
                                </div>
                            </div>                           

                            <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div>
                                    <label for="category_name" class="form-label">Status</label>
                                    <select class="form-control" name="category_status">
                                        <option value="">--status--</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    <span class="text-danger small" id="category_name_error"></span>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div class= "mt-4">
                                    <label for="category_name" class="form-label mt-3"></label>
                                    <button type="submit" class="btn btn-success btn-sm search_btn" name="search_material_category">Search</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
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
                    <div class="flex-shrink-0 d-none">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <label for="hover-rows-showcode" class="form-label text-muted">Show Code</label>
                            <input class="form-check-input code-switcher" type="checkbox" id="hover-rows-showcode">
                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">PI Number</th>
                                                <th scope="col">GR Number</th>
                                                <th scope="col">PO Number</th>
                                                <th scope="col">Stockist Name</th>
                                                <th scope="col">Requested date </th>
                                                <th scope="col">Amount</th>                                        
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($purchase_invoice)){ foreach($purchase_invoice as $k){ ?>
                                            <tr>
                                                <td><?php if(!empty($k->purchaseInvoiceNum)){ echo $k->purchaseInvoiceNum;}?></td>
                                                <td><?php if(!empty($k->GRNNo)){ echo $k->GRNNo;}?></td>
                                                <td><?php if(!empty($k->PoRefNo)){ echo $k->PoRefNo;}?></td>
                                                <td><?php if(!empty($k->toCustomerName)){ echo $k->toCustomerName;}?></td>
                                                <td><?php if(!empty($k->invoiceDate)){ echo date('Y-m-d',strtotime($k->invoiceDate));}?></td>
                                                <td><?php if(!empty($k->totalNetAmount)){ echo $k->totalNetAmount;}?></td>
                                                <td><?php if(!empty($k->status)){ echo $k->status;}?></td>
                                                    
                                                <td>
                                                    <a href="<?php echo base_url();?>purchaseinvoice/viewPurchaseInvoice/<?php echo $this->common_model->encode($k->id);?>"><i class="ri-eye-fill fs-17 lh-1 align-middle"></i></a> 
                                                </td>
                                            </tr>
                                        <?php } } else{ ?>
                                            <tr>
                                                <td align="center" colspan="8">No Records Found</td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    
                                    <nav class="mt-3 d-block">
                                        <?php echo $this->pagination->create_links(); ?>
                                    </nav>
                                </div>
                            </div>
                            <!--end col-->

                        </div>
                        <!--end row-->
                    </div>
                    
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>

</div>
<!-- container-fluid -->