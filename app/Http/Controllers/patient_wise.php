<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.dropbtn {
  border:solid 2px #0a4098;
  color: #000;
  padding: 10px;
  font-size: 14px;
  cursor: pointer;
  border-radius:5px;
  background-color:#fff;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #0a4098;
  color: #fff;
}

.dropdown {
  float: right;
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #fff;
 min-width:180px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  right: 0;
  z-index: 100;
}

.dropdown-content a {
  color: black;
  padding:8px 10px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #86b1f8;}

.show {display: block;}

.box {
  width: 60%;
  margin: 0 auto;
  background: rgba(255,255,255,0.2);
  padding:20px;
  border: 2px solid #fff;
  border-radius: 20px/50px;
  background-clip: padding-box;
  text-align: center;
}

.button {
  font-size: 1em;
  padding: 10px;
  color: #fff;
  border: 2px solid #06D85F;
  border-radius: 20px/50px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-out;
}
.button:hover {
  background: #06D85F;
}

.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}
</style>

<main>
<div class="container-fluid">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Folders</li>
	<li class="breadcrumb-item active" aria-current="page">MedeMedia</li>
  <?php
 foreach($pfolder as $value) {
   ?> 
	<li class="breadcrumb-item active" aria-current="page"><?php echo $value->f_n; ?></li>
  <li class="breadcrumb-item active" aria-current="page"><?php echo $value->d_f_n; ?></li>
  <?php
 }
  ?>
  </ol>
</nav>
<div class="row">
<div class="col-md-8 p_title">
<h1 class="mt-4"> <span class="sb-nav-link-icon"  style="color:#ff8400;"><i class="far fa-folder"></i></span> MedeMedia</h1>  
</div>
<div class="col-md-4">
<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">More <i class="fas fa-arrow-down"></i></button>
  <div id="myDropdown" class="dropdown-content">
    <!-- <a href="">Upload</a> -->
    <a href="#popup1" >Create Folder</a>
    <!-- <a href="">Create Document</a> -->
	<!-- <a href="">Create Presentation</a> -->
	<!-- <a href="">Create Spreadsheet</a> -->
	<!-- <a href="">Create Note</a> -->
	<!-- <a href="">Create URL</a> -->
  </div>
</div>
</div>


</div>   
<br>

 <div class=" mb-4">
<div class="card-body">
<div class="table-responsive">
<table class="table table_b_b" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th width="45%" >Name</th>
<th width="5%" >#</th>
<th width="10%" >Size</th>
<th width="10%" >Uploaded</th>
<th width="10%" >Creator</th>
<th width="5%" >Note</th>
 <!--  <th width="10%" >Address</th> -->
