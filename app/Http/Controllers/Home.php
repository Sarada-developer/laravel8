<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_controller
{
	public function __construct()  
	{
		parent::__construct();	  
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('My_model');
		if($this->session->userdata('user_id') == '' || $this->session->userdata('name') == '') {
			$this->session->set_flashdata('error', 'You have to login to access this page!');
			redirect(base_url().'login');
		}	  
	} 
	 
	public function index()
	{
		$this->load->view('login');
		// $result['data'] = $this->My_model->getState();
		// $this->load->view('prescriptions-form',$result);
	}	
	public function prescriptions_form()
	{
		$result['data1'] = $this->My_model->getState();
		$result['data2']=$this->My_model->service_type();
		$result['data3']=$this->My_model->brace_type1();
		$result['data4']=$this->My_model->brace_type2();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('prescriptions-form',$result);	
		$this->load->view('include/footer');
	}
	
	
	

	 // function state()

  //   {
  //   	$results['data'] = $this->My_model->getState();
		// $this->load->view('prescriptions-form',$results);
  //   }
    
   public function get_city(){ 

		$s_id['sid'] = $this->input->post('state_id');
		//echo $s_id['sid']; die;
		$this->load->view('GetCity',$s_id);
	}
	
	public function get_cmnt(){

		$s_id['sid'] = $this->input->post('form_id');
		//echo $s_id['sid']; die;
		$this->load->view('GetCmnt',$s_id);
	}
	
	public function savedata()
	{
		if($this->input->POST('submit'))
		{  
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    $date1=date('Y-m-d H:i:s');
		    $date2=date('Y-m-d H:i:s');
		    $flag=0;
		    $customer_support=0;
		    $calls=0;
		    $return=0;
		    // $img=$this->input->POST('chooseFile');
		
			// $gen=implode(",", $g);
			// $mar=implode(",", $h);

			

		if(is_uploaded_file($_FILES["chooseFile"]["tmp_name"]))
		{
			//$file_name = uniqid(rand()).$_FILES["chooseFile"]["name"];
			//$file_path="upload/".$file_name;
			//move_uploaded_file($_FILES["chooseFile"]["tmp_name"],$file_path) or die("Failed to upload");
			//$img = $file_name;
			
			//========================= Start Image For Thumbnel Converting ===============================================
			$prod_fullimage = uniqid(rand()).$_FILES["chooseFile"]["name"];
			
			list($temp_width,$temp_height) = @getimagesize($prod_fullimage);
			
			$tag = "width";
			$Twidth = 407;
			$Theight = '';
			$uploadthumbdir = "upload/thumbnail/";
			$this->thumbnail($uploadthumbdir.$prod_fullimage,$_FILES['chooseFile']['tmp_name'],$Twidth,$Theight,$tag);
			
	//========================== End Image For Thumbnel Converting ===============================================
			
			move_uploaded_file($_FILES['chooseFile']['tmp_name'], "upload/$prod_fullimage")or die("Failed to upload");
			$img = $prod_fullimage;
			
		}
		else
		{
			$img ='';
		}
			
		$this->My_model->saverecords($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p,$q,$r,$s,$t,$u,$v,$w,$x,$y,$z,$img,$date1,$date2,$flag,$customer_support,$calls,$return);
		redirect('home/submitted');	

	}
  }

function thumbnail($filethumb,$file,$Twidth,$Theight,$tag)
{
	list($width,$height,$type,$attr)=getimagesize($file);
	switch($type)
	{
		case 1:
			$img = imagecreatefromgif($file);
		break;
		case 2:
			$img=imagecreatefromjpeg($file);
		break;
		case 3:
			$img=imagecreatefrompng($file);
		break;
	}
	if($tag == "width") //width contraint
	{
		$Theight=round(($height/$width)*$Twidth);
	}
	elseif($tag == "height") //height constraint
	{
		$Twidth=round(($width/$height)*$Theight);
	}
	else
	{
		if($width > $height)
			$Theight=round(($height/$width)*$Twidth);
		else
			$Twidth=round(($width/$height)*$Theight);
	}
	$thumb=imagecreatetruecolor($Twidth,$Theight);
	
	if(imagecopyresampled($thumb,$img,0,0,0,0,$Twidth,$Theight,$width,$height))
	{
		
		switch($type)
		{
			case 1:
				imagegif($thumb,$filethumb);
			break;
			case 2:
				imagejpeg($thumb,$filethumb);
			break;
			case 3:
				imagepng($thumb,$filethumb);
			break;
		}
		chmod($filethumb,0666);
		return true;
	}
}
public function shared_folders()
{	
	$this->load->view('include/header');
	$this->load->view('include/menu');
	$this->load->view('share_folders');
	$this->load->view('include/footer');
}

public function billed()
{	
	$this->load->view('include/header');
	$this->load->view('include/menu');
	$result['folder']=$this->My_model->getAllMedFloder();
	$this->load->view('billed',$result);
	$this->load->view('include/footer');
}

// start work by naba on 11.05.2021
public function date_wise($id)
{	
	$this->load->view('include/header');
	$this->load->view('include/menu');
	$result['folder_name']=$this->My_model->getFolderName($id);
	$result['dfolder'] = $this->My_model->getAllDateFolder($id);
	$result['folder'] = $this->My_model->getFolder();
	$this->load->view('date_wise',$result);	
	$this->load->view('include/footer');
}


public function save_date_wise()
{	
	if($this->input->POST('submit'))
	{  
		$direct_id=$this->input->POST('direct_id');
		//echo "<pre>"; print_r($_REQUEST); die;
		$med_folder_id=$this->input->POST('med_folder_id');
		//$date_folder_name=$this->input->POST('date_folder_name');
		$dateArr = explode("-",$this->input->POST('date_folder_name'));
		$date_folder_name = $dateArr[1].$dateArr[2].$dateArr[0];
		//echo "<pre>"; print_r($dateArr); die;
		$details=$this->input->POST('details');
		$user_id=$this->session->userdata('user_id');
		
		$this->My_model->save_date_wise_data($med_folder_id,$date_folder_name,$details,$user_id);
		redirect('home/date_wise/'.$direct_id);	
	}
}
// end work by naba on 11.05.2021
public function save_med_folder()
{
	if($this->input->POST('submit'))
	{		
		$direct_id=$this->input->POST('direct_id');
		$folder_name=$this->input->POST('folder_name');
		$details=$this->input->POST('details');
		$user_id=$this->session->userdata('user_id');
		// echo "<pre>";
		// echo $user_id;
		// die;

		$this->My_model->save_med_folder($folder_name,$details,$user_id);
		redirect('home/billed/'.$direct_id);
	}
}

public function save_patient_wise()
{
	if($this->input->POST('submit'))
	{	
		$direct_id=$this->input->POST('direct_id');
		$med_folder_id=$this->input->POST('med_folder_id');
		$date_folder_id=$this->input->POST('date_folder_id');
		$patient_folder_name=$this->input->POST('patient_folder_name');
		$details=$this->input->POST('details');
		$user_id=$this->session->userdata('user_id');
		$this->My_model->save_patient_folder($med_folder_id,$date_folder_id,$patient_folder_name,$details,$user_id);
		redirect('home/patient_wise/'.$direct_id);
	}
}

public function save_patient_note()
{
	$direct_id=$this->input->POST('direct_id');
		$id=$this->input->POST('Id');
		$page_name=$this->input->POST('page_name');
		$patient_note=$this->input->POST('note');

		$this->My_model->save_patient_note($id,$patient_note);
		redirect('home/patient_wise/'.$direct_id);
	
}
public function save_patient_document_note()
{
	$direct_id=$this->input->POST('direct_id');
		$id=$this->input->POST('Id');
		$page_name=$this->input->POST('page_name');
		$patient_note=$this->input->POST('note');

		$this->My_model->save_patient_document_note($id,$patient_note);
		redirect('home/patient_documents/'.$direct_id);
	
}
public function save_date_note()
{
	$direct_id=$this->input->POST('direct_id');
		$id=$this->input->POST('Id');
		$page_name=$this->input->POST('page_name');
		$patient_note=$this->input->POST('note');

		$this->My_model->save_date_note($id,$patient_note);
		redirect('home/date_wise/'.$direct_id);
	
}


public function patient_wise($id)
{	
	
	$this->load->view('include/header');
	$this->load->view('include/menu');
	$result['folder']=$this->My_model->getFolder();
	$result['dfolder']=$this->My_model->getDateFolder();
	$result['pfolder']=$this->My_model->getAllPatientFolder($id);
	
	$result['foldernm']=$this->My_model->getBcrumFolderName($id);
	//echo "<pre>"; print_r($result['foldernm']); die;
	$this->load->view('patient_wise',$result);
	$this->load->view('include/footer');
}

public function patient_documents($id)
{	
	$this->load->view('include/header');
	$this->load->view('include/menu');
	$result['docfolder'] = $this->My_model->getAllDocFolder($id);
	$result['folder'] = $this->My_model->getFolder();
	$result['dfolder'] = $this->My_model->getaDateFolder();
	$result['pfolder'] = $this->My_model->getPatientFolder();
	
	$result['foldernm']=$this->My_model->getBcrumFolderPName($id);
	$this->load->view('patient_documents',$result);	
	$this->load->view('include/footer');
}

public function save_upload_files()
{	
	if($this->input->POST('submit'))
	{  
		//echo "<pre>"; print_r($_REQUEST); die;
		$direct_id=$this->input->POST('direct_id');
		$med_folder_id=$this->input->POST('med_folder_id');
		$med_date_folder_id=$this->input->POST('med_date_folder_id'); 
		$patient_folder_id=$this->input->POST('patient_folder_id');
		//$details=$this->input->POST('details');
		$user_id=$this->session->userdata('user_id');
		
		if(is_uploaded_file($_FILES["chooseFile"]["tmp_name"]))
		{

		//========================= Start Image For Thumbnel Converting ===============================================
			$prod_fullimage = rand().$_FILES["chooseFile"]["name"];
			
			/*list($temp_width,$temp_height) = @getimagesize($prod_fullimage);
			
			$tag = "width";
			$Twidth = 407;
			$Theight = '';
			$uploadthumbdir = "upload/thumbnail/";
			$this->thumbnail($uploadthumbdir.$prod_fullimage,$_FILES['chooseFile']['tmp_name'],$Twidth,$Theight,$tag);*/
			
		//========================== End Image For Thumbnel Converting ===============================================
			
			move_uploaded_file($_FILES['chooseFile']['tmp_name'], "upload/patient_doc/$prod_fullimage")or die("Failed to upload");
			$file_name = $prod_fullimage;
			
		}
		else
		{
			$file_name ='';
		}
		
		
		$this->My_model->save_upload_files_data($med_folder_id,$med_date_folder_id,$patient_folder_id,$file_name,$user_id);
		redirect('home/patient_documents/'.$direct_id);	
	}
}

public function submitted()
	{	
		$result['data']=$this->My_model->displayRecords();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('submitted',$result);
		$this->load->view('include/footer');

	}
	public function eligibility()
	{	
		$result['data']=$this->My_model->displayRecords1();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('eligibility',$result);
		$this->load->view('include/footer');
	}
	
	public function pre_cert()
	{	
		$result['data']=$this->My_model->displayRecords2();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('pre-cert',$result);
		$this->load->view('include/footer');
	}
	public function compliance()
	{	
		$result['data']=$this->My_model->displayRecords3();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('compliance',$result);
		$this->load->view('include/footer');
	}
	public function certified()
	{
		$result['data']=$this->My_model->displayRecords4();

		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('certified',$result);
		$this->load->view('include/footer');
	}
	
	public function logistics()
	{
		$result['data']=$this->My_model->displayRecords5();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('logistics',$result);
		$this->load->view('include/footer');
	}
	public function fulfillment()
	{
		$result['data']=$this->My_model->displayRecords6();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('fulfillment',$result);
		$this->load->view('include/footer');
	}
	public function billing()
	{
		$result['data']=$this->My_model->displayRecords8();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('billing',$result);
		$this->load->view('include/footer');
	}
	public function posting()
	{
		$result['data']=$this->My_model->displayRecords10();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('posting',$result);
		$this->load->view('include/footer');
	}
	public function paid()
	{
		$result['data']=$this->My_model->displayRecords11();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('paid',$result);
		$this->load->view('include/footer');
	}
	
	public function denied()
	{	
		$result['data']=$this->My_model->displayRecords7();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('denied',$result);
		$this->load->view('include/footer');
	}
	public function review()
	{
		$result['data']=$this->My_model->displayRecords13();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('review',$result);
		$this->load->view('include/footer');
	}
	public function rebill()
	{
		$result['data']=$this->My_model->displayRecords14();
		$this->load->view('include/header');
		$this->load->view('include/menu'); 
		$this->load->view('rebill',$result);
		$this->load->view('include/footer');
	}
	public function secondary_pending()
	{
		$result['data']=$this->My_model->displayRecords15();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('secondary-pending',$result);
		$this->load->view('include/footer');
	}
	public function secondary_paid()
	{
		$result['data']=$this->My_model->displayRecords16();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('secondary-paid',$result);
		$this->load->view('include/footer');
	}
	public function problems()
	{
		$result['data']=$this->My_model->displayRecords17();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('problems',$result);
		$this->load->view('include/footer');
	}
	public function eligible_refills()
	{
		$result['data']=$this->My_model->displayRecords18();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('eligible_refills',$result);
		$this->load->view('include/footer');
	}
	public function third_party()
	{
		$result['data']=$this->My_model->displayRecords19();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('third-party',$result);
		$this->load->view('include/footer');
	}
	public function rescript()
	{
		$result['data']=$this->My_model->displayRecords20();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('rescript',$result);
		$this->load->view('include/footer');
	}
	public function all_prescriptions()
	{
		$result['data']=$this->My_model->displayRecords12();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('all-prescriptions',$result);
		$this->load->view('include/footer');
	}
	public function audit()
	{
		$result['data']=$this->My_model->displayRecord1();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('audit',$result);
		$this->load->view('include/footer');
	}
	public function complaint()
	{	$result['data']=$this->My_model->displayRecord2();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('complaint',$result);
		$this->load->view('include/footer');
	}
	public function hardship()
	{ 	$result['data']=$this->My_model->displayRecord3();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('hardship',$result);
		$this->load->view('include/footer');
	}
	public function refund()
	{	$result['data']=$this->My_model->displayRecord4();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('refund',$result);
		$this->load->view('include/footer');
	}
	public function other()
	{	$result['data']=$this->My_model->displayRecord5();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('other',$result);
		$this->load->view('include/footer');
	}
		public function confirmation_call()
	{   
		$result['data']=$this->My_model->showRecord1();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('confirmation-call',$result);
		$this->load->view('include/footer');
	}
	public function denial_call()
	{
		$result['data']=$this->My_model->showRecord2();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('denial-call',$result);
		$this->load->view('include/footer');
	}
	public function return_requested()
	{
		$result['data']=$this->My_model->return_requested();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('return-requested',$result);
		$this->load->view('include/footer');
	}
	public function returning()
	{ 
		$result['data']=$this->My_model->returning();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('returning',$result);
		$this->load->view('include/footer');
	}
	public function returned()
	{
		$result['data']=$this->My_model->returned();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('returned',$result);
		$this->load->view('include/footer');
	}
	public function reversed()
	{
		$result['data']=$this->My_model->reversed();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('reversed',$result);
		$this->load->view('include/footer');
	}
	public function refunded()
	{
		$result['data']=$this->My_model->refunded();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('refunded',$result);
		$this->load->view('include/footer');

	}
	public function patient_reports()
	{ 
	 $result['data1'] = $this->My_model->getState();
    $result['data2'] = $this->My_model->brace_type1();
    $result['data3'] = $this->My_model->brace_type2();
    $start_date=$this->input->post('start_date');
	 $end_date=$this->input->post('end_date');
	    $status=$this->input->post('status');
	    $return_state=$this->input->post('return');
	    $doctor=$this->input->post('doctor');
	     $state=$this->input->post('state');
	     $brace_type1=$this->input->post('brace_type1');
	     $brace_type2=$this->input->post('brace_type2');

	     if(((isset($start_date) && $start_date<>'') && (isset($end_date) && $end_date<>'')) || (isset($status) && $status<>'' ) || (isset($return_state) && $return_state<>'' ) || (isset($doctor)) && $doctor<>''  || (isset($state) && $state<>'')  || (isset($brace_type1) && $brace_type1<>'')  || (isset($brace_type2) && $brace_type2<>''))
	     {
        $result['data']=$this->My_model->show_options($start_date,$end_date,$status,$return_state,$doctor,$state,$brace_type1,$brace_type2);
        
	    }
	    
	    else
	    {
	    	 
		$result['data']=$this->My_model->displayRecords12();
	
	}
	$result['start_date']=$start_date;
	$result['end_date']=$end_date;
	$result['status']=$status;
	$result['return_state']=$return_state;
	$result['doctor']=$doctor;
	$result['stat']=$state;
	$result['brace_type1']=$brace_type1;
	$result['brace_type2']=$brace_type2;
	$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('patient-reports',$result);
		$this->load->view('include/footer');
	}
	public function product_reports()
	{
		$result['data1'] = $this->My_model->getState();
		$result['data2'] = $this->My_model->brace_type1();
    $result['data3'] = $this->My_model->brace_type2();
	    
	$start_date=$this->input->post('start_date');
	 $end_date=$this->input->post('end_date');
	    $status=$this->input->post('status');
	    $return_state=$this->input->post('return');             
	    $doctor=$this->input->post('doctor');
	     $state=$this->input->post('state');
	     $brace_type1=$this->input->post('brace_type1');
	     $brace_type2=$this->input->post('brace_type2');

	     if(((isset($start_date) && $start_date<>'') && (isset($end_date) && $end_date<>'')) || (isset($status) && $status<>'' ) || (isset($return_state) && $return_state<>'' ) || (isset($doctor)) && $doctor<>''  || (isset($state) && $state<>'')  || (isset($brace_type1) && $brace_type1<>'')  || (isset($brace_type2) && $brace_type2<>''))
	     {
        $result['data']=$this->My_model->show_options($start_date,$end_date,$status,$return_state,$doctor,$state,$brace_type1,$brace_type2);
       
	    }
	    else
	    {
		
		$result['data']=$this->My_model->displayRecords12();
	}
		
	$result['start_date']=$start_date;
	$result['end_date']=$end_date;
	$result['status']=$status;
	$result['return_state']=$return_state;
	$result['doctor']=$doctor;
	$result['stat']=$state;
	$result['brace_type1']=$brace_type1;
	$result['brace_type2']=$brace_type2;
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('product-reports',$result);
		$this->load->view('include/footer');
	

		
	}
	public function group_reports()
	{
	    $result['data2'] = $this->My_model->brace_type1();
        $result['data3'] = $this->My_model->brace_type2();
    
        $denied=$this->My_model->denied_no();
        $returned=$this->My_model->returned_no();

        $start_date=$this->input->post('start_date');
	    $end_date=$this->input->post('end_date');
	    $brace_type1=$this->input->post('brace_type1');
	    $brace_type2=$this->input->post('brace_type2');

	  if(((isset($start_date) && $start_date<>'') && (isset($end_date) && $end_date<>'')) || (isset($brace_type1) && $brace_type1<>'')  || (isset($brace_type2) && $brace_type2<>''))
	     {
            $count=$this->My_model->group_result($start_date,$end_date,$brace_type1,$brace_type2);
		    //$result['count1']=($denied * $count)/100;
		    //$result['count2']=($returned * $count)/100;
		    $result['count1']=($count * 100) / $denied;
		    $result['count2']=($count * 100) / $returned;
			}
			else
			{
			$count=$this->My_model->group_result($start_date,$end_date,$brace_type1,$brace_type2);
		    //$result['count1']=($denied * $count)/100;
		    //$result['count2']=($returned * $count)/100;	
		    $result['count1']=($count * 100) / $denied;
		    $result['count2']=($count * 100) / $returned;
			}

	    $result['start_date']=$start_date;
	    $result['end_date']=$end_date;
	    $result['brace_type1']=$brace_type1;
	    $result['brace_type2']=$brace_type2;
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('group-reports',$result);
		$this->load->view('include/footer');
		}
		public function patient_statement()

	{ 
		$result['data']=$this->My_model->patient_statement();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('patient-statement',$result);
		$this->load->view('include/footer');
	}
	public function patient_statement_form()

	{

        $result['data1']=$this->My_model->brace_type1();
		$result['data2']=$this->My_model->brace_type2();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('patient-statement-form',$result);	
		$this->load->view('include/footer');
	}

	public function patient_statement_save()
	{
		if($this->input->POST('submit'))
		{
	    $patient_name=$this->input->POST('patient_name');
		$brace_type1=$this->input->POST('brace_type1');
		$brace_type2=$this->input->POST('brace_type2');
		$payment_status=$this->input->POST('payment_status');
		$payment_details=$this->input->POST('payment_details');
		$amount1=$this->input->POST('cash_amount');
		$amount2=$this->input->POST('cheque_amount');
		$cheque_number=$this->input->POST('cheque_number');
		$provider_npi=$this->input->POST('provider_npi');
		if($amount1=='')
		{
		$amount=$amount2;
	 	}
	 	else
	 	{
		$amount=$amount1;
		}
		
		$date1=date('Y-m-d H:i:s');
		$date2=date('Y-m-d H:i:s');
	

$this->My_model->patient_statement_save($patient_name,$brace_type1,$brace_type2,$payment_status,$payment_details,$amount,$cheque_number,$provider_npi,$date1,$date2);
redirect('home/patient_statement');
	}
	}	
	function patient_statement_details()
	{
		$this->load->view('include/header');
		$this->load->view('include/menu');

	    $id=$this->input->get('id');
$result['data']=$this->My_model->patient_statement_details($id);
$this->load->view('patient_statement_details',$result);
	    $this->load->view('include/footer');
if($this->input->post('view'))
	{
		 $patient_name=$this->input->POST('patient_name');
		$brace_type1=$this->input->POST('brace_type1');
		$brace_type2=$this->input->POST('brace_type2');
		$payment_status=$this->input->POST('payment_status');
		$payment_details=$this->input->POST('payment_details');
		$amount=$this->input->POST('amount');
		$cheque_number=$this->input->POST('cheque_number');
		$provider_npi=$this->input->POST('provider_npi');
		redirect('home/patient_statement_details');

	}
	}
	public function cheque()
	{
		$result['data']=$this->My_model->cheque_details();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('cheque',$result);
		$this->load->view('include/footer');
	}
	public function adjustment()

	{ 
		$result['data']=$this->My_model->returned();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('adjustment',$result);
		$this->load->view('include/footer');
	}

	public function prescriptions_view_details()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details1()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details1',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details1');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details2()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details2',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details2');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details3()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details3',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details3');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details4()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details4',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details4');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details5()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details5',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details5');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details6()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details6',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details6');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details7()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details7',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details7');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details8()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details8',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details8');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details9()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details9',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details9');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details10()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details10',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details10');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details11()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details11',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details11');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details12()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details12',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details12');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details13()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details13',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details13');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details14()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details14',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details14');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details15()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details15',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details15');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details16()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details16',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details16');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details17()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details17',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details17');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details18()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details18',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details18');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details19()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details19',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details19');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details20()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
	//echo $id;
	    if($this->input->POST('submit'))
	    {
	    	$id=$this->input->POST('id');
$adjustment_value=$this->input->POST('adjustment_value');
 $this->My_model->adjustment_val($adjustment_value,$id);
 redirect('Home/adjustment');
			}
	
	$result['data']=$this->My_model->displayrecordsById($id);
	$this->load->view('prescriptions-view-details20',$result);
	$this->load->view('include/footer');
	if($this->input->post('view'))
	{
			$a=$this->input->POST('dme_provider_name');
			$b=$this->input->POST('physician_name');
		    $c=$this->input->POST('physician_ipn_number');
			$d=$this->input->POST('patient_name');
			$e=$this->input->POST('patient_phone');
			$f=$this->input->POST('date_of_birth');
			$g=$this->input->POST('gender');
			$h=$this->input->POST('marital_status');
            $i=$this->input->POST('address');
            $j=$this->input->POST('state');
            $k=$this->input->POST('city');
            $l=$this->input->POST('zip_code');
            $m=$this->input->POST('jurisdiction');
			$n=$this->input->POST('service_type');
		    $o=$this->input->POST('brace_type1');
			$p=$this->input->POST('brace_code1');
			$q=$this->input->POST('brace_type2');
			$r=$this->input->POST('brace_code2');
			$s=$this->input->POST('policy_holder');
            $t=$this->input->POST('insurance_type');
            $u=$this->input->POST('insurance_id');
            $v=$this->input->POST('height');
            $w=$this->input->POST('weight');
            $x=$this->input->POST('waist_size');
			$y=$this->input->POST('shoe_size');
		    $z=$this->input->POST('extra_notes');
		    
		if(is_uploaded_file($_FILES['images']['tmp_name']))
		{
			$file_path="upload/".uniqid(rand()).$_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"],["tmp_name"],$file_path);
			// $this->insert_data->updaterecords($n,$a,$e,$file_path,$id);
			//$this->load->view('Message');
			redirect('Home/prescriptions_view_details20');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	}
	public function prescriptions_view_details21()
	{	
	    $this->load->view('include/header');
		$this->load->view('include/menu');
	    $id=$this->input->get('id');
		$result['id1']=$id;
	$result['data1']=$this->My_model->ven_brc1($id);
	// print_r($result['data1']);
	// die();
	$result['data2']=$this->My_model->ven_brc2($id);
	$this->load->view('prescriptions-view-details21',$result);
	$this->load->view('include/footer');
	if($this->input->post('price'))
	{
						
	redirect('Home/prescriptions_view_details21');
		}
		else
		{
		 echo "Sorry error occured";
		}
	}	

	
	public function updtestate(){
		$id=$this->input->POST('id');
		$eligibility=$this->input->POST('eligibility');
		$this->My_model->updtestate($eligibility,$id);
		redirect('home/submitted');	
	}
	public function updtestate1(){
		$id=$this->input->POST('id');
		$eligibility=$this->input->POST('eligibility');
		$this->My_model->updtestate1($eligibility,$id);
		redirect('home/eligibility');	
	}
	public function updtestate2(){
		$id=$this->input->POST('id');
		$eligibility=$this->input->POST('eligibility');
		$this->My_model->updtestate2($eligibility,$id);
		redirect('home/pre_cert');	
	}
	public function updtestate3(){
		$id=$this->input->POST('id');
		$eligibility=$this->input->POST('eligibility');
		$this->My_model->updtestate3($eligibility,$id);
		redirect('home/compliance');	
	}
	public function updtestate4(){
		$id=$this->input->POST('id');
		$eligibility=$this->input->POST('eligibility');
		$this->My_model->updtestate4($eligibility,$id);
		redirect('home/certified');	
	}
	public function updtestate5(){
		$id=$this->input->POST('id');
		$eligibility=$this->input->POST('eligibility');
		$this->My_model->updtestate5($eligibility,$id);
		redirect('home/logistics');	
	}
	public function updtestate6(){
		$id=$this->input->POST('id');
		$eligibility=$this->input->POST('eligibility');
		$this->My_model->updtestate6($eligibility,$id);
		redirect('home/fulfillment');	
	}
	public function updtestate8(){
		$id=$this->input->POST('id');
		$eligibility=$this->input->POST('eligibility');
		$this->My_model->updtestate8($eligibility,$id);
		redirect('home/billing');	  
	}
	public function updtestate10(){
		$id=$this->input->POST('id');
		$eligibility=$this->input->POST('eligibility');
		$this->My_model->updtestate10($eligibility,$id);
		redirect('home/posting');	
	}
	public function updtestate11(){
		$id=$this->input->POST('id');
		$eligibility=$this->input->POST('eligibility');
		$this->My_model->updtestate11($eligibility,$id);
		redirect('home/review');	
	}
	public function updtestate12(){
		$id=$this->input->POST('id');
		$eligibility=$this->input->POST('eligibility');
		$this->My_model->updtestate12($eligibility,$id);
		redirect('home/rebill');	
	}
	public function updtestate13(){
		$id=$this->input->POST('id');
		$eligibility=$this->input->POST('eligibility');
		$this->My_model->updtestate13($eligibility,$id);
		redirect('home/paid');	
	}
	public function updtestate14(){
		$id=$this->input->POST('id');
		$eligibility=$this->input->POST('eligibility');
		$this->My_model->updtestate14($eligibility,$id);
		redirect('home/secondary_pending');	
	}
	public function updtestate15(){
		$id=$this->input->POST('id');
		$eligibility=$this->input->POST('eligibility');
		$this->My_model->updtestate15($eligibility,$id);
		redirect('home/secondary_paid');	
	}
	public function updtestate16(){
		$id=$this->input->POST('id');
		$eligibility=$this->input->POST('eligibility');
		$this->My_model->updtestate16($eligibility,$id);
		redirect('home/problems');	
	}
	public function updtestate17(){
		$id=$this->input->POST('id');
		$eligibility=$this->input->POST('eligibility');
		$this->My_model->updtestate17($eligibility,$id);
		redirect('home/eligible_refills');	
	}
	public function updtestate18(){
		$id=$this->input->POST('id');
		$eligibility=$this->input->POST('eligibility');
		$this->My_model->updtestate18($eligibility,$id);
		redirect('home/third_party');	
	}
	public function updtestate19(){
		$id=$this->input->POST('id');
		$eligibility=$this->input->POST('eligibility');
		$this->My_model->updtestate19($eligibility,$id);
		redirect('home/rescript');	
	}
	public function update1(){
		//echo "<pre>"; print_r($_REQUEST); die;
		$id=$this->input->POST('Id');
		$customer_support=$this->input->POST('customer_support');

		$page_name=$this->input->POST('page_name');
		// echo "<pre>"; print_r($_REQUEST); die;
		$this->My_model->update1($customer_support,$id);
		if($page_name=='submitted')
		{
			redirect('home/submitted');
		}
		elseif($page_name=='eligibility')
		{
			redirect('home/eligibility');
		}
		elseif($page_name=='pre_cert')
		{
			redirect('home/pre_cert');
		}
		elseif($page_name=='compliance')
		{
			redirect('home/compliance');
		}
		elseif($page_name=='certified') 
		{
			redirect('home/certified');
		}
		elseif($page_name=='logistics')
		{
			redirect('home/logistics');
		}
		elseif($page_name=='fulfillment')
		{
			redirect('home/fulfillment');
		}
		elseif($page_name=='billing')
		{
			redirect('home/billing');
		}
		elseif($page_name=='posting')
		{
			redirect('home/posting');
		}
		elseif($page_name=='review')
		{
			redirect('home/review');
		}
		elseif($page_name=='rebill')
		{
			redirect('home/rebill');
		}
		elseif($page_name=='paid')
		{
			redirect('home/paid');
		}
		elseif($page_name=='secondary_pending')
		{
			redirect('home/secondary_pending');
		}
		elseif($page_name=='secondary_paid')
		{
			redirect('home/secondary_paid');
		}
		elseif($page_name=='problems')
		{
			redirect('home/problems');
		}
		elseif($page_name=='eligible_refills')
		{
			redirect('home/eligible_refills');
		}
		elseif($page_name=='third_party')
		{
			redirect('home/third_party');
		}
		elseif($page_name=='rescript')
		{
			redirect('home/rescript');
		}
		elseif($page_name=='denied')
		{
			redirect('home/denied');
		}
		elseif($page_name=='all_prescriptions')
		{
			redirect('home/all_prescriptions');
		}
	}
	
	public function update_calls(){
		//echo "<pre>"; print_r($_REQUEST); die;
		$id=$this->input->POST('Id');
		$calls=$this->input->POST('calls');

		$page_name=$this->input->POST('page_name');
		//echo "<pre>"; print_r($_REQUEST); die;
		
		$this->My_model->update2($calls,$id);

		
		if($page_name=='certified') 
		{
			redirect('home/certified');
		}
		elseif($page_name=='logistics')
		{
			redirect('home/logistics');
		}
		elseif($page_name=='fulfillment')
		{
			redirect('home/fulfillment');
		}
		elseif($page_name=='billing')
		{
			redirect('home/billing');
		}
		elseif($page_name=='posting')
		{
			redirect('home/posting');
		}
		elseif($page_name=='review')
		{
			redirect('home/review');
		}
		elseif($page_name=='rebill')
		{
			redirect('home/rebill');
		}
		elseif($page_name=='paid')
		{
			redirect('home/paid');
		}
		elseif($page_name=='secondary_pending')
		{
			redirect('home/secondary_pending');
		}
		elseif($page_name=='secondary_paid')
		{
			redirect('home/secondary_paid');
		}
		elseif($page_name=='problems')
		{
			redirect('home/problems');
		}
		elseif($page_name=='eligible_refills')
		{
			redirect('home/eligible_refills');
		}
		elseif($page_name=='third_party')
		{
			redirect('home/third_party');
		}
		elseif($page_name=='rescript')
		{
			redirect('home/rescript');
		}
		elseif($page_name=='denied')
		{
			redirect('home/denied');
		}

	}

	public function update_return(){
		//echo "<pre>"; print_r($_REQUEST); die;
		$id=$this->input->POST('Id');
		$return=$this->input->POST('return');
		$comments=$this->input->POST('comments');
		$page_name=$this->input->POST('page_name');
		//echo "<pre>"; print_r($_REQUEST); die;
		
		$this->My_model->update_return($return,$id);
		$this->My_model->comment($comments,$id);

		
		if($page_name=='posting')
		{
			redirect('home/posting');
		}
		elseif($page_name=='review')
		{
			redirect('home/review');
		}
		elseif($page_name=='rebill')
		{
			redirect('home/rebill');
		}
		elseif($page_name=='paid')
		{
			redirect('home/paid');
		}
		elseif($page_name=='secondary_pending')
		{
			redirect('home/secondary_pending');
		}
		elseif($page_name=='secondary_paid')
		{
			redirect('home/secondary_paid');
		}
		elseif($page_name=='problems')
		{
			redirect('home/problems');
		}
		elseif($page_name=='eligible_refills')
		{
			redirect('home/eligible_refills');
		}
		elseif($page_name=='third_party')
		{
			redirect('home/third_party');
		}
		elseif($page_name=='rescript')
		{
			redirect('home/rescript');
		}
		elseif($page_name=='denied')
		{
			redirect('home/denied');
		}

	}
	
	// public function update2(){
	// 	$id=$this->input->POST('Id');
	// 	$customer_support=$this->input->POST('customer_support');
	// 	$this->My_model->update2($customer_support,$id);
	// 		redirect('home/eligibility');
	// }

	public function dashboard()  
	{
		$year=$this->input->POST('year');
		$month=$this->input->POST('month');
		if((isset($year) && $year<>'') && (isset($month) && $month<>'')){
		    $year = $year;
		    $month = $month;
		} else {
		    $year = date("Y");
		    $month = date("m");
		}
		
		$result['count1']=$this->My_model->count1($year,$month);
		$result['count2']=$this->My_model->count2($year,$month);
		$result['count3']=$this->My_model->count3($year,$month);
		$result['count4']=$this->My_model->count4($year,$month);
		$result['count5']=$this->My_model->count5($year,$month);
		$result['count6']=$this->My_model->count6($year,$month);
		$result['count7']=$this->My_model->count7($year,$month);
		$result['count8']=$this->My_model->count8($year,$month);
		$result['count9']=$this->My_model->count9($year,$month);
		$result['count10']=$this->My_model->count10($year,$month);
		$result['count11']=$this->My_model->count11($year,$month);
		$result['count12']=$this->My_model->count12($year,$month);
		$result['year'] = $year;
		$result['month'] = $month;

		//echo "<pre>"; print_r($result); die;
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('dashboard',$result);
		$this->load->view('include/footer');
	
	}
	
	public function export_csv(){
		$arr_csv=$this->My_model->single_store_csv();
		$this->load->helper('csv');
		//query_to_csv($arr_csv, TRUE, 'patient-reports-'.date("Y-m-d h:i:s").'.csv');
		query_to_csv($arr_csv, TRUE, 'Reports-'.date("Y-m-d h:i:s").'.csv');
	}
	public function add_user()
	{
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('add-user');	
		$this->load->view('include/footer');
	}
	public function user_list()
	{
		$result['data']=$this->My_model->user_list();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('user-list',$result);	
		$this->load->view('include/footer');
	}
	public function save_user()
	{
		if($this->input->POST('submit'))
		{  
$account_holder_name=$this->input->POST('account_holder_name');
			$email=$this->input->POST('email');
		    $password=$this->input->POST('password');
			$phone_no=$this->input->POST('phone_no');
			$role=$this->input->POST('role');
			$status=$this->input->POST('status');
            $profit_sharing_percentage=0;			
		}
		$result['data']=$this->My_model->vendor_match($email);
// print_r() ;
// die();
if($result['data']>0)
		{ 
// echo "<script>alert('Data already exsist')</script>";
// exit();
$this->session->set_flashdata('category_error', 'Data already exists.');
redirect("home/add_user");
exit();
		}
		else
		{
			$this->session->set_flashdata('category_success', 'Data inserted.');
$this->My_model->save_user($account_holder_name,$email,$password,$phone_no,$role,$status,$profit_sharing_percentage);
		redirect('home/user_list');
	}
}
public function update_user()
	{
		

		if($this->input->POST('submit'))

		{  
			$id=$this->input->POST('id');
$account_holder_name=$this->input->POST('account_holder_name');
			$email=$this->input->POST('email');
		    $password=$this->input->POST('password');
			$phone_no=$this->input->POST('phone_no');
		}
$this->My_model->update_user($id,$account_holder_name,$email,$password,$phone_no);
$this->session->set_flashdata('weldone','Successfully Updated');
		redirect('home/dashboard');
}
public function user_info()
	{
		if($this->input->POST('edit'))
		{
		$id=$this->input->POST('id');
		// echo $id;
		// die();
		// $result['data1'] = $this->My_model->role();
		// $result['data2'] = $this->My_model->status();
		$result['data'] = $this->My_model->user_details($id);
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('user-info',$result);	
		$this->load->view('include/footer');
	}
	}
public function edit_user()
	{
if($this->input->POST('edit'))

		{  
			$id=$this->input->POST('id');
$account_holder_name=$this->input->POST('account_holder_name');
			$email=$this->input->POST('email');
		    $password=$this->input->POST('password');
			$phone_no=$this->input->POST('phone_no');
			$role=$this->input->POST('role');
			$status=$this->input->POST('status');
			$profit_sharing_percentage=0;
		}
$this->My_model->edit_user($id,$account_holder_name,$email,$password,$phone_no,$role,$status,$profit_sharing_percentage);
$this->session->set_flashdata('weldone','Successfully Updated');
		redirect('home/user_list');
}
function delete_user()
{
	if($this->input->POST('delete'))
	{
		$id=$this->input->POST('id');
	}
$this->My_model->delete_user($id);
$this->session->set_flashdata('delete','Successfully Deleted');
		redirect('home/user_list');
}
public function brace_type_1()
	{
		$result['data']=$this->My_model->brace_type1();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('brace_type_1',$result);	
		$this->load->view('include/footer');
	}
	public function add_brace1()
	{
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('add_brace1');	
		$this->load->view('include/footer');
	}
	public function save_brace1()
	{
		if($this->input->POST('submit'))
		{  
            $brace1=$this->input->POST('brace1');
			$price=$this->input->POST('price');
		}
		$result['data']=$this->My_model->brace1_match($brace1);
// print_r() ;
// die();
if($result['data']>0)
		{ 
// echo "<script>alert('Data already exsist')</script>";
// exit();
$this->session->set_flashdata('category_error', 'Data already exists.');
redirect("home/add_brace1");
exit();
		}
		else
		{
			$this->session->set_flashdata('category_success', 'Data inserted.');

$this->My_model->save_brace1($brace1,$price);
		redirect('home/brace_type_1');
	}
}
public function brace1_info()
	{
		if($this->input->POST('edit'))
		{
		$id=$this->input->POST('id');
		$result['data'] = $this->My_model->brace1_info($id);
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('brace1_info',$result);	
		$this->load->view('include/footer');
	}
	}
	public function edit_brace1()
	{
if($this->input->POST('edit'))

		{  
			$id=$this->input->POST('id');
            $brace1=$this->input->POST('brace1');
			$price=$this->input->POST('price');
		 
		}
$this->My_model->edit_brace1($id,$brace1,$price);
$this->session->set_flashdata('weldone','Successfully Updated');
		redirect('home/brace_type_1');
}
function brace1_delete()
{
	if($this->input->POST('delete'))
	{
		$id=$this->input->POST('id');
	}
$this->My_model->brace1_delete($id);
$this->session->set_flashdata('delete','Successfully Deleted');
		redirect('home/brace_type_1');
}
public function brace_type_2()
	{
		$result['data']=$this->My_model->brace_type2();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('brace_type_2',$result);	
		$this->load->view('include/footer');
	}
	public function add_brace2()
	{
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('add_brace2');	
		$this->load->view('include/footer');
	}
	public function save_brace2()
	{
		if($this->input->POST('submit'))
		{  
            $brace2=$this->input->POST('brace2');
			$price=$this->input->POST('price');
		}
		$result['data']=$this->My_model->brace2_match($brace2);
// print_r() ;
// die();
if($result['data']>0)
		{ 
// echo "<script>alert('Data already exsist')</script>";
// exit();
$this->session->set_flashdata('category_error', 'Data already exists.');
redirect("home/add_brace2");
exit();
		}
		else
		{
			$this->session->set_flashdata('category_success', 'Data inserted.');
$this->My_model->save_brace2($brace2,$price);
		redirect('home/brace_type_2');
	}
}
public function brace2_info()
	{
		if($this->input->POST('edit'))
		{
		$id=$this->input->POST('id');
		$result['data'] = $this->My_model->brace2_info($id);
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('brace2_info',$result);	
		$this->load->view('include/footer');
	}
	}
	public function edit_brace2()
	{
if($this->input->POST('edit'))

		{  
			$id=$this->input->POST('id');
            $brace2=$this->input->POST('brace2');
			$price=$this->input->POST('price');
		 
		}
$this->My_model->edit_brace2($id,$brace2,$price);
$this->session->set_flashdata('weldone','Successfully Updated');
		redirect('home/brace_type_2');
}
function brace2_delete()
{
	if($this->input->POST('delete'))
	{
		$id=$this->input->POST('id');
	}
$this->My_model->brace2_delete($id);
$this->session->set_flashdata('delete','Successfully Deleted');
		redirect('home/brace_type_2');
}

public function bracetype1()
	{
		$result['data1']=$this->My_model->user_list();
		$result['data2']=$this->My_model->brace_type1();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('bracetype1',$result);	
		$this->load->view('include/footer');
	}
	public function vendor_brace1()
	{
		if($this->input->POST('submit'))
		{  
			$vendor=$this->input->POST('vendor');
            $brace1=$this->input->POST('brace1');
			$price=$this->input->POST('price');
			$date1=date('Y-m-d H:i:s');
		    $date2=date('Y-m-d H:i:s');
		}
$result['data']=$this->My_model->vendor_brace1_match($vendor,$brace1);
// print_r() ;
// die();
if($result['data']>0)
		{ 
// echo "<script>alert('Data already exsist')</script>";
// exit();
$this->session->set_flashdata('category_error', 'Data already exists.');
redirect("home/bracetype1");
exit();
		}
		else
		{
$this->session->set_flashdata('category_success', 'Data inserted.');


$this->My_model->vendor_brace1($vendor,$brace1,$price,$date1,$date2);
		redirect('home/user_list');
		exit();
	}
}
public function bracetype2()
	{
		$result['data1']=$this->My_model->user_list();
		$result['data2']=$this->My_model->brace_type2();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('bracetype2',$result);	
		$this->load->view('include/footer');
	}
	public function vendor_brace2()
	{
		if($this->input->POST('submit'))
		{  
			$vendor=$this->input->POST('vendor');
            $brace2=$this->input->POST('brace2');
			$price=$this->input->POST('price');
			 $date1=date('Y-m-d H:i:s');
		    $date2=date('Y-m-d H:i:s');
		}
		$result['data']=$this->My_model->vendor_brace2_match($vendor,$brace2);
		if($result['data']>0)
		{ 
// echo "<script>alert('Data already exsist')</script>";
// exit();
$this->session->set_flashdata('category_error', 'Data already exists.');
redirect("home/bracetype2");
exit();
		}
		else
		{
$this->session->set_flashdata('category_success', 'Data inserted.');


$this->My_model->vendor_brace2($vendor,$brace2,$price,$date1,$date2);
		redirect('home/user_list');
		exit();
	}

}

public function ven_brc1_edit()
	{
		if($this->input->POST('edit'))
		{
			$id1=$this->input->get('id1');
			$result['id1']=$id1;
	
		$id=$this->input->POST('id');
		$result['data'] = $this->My_model->ven_brc1_edit($id);
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('ven_brc1_edit',$result);	
		$this->load->view('include/footer');
	}
	}
	public function updte_ven_brc1()
	{
if($this->input->POST('edit'))

		{  
			$id1=$this->input->get('id1');
			$id=$this->input->POST('id');
            // $brace1=$this->input->POST('brace1');
			$price=$this->input->POST('price');
		 
		}
$this->My_model->updte_ven_brc1($id,$price);
$this->session->set_flashdata('weldone','Successfully Updated');
		redirect('home/prescriptions_view_details21?id='.$id1);
}
public function ven_brc2_edit()
	{
		if($this->input->POST('edit'))
		{
			$id1=$this->input->get('id1');
			$result['id1']=$id1;
		$id=$this->input->POST('id');
		$result['data'] = $this->My_model->ven_brc2_edit($id);
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('ven_brc2_edit',$result);	
		$this->load->view('include/footer');
	}
	}
	public function updte_ven_brc2() 
	{
if($this->input->POST('edit'))

		{  
			$id1=$this->input->get('id1');
			$id=$this->input->POST('id');
            // $brace2=$this->input->POST('brace2');
			$price=$this->input->POST('price');
		 
		}
$this->My_model->updte_ven_brc2($id,$price);
$this->session->set_flashdata('weldone','Successfully Updated');
		redirect('home/prescriptions_view_details21?id='.$id1);
}
public function profit_sharing_vendor()
	{
	$result['data']=$this->My_model->user_list();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('profit_sharing_vendor',$result);	
		$this->load->view('include/footer');
	}
	public function add_profit_sharing_vendor()
	{
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('add_profit_sharing_vendor');	
		$this->load->view('include/footer');
	}
	public function save_profit_sharing_vendor()
	{
		if($this->input->POST('submit'))
		{  
$account_holder_name=$this->input->POST('account_holder_name');
			$email=$this->input->POST('email');
		    $password=$this->input->POST('password');
			$phone_no=$this->input->POST('phone_no');
			$role=$this->input->POST('role');
			$status=$this->input->POST('status');
$profit_sharing_percentage=$this->input->POST('profit_sharing_percentage');
		}
		$result['data']=$this->My_model->vendor_match($email);
// print_r() ;
// die();
if($result['data']>0)
		{ 
// echo "<script>alert('Data already exsist')</script>";
// exit();
$this->session->set_flashdata('category_error', 'Data already exists.');
redirect("home/add_profit_sharing_vendor");
exit();
		}
		else
		{
			$this->session->set_flashdata('category_success', 'Data inserted.');
$this->My_model->save_user($account_holder_name,$email,$password,$phone_no,$role,$status,$profit_sharing_percentage);
		redirect('home/profit_sharing_vendor');
	}
}
public function profit_sharing_vendor_info()
	{
		if($this->input->POST('edit'))
		{
		$id=$this->input->POST('id');
	
		$result['data'] = $this->My_model->user_details($id);
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('profit_sharing_vendor_info',$result);	
		$this->load->view('include/footer');
	}
	}
	public function edit_profit_sharing_vendor()
	{
if($this->input->POST('edit'))

		{  
			$id=$this->input->POST('id');
$account_holder_name=$this->input->POST('account_holder_name');
			$email=$this->input->POST('email');
		    $password=$this->input->POST('password');
			$phone_no=$this->input->POST('phone_no');
			$role=$this->input->POST('role');
			$status=$this->input->POST('status');
	$profit_sharing_percentage=$this->input->POST('profit_sharing_percentage');
		}
$this->My_model->edit_user($id,$account_holder_name,$email,$password,$phone_no,$role,$status,$profit_sharing_percentage);
$this->session->set_flashdata('weldone','Successfully Updated');
		redirect('home/profit_sharing_vendor');
}
function delete_profit_sharing_vendor()
{
	if($this->input->POST('delete'))
	{
		$id=$this->input->POST('id');
	}
$this->My_model->delete_user($id);
$this->session->set_flashdata('delete','Successfully Deleted');
		redirect('home/profit_sharing_vendor');
}
public function state_list()
	{
		$result['data']=$this->My_model->getState();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('state_list',$result);	
		$this->load->view('include/footer');
	}
	public function add_state()
	{
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('add_state');	
		$this->load->view('include/footer');
	}
	public function save_state()
	{
		if($this->input->POST('submit'))
		{  
            $state=$this->input->POST('state');

		}
		$result['data']=$this->My_model->state_match($state);
		if($result['data']>0)
{
$this->session->set_flashdata('category_error', 'Data already exists.');
redirect("home/add_state");
exit();
}
else
{
	$this->session->set_flashdata('category_success', 'Data inserted.');

$this->My_model->save_state($state);

		redirect('home/state_list');
	}
}
public function edit_state()
	{
		if($this->input->POST('edit'))
		{
		$id=$this->input->POST('id');
		$result['data'] = $this->My_model->edit_state($id);
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('edit_state',$result);	
		$this->load->view('include/footer');
	}
	}
	public function update_state()
	{
if($this->input->POST('edit'))

		{  
			$id=$this->input->POST('id');
            $state=$this->input->POST('state');
		 
		}
$this->My_model->update_state($id,$state);
$this->session->set_flashdata('weldone','Successfully Updated');
		redirect('home/state_list');
}
function delete_state()
{
	if($this->input->POST('delete'))
	{
		$id=$this->input->POST('id');
	}
$this->My_model->delete_state($id);
$this->session->set_flashdata('delete','Successfully Deleted');
		redirect('home/state_list');
}
public function city_list()
	{
		$result['data']=$this->My_model->city_list();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('city_list',$result);	
		$this->load->view('include/footer');
	}
	public function add_city()
	{
		$result['data1']=$this->My_model->getState();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('add_city',$result);	
		$this->load->view('include/footer');
	}
	public function save_city()
	{
		if($this->input->POST('submit'))
		{  
			$state=$this->input->POST('state');
            $city=$this->input->POST('city');
		}
		$result['data']=$this->My_model->city_match($state,$city);
		if($result['data']>0)
		{ 
// echo "<script>alert('Data already exsist')</script>";
// exit();
$this->session->set_flashdata('category_error', 'Data already exists.');
redirect("home/add_city");
exit();
		}
else
{
	$this->session->set_flashdata('category_success', 'Data inserted.');

$this->My_model->save_city($state,$city);
		redirect('home/city_list');
	}
}
	public function edit_city()
	{
		if($this->input->POST('edit'))
		{
		$id=$this->input->POST('id');
		$result['data1']=$this->My_model->getState();
		$result['data'] = $this->My_model->edit_city($id);
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('edit_city',$result);	
		$this->load->view('include/footer');
	}
	}
	public function update_city()
	{
if($this->input->POST('edit'))

		{  
			$id=$this->input->POST('id');
			$state_id=$this->input->POST('state_id');
            // $state=$this->input->POST('state');
            $city=$this->input->POST('city');
		 
		}
$this->My_model->update_city($id,$state_id,$city);
$this->session->set_flashdata('weldone','Successfully Updated');
		redirect('home/city_list');
}
function delete_city()
{
	if($this->input->POST('delete'))
	{
		$id=$this->input->POST('id');
	}
$this->My_model->delete_city($id);
$this->session->set_flashdata('delete','Successfully Deleted');
		redirect('home/city_list');
}
public function ticket_details()
	{
		$id=$this->session->userdata('user_id');
		$result['data']=$this->My_model->ticket_details($id);
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('ticket_details',$result);	
		$this->load->view('include/footer');
	}
	public function add_ticket()
	{
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('add_ticket');	
		$this->load->view('include/footer');
	}
	public function save_ticket()
	{
		if($this->input->POST('submit'))
		{  
			$id=$this->session->userdata('user_id');
			$subject=$this->input->POST('subject');
            $message=$this->input->POST('message');
            $date=date('Y-m-d H:i:s');
		}

$this->My_model->save_ticket($id,$subject,$message,$date);
		redirect('home/ticket_details');

}
public function show_tickets()
	{
		$result['data']=$this->My_model->show_tickets();
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('show_tickets',$result);	
		$this->load->view('include/footer');
	}
	function delete_ticket()
{
	if($this->input->POST('delete'))
	{
		$id=$this->input->POST('id');
	}
$this->My_model->delete_ticket($id);
$this->session->set_flashdata('delete','Successfully Deleted');
		redirect('home/show_tickets');
}
public function reply()
	{
		if($this->input->POST('reply'))
		{
		$id=$this->input->POST('id');
		$result['data'] = $this->My_model->reply_ticket($id);
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('reply',$result);	  
		$this->load->view('include/footer');
	}
	}
	public function show_reply()
	{
if($this->input->POST('submit'))

		{  
			$id=$this->input->POST('id');
			$vendor_id=$this->input->POST('vendor_id');
            $subject=$this->input->POST('subject');
            $message=$this->input->POST('message');
            $reply=$this->input->POST('reply');
            $date=date('Y-m-d H:i:s');
		 
		}
$this->My_model->show_reply($id,$vendor_id,$subject,$message,$reply,$date);
$this->session->set_flashdata('weldone','Successfully Updated');
		redirect('home/show_tickets');
}
}

?>