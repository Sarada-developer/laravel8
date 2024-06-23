<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="<?php echo base_url().'Home/dashboard' ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-folder"></i></div>
                                Dashboard
                            </a>
							 <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="far fa-folder"></i></div>
                                Folders
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url().'Home/shared_folders' ?>"><span>Shared Folders</span></a>                                  
                                </nav>
                            </div> 

                            
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts_9" aria-expanded="false" aria-controls="collapseLayouts_9">
<div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Vendor Management
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
    <div class="collapse" id="collapseLayouts_9" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
            
            <a class="nav-link" href="<?php echo base_url().'Home/user_list' ?>"><span>Vendor</span></a>
            <a class="nav-link" href="<?php echo base_url().'Home/profit_sharing_vendor' ?>">
                     <span>Profit Sharing Vendor</span></a>
                                </nav>
                            </div>
                            <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts_1" aria-expanded="false" aria-controls="collapseLayouts_1">
                                <div class="sb-nav-link-icon"><i class="far fa-file-alt"></i></div>
                                Prescriptions
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts_1" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url().'Home/submitted' ?>"><span>Submitted</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/eligibility' ?>"><span>Eligibility</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/pre_cert' ?>"><span>Pre-Cert</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/compliance' ?>"><span>Compliance</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/certified' ?>"><span>Certified</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/logistics' ?>"><span>Logistics</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/fulfillment' ?>"><span>Fulfillment</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/billing' ?>"><span>Billing</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/posting' ?>"><span>Posting</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/review' ?>"><span>Review</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/rebill' ?>"><span>Rebill</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/paid' ?>"><span>Paid</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/secondary_pending' ?>"><span>Secondary Pending</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/secondary_paid' ?>"><span>Secondary Paid</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/problems' ?>"><span>Problems</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/eligible_refills' ?>"><span>Eligible Refills</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/third_party' ?>"><span>Third-Party</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/rescript' ?>"><span>Rescript</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/denied' ?>"><span>Denied</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/all_prescriptions' ?>"><span>All Prescriptions</span></a>
                                </nav>
                            </div>  -->

                            <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts_2" aria-expanded="false" aria-controls="collapseLayouts_2">
                                <div class="sb-nav-link-icon"><i class="far fa-comments"></i></div>
                                Customer Support
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts_2" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url().'Home/audit' ?>"><span>Audit</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/complaint' ?>"><span>Complaint</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/hardship' ?>"><span>Hardship</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/refund' ?>"><span>Refund</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/other' ?>"><span>Other</span></a>
                                </nav>
                            </div> -->

                           <!-- <a class="nav-link" href="404.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-check-circle"></i></div>
                                Proof of Delivery
                            </a>-->

                            <!-- <a class="nav-link" href="<?php echo base_url().'Home/confirmation_call' ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-phone-alt"></i></div>
                               Confirmation Call
                            </a>

                            <a class="nav-link" href="<?php echo base_url().'Home/denial_call' ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-phone-slash"></i></div>
                               Denial Call
                            </a>
                             
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts_6" aria-expanded="false" aria-controls="collapseLayouts_6">
                                <div class="sb-nav-link-icon"><i class="fas fa-exchange-alt"></i></div>
                                Returns
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts_6" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url().'Home/return_requested' ?>">
                                        <span>Requested</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/returning' ?>"><span>Returning</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/returned' ?>"><span>Returned</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/reversed' ?>"><span>Reversed</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/refunded' ?>"><span>Refunded</span></a>
                                </nav>
                            </div> 

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts_7" aria-expanded="false" aria-controls="collapseLayouts_7">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-bar mr-1"></i></div>
                                Reports
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts_7" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url().'Home/patient_reports' ?>"><span>Patient Reports</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/product_reports' ?>"><span>Product Reports</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/group_reports' ?>"><span>Group Reports</span></a>
                                </nav>
                            </div> 

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts_8" aria-expanded="false" aria-controls="collapseLayouts_8">
                                <div class="sb-nav-link-icon"><i class="fas fa-dollar-sign"></i></div>
                                Payments
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts_8" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url().'Home/patient_statement' ?>">
                                    <span>Patient Statement</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/cheque' ?>"><span>Cheque</span></a>
                                    <a class="nav-link" href="<?php echo base_url().'Home/adjustment' ?>"><span>Adjustments</span></a>
                                </nav>
                            </div>  -->
     <!-- <?php
     if($this->session->userdata('role')=='admin')
     {
        ?>                  
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts_9" aria-expanded="false" aria-controls="collapseLayouts_9">
<div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Vendor Management
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
    <div class="collapse" id="collapseLayouts_9" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
            
            <a class="nav-link" href="<?php echo base_url().'Home/user_list' ?>"><span>Vendor</span></a>
            <a class="nav-link" href="<?php echo base_url().'Home/profit_sharing_vendor' ?>">
                     <span>Profit Sharing Vendor</span></a>
                                </nav>
                            </div>
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts_11" aria-expanded="false" aria-controls="collapseLayouts_11">
<div class="sb-nav-link-icon"><i class="fas fa-search-dollar"></i></div>
                                Price Assignment
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
    <div class="collapse" id="collapseLayouts_11" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="<?php echo base_url().'Home/bracetype1' ?>">
                     <span> Brace Type 1</span></a>
            <a class="nav-link" href="<?php echo base_url().'Home/bracetype2' ?>"><span> Brace Type 2</span></a>
            
                                </nav>
                            </div>
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts_10" aria-expanded="false" aria-controls="collapseLayouts_10">
<div class="sb-nav-link-icon"><i class="fas fa-briefcase-medical"></i></div>
                                Brace Type
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
    <div class="collapse" id="collapseLayouts_10" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="<?php echo base_url().'Home/brace_type_1' ?>">
                     <span> Brace Type 1</span></a>
            <a class="nav-link" href="<?php echo base_url().'Home/brace_type_2' ?>"><span> Brace Type 2</span></a>
            
                                </nav>
                            </div>
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts_12" aria-expanded="false" aria-controls="collapseLayouts_12">
<div class="sb-nav-link-icon"><i class="fas fa-map-marker-alt"></i></div>
                             Location Management
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
    <div class="collapse" id="collapseLayouts_12" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="<?php echo base_url().'Home/state_list' ?>">
                     <span>State</span></a>
            <a class="nav-link" href="<?php echo base_url().'Home/city_list' ?>"><span>City</span></a>
            
                                </nav>
                            </div> 
                            <a class="nav-link" href="<?php echo base_url().'Home/show_tickets' ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-ticket-alt"></i></div>
                               Tickets
                            </a>
                              <?php
                              }
                            
     if($this->session->userdata('role')!='admin')
     {
        ?>   
        <a class="nav-link" href="<?php echo base_url().'Home/ticket_details' ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-ticket-alt"></i></div>
                               Ticket
                            </a>
                            <?php
                              }
                            ?> 
                            
                            
                            
                        </div>
                    </div> -->
                    <!-- <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div> -->
                </nav>
            </div>

            <div id="layoutSidenav_content">