<th width="5%"><i class="fas fa-hamburger"></i></th>
<th width="5%"><i class="fas fa-hamburger"></i></th>
</tr>
</thead>

 <tbody>
 <?php
 foreach($pfolder as $value) {
  
   ?> 
 <tr>
 <td><span><input type="checkbox" name="" id=""></span>&nbsp; &nbsp; <span class="sb-nav-link-icon" style="font-size:16px;"><i class="far fa-star"></i></span>&nbsp; &nbsp; <span class="sb-nav-link-icon" style="color:#ff8400; font-size:16px;"><a href="<?php echo base_url().'home/patient_documents/'.$value->id ?>" style="text-decoration:none;" ><i class="fas fa-folder-open"></i></span><?php echo $value->patient_folder_name; ?></a></td>

<td>(2)</td>
<td>324 KB</td>
<td><?php echo date("m-d-Y", strtotime($value->created_date)); ?></td>
<td><?php echo $value->fname; ?></td>
<!-- <td><a href="#popup2" ><i class="fas fa-sticky-note" style="color:#ff8400;"></i></a></td> -->
<td><a data-id="<?php echo $value->id; ?>" data-name="patient_wise" class="text-danger" onClick="togglePopup(<?php echo $value->id; ?>,'patient_wise');"  data-toggle="modal" data-target="#myModal4"><i class="fas fa-sticky-note" style="color:#ff8400;"></i></a></td>
<td></td> 
<td></td>              
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
 
 
<div id="popup1" class="overlay">
	<div class="popup">
		<h2>Create Folder</h2>
		<a class="close" href="#">&times;</a>
		<hr>
    <form method="post" id="frm" enctype="multipart/form-data" action="<?php echo base_url().'home/save_patient_wise'?>">
    <input type="hidden" name="direct_id" value="<?php echo $this->uri->segment(3); ?>" />

		<!-- <div class="content">
		 <div class="form-group" style="margin-bottom:6px;">
         <label for="dme_provider_name">Name</label>
         <input type="text" class="form-control input-field" id="dme_provider_name" name="folder_name" placeholder="Name">
		 </div>                         

          <div class="form-group" style="margin-bottom:6px;">
          <label for="physician_name">Details</label>
          <textarea type="text" class="form-control input-field" id="physician_name" name="details" placeholder="Details"></textarea>
          </div>
		  
		 <button type="Submit" class="btn btn_v btn-default" style="margin-top: 17px;font-size: 20px;padding: 5px 40px;  font-weight: 600;" id="submit" name="submit" value="submit">Submit</button>
                            
		</div> -->
    <div class="content">
		 <div class="form-group" style="margin-bottom:6px;">
         <label for="dme_provider_name">Select Med Folder</label>
         	<select class="form-control input-field" name="med_folder_id" id="med_folder_id" required>
				<option value="0">--Select One--</option>
				<?php foreach($folder as $value) { ?>
				  <option value="<?php echo $value->id; ?>"><?php echo $value->folder_name; ?></option>
				<?php } ?>


			</select>
		 </div>
     <div class="form-group" style="margin-bottom:6px;">
         <label for="dme_provider_name">Select Date Folder</label>
         	<select class="form-control input-field" name="date_folder_id" id="date_folder_id" required>
				<option value="0">--Select One--</option>
				<?php foreach($dfolder as $value) { ?>
				  <option value="<?php echo $value->id; ?>"><?php echo $value->date_folder_name; ?></option>
				<?php } ?>


			</select>
		 </div>
     <!-- <div class="form-group" style="margin-bottom:6px;">
         <label for="dme_provider_name">Date Folder Name</label>
         	<input type="date" class="form-control input-field" id="date_folder_id" name="date_folder_id" placeholder="Date Folder Name" required>
		 </div>   -->
		 
		 <div class="form-group" style="margin-bottom:6px;">
         <label for="dme_provider_name">Folder Name</label>
         	<input type="text" class="form-control input-field" id="patient_folder_name" name="patient_folder_name" placeholder="Date Folder Name" required>
		 </div>                         

          <div class="form-group" style="margin-bottom:6px;">
          <label for="physician_name">Details</label>
          <textarea type="text" class="form-control input-field" id="details" name="details" placeholder="Details" required></textarea>
          </div>
		  
		 <button type="Submit" class="btn btn_v btn-default" style="margin-top: 17px;font-size: 20px;padding: 5px 40px;  font-weight: 600;" id="submit" name="submit" value="submit">Submit</button>
                            
		</div>
    </form>
	</div>
</div>


<!-- <div id="popup2" class="overlay">
	<div class="popup">
		<h2>Note</h2>
		<a class="close" href="#">&times;</a>
		<hr>
    <form method="post" id="frm" enctype="multipart/form-data" action="<?php echo base_url().'home/save_patient_note'?>">
    <input type="hidden" name="direct_id" value="<?php echo $this->uri->segment(3); ?>" />
		<div class="content">
		 <div class="form-group" style="margin-bottom:6px;">
         <label for="dme_provider_name">Name</label>
         <input type="text" class="form-control input-field" id="patient_name" name="patient_name" placeholder="Name">
		 </div>                         

          <div class="form-group" style="margin-bottom:6px;">
          <label for="physician_name">Details</label>
          <textarea type="text" class="form-control input-field" id="physician_name" name="note" placeholder="Details"></textarea>
          </div>
		  
		 <button type="Submit" class="btn btn_v btn-default" style="margin-top: 17px;font-size: 20px;padding: 5px 40px;  font-weight: 600;" id="submit" name="submit" value="submit">Submit</button>
                            
		</div>
    </form>
	</div>
</div> -->
 
 
</main>




<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}


  function togglePopup(e,n) {

    // alert(e);

    $('#ValiD').val(e);

    $('#Pagename').val(n);

}



</script>
