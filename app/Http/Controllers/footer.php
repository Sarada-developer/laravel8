`<!-- Modal -->  

  <div class="modal fade" id="myModal" role="dialog">  

    <div class="modal-dialog">

    

      <!-- Modal content-->

      <div class="modal-content"> 

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Customer Support</h4>

        </div>

        <div class="modal-body">

            

          <form action="<?php echo base_url() ?>Home/update1" method="post">

            <div class="form-group">

                

              <input type="hidden" id="ValID" name="Id" />

              <input type="hidden" id="PageName" name="page_name" />

                        

              <select class="form-control" id="pwd" name="customer_support">

                <option value="select">...Select...</option>

                <option value="1">Audit</option>

                <option value="2">Complaint</option>

                <option value="3">Hardship</option>

                <option value="4">Refund</option>

                <option value="5">Others</option>

              </select>

            </div>

            <div class="btn_cls">

                <button type="submit" class="btn btn-default">Update</button>   

            </div> 

            

        </form>

        </div>

        

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal" style="background: #d40303; color: #fff;">Close</button>

        </div>

      </div>

      

    </div>

  </div>

<!-- Modal End -->



<!-- Modal -->  

  <div class="modal fade" id="myModal2" role="dialog">  

    <div class="modal-dialog">

    

      <!-- Modal content-->

      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Calls</h4>

        </div>

        <div class="modal-body">

          <form action="<?php echo base_url() ?>Home/update_calls" method="post">

            <div class="form-group">

                

              <input type="hidden" id="ValIDN" name="Id" /> 

              <input type="hidden" id="PageNameN" name="page_name" />

                        

              <select class="form-control" id="pwd" name="calls">

                <option value="select">...Select...</option>

                <option value="1">Confirmation Call</option>

                <option value="2">Denial Call</option>

              </select>

            </div>

            <div class="btn_cls">

                <button type="submit" class="btn btn-default">Update</button>   

            </div>      

        </form>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal" style="background: #d40303; color: #fff;">Close</button>

        </div>

      </div>

      

    </div>

  </div>

<!-- Modal End -->



<!-- Modal -->  

  <div class="modal fade" id="myModal3" role="dialog">  

    <div class="modal-dialog">

    

      <!-- Modal content-->

      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Return</h4>

        </div>

        <div class="modal-body">

          <form action="<?php echo base_url() ?>Home/update_return" method="post">

            <div class="form-group">

                

              <input type="hidden" id="valId" name="Id" />

              <input type="hidden" id="pageName" name="page_name" />

                        

              <select class="form-control" id="returnState" name="return">

<option value="">...Select...</option>

<option value="1">Requested</option>

<option value="2">Returning</option>

<option value="3">Returned</option>

<option value="4">Reversed</option>

<option value="5">Refunded</option>

              </select>

              <br>

              <label><b>Comments:</b></label>

              <textarea class="form-control" id="returnComment" name="comments"></textarea>

            </div>

            <div class="btn_cls">

                <button type="submit" class="btn btn-default">Update</button>   

            </div>

        </form>

        <div id="cmntlist"></div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal" style="background: #d40303; color: #fff;">Close</button>

        </div>

      </div>

      

    </div>

  </div>

<!-- Modal End -->
<!-- Modal Start -->

<div class="modal fade" id="myModal4" role="dialog">  

    <div class="modal-dialog">

    

      <!-- Modal content-->

      <div class="modal-content"> 

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Customer Support</h4>

        </div>

        <div class="modal-body">

            

          <form action="<?php echo base_url() ?>home/save_patient_note" method="post">

            <div class="form-group">

                

              <input type="hidden" id="ValID" name="Id" />

              <input type="hidden" id="PageName" name="page_name" />
              <div class="form-group" style="margin-bottom:6px;">
          <label for="physician_name">Details</label>
          <textarea type="text" class="form-control input-field" id="physician_name" name="note" placeholder="Details"></textarea>
          </div>

            </div>

            <div class="btn_cls">

                <button type="submit" class="btn btn-default" style="background: #d40303; color: #fff;">Update</button>   

            </div> 

            

        </form>

        </div>

        

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal" style="background: #d40303; color: #fff;">Close</button>

        </div>

      </div>

      

    </div>

  </div>


<footer class="bg-light mt-auto">

                    <div class="container-fluid">

                        <div class="d-flex align-items-center justify-content-between small">

                            <div class="text-muted">Copyright &copy;2020 All Rights Reserved | MedeMedia </div>

                            <!-- <div>

                                <a href="#">Privacy Policy</a>

                                &middot;

                                <a href="#">Terms &amp; Conditions</a>

                            </div> -->

                        </div>

                    </div>

                </footer>

            </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

        <!--<script src="<?php echo base_url(); ?>assets/demo/chart-area-demo.js"></script>

        <script src="<?php echo base_url(); ?>assets/demo/chart-bar-demo.js"></script>-->

        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

        <script src="<?php echo base_url(); ?>assets/demo/datatables-demo.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/jquery.form-validator.min.js"></script>

    </body>

</html>