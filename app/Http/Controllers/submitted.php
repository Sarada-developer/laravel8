

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>

  .icon_i

  {

    font-size: 40px;

    color: #f58800;

    cursor: pointer;

  }

  .modal-body {

    position: relative;

    padding: 40px;

}

.modal-header {

    padding: 12px;

    border-bottom: 1px solid #e5e5e5;

    text-align: center;

    background: #e87735;

    color: #fff;

}

.modal-title {

    margin: 0;

    line-height: 1.42857143;

    font-size: 24px;

    font-weight: 700;

}

.btn_cls

{

  text-align: center;

}

.btn_cls .btn

{

    font-size: 20px;

    font-weight: 600;

    background: #4CAF50;

    color: #fff;

    padding: 6px 40px; 

}

</style>

             <main>

                    <div class="container-fluid">

                        <div class="col-md-12 p_title">

                            <h1 class="mt-4">Submitted</h1>  

                        </div>  

                        <?php if($this->session->flashdata('error')){  ?>



                            <div class="alert alert-danger">

                                <a href="#" class="close" data-dismiss="alert">&times;</a>

                                <strong>Success!</strong> <?php echo $this->session->flashdata('error'); ?>

                            </div>

                    

                        <?php } ?>           

                        <div><a href="<?php echo base_url(); ?>Home/prescriptions_form"><button type="button" class="btn btn_v btn-default"><i class="far fa-plus-square"></i> Add Prescription</button></a></div><br>

                         <div class=" mb-4">

                            

                            <div class="card-body">

                                <div class="table-responsive">

                                    <table class="table table_b_b" id="dataTable" width="100%" cellspacing="0">

                                        <thead>

                                            <tr>

                                                <th width="15%" >Received On</th>

                                                <th width="20%" >DME Provider Name</th>

                                                <th width="20%" >Physician Name</th>

                                                <th width="15%" >Patient Name</th>

                                                <th width="10%" >Phone</th>

<!--                                                 <th width="10%" >Address</th> -->

                                                <th width="5%">&nbsp;</th>

                                                <th width="5%">&nbsp;</th>

                                            </tr>

                                        </thead>

                                       

                                        <tbody>

                        

                    <tr>

                        <?php

                    

                        foreach($data as $row)

                        { 

                        ?>

                      <td> <?php echo date("m-d-Y h:i:s A", strtotime($row->added_datetime)); //echo $row->added_datetime; ?></td>

                 <td><?php echo $row->dme_provider_name; ?></td>

                      <td><?php echo $row->physician_name; ?></td>

                      <td><?php echo $row->patient_name; ?></td>

                      <td><?php echo $row->patient_phone; ?></td>

                      <!-- <td><?php echo $row->address; ?></td>                -->

  <td><a href="<?php echo base_url(); ?>Home/prescriptions_view_details?id=<?php echo $row->id ?>"><button type="Submit" name="view" class="btn btn_v btn-default">View</button></a></td> 

  <td> <a data-id="<?php echo $row->id; ?>" data-name="submitted" class="text-danger" onClick="togglePopup(<?php echo $row->id; ?>,'submitted');"  data-toggle="modal" data-target="#myModal"><i class='far fa-comments'></i></a><br>

    <?php

    if($row->customer_support_state==1)

    {

      echo "Audit";

    }

    elseif ($row->customer_support_state==2) 

    {

      echo "Complaint";

    }

    elseif ($row->customer_support_state==3) 

    {

      echo "Hardship";

    }

    elseif ($row->customer_support_state==4) 

    {

      echo "Refund";

    }

    elseif ($row->customer_support_state==5) 

    {

      echo "Other";

    }

    ?>

                    </td>              

                </tr>

                                            <?php

                                         

                                         }

                                    

                                    ?>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>



                        

                    </div>

                    

                    

                </main>

                

<script language="javascript">

  function togglePopup(e,n) {

    //alert(e);

    $('#ValID').val(e);

    $('#PageName').val(n);

}

</script>

                

