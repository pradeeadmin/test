<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class dashboard extends CI_Controller{

	public function index($link1='',$link2='',$link3=''){
		$data['title'] = 'Telemarketing - Dashboard';
		$menus['menu'] = 'dashboard'; 
		if($this->session->userdata('login') == FALSE)
		{
			redirect('login/login','location');
		}
		
		$this->load->model('common_models');
		ob_start();
		/*$this->load->file('KoolControls/KoolGrid/koolgrid.php') ;
		include "KoolControls/KoolAjax/koolajax.php";
		include "KoolControls/KoolAjax/dbconnect.php";
		$koolajax->scriptFolder = base_url()."KoolControls/KoolAjax";
		$ds = new MySQLDataSource($db_con);*/
		
		$Login_Details = $this->session->userdata('login');
//print_r($Login_Details);
$userpermission = $Login_Details["user_permission"]; 
$user_id = $Login_Details["user_id"];
$username = $Login_Details["username"];

		if(isset($_POST['search'])){
		//echo "search";
			ob_start();
			if(isset($opportunities2)){
				$this->session->unset_userdata('opportunities2');
			}
			$txtcompany  		= $this->input->post('txtcompany');
			$txtfirstname  			= $this->input->post('txtfirstname');
			$txtlastname  			= $this->input->post('txtlastname');
			$txtphoneno  	= $this->input->post('txtphoneno');
		$opportunities2	= 	$this->session->userdata('opportunities2');	
		$opportunities2= array("opportunities2" => array('txtcompany' => $txtcompany, 'txtfirstname'=> $txtfirstname, 'txtlastname'=> $txtlastname, 'txtphoneno'=> $txtphoneno));
		$this->session->set_userdata($opportunities2);
		
		$formctrl1 = trim($txtcompany);
			$formctrl2 = trim($txtfirstname);
			$formctrl3 = trim($txtlastname);
			$formctrl4 = trim($txtphoneno);
		
		if($formctrl1!="" && $formctrl2 =="" && $formctrl3 =="" && $formctrl4 ==""){
			$query = "select * from business_lists where company_name like '%".$formctrl1."%'";
		}else if($formctrl2!="" && $formctrl1 =="" && $formctrl3 =="" && $formctrl4 ==""){
			$query = "select * from business_lists where first_name like '%".$formctrl2."%'";
		}else if($formctrl3!="" && $formctrl1 =="" && $formctrl2 =="" && $formctrl4 ==""){
	     	$query = "select * from business_lists where last_name like '%".$formctrl3 ."%'";
		}else if($formctrl4!="" && $formctrl1 =="" && $formctrl3 =="" && $formctrl2 ==""){
			$query = "select * from business_lists where phone like '%".$formctrl4."%'";
		}else if($formctrl1 !="" && $formctrl2 !="" && $formctrl3 =="" && $formctrl4 ==""){
			$query = "select * from business_lists where company_name like '%".$formctrl1."%' and first_name like '%".$formctrl2."%'";
		}else if($formctrl1 !="" && $formctrl3 !="" && $formctrl4 =="" && $formctrl2 ==""){
			$query = "select * from business_lists where company_name like '%".$formctrl1."%' and last_name like '%".$formctrl3."%'";
		}else if($formctrl1!="" && $formctrl4 !="" && $formctrl3 =="" && $formctrl2 ==""){
			$query = "select * from business_lists where company_name like '%".$formctrl1."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl2 !="" && $formctrl1 !="" && $formctrl3 =="" && $formctrl4 ==""){
			$query = "select * from business_lists where  company_name like '%".$formctrl1."%' and  first_name  like '%".$formctrl2."%'";
		}else if($formctrl2 !="" && $formctrl3 !="" && $formctrl4 =="" && $formctrl2 ==""){
			$query = "select * from business_lists where first_name like '%".$formctrl2."%' and last_name like '%".$formctrl3."%'";
		}else if($formctrl2 !="" && $formctrl4 !="" && $formctrl3 =="" && $formctrl1 ==""){
			$query = "select * from business_lists where first_name like '%".$formctrl2."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl3 !="" && $formctrl1 !="" && $formctrl4 =="" && $formctrl2 ==""){
			$query = "select * from business_lists where company_name like '%".$formctrl3."%' and last_name like '%".$formctrl1."%'";
		}else if($formctrl3 !="" && $formctrl2 !="" && $formctrl1 =="" && $formctrl4 ==""){
			$query = "select * from business_lists where  first_name like '%".$formctrl3."%' and last_name like '%".$formctrl2."%'";
		}else if($formctrl3 !="" && $formctrl4 !="" && $formctrl1 =="" && $formctrl2 ==""){
			$query = "select * from business_lists where last_name like '%".$formctrl3."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl4 !=""  && $formctrl1 !="" && $formctrl1 =="" && $formctrl2 ==""){
			$query = "select * from business_lists where  company_name  like '%".$formctrl1."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl4 !="" && $formctrl2 !="" && $formctrl3 =="" && $formctrl1 ==""){
			$query = "select * from business_lists where first_name like '%".$formctrl2."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl4 !="" && $formctrl3 !="" && $formctrl1 =="" && $formctrl2 ==""){
			$query = "select * from business_lists where last_name  like '%".$formctrl3."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl1 !="" && $formctrl2 !="" && $formctrl3 !="" && $formctrl4 ==""){
			$query = "select * from business_lists where company_name like '%".$formctrl1."%' and first_name like '%".$formctrl2."%' and last_name like '%".$formctrl3."%'";
		}else if($formctrl1 !="" && $formctrl2 !="" && $formctrl4 !="" && $formctrl3 ==""){
			$query = "select * from business_lists where company_name like '%".$formctrl1."%' and first_name like '%".$formctrl2."%' and  phone like '%".$formctrl4."%'";
		}else if($formctrl2 !="" && $formctrl1 !="" && $formctrl3 !="" && $formctrl4 ==""){
			$query = "select * from business_lists where company_name  like '%".$formctrl1."%' and first_name like '%".$formctrl2."%' and last_name like '%".$formctrl3."%'";
		}else if($formctrl2 !="" && $formctrl3 !="" && $formctrl4 !="" && $formctrl1 ==""){
			$query = "select * from business_lists where first_name like '%".$formctrl2."%' and last_name like '%".$formctrl3."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl3 !="" && $formctrl1 !="" && $formctrl2 !="" && $formctrl4 ==""){
			$query = "select * from business_lists where  company_name like '%".$formctrl1."%' and first_name  like '%".$formctrl2."%' and last_name like '%".$formctrl3."%'";
		}else if($formctrl3 !="" && $formctrl2 !="" && $formctrl4 !="" && $formctrl1 ==""){
			$query = "select * from business_lists where first_name  like '%".$formctrl2."%' and last_name like '%".$formctrl3."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl4 !="" && $formctrl1 !="" && $formctrl2 !="" && $formctrl3 ==""){
			$query = "select * from business_lists where company_name like '%".$formctrl1."%' and first_name like '%".$formctrl2."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl4 !="" && $formctrl2 !="" && $formctrl3 !="" && $formctrl1 ==""){
			$query = "select * from business_lists where first_name like '%".$formctrl2."%' and last_name like '%".$formctrl3."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl4 !="" && $formctrl2 !="" && $formctrl3 !="" && $formctrl1 !=""){
		 $query = "select * from business_lists where company_name like '%".$formctrl1."%' and first_name like '%".$formctrl2."%' and last_name like '%".$formctrl3."%' and phone like '%".$formctrl4."%'";	
		}else{
		 $query = "select * from business_lists where company_name like '%".$formctrl1."%' or first_name like '%".$formctrl2."%' or last_name like '%".$formctrl3."%' or phone like '%".$formctrl4."%'";
		}	
		
		$data["grid_business"] = $this->common_models->select_business_listing($query);
		}elseif(isset($opportunities2) != ''){
		//echo "session";
			$txtcompany		=	$opportunities2{'txtcompany'};
			$txtfirstname			=	$opportunities2{'txtfirstname'};
			$txtlastname 			=	$opportunities2{'txtlastname'};
			$txtphoneno 	=	$opportunities2{'txtphoneno'};
			
		
		$opportunities2	= 	$this->session->userdata('opportunities2');	
		$opportunities2= array("opportunities2" => array('txtcompany' => $txtcompany, 'txtfirstname'=> $txtfirstname, 'txtlastname'=> $txtlastname, 'txtphoneno'=> $txtphoneno));
		$this->session->set_userdata($opportunities2);
		
		$formctrl1 = trim($txtcompany);
			$formctrl2 = trim($txtfirstname);
			$formctrl3 = trim($txtlastname);
			$formctrl4 = trim($txtphoneno);
		
		if($formctrl1!="" && $formctrl2 =="" && $formctrl3 =="" && $formctrl4 ==""){
			$query = "select * from business_lists where company_name like '%".$formctrl1."%'";
		}else if($formctrl2!="" && $formctrl1 =="" && $formctrl3 =="" && $formctrl4 ==""){
			$query = "select * from business_lists where first_name like '%".$formctrl2."%'";
		}else if($formctrl3!="" && $formctrl1 =="" && $formctrl2 =="" && $formctrl4 ==""){
	     	$query = "select * from business_lists where last_name like '%".$formctrl3 ."%'";
		}else if($formctrl4!="" && $formctrl1 =="" && $formctrl3 =="" && $formctrl2 ==""){
			$query = "select * from business_lists where phone like '%".$formctrl4."%'";
		}else if($formctrl1 !="" && $formctrl2 !="" && $formctrl3 =="" && $formctrl4 ==""){
			$query = "select * from business_lists where company_name like '%".$formctrl1."%' and first_name like '%".$formctrl2."%'";
		}else if($formctrl1 !="" && $formctrl3 !="" && $formctrl4 =="" && $formctrl2 ==""){
			$query = "select * from business_lists where company_name like '%".$formctrl1."%' and last_name like '%".$formctrl3."%'";
		}else if($formctrl1!="" && $formctrl4 !="" && $formctrl3 =="" && $formctrl2 ==""){
			$query = "select * from business_lists where company_name like '%".$formctrl1."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl2 !="" && $formctrl1 !="" && $formctrl3 =="" && $formctrl4 ==""){
			$query = "select * from business_lists where  company_name like '%".$formctrl1."%' and  first_name  like '%".$formctrl2."%'";
		}else if($formctrl2 !="" && $formctrl3 !="" && $formctrl4 =="" && $formctrl2 ==""){
			$query = "select * from business_lists where first_name like '%".$formctrl2."%' and last_name like '%".$formctrl3."%'";
		}else if($formctrl2 !="" && $formctrl4 !="" && $formctrl3 =="" && $formctrl1 ==""){
			$query = "select * from business_lists where first_name like '%".$formctrl2."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl3 !="" && $formctrl1 !="" && $formctrl4 =="" && $formctrl2 ==""){
			$query = "select * from business_lists where company_name like '%".$formctrl3."%' and last_name like '%".$formctrl1."%'";
		}else if($formctrl3 !="" && $formctrl2 !="" && $formctrl1 =="" && $formctrl4 ==""){
			$query = "select * from business_lists where  first_name like '%".$formctrl3."%' and last_name like '%".$formctrl2."%'";
		}else if($formctrl3 !="" && $formctrl4 !="" && $formctrl1 =="" && $formctrl2 ==""){
			$query = "select * from business_lists where last_name like '%".$formctrl3."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl4 !=""  && $formctrl1 !="" && $formctrl1 =="" && $formctrl2 ==""){
			$query = "select * from business_lists where  company_name  like '%".$formctrl1."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl4 !="" && $formctrl2 !="" && $formctrl3 =="" && $formctrl1 ==""){
			$query = "select * from business_lists where first_name like '%".$formctrl2."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl4 !="" && $formctrl3 !="" && $formctrl1 =="" && $formctrl2 ==""){
			$query = "select * from business_lists where last_name  like '%".$formctrl3."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl1 !="" && $formctrl2 !="" && $formctrl3 !="" && $formctrl4 ==""){
			$query = "select * from business_lists where company_name like '%".$formctrl1."%' and first_name like '%".$formctrl2."%' and last_name like '%".$formctrl3."%'";
		}else if($formctrl1 !="" && $formctrl2 !="" && $formctrl4 !="" && $formctrl3 ==""){
			$query = "select * from business_lists where company_name like '%".$formctrl1."%' and first_name like '%".$formctrl2."%' and  phone like '%".$formctrl4."%'";
		}else if($formctrl2 !="" && $formctrl1 !="" && $formctrl3 !="" && $formctrl4 ==""){
			$query = "select * from business_lists where company_name  like '%".$formctrl1."%' and first_name like '%".$formctrl2."%' and last_name like '%".$formctrl3."%'";
		}else if($formctrl2 !="" && $formctrl3 !="" && $formctrl4 !="" && $formctrl1 ==""){
			$query = "select * from business_lists where first_name like '%".$formctrl2."%' and last_name like '%".$formctrl3."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl3 !="" && $formctrl1 !="" && $formctrl2 !="" && $formctrl4 ==""){
			$query = "select * from business_lists where  company_name like '%".$formctrl1."%' and first_name  like '%".$formctrl2."%' and last_name like '%".$formctrl3."%'";
		}else if($formctrl3 !="" && $formctrl2 !="" && $formctrl4 !="" && $formctrl1 ==""){
			$query = "select * from business_lists where first_name  like '%".$formctrl2."%' and last_name like '%".$formctrl3."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl4 !="" && $formctrl1 !="" && $formctrl2 !="" && $formctrl3 ==""){
			$query = "select * from business_lists where company_name like '%".$formctrl1."%' and first_name like '%".$formctrl2."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl4 !="" && $formctrl2 !="" && $formctrl3 !="" && $formctrl1 ==""){
			$query = "select * from business_lists where first_name like '%".$formctrl2."%' and last_name like '%".$formctrl3."%' and phone like '%".$formctrl4."%'";
		}else if($formctrl4 !="" && $formctrl2 !="" && $formctrl3 !="" && $formctrl1 !=""){
		 $query = "select * from business_lists where company_name like '%".$formctrl1."%' and first_name like '%".$formctrl2."%' and last_name like '%".$formctrl3."%' and phone like '%".$formctrl4."%'";	
		}else{
		 $query = "select * from business_lists where company_name like '%".$formctrl1."%' or first_name like '%".$formctrl2."%' or last_name like '%".$formctrl3."%' or phone like '%".$formctrl4."%'";
		}	
		$data["grid_business"] = $this->common_models->select_business_listing($query);
		}else{

		//echo "em";
		//$query = "SELECT * FROM  business_lists where status = 'Follow Up' and sales_person_id='".$user_id."'";
		//$query = "SELECT A.auto_buisness_id,A.company_name,A.first_name,A.last_name,A.address1,A.city,A.state,A.zipcode,A.primary_email,A.phone,A.website,B.ccate_name FROM  business_lists A join tbl_category B on A.category = B.nauto_cate_id where A.status = 'Follow Up' and A.sales_person_id='".$user_id."'";
		 $query = "SELECT B.auto_buisness_id, B.company_name, A.follow_date, A.callduration, A.active as status,A.AutoId,C.ccate_name,C.nauto_cate_id
FROM calltracking A,business_lists B,tbl_category C WHERE A.companyid = B.auto_buisness_id
AND A.createdby = '".$username."' AND B.category = C.nauto_cate_id
AND A.active = 'Open'
ORDER BY A.follow_date ASC";
		$data["grid"] = $this->common_models->select_business_listing($query);
		}
	
		if(isset($_POST['search'])){
			$data['txtcompany']		=	$_POST['txtcompany'];
			$data['txtfirstname']		=	$_POST['txtfirstname'];
			$data['txtlastname']		=	$_POST['txtlastname'];
			$data['txtphoneno']	=	$_POST['txtphoneno'];				
		}else
		{
			
			$data['txtcompany']		=	"";
			$data['txtfirstname']		=	"";
			$data['txtlastname']		=	"";
			$data['txtphoneno']	=	"";		
			
		}
		
		
		$data['title']= 'Telemarketing - Business List';
		$data['add_new'] = '';
		$menus['menu']	= 'dashboard';
		
		
		$data['company']		= $this->common_models->getAllDistinctRecords('business_lists','company_name');
		$data['firstname']		= $this->common_models->getAllDistinctRecords('business_lists','first_name');
		$data['lastname']		= $this->common_models->getAllDistinctRecords('business_lists','last_name');
		$data['phoneno']		= $this->common_models->getAllDistinctRecords('business_lists','phone');
		$data['category']		= $this->common_models->getAllRecords('tbl_category');
		$data['link1']=$link1;
		$data['link2']=$link2;
		$data['link3']=$link3;
	  	$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
	    $this->load->view('login/dashboard',$data);
		$this->load->view('includes/footer');
	}
	
	// CATEGORY START
	public function Category()
	{
		
		if($this->session->userdata('login') == FALSE)
		{
			redirect('login/login','location');
		}
		ob_start();
		$this->load->model('common_models');
		$this->load->file('KoolControls/KoolGrid/koolgrid.php') ;
		include "KoolControls/KoolAjax/koolajax.php";
		include "KoolControls/KoolAjax/dbconnect.php";
		$koolajax->scriptFolder = base_url()."KoolControls/KoolAjax";
		$ds = new MySQLDataSource($db_con);
		
		//$ds->SelectCommand = "SELECT nauto_cate_id,ccate_name,ccate_description,ccate_img,ncate_order,status_flag FROM  tbl_category";
		$ds->SelectCommand = "SELECT * FROM  tbl_category order by ccate_name asc";
		
		$ds->DeleteCommand = "DELETE FROM tbl_category WHERE nauto_cate_id=@nauto_cate_id";
	
		$grid = new KoolGrid("grid");
		$grid->styleFolder="office2010blue";
		$grid->DataSource = $ds;
		$grid->AllowResizing = true;	
		$grid->MasterTable->ShowFunctionPanel = true;	
		$grid->MasterTable->InsertSettings->ColumnNumber = 2;
		$grid->RowAlternative = true;
		$grid->AllowMultiSelecting = true;
		$grid->AllowEditing = true;
		$grid->AllowDeleting = true;
		$grid->AjaxEnabled = true;
		$grid->AjaxLoadingImage =  "KoolControls/KoolAjax/loading/5.gif";
		$grid->AllowHovering = true;
		$grid->AllowSorting = true;//Enable sorting for all rows;
		$grid->SingleColumnSorting = true;
		//$grid->AllowFiltering = true;//Enable filtering for all rows;
		$grid->AllowFiltering = false;
		$grid->AllowResizing = true;
		$grid->AllowInserting = false;
		$grid->AutoGenerateDeleteColumn = true;
		$grid->AutoGenerateEditColumn = true;	
		$grid->MasterTable->EditSettings->Mode = "form";
		//$grid->MasterTable->EditSettings->InputFocus = "HideGrid";//You can test the "BlurGrid"
		//$grid->AutoGenerateRowSelectColumn = true;
		$grid->AutoGenerateEditColumn = false;
		$grid->PageSize  = 50;
		$grid->ShowStatus = true;
		$grid->MasterTable->Pager = new GridPrevNextAndNumericPager();
		$column = new GridEditDeleteColumn();	
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditCategory/{nauto_cate_id}" style="color:#000000; text-decoration:none">{ccate_name}</a>';
		$col->HeaderText = "Category Name";
		$grid->MasterTable->AddColumn($col);
		
		/*$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditCategory/{nauto_cate_id}" style="text-decoration:none;"><img src="'.base_url().'includes/category/{ccate_img}" style="height:40px; width:40px;text-decoration:none;"></a>';
		$col->HeaderText = "Category Image";
		$grid->MasterTable->AddColumn($col);*/
		
	   /*$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditCategory/{nauto_cate_id}" style="color:#000000; text-decoration:none">{ncate_order}</a>';
		$col->HeaderText = "Display Order";
		$grid->MasterTable->AddColumn($col);*/
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditCategory/{nauto_cate_id}" style="color:#000000; text-decoration:none">{status_flag}</a>';
		$col->HeaderText = "Active";
		$grid->MasterTable->AddColumn($col);
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/delete_cat_records/{nauto_cate_id}" style="color:#000000; text-decoration:none" onclick="return myFunction();">Delate All Records</a>';
		$col->HeaderText = "Action";
		$grid->MasterTable->AddColumn($col);
		
		/*$column = new GridDropDownColumn();
		$column->AddItem("Yes","Yes");
		$column->AddItem("No","No");
		$column->Filter = array("Value"=>"Yes","Exp"=>"Equal");
		$column->HeaderText = "Status";	
		$column->DataField = "status_flag";
		$grid->MasterTable->AddColumn($column);*/
		
					
		$grid->Process();	
		$data["grid"] = $grid->Render();
		$data["ajax"] = $koolajax->Render();
		$data['title']= 'Telemarketing - Category';
		$data['add_new'] = 'index.php/login/dashboard/AddCategory';
		$menus['menu']	= 'category';
		$date['category']=''; 
		$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
		$this->load->view('login/category_list',$data);
	    $this->load->view('includes/footer');
	}
	
	public function AddCategory()
	{
		
        $this->load->model('common_models');
		$this->common_models->delete_cache_memory();
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$data['title'] 				= 'Category';
		$data['add_new'] 			= 'index.php/login/dashboard/AddCategory';
		//$records['category']		= $this->common_models->getAllRecords('tbl_category');
		$records['script']		= $this->common_models->getAllRecords('script');
		//$records['mail_template']		= $this->common_models->getAllRecords('mailTemplate');
		$records['mail_template']	= $this->common_models->getRecordById('mailTemplate','mailTemplateStatus',1);
		$records['category'] 	= '';
		$menus['menu']	= 'category'; 
		$data["grid"]	= '';
		$data["ajax"] 	= '';
		$data['add_new'] = '';
	  	$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
	    $this->load->view('login/category',$records);
	    $this->load->view('includes/footer');
	}
	
	public function EditCategory($link)
	{
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
        $data['title'] = 'Telemarketing - Category';
		$this->load->model('common_models');
		$records['script']		= $this->common_models->getAllRecords('script');
		$records['category']	= $this->common_models->getRecordById('tbl_category','nauto_cate_id',$link);
		$records['mail_template']	= $this->common_models->getRecordById('mailTemplate','mailTemplateStatus',1);
		//$records['mail_template']		= $this->common_models->getAllRecords('mailTemplate');
	
		
		
		$data['add_new'] = '';
		$data["grid"] = '';
		$data["ajax"] = '';
		//print_r($records['uploadfiles']);die;
		$menus['menu']	= 'category'; 
	  	$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
	    $this->load->view('login/category',$records);
	    $this->load->view('includes/footer');
	}
	
	public function CategoryInsert($link1)
    {
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$this->load->model('common_models');
				
		
		$category_id	 	= trim($this->input->post('category_id'));
		$category_name	 	= trim($this->input->post('category_name'));
		$description	    = trim($this->input->post('description'));
		$displayorder	 	= trim($this->input->post('displayorder'));
		$statuss	 		= trim($this->input->post('status'));
		$preimage 			= trim($this->input->post('preimage'));
		$script_id 			= trim($this->input->post('script_id'));
		$mail_template_id 			= trim($this->input->post('mail_template_id'));
		$sales_manager 			= trim($this->input->post('sales_manager'));
		$sales_person 			= trim($this->input->post('sales_person'));
		$ddate = date('Y-m-d');
		
				
		if($statuss == 'on'){
		$status = 'Yes';
		}else{
		$status = 'No';
		}
				
		$category_data 		 = $this->common_models->getRecordById('tbl_category','nauto_cate_id',$category_id);
		
		if(isset($_FILES['uploadfile']['name']) && $_FILES['uploadfile']['name'] != ''){
					$file_name = $_FILES['uploadfile']['name']; 
					$exp 			=   explode(".",$file_name);
					
					$upload_path	= 	'./includes/category/'; 
					$time_name		=	time().$file_name;
					//$photo_type		= 	$_FILES['document_upload']['type'];
					$time_file		=	'';
					$photo_file 	= 	$upload_path.basename($time_name);
					$db_file 		= 	basename($_FILES['uploadfile']['name']);
					$time_file		=	time().$db_file;
						if(move_uploaded_file($_FILES['uploadfile']['tmp_name'],$photo_file)){     
							//chmod($photo_file,777);
						}
		}else{
			$time_file		=	$preimage;
			 }	
		
		if($category_id  != ""){
							$values 			= array('ccate_name' 		=> $category_name,
														'ccate_description' => $description,
		                    	  					  	'ccate_img' 		=> $time_file,
														'ncate_order'    	=> $displayorder,
													 	'status_flag' 		=> $status,
														'script_id' 		=> $script_id,
														'mail_template_id'  => $mail_template_id,
                                                        'dcreated_dt'		=> $ddate,
														'sales_manager'		=> $sales_manager,
														'sales_person'		=> $sales_person);
		
			
			$this->db->where('nauto_cate_id', $category_id);								
			$this->db->update('tbl_category', $values);
			$Insert_id = $category_id;
		}else{
		
		
			$values 			= array('ccate_name' => $category_name,
										'ccate_description' => $description,
		                    	  		'ccate_img' 		=> $time_file,
										'ncate_order'    	=> $displayorder,
										'status_flag' 		=> $status,
										'script_id' 		=> $script_id,
										'mail_template_id'  => $mail_template_id,
                                        'dcreated_dt'		=> $ddate,
										'sales_manager'		=> $sales_manager,
										'sales_person'		=> $sales_person);
									
			//print_r($values );die;
	     	$this->db->insert('tbl_category',$values);
			$Insert_id  = $this->db->insert_id();
		}
		
		if($link1 == 'save'){
				redirect('login/dashboard/EditCategory/'.$Insert_id,'location');		
			}elseif($link1 == 'saveClose'){
				redirect('login/dashboard/Category','location');		
			}elseif($link1 == 'saveNew'){
				redirect('login/dashboard/AddCategory','location');			
			}
		
	}
	
	public function delete_category($category_id)
	{
		date_default_timezone_set('America/New_York');
		$script_tz 			= date_default_timezone_get();
		$this->load->model('common_models');
		if($this->session->userdata('login') == FALSE)
		{
			redirect('login/login','location');
		}
		$get_image 	   = $this->common_models->getRecordById('tbl_category','nauto_cate_id',$category_id);
		//print_r($get_image);die;
		$path = "./includes/category/".$get_image[0]->ccate_img; 
		unlink($path);
		$values 				   = array('ccate_img'	=> '');
		$this->db->where('nauto_cate_id', $category_id);								
		$this->db->update('tbl_category', $values);
		
	}
	
	public function delete_cat_records($category_id)
	{
		date_default_timezone_set('America/New_York');
		$script_tz 			= date_default_timezone_get();
		$this->load->model('common_models');
		if($this->session->userdata('login') == FALSE)
		{
			redirect('login/login','location');
		}
		
		
		$get_image 	   = $this->common_models->getRecordById('business_lists','category',$category_id);
		//print_r($get_image);
		//die;
		$total_reocrds =  count($get_image);
		if(isset($total_reocrds) && $total_reocrds == 0){
			$this->session->set_flashdata('success', 'No records found to delete.');
		}else{
			$this->session->set_flashdata('success', $total_reocrds.' Records deleted successfully.');
		}
		$this->db->where('category', $category_id);								
		$this->db->delete('business_lists');
		
		redirect('login/dashboard/category','location');
	}
	 
	//CATEGORY END
	
	// SCRIPT START
	public function script()
	{
		
		if($this->session->userdata('login') == FALSE)
		{
			redirect('login/login','location');
		}
		ob_start();
		$this->load->model('common_models');
		$this->load->file('KoolControls/KoolGrid/koolgrid.php') ;
		include "KoolControls/KoolAjax/koolajax.php";
		include "KoolControls/KoolAjax/dbconnect.php";
		$koolajax->scriptFolder = base_url()."KoolControls/KoolAjax";
		$ds = new MySQLDataSource($db_con);
		
		//$ds->SelectCommand = "SELECT nauto_cate_id,ccate_name,ccate_description,ccate_img,ncate_order,status_flag FROM  tbl_category";
		$ds->SelectCommand = "SELECT * FROM  script";
		
		$ds->DeleteCommand = "DELETE FROM script WHERE script_id =@script_id";
	
		$grid = new KoolGrid("grid");
		$grid->styleFolder="office2010blue";
		$grid->DataSource = $ds;
		$grid->AllowResizing = true;	
		$grid->MasterTable->ShowFunctionPanel = true;	
		$grid->MasterTable->InsertSettings->ColumnNumber = 2;
		$grid->RowAlternative = true;
		$grid->AllowMultiSelecting = true;
		$grid->AllowEditing = true;
		$grid->AllowDeleting = true;
		$grid->AjaxEnabled = true;
		$grid->AjaxLoadingImage =  "KoolControls/KoolAjax/loading/5.gif";
		$grid->AllowHovering = true;
		$grid->AllowSorting = true;//Enable sorting for all rows;
		$grid->SingleColumnSorting = true;
		//$grid->AllowFiltering = true;//Enable filtering for all rows;
		$grid->AllowFiltering = false;
		$grid->AllowResizing = true;
		$grid->AllowInserting = false;
		$grid->AutoGenerateDeleteColumn = true;
		$grid->AutoGenerateEditColumn = true;	
		$grid->MasterTable->EditSettings->Mode = "form";
		//$grid->MasterTable->EditSettings->InputFocus = "HideGrid";//You can test the "BlurGrid"
		//$grid->AutoGenerateRowSelectColumn = true;
		$grid->AutoGenerateEditColumn = false;
		$grid->PageSize  = 50;
		$grid->ShowStatus = true;
		$grid->MasterTable->Pager = new GridPrevNextAndNumericPager();
		$column = new GridEditDeleteColumn();	
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/Editscript/{script_id}" style="color:#000000; text-decoration:none">{script_title}</a>';
		$col->HeaderText = "Script Title";
		$grid->MasterTable->AddColumn($col);
		
		
		$column = new GridDropDownColumn();
	$column->AddItem("Yes","1");
	$column->AddItem("No","0");
	$column->HeaderText = "Status";	
	$column->DataField = "status";
	$grid->MasterTable->AddColumn($column);
					
		$grid->Process();	
		$data["grid"] = $grid->Render();
		$data["ajax"] = $koolajax->Render();
		$data['title']= 'Telemarketing - Script';
		$data['add_new'] = 'index.php/login/dashboard/AddScript';
		$menus['menu']	= 'script';
		$date['script']=''; 
		$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
		$this->load->view('login/script_list',$data);
	    $this->load->view('includes/footer');
	}
	
	public function mail_template()
	{
		
		if($this->session->userdata('login') == FALSE)
		{
			redirect('login/login','location');
		}
		ob_start();
		$this->load->model('common_models');
		$this->load->file('KoolControls/KoolGrid/koolgrid.php') ;
		include "KoolControls/KoolAjax/koolajax.php";
		include "KoolControls/KoolAjax/dbconnect.php";
		$koolajax->scriptFolder = base_url()."KoolControls/KoolAjax";
		$ds = new MySQLDataSource($db_con);
		
		//$ds->SelectCommand = "SELECT nauto_cate_id,ccate_name,ccate_description,ccate_img,ncate_order,status_flag FROM  tbl_category";
		$ds->SelectCommand = "SELECT * FROM  mailTemplate";
		
		$ds->DeleteCommand = "DELETE FROM mailTemplate WHERE mailTempId =@mailTempId";
	
		$grid = new KoolGrid("grid");
		$grid->styleFolder="office2010blue";
		$grid->DataSource = $ds;
		$grid->AllowResizing = true;	
		$grid->MasterTable->ShowFunctionPanel = true;	
		$grid->MasterTable->InsertSettings->ColumnNumber = 2;
		$grid->RowAlternative = true;
		$grid->AllowMultiSelecting = true;
		$grid->AllowEditing = true;
		$grid->AllowDeleting = true;
		$grid->AjaxEnabled = true;
		$grid->AjaxLoadingImage =  "KoolControls/KoolAjax/loading/5.gif";
		$grid->AllowHovering = true;
		$grid->AllowSorting = true;//Enable sorting for all rows;
		$grid->SingleColumnSorting = true;
		//$grid->AllowFiltering = true;//Enable filtering for all rows;
		$grid->AllowFiltering = false;
		$grid->AllowResizing = true;
		$grid->AllowInserting = false;
		$grid->AutoGenerateDeleteColumn = true;
		$grid->AutoGenerateEditColumn = true;	
		$grid->MasterTable->EditSettings->Mode = "form";
		//$grid->MasterTable->EditSettings->InputFocus = "HideGrid";//You can test the "BlurGrid"
		//$grid->AutoGenerateRowSelectColumn = true;
		$grid->AutoGenerateEditColumn = false;
		$grid->PageSize  = 50;
		$grid->ShowStatus = true;
		$grid->MasterTable->Pager = new GridPrevNextAndNumericPager();
		$column = new GridEditDeleteColumn();	
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/Edit_mail_template/{mailTempId}" style="color:#000000; text-decoration:none">{mailTemplateName}</a>';
		$col->HeaderText = "Mail Template Subject Name";
		$grid->MasterTable->AddColumn($col);
		
		$col = new GridDropDownColumn();
	$col->AddItem("Yes","1");
	$col->AddItem("No","0");
	$col->HeaderText = "Interested Mail Template";	
	$col->DataField = "intMailTemplateStatus";
	$grid->MasterTable->AddColumn($col);

		
	$col = new GridDropDownColumn();
	$col->AddItem("Yes","1");
	$col->AddItem("No","0");
	$col->HeaderText = "Mail Template Status";	
	$col->DataField = "mailTemplateStatus";
	$grid->MasterTable->AddColumn($col);

					
		$grid->Process();	
		$data["grid"] = $grid->Render();
		$data["ajax"] = $koolajax->Render();
		$data['title']= 'Telemarketing - Mail Template';
		$data['add_new'] = 'index.php/login/dashboard/Add_mail_template';
		$menus['menu']	= 'mail_template';
		$date['mail_template']=''; 
		$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
		$this->load->view('login/script_list',$data);
	    $this->load->view('includes/footer');
	}
	
	public function Add_mail_template()
	{
		
        $this->load->model('common_models');
		$this->common_models->delete_cache_memory();
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$data['title'] 				= 'Add Mail Template';
		$data['add_new'] 			= 'index.php/login/dashboard/Add_mail_template';
		$records['mail_template'] 	= '';
		$menus['menu']	= 'mail_template'; 
		$data["grid"]	= '';
		$data["ajax"] 	= '';
		$data['add_new'] = '';
	  	$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
	    $this->load->view('login/mail_template',$records);
	    $this->load->view('includes/footer');
	}
	public function Edit_mail_template($link='')
	{
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
        $data['title'] = 'Telemarketing - Mail Template';
		$this->load->model('common_models');
		$records['mail_template']	= $this->common_models->getRecordById('mailTemplate','mailTempId',$link);
		
		//print_r($records['uploadfiles']);die;
		$menus['menu']	= 'mail_template'; 
	  	$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
	    $this->load->view('login/mail_template',$records);
	    $this->load->view('includes/footer');
	}
	
	public function Addscript()
	{
		
        $this->load->model('common_models');
		$this->common_models->delete_cache_memory();
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$data['title'] 				= 'Category';
		$data['add_new'] 			= 'index.php/login/dashboard/AddScript';
		//$records['category']		= $this->common_models->getAllRecords('tbl_category');
		$records['script'] 	= '';
		$menus['menu']	= 'script'; 
		$data["grid"]	= '';
		$data["ajax"] 	= '';
		$data['add_new'] = '';
	  	$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
	    $this->load->view('login/script',$records);
	    $this->load->view('includes/footer');
	}
	
	public function EditScript($link='')
	{
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
        $data['title'] = 'Telemarketing - Script';
		$this->load->model('common_models');
		$records['script']	= $this->common_models->getRecordById('script','script_id',$link);
		
		//print_r($records['uploadfiles']);die;
		$menus['menu']	= 'script'; 
	  	$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
	    $this->load->view('login/script',$records);
	    $this->load->view('includes/footer');
	}
	public function scriptpopup($link)
	{
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$this->load->model('common_models');
		$script	   = $this->common_models->getRecordById('tbl_category','nauto_cate_id',$link);
		//print_r($get_image);die;
		$script_id = $script[0]->script_id; 
		
 $record['scriptmessage'] = $this->common_models->twoWhereConditions('script','script_id','status',$script_id,'1');	    
 $this->load->view('login/scriptpopup',$record);
	}
	
	
	public function begincallpopup($link,$link3='',$link2='')
	{
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$this->load->model('common_models');
$Login_Details = $this->session->userdata('login');
$username = $Login_Details["username"];
		
	$records['buisness']	= $this->common_models->getRecordById('business_lists','auto_buisness_id',$link);
	$records['statuss']		= $this->common_models->getAllRecordsAsc('call_comments','comment_title');
    $records['buisness_id']=$link;
	$records['cat_id'] = $link3;
	$script	   = $this->common_models->getRecordById('tbl_category','nauto_cate_id',$link3);
		//print_r($get_image);die;
		$script_id = $script[0]->script_id; 
 $records['scriptmessage'] = $this->common_models->twoWhereConditions('script','script_id','status',$script_id,'1');	
	if(isset($link2) && $link2!="" && is_numeric($link2)){
	$records['santhoshnext']	= $this->common_models->followup_next($username,$link2);
	$san_nextreccount = count($records['santhoshnext']);
	if(isset($san_nextreccount) && $san_nextreccount !=0){
		 $next_companyid = $records['santhoshnext'][0]->companyid;
		 $AutoId 		= $records['santhoshnext'][0]->AutoId;
		
		$records['sant_next_rec_count'] = $san_nextreccount;
		$records['sant_next_companyid'] = $next_companyid;
		$records['sant_AutoId'] = $AutoId;
	}
	}

	//print_r($records['buisness_next']);
//	print_r($records['endcallnext']);
		
		//print_r($get_image);die;
		//die;
		
		
 $this->load->view('login/begincall',$records);
	}
	
	
	public function BegincallInsert()
    {
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$this->load->model('common_models');
				
		date_default_timezone_set('America/New_York');
		$script_tz 			= date_default_timezone_get();
		$starttime = date('H:i:s');
		$endtime = '00:00:00';
		$callduration = '00:00:00';
		$dt = date('Y-m-d');
		
		$companyid	 		    = trim($this->input->post('companyid'));
		$createdby	 		    = trim($this->input->post('createdby'));
		
		/*set previous record active equal to Close*/
		    $close_values 	=	array('active'     => 'Close');
			$this->db->where('companyid', $companyid);									
			$this->db->update('calltracking', $close_values);	
		/*set previous record active equal to Close*/
		 $values 	=	array('companyid' 	  	=> $companyid,
							'callstarttime' 	=> $starttime,
							'callendtime' 	 	=> $endtime,
							'callduration' 		=> $callduration,
							'createddt' 	    => $dt,
							'createdby' 		=> $createdby);
														                             
														
	     $this->db->insert('calltracking',$values);
		 $Insert_id  = $this->db->insert_id();
		
		
		
		
		 echo ''.$Insert_id.'|'.$starttime.'|'.$dt.'';
		
        //$this->load->view('login/begincall',$data);
	}
	
	public function EndcallInsert()
    {
		if($this->session->userdata('login') == FALSE)
		{
			redirect('login/login','location');
		}
		$this->load->model('common_models');
		$data = $this->input->post('form');
		parse_str($data,$_post);
		$companyid	 		    = $_post['buisness_id'];
		$createdby	 		    = $_post['username'];
	    $callstatus	 		    = $_post['callstatus'];
		$Notes	 		        = $_post['Notes'];
		$cemail	 		        = $_post['cemail'];
		$companyname	 		        = $_post['companyname'];
		$cfname	 		        = $_post['cfname'];
		$clname	 		        = $_post['clname'];
		$calltracking_id	    = $_post['calltracking_id'];
		 $pnumber	    = $_post['pnumber'];
		 if(isset($_post['customattribut'])){
		 $customattribut_data =  $_post['customattribut'];
			if(isset($customattribut_data) && $customattribut_data !=""){
		 		if(count($customattribut_data) > 0){
		  		foreach( $customattribut_data as  $key=>$value) {
			  $getval = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$key);
			  $techid = $this->common_models->getRecordById('tbl_technologies','tech_name',str_replace('_',' ',$getval[1]));
			  $tech_id = $techid[0]->tech_id;
			  $this->common_models->update_custom_values($getval[0],$value,$companyid,$tech_id); 
		  }
		 }
	    }
		 }
		$valuefinal ="";
		$i=0;
	    
		//print_r($customattributmultiple_data);die;
		if(isset($_post['customattributmultiple']) && $_post['customattributmultiple'] !=""){
			$customattributmultiple_data = $_post['customattributmultiple'];
		  if(count($customattributmultiple_data) >0 ) {
			  foreach($customattributmultiple_data as  $key=>$value) {
				 	$getval = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$key);
			  		$techid = $this->common_models->getRecordById('tbl_technologies','tech_name',str_replace('_',' ',$getval[1]));
			   		$tech_id = $techid[0]->tech_id;
					$base_attribut = $getval[0];
				  foreach( $value as  $key=>$value) {	
					  $key1 = $key;
					  $valuefinal .= $value.';';
					  $i++;
				  }
				  $this->common_models->update_custom_values($base_attribut,$valuefinal,$companyid,$tech_id);	
			  }
		  }
		}
		 
		if(isset($_post['follow_date1']) && $_post['follow_date1']!=""){
			$follow_date1 = $_post['follow_date1'];;
		}else{
			$follow_date1 = '-';
		}
		if(isset($_post['followstatus']) && $_post['followstatus']!=""){
			$followstatus = $_post['followstatus'];
		}else{
			$followstatus = '-';
		}
		if(isset($_post['follow_time']) && $_post['follow_time']!=""){
			$follow_time = $_post['follow_time'];
		}else{
			$follow_time = '-';
		}
		
		
		
		date_default_timezone_set('America/New_York');
			$script_tz 			= date_default_timezone_get();
			$endtime = date('H:i:s');
			$dt      = date('Y-m-d');
			$Login_Details = $this->session->userdata('login');
			$username = $Login_Details["username"];
			$unique_id = $Login_Details["unique_id"];
			/*Update call status in  master data*/
			$records['callstatus_name_rec']	= $this->common_models->getRecordById('call_comments','comment_id',$callstatus);
			$callstatus_name=$records['callstatus_name_rec'][0]->comment_title;	
			
			
			/* Get sales manager & person id based on category id start*/
			$records['business_lists_cat_id']	= $this->common_models->getRecordById('business_lists','auto_buisness_id',$companyid);
			$business_lists_cat_ids=$records['business_lists_cat_id'][0]->category;
			$records['sales_team']	= $this->common_models->getRecordById('tbl_category','nauto_cate_id',$business_lists_cat_ids);
			$sales_manager =$records['sales_team'][0]->sales_manager;	
			$sales_person =$records['sales_team'][0]->sales_person;
			$mail_template_id =$records['sales_team'][0]->mail_template_id;	
			/* Get sales manager & person id based on category id end*/
			
			
			$callstatus_values = array('status' => $callstatus_name,'follow_up_date' => $follow_date1,'primary_email' => $cemail,'company_name' => $companyname,'first_name' => $cfname,'last_name' => $clname,'phone' => $pnumber,'sales_manager' => $sales_manager,'sales_person' => $sales_person,'notes' => $Notes);
			//print_r($callstatus_values); die;
			$this->db->where('auto_buisness_id', $companyid);								
			$this->db->update('business_lists', $callstatus_values);
			/*Update call status in  master data*/	
			
							/*virtual crm leads api call*/
		if((isset($callstatus) && $callstatus=='21') || (isset($followstatus) && $followstatus=='21')){	
		/*$urls = "http://ws.virtual-crm.com/ServiceVCRM.svc/SaveToVirtualCRMTeleMarketing?strLSID=telemarketing&pid=$companyid&str1=telemarketingdb&str2=tele_user&str3=tele_pass&str4=business_lists";
		//redirect($urls,'location');
		$proxy = '74.208.106.12:80';
		//echo "update";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		curl_setopt($ch, CURLOPT_URL,$urls);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		$cev = curl_exec($ch);*/ 
		
		$records['virtual_crm_data']	= $this->common_models->getRecordById('business_lists','auto_buisness_id',$companyid);
		$company_name                   =$records['virtual_crm_data'][0]->company_name;
		$first_name                   =$records['virtual_crm_data'][0]->first_name;
		$last_name                   =$records['virtual_crm_data'][0]->last_name;
		$phone                   =$records['virtual_crm_data'][0]->phone;
		$notes                   =$records['virtual_crm_data'][0]->notes;
		$follow_up_date                   =$records['virtual_crm_data'][0]->follow_up_date;
		$sales_manager                   =$records['virtual_crm_data'][0]->sales_manager;
		$sales_person                   =$records['virtual_crm_data'][0]->sales_person;
		$lead_date                   =$records['virtual_crm_data'][0]->lead_date;
		$address1                   =$records['virtual_crm_data'][0]->address1;
		$address2                   =$records['virtual_crm_data'][0]->address2;
		$city                   =$records['virtual_crm_data'][0]->city;
		$state                   =$records['virtual_crm_data'][0]->state;
		$country                   =$records['virtual_crm_data'][0]->country;
		$zipcode                   =$records['virtual_crm_data'][0]->zipcode;
		$secondary_phone                   =$records['virtual_crm_data'][0]->secondary_phone;
		$fax                   =$records['virtual_crm_data'][0]->fax;
		$primary_email                   =$records['virtual_crm_data'][0]->primary_email;
		$website                   =$records['virtual_crm_data'][0]->website;
		
		$virtual_data_post = array('company_name'=>$company_name,
							'first_name'=>$first_name,
							'last_name'=>$last_name,
							'phone'=>$phone,
							'notes'=>$notes,
							'follow_up_date'=>$follow_up_date,
							'sales_manager'=>$sales_manager,
							'sales_person'=>$sales_person,
							'unique_id'=>$unique_id,
							'lead_date'=>$lead_date,
							'address1'=>$address1,
							'address2'=>$address2,
							'city'=>$city,
							'state'=>$state,
							'country'=>$country,
							'zipcode'=>$zipcode,
							'secondary_phone'=>$secondary_phone,
							'fax'=>$fax,
							'primary_email'=>$primary_email,
							'website'=>$website);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'http://telemark.carpetscleaners.us/mssql_api/telemarkapi.php?action=leadinsert');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $virtual_data_post);
			$virtual_data_exec= curl_exec($ch);
			curl_close($ch);
		
		}
		/*virtual crm leads api call*/					
			$record['callexist'] = $this->common_models->threeWhereConditions('calltracking','companyid','createdby','AutoId',$companyid,$username,$calltracking_id);
			
			if(count($record['callexist'])>0){
				$starttime    = $record['callexist'][0]->callstarttime;
				$to_time      = strtotime($endtime);
				$from_time    = strtotime($starttime);
				$time_diff    = $to_time - $from_time;
				$callduration = gmdate('H:i:s', $time_diff);
				
				if(isset($followstatus) && $followstatus =="-"){
					$create_record= 'Yes';
				}else{
					$records['create_record']	= $this->common_models->getRecordById('call_comments','comment_id',$followstatus);
					$create_record=$records['create_record'][0]->create_new_record;	
				}
				
				if($create_record=='Yes'){
					
					if((isset($callstatus) && $callstatus=='21') || (isset($followstatus) && $followstatus=='21')){
						$activestatus ='Close';
					}else{
						$activestatus ='Open';
					}
					$records['business_lists']	= $this->common_models->getRecordById('business_lists','auto_buisness_id',$companyid);
					$first_name=$records['business_lists'][0]->first_name;		
					$last_name=$records['business_lists'][0]->last_name;	 	
					$email=$records['business_lists'][0]->primary_email;

					if(isset($email) && $email!=""){
						if((isset($callstatus) && $callstatus=='21') || (isset($followstatus) && $followstatus=='21')){	
							
						$records['mail_temp']	= $this->common_models->get_interested_mail_content($mail_template_id);
						$mailTemplateName   =$records['mail_temp'][0]->mailTemplateName;	
						$mailTemplateContent =$records['mail_temp'][0]->mailTemplateContent;	
						$shortcode = array("%%FIRST_NAME%%", "%%LAST_NAME%%");
						$orgstring   = array($first_name, $last_name);
						$mail_cont = str_replace($shortcode, $orgstring, $mailTemplateContent);

		$send=$mail_cont;

		$from='info@desss.com';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		$headers .= 'From:'. $from . "\r\n";
		
		$INCLUDE_DIR = "includes/mailer/";
		
		require($INCLUDE_DIR . "class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();                                   // send via SMTP
		$mail->Host     = "smtp.1and1.com"; // SMTP servers
		$mail->Port     = 587 ; // SMTP Port
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->Username = $from;  // SMTP username
		$mail->Password = "earth05"; // SMTP password
		$mail->From     = "info@desss.com";
		$mail->FromName = "Telemarketing";
		$mail->AddAddress($email);      
		$mail->AddBCC("santhosh.s@desss.com");
		$mail->AddBCC("dev@desss.com");     
		$subject = $mailTemplateName;
		$mail->IsHTML(true);                               // send as HTML
		$mail->Subject  =  $subject;
		$mail->Body     =  $send;	
		 if(!$mail->Send())
			{
				//echo "mail not sent";
			}
			else
			{
				//echo "mail sent";
			}
		
						}else{/*
							
						$records['mail_temp']	= $this->common_models->get_mail_content();
						$mailTemplateName   =$records['mail_temp'][0]->mailTemplateName;	
						$mailTemplateContent =$records['mail_temp'][0]->mailTemplateContent;	
						$shortcode = array("%%FIRST_NAME%%", "%%LAST_NAME%%");
						$orgstring   = array($first_name, $last_name);
						$mail_cont = str_replace($shortcode, $orgstring, $mailTemplateContent);

		$send=$mail_cont;

		$from='santhosh.s@desss.com';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		$headers .= 'From:'. $from . "\r\n";
		
		$INCLUDE_DIR = "includes/mailer/";
		
		require($INCLUDE_DIR . "class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();                                   // send via SMTP
		$mail->Host     = "smtp.1and1.com"; // SMTP servers
		$mail->Port     = 587 ; // SMTP Port
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->Username = $from;  // SMTP username
		$mail->Password = "1234567"; // SMTP password
		$mail->From     = "info@desss.com";
		$mail->FromName = "Telemarketing";
		$mail->AddAddress($email);      
		$mail->AddBCC("santhosh.s@desss.com");
		$mail->AddBCC("dev@desss.com");     
		$subject = $mailTemplateName;
		$mail->IsHTML(true);                               // send as HTML
		$mail->Subject  =  $subject;
		$mail->Body     =  $send;	
		 if(!$mail->Send())
			{
				//echo "mail not sent";
			}
			else
			{
				//echo "mail sent";
			}
		
						*/}
		            }	
				}else{
					if((isset($callstatus) && $callstatus=='21') || (isset($followstatus) && $followstatus=='21')){
						$activestatus ='Close';
					}else{
						$activestatus ='Open';
					}
				}
							

	
		                            $values 	=	array('callendtime'     => $endtime,
														'callduration' 		=> $callduration,
														'createddt' 	    => $dt,
														'createdby' 		=> $createdby,
														'call_status' 	    => $callstatus,
														'active' 	        => $activestatus,
														'follow_date' 	    => $follow_date1,
														'follow_status' 	=> $followstatus,
														'notes' 	        => $Notes,
														'follow_time' 	    => $follow_time);
														
																	
			$this->db->where('AutoId', $calltracking_id);
			$this->db->where('companyid', $companyid);
			$this->db->where('createdby', $username);									
			$this->db->update('calltracking', $values);							
			echo $callduration;
			}	
		
		//redirect('login/dashboard/EditBusiness/'.$calltracking_id,'location');
	
		
	}
	
	
	public function mail_temp_insert($link1)
    {
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$this->load->model('common_models');
		
		$mail_temp_id	 		= trim($this->input->post('mail_temp_id'));
		$mail_sub_name	 	= trim($this->input->post('mail_sub_name'));
		$mail_content 	    = trim($this->input->post('mail_content'));
		$statuss	 		= trim($this->input->post('status'));
		$interested_mail_template	 		= trim($this->input->post('interested_mail_template'));
		if($statuss == 'on'){
		$status ='1';
		}else{
		$status = '0';
		}
		if($interested_mail_template == 'on'){
		$interested_mail_template ='1';
		}else{
		$interested_mail_template = '0';
		}
		
		if($mail_temp_id  != ""){
							$values 			= array('mailTemplateName' 		=> $mail_sub_name,
														'mailTemplateContent' => $mail_content,
		                    	  					  	'mailTemplateStatus' 		=> $status,
														'intMailTemplateStatus' 		=> $interested_mail_template);
		
			$this->db->where('mailTempId', $mail_temp_id);								
			$this->db->update('mailTemplate', $values);
			$Insert_id = $mail_temp_id;
		}else{
			$values 			= array('mailTemplateName' 		=> $mail_sub_name,
														'mailTemplateContent' => $mail_content,
		                    	  					  	'mailTemplateStatus' 		=> $status,
														'intMailTemplateStatus' 		=> $interested_mail_template);
									
			//print_r($values );die;
	     	$this->db->insert('mailTemplate',$values);
			$Insert_id  = $this->db->insert_id();
		}
		
		if($link1 == 'save'){
				redirect('login/dashboard/Edit_mail_template/'.$Insert_id,'location');		
			}elseif($link1 == 'saveClose'){
				redirect('login/dashboard/mail_template','location');		
			}elseif($link1 == 'saveNew'){
				redirect('login/dashboard/Add_mail_template','location');			
			}
		
	}
	
	public function ScriptInsert($link1)
    {
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$this->load->model('common_models');
				
		
		$script_id	 		= trim($this->input->post('script_id'));
		$script_title	 	= trim($this->input->post('script_title'));
		$script_name 	    	= trim($this->input->post('script_cms'));
		$statuss	 		= trim($this->input->post('status'));
						
		if($statuss == 'on'){
		$status ='1';
		}else{
		$status = '0';
		}
				
		$category_data 		 = $this->common_models->getRecordById('script','script_id',$script_id);
		
		
		
		if($script_id  != ""){
							$values 			= array('script_title' 		=> $script_title,
														'script_name' => $script_name,
		                    	  					  	'status' 		=> $status);
		
			
			$this->db->where('script_id', $script_id);								
			$this->db->update('script', $values);
			$Insert_id = $script_id;
		}else{
			$values 			= array('script_title' 		=> $script_title,
														'script_name' => $script_name,
		                    	  					  	'status' 		=> $status);
									
			//print_r($values );die;
	     	$this->db->insert('script',$values);
			$Insert_id  = $this->db->insert_id();
		}
		
		if($link1 == 'save'){
				redirect('login/dashboard/EditScript/'.$Insert_id,'location');		
			}elseif($link1 == 'saveClose'){
				redirect('login/dashboard/Script','location');		
			}elseif($link1 == 'saveNew'){
				redirect('login/dashboard/AddScript','location');			
			}
		
	}
	
	public function Script_Check_Availability()
	{
		
		$this->load->model('common_models');
		$script_title = $this->input->post('script_title');
		$script_id = $this->input->post('script_id');
		
			if($script_id == '')
			{
				$record['script'] = $this->common_models->getRecordById('script','script_title',$script_title);
				if($record['script'] != '')
				{
						echo "no";
				}else{
						echo "yes";
				}
			}else{	
			  $record['script'] = $this->common_models->getRecordByEditDuplicateValues('script','script_id','script_title',$script_id,$script_title);
			  if($record['script'])
			  {
				 echo "no";
			  }else{
				  echo "yes";
			  }
		   } 	
	}
	//SCRIPT END
	
	
	// USER START
	public function users()
	{
		
		if($this->session->userdata('login') == FALSE)
		{
			redirect('login/login','location');
		}
		ob_start();
		$this->load->model('common_models');
		$this->load->file('KoolControls/KoolGrid/koolgrid.php') ;
		include "KoolControls/KoolAjax/koolajax.php";
		include "KoolControls/KoolAjax/dbconnect.php";
		$koolajax->scriptFolder = base_url()."KoolControls/KoolAjax";
		$ds = new MySQLDataSource($db_con);
		
		//$ds->SelectCommand = "SELECT nauto_cate_id,ccate_name,ccate_description,ccate_img,ncate_order,status_flag FROM  tbl_category";
		$ds->SelectCommand = "SELECT * FROM  users order by auto_user_id desc";
		
		$ds->DeleteCommand = "DELETE FROM users WHERE auto_user_id =@auto_user_id";
	
		$grid = new KoolGrid("grid");
		$grid->styleFolder="office2010blue";
		$grid->DataSource = $ds;
		$grid->AllowResizing = true;	
		$grid->MasterTable->ShowFunctionPanel = true;	
		$grid->MasterTable->InsertSettings->ColumnNumber = 2;
		$grid->RowAlternative = true;
		$grid->AllowMultiSelecting = true;
		$grid->AllowEditing = true;
		$grid->AllowDeleting = true;
		$grid->AjaxEnabled = true;
		$grid->AjaxLoadingImage =  "KoolControls/KoolAjax/loading/5.gif";
		$grid->AllowHovering = true;
		$grid->AllowSorting = true;//Enable sorting for all rows;
		$grid->SingleColumnSorting = true;
		//$grid->AllowFiltering = true;//Enable filtering for all rows;
		$grid->AllowFiltering = false;
		$grid->AllowResizing = true;
		$grid->AllowInserting = false;
		$grid->AutoGenerateDeleteColumn = true;
		$grid->AutoGenerateEditColumn = true;	
		$grid->MasterTable->EditSettings->Mode = "form";
		//$grid->MasterTable->EditSettings->InputFocus = "HideGrid";//You can test the "BlurGrid"
		//$grid->AutoGenerateRowSelectColumn = true;
		$grid->AutoGenerateEditColumn = false;
		$grid->PageSize  = 50;
		$grid->ShowStatus = true;
		$grid->MasterTable->Pager = new GridPrevNextAndNumericPager();
		$column = new GridEditDeleteColumn();	
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditUser/{auto_user_id}" style="color:#000000; text-decoration:none">{username}</a>';
		$col->HeaderText = "User Name";
		$grid->MasterTable->AddColumn($col);
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditUser/{auto_user_id}" style="color:#000000; text-decoration:none">{first_name}</a>';
		$col->HeaderText = "First Name";
		$grid->MasterTable->AddColumn($col);
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditUser/{auto_user_id}" style="color:#000000; text-decoration:none">{contact_number}</a>';
		$col->HeaderText = "Contact Number";
		$grid->MasterTable->AddColumn($col);
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditUser/{auto_user_id}" style="color:#000000; text-decoration:none">{address1}</a>';
		$col->HeaderText = "Address";
		$grid->MasterTable->AddColumn($col);
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditUser/{auto_user_id}" style="color:#000000; text-decoration:none">{city}</a>';
		$col->HeaderText = "City";
		$grid->MasterTable->AddColumn($col);
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditUser/{auto_user_id}" style="color:#000000; text-decoration:none">{state}</a>';
		$col->HeaderText = "State";
		$grid->MasterTable->AddColumn($col);
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditUser/{auto_user_id}" style="color:#000000; text-decoration:none">{zipcode}</a>';
		$col->HeaderText = "Zip Code";
		$grid->MasterTable->AddColumn($col);
		
		
					
		$grid->Process();	
		$data["grid"] = $grid->Render();
		$data["ajax"] = $koolajax->Render();
		$data['title']= 'Telemarketing - Users';
		$data['add_new'] = 'index.php/login/dashboard/AddUser';
		$menus['menu']	= 'user';
		$date['user']=''; 
		$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
		$this->load->view('login/user_list',$data);
	    $this->load->view('includes/footer');
	}
	
	public function Adduser()
	{
		
        $this->load->model('common_models');
		$this->common_models->delete_cache_memory();
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$data['title'] 				= 'Users';
		$data['add_new'] 			= 'index.php/login/dashboard/AddUser';
		$records['state']		= $this->common_models->getAllRecords('kcb_tbstates');
		$records['script']		= $this->common_models->getAllRecords('script');
		$data['category']	= $this->common_models->getAllRecords1('tbl_category');
		$records['user'] 	= '';
		$menus['menu']	= 'user'; 
		$data["grid"]	= '';
		$data["ajax"] 	= '';
		$data['add_new'] = '';
	  	$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
	    $this->load->view('login/user',$records);
	    $this->load->view('includes/footer');
	}
	
	public function Edituser($link)
	{
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
        $data['title'] = 'Telemarketing - User';
		$this->load->model('common_models');
		$records['state']		= $this->common_models->getAllRecords('kcb_tbstates');
		$records['script']		= $this->common_models->getAllRecords('script');
		$data['category']	= $this->common_models->getAllRecords1('tbl_category');
		$records['user']	= $this->common_models->getRecordById('users','auto_user_id',$link);
		
		//print_r($records['uploadfiles']);die;
		$menus['menu']	= 'user'; 
	  	$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
	    $this->load->view('login/user',$records);
	    $this->load->view('includes/footer');
	}
	
	public function UserInsert($link1)
    {
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$this->load->model('common_models');
				
		$user_id	 		= trim($this->input->post('user_id'));
		$user_name	 		= trim($this->input->post('user_name'));
		$password	 		= trim($this->input->post('password'));
		$first_name 	    = trim($this->input->post('first_name'));
		$last_name	 		= trim($this->input->post('last_name'));
		
		$contact_number	 	= trim($this->input->post('contact_number'));
		$address1	 		= trim($this->input->post('address1'));
		$address2 	    	= trim($this->input->post('address2'));
		$city	 			= trim($this->input->post('city'));
		
		$state	 			= trim($this->input->post('state'));
		$user_permission	 			= trim($this->input->post('user_permission'));
		$zip	 			= trim($this->input->post('zip'));
		$script_id 	   		= trim($this->input->post('script_id'));
		$category 	   		= $this->input->post('category_id');
		$unique_id 	   		= $this->input->post('unique_id');
		$category_id = implode(",", $category);
		$createddt 			= date('Y-m-d');
		$createdby 			= '';
						
		
		if($user_id  != ""){
							$values 			= array('username' 		  => $user_name,
														'password' 		  => $password,
		                    	  					  	'user_permission' => $user_permission,
														'first_name' 	  => $first_name,
														'last_name' 	  => $last_name,
														'contact_number'  => $contact_number,
														'address1' 		  => $address1,
														'address2' 	      => $address2,
														'city' 		      => $city,
														'state' 		  => $state,
														'zipcode' 		  => $zip,
														'scriptid' 		  => $script_id,
														'category_id' 		  => $category_id,
														'createddt' 	  => $createddt,
														'createdby' 	  => $createdby,
														'unique_id' 	  => $unique_id);
		
			
			$this->db->where('auto_user_id', $user_id);								
			$this->db->update('users', $values);
			$Insert_id = $user_id;
		}else{
			$values 			= 						array('username'  => $user_name,
														'password' 		  => $password,
		                    	  					  	'user_permission' => $user_permission,
														'first_name' 	  => $first_name,
														'last_name' 	  => $last_name,
														'contact_number'  => $contact_number,
														'address1' 		  => $address1,
														'address2' 	      => $address2,
														'city' 		      => $city,
														'state' 		  => $state,
														'zipcode' 		  => $zip,
														'scriptid' 		  => $script_id,
														'category_id' 		  => $category_id,
														'createddt' 	  => $createddt,
														'createdby' 	  => $createdby,
														'unique_id' 	  => $unique_id);
									
			//print_r($values );die;
	     	$this->db->insert('users',$values);
			$Insert_id  = $this->db->insert_id();
		}
		
		if($link1 == 'save'){
				redirect('login/dashboard/EditUser/'.$Insert_id,'location');		
			}elseif($link1 == 'saveClose'){
				redirect('login/dashboard/users','location');		
			}elseif($link1 == 'saveNew'){
				redirect('login/dashboard/AddUser','location');			
			}
		
	}
	
	public function User_Check_Availability()
	{
		
		$this->load->model('common_models');
		$user_name = $this->input->post('user_name');
		$user_id = $this->input->post('user_id');
		
			if($user_id == '')
			{
				$record['user'] = $this->common_models->getRecordById('users','username',$user_name);
				if($record['user'] != '')
				{
						echo "no";
				}else{
						echo "yes";
				}
			}else{	
			  $record['user'] = $this->common_models->getRecordByEditDuplicateValues('users','auto_user_id','username',$user_id,$user_name);
			  if($record['user'])
			  {
				 echo "no";
			  }else{
				  echo "yes";
			  }
		   } 	
	}
	//USER END
	
	
	public function Company_Check_Availability()
	{
		
		$this->load->model('common_models');
		 $company_name = $this->input->post('company_name');
		 $buisness_id  = $this->input->post('buisness_id');
			if($buisness_id == '')
			{
				$record['company'] = $this->common_models->getRecordById('business_lists','company_name',$company_name);
				if(count($record['company']) >0)
				{
						echo "no";
				}else{
						echo "yes";
				}
			}else{	
			  $record['company'] = $this->common_models->getRecordByEditDuplicateValues('business_lists','auto_buisness_id','company_name',$buisness_id,$company_name);
			  if(count($record['company']) >0)
			  {
				 echo "no";
			  }else{
				  echo "yes";
			  }
		   } 	
	}
	
	// CALL COMMENTS START
	public function callcomments()
	{
		
		if($this->session->userdata('login') == FALSE)
		{
			redirect('login/login','location');
		}
		ob_start();
		$this->load->model('common_models');
		$this->load->file('KoolControls/KoolGrid/koolgrid.php') ;
		include "KoolControls/KoolAjax/koolajax.php";
		include "KoolControls/KoolAjax/dbconnect.php";
		$koolajax->scriptFolder = base_url()."KoolControls/KoolAjax";
		$ds = new MySQLDataSource($db_con);
		
		//$ds->SelectCommand = "SELECT nauto_cate_id,ccate_name,ccate_description,ccate_img,ncate_order,status_flag FROM  tbl_category";
		$ds->SelectCommand = "SELECT * FROM  call_comments order by comment_title asc";
		
		$ds->DeleteCommand = "DELETE FROM call_comments WHERE comment_id=@comment_id";
	
		$grid = new KoolGrid("grid");
		$grid->styleFolder="office2010blue";
		$grid->DataSource = $ds;
		$grid->AllowResizing = true;	
		$grid->MasterTable->ShowFunctionPanel = true;	
		$grid->MasterTable->InsertSettings->ColumnNumber = 2;
		$grid->RowAlternative = true;
		$grid->AllowMultiSelecting = true;
		$grid->AllowEditing = true;
		$grid->AllowDeleting = true;
		$grid->AjaxEnabled = true;
		$grid->AjaxLoadingImage =  "KoolControls/KoolAjax/loading/5.gif";
		$grid->AllowHovering = true;
		$grid->AllowSorting = true;//Enable sorting for all rows;
		$grid->SingleColumnSorting = true;
		//$grid->AllowFiltering = true;//Enable filtering for all rows;
		$grid->AllowFiltering = false;
		$grid->AllowResizing = true;
		$grid->AllowInserting = false;
		$grid->AutoGenerateDeleteColumn = true;
		$grid->AutoGenerateEditColumn = true;	
		$grid->MasterTable->EditSettings->Mode = "form";
		//$grid->MasterTable->EditSettings->InputFocus = "HideGrid";//You can test the "BlurGrid"
		//$grid->AutoGenerateRowSelectColumn = true;
		$grid->AutoGenerateEditColumn = false;
		$grid->PageSize  = 50;
		$grid->ShowStatus = true;
		$grid->MasterTable->Pager = new GridPrevNextAndNumericPager();
		$column = new GridEditDeleteColumn();	
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditCallComment/{comment_id}" style="color:#000000; text-decoration:none">{comment_title}</a>';
		$col->HeaderText = "Comment Title";
		$grid->MasterTable->AddColumn($col);
		
		
		
		$column = new GridDropDownColumn();
		//$column->AddItem("","");
		$column->AddItem("Yes","Yes");
		$column->AddItem("No","No");
		//$column->Filter = array("Value"=>"Yes","Exp"=>"Equal");
		$column->HeaderText = "Status";	
		$column->DataField = "status";
		$grid->MasterTable->AddColumn($column);
	
	    $col = new GridCustomColumn();
		$col->ItemTemplate = '{create_new_record}';
		$col->HeaderText = "Create New Record";
		$grid->MasterTable->AddColumn($col);
	   
	    $col = new GridCustomColumn();
		$col->ItemTemplate = '{follow_up_details}';
		$col->HeaderText = "Follow Up Details";
		$grid->MasterTable->AddColumn($col);
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '{crm_record}';
		$col->HeaderText = "CRM Record";
		$grid->MasterTable->AddColumn($col);
					
		$grid->Process();	
		$data["grid"] = $grid->Render();
		$data["ajax"] = $koolajax->Render();
		$data['title']= 'Telemarketing - CallComment';
		$data['add_new'] = 'index.php/login/dashboard/AddCallComment';
		$menus['menu']	= 'callcomments';
		$date['category']=''; 
		$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
		$this->load->view('login/callcomment_list',$data);
	    $this->load->view('includes/footer');
	}
	
	public function AddCallComment()
	{
		
        $this->load->model('common_models');
		$this->common_models->delete_cache_memory();
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$data['title'] 				= 'AddCallComment';
		$data['add_new'] 			= 'index.php/login/dashboard/AddCallComment';
	
		$records['comments'] 	= '';
		$menus['menu']	= 'callcomments'; 
		$data["grid"]	= '';
		$data["ajax"] 	= '';
		$data['add_new'] = '';
	  	$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
	    $this->load->view('login/callcomment',$records);
	    $this->load->view('includes/footer');
	}
	
	public function EditCallComment($link)
	{
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
        $data['title'] = 'Telemarketing - CallComment';
		$this->load->model('common_models');
		$records['comments']	= $this->common_models->getRecordById('call_comments','comment_id',$link);
		
		//print_r($records['uploadfiles']);die;
		$menus['menu']	= 'CallComment'; 
	  	$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
	    $this->load->view('login/callcomment',$records);
	    $this->load->view('includes/footer');
	}
	
	public function CommentInsert($link1)
    {
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$this->load->model('common_models');
				
		
		$comment_id	 		= trim($this->input->post('comment_id'));
		$comment_title	 	= trim($this->input->post('comment_title'));
		$valid_status1	 	= trim($this->input->post('valid_status'));
		$new_record1	 	= trim($this->input->post('new_record'));
		$follow_up_details	 	= trim($this->input->post('follow_up_details'));
		$crm_record			= trim($this->input->post('crm_record'));
		if($valid_status1 == "on"){
			$valid_status ="Yes";
		}else{
			$valid_status ="No";
		}
		if($new_record1 == "on"){
			$new_record ="Yes";
		}else{
			$new_record ="No";
		}
		
		if($follow_up_details == "on"){
			$follow_up_details ="Yes";
		}else{
			$follow_up_details ="No";
		}
		if($crm_record == "on"){
			$crm_record ="Yes";
		}else{
			$crm_record ="No";
		}
		if($comment_id  != ""){	
			$values	= array('comment_title'             => $comment_title,
							'status' 		            => $valid_status,
							'create_new_record' 		=> $new_record,
							'follow_up_details' 		=> $follow_up_details,
							'crm_record'			   => $crm_record);
							
							
			$this->db->where('comment_id', $comment_id);								
			$this->db->update('call_comments', $values);
			$Insert_id = $comment_id;
		}else{    
			$values 			= array('comment_title' 		           => $comment_title,
										'status' 				            => $valid_status,
										'create_new_record' 		        => $new_record,
										'follow_up_details' 		=> $follow_up_details);
			//print_r($values );die;
	     	$this->db->insert('call_comments',$values);
			$Insert_id  = $this->db->insert_id();
		}
		
		if($link1 == 'save'){
				redirect('login/dashboard/EditCallComment/'.$Insert_id,'location');		
			}elseif($link1 == 'saveClose'){
				redirect('login/dashboard/callcomments','location');		
			}elseif($link1 == 'saveNew'){
				redirect('login/dashboard/AddCallComment','location');			
			}
		
	}
	
	public function delete_callcomment($category_id)
	{
		date_default_timezone_set('America/New_York');
		$script_tz 			= date_default_timezone_get();
		$this->load->model('common_models');
		if($this->session->userdata('login') == FALSE)
		{
			redirect('login/login','location');
		}
		$get_image 	   = $this->common_models->getRecordById('tbl_category','nauto_cate_id',$category_id);
		//print_r($get_image);die;
		$path = "./includes/category/".$get_image[0]->ccate_img; 
		unlink($path);
		$values 				   = array('ccate_img'	=> '');
		$this->db->where('nauto_cate_id', $category_id);								
		$this->db->update('tbl_category', $values);
		
	}
	 
	//CALL COMMENTS END
	

	
	public function Category_Check_Availability()
	{
		
		$this->load->model('common_models');
		$category_name = $this->input->post('category_name');
		$category_id = $this->input->post('category_id');
		
			if($category_id == '')
			{
				$record['category_name'] = $this->common_models->getRecordById('tbl_category','ccate_name',$category_name);
				if($record['category_name'] != '')
				{
						echo "no";
				}else{
						echo "yes";
				}
			}else{	
			  $record['category_name'] = $this->common_models->getRecordByEditDuplicateValues('tbl_category','nauto_cate_id','ccate_name',$category_id,$category_name);
			  if($record['category_name'])
			  {
				 echo "no";
			  }else{
				  echo "yes";
			  }
		   } 	
	}
	
	public function Comment_Check_Availability()
	{
		
		$this->load->model('common_models');
		$comment_title = $this->input->post('comment_title');
		$comment_id = $this->input->post('comment_id');
		
			if($comment_id == '')
			{
				$record['category_name'] = $this->common_models->getRecordById('call_comments','comment_title',$comment_title);
				if($record['category_name'] != '')
				{
						echo "no";
				}else{
						echo "yes";
				}
			}else{	
			  $record['category_name'] = $this->common_models->getRecordByEditDuplicateValues('call_comments','comment_id','comment_title',$comment_title,$comment_id);
			  if($record['category_name'])
			  {
				 echo "no";
			  }else{
				  echo "yes";
			  }
		   } 	
	}
	
	public function businesslist()
	{
		
		
		if($this->session->userdata('login') == FALSE)
		{
			redirect('login/login','location');
		}
		$Login_Details = $this->session->userdata('login');
		$userpermission = $Login_Details["user_permission"];
		$category_id = $Login_Details["category_id"];

		$this->load->model('common_models');
		ob_start();
		$this->load->file('KoolControls/KoolGrid/koolgrid.php') ;
		
		include "KoolControls/KoolAjax/koolajax.php";
		include "KoolControls/KoolAjax/dbconnect.php";
		$koolajax->scriptFolder = base_url()."KoolControls/KoolAjax";
		$ds = new MySQLDataSource($db_con);
		
		if($userpermission==1){	
		  $ds->SelectCommand = "SELECT A.auto_buisness_id,A.company_name,A.first_name,A.last_name,A.address1,A.city,A.state,A.zipcode,A.primary_email,A.phone,A.website,A.active,B.ccate_name FROM business_lists A join tbl_category B on A.category = B.nauto_cate_id";
		// die;
		}else{
		 $ds->SelectCommand = "select * from business_lists where active='Yes' and category IN ( ".$category_id." )";
		 //$ds->SelectCommand = "SELECT A.company_name,A.first_name,A.last_name,A.address1,A.city,A.state,A.zipcode,A.primary_email,A.phone,A.website,B.ccate_name FROM  business_lists A join tbl_category B on A.category = B.nauto_cate_id where A.category IN ( ".$category_id." )";
		 
		}
			
		$ds->DeleteCommand = "DELETE FROM business_lists WHERE auto_buisness_id=@auto_buisness_id";
		$grid = new KoolGrid("grid");
		$grid->styleFolder="office2010blue";
		$grid->scriptFolder = base_url()."KoolControls/KoolGrid";
		$grid->DataSource = $ds;
		$grid->AllowResizing = true;	
		$grid->MasterTable->ShowFunctionPanel = true;	
		$grid->MasterTable->InsertSettings->ColumnNumber = 2;
		$grid->RowAlternative = true;
		$grid->AllowMultiSelecting = true;
		//$grid->AllowEditing = true;
		$grid->AllowDeleting = true;
		$grid->AjaxEnabled = true;
		$grid->AjaxLoadingImage =  "KoolControls/KoolAjax/loading/5.gif";
		$grid->AllowHovering = true;
		$grid->AllowSorting = true;//Enable sorting for all rows;
		$grid->SingleColumnSorting = true;
		//$grid->AllowFiltering = true;//Enable filtering for all rows;
		$grid->AllowFiltering = false;
		$grid->AllowResizing = true;
		$grid->AllowInserting = false;
		$grid->PageSize  = 50;
		$grid->AutoGenerateDeleteColumn = true;
		//$grid->FilterOptions  = array("No_Filter","Greater_Than","Less_Than");
		//$grid->AutoGenerateEditColumn = true;	
		$grid->MasterTable->EditSettings->Mode = "form";
		//$grid->MasterTable->EditSettings->InputFocus = "HideGrid";//You can test the "BlurGrid"
		//$grid->AutoGenerateRowSelectColumn = true;
		$grid->MasterTable->Pager = new GridPrevNextAndNumericPager();
		
		/*$col = new GridCustomColumn();
		$col->HeaderText = "EDIT";
		$col->AllowFiltering = false;
		$col->AllowSorting = false;	
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditBusiness/{auto_buisness_id}" style="color:#000000; text-decoration:none" class=kgrLinkEdit>Edit</a>';
		$grid->MasterTable->AddColumn($col);*/
		
		$column = new GridEditDeleteColumn();
		$column->HeaderText = "Delete";
		$column->Align = "center";
		$column->ShowEditButton = false;
		$grid->MasterTable->AddColumn($column);
	
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditBusiness/{auto_buisness_id}" style="color:#000000; text-decoration:none">{company_name}</a>';
		$col->HeaderText = "Company Name";
		$grid->MasterTable->AddColumn($col);
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditBusiness/{auto_buisness_id}" style="color:#000000; text-decoration:none">{first_name}   {last_name}</a>';
		$col->HeaderText = "Name";
		$grid->MasterTable->AddColumn($col);
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditBusiness/{auto_buisness_id}" style="color:#000000; text-decoration:none">{address1}</a>';
		$col->HeaderText = "Address1";
		$grid->MasterTable->AddColumn($col);
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditBusiness/{auto_buisness_id}" style="color:#000000; text-decoration:none">{ccate_name}</a>';
		$col->HeaderText = "Category";
		$grid->MasterTable->AddColumn($col);
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditBusiness/{auto_buisness_id}" style="color:#000000; text-decoration:none">{city}</a>';
		$col->HeaderText = "city";
		$grid->MasterTable->AddColumn($col);
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditBusiness/{auto_buisness_id}" style="color:#000000; text-decoration:none">{state}</a>';
		$col->HeaderText = "State";
		$grid->MasterTable->AddColumn($col);
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditBusiness/{auto_buisness_id}" style="color:#000000; text-decoration:none">{zipcode}</a>';
		$col->HeaderText = "Zipcode";
		$grid->MasterTable->AddColumn($col);
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditBusiness/{auto_buisness_id}" style="color:#000000; text-decoration:none">{primary_email}</a>';
		$col->HeaderText = "Primary Email";
		$grid->MasterTable->AddColumn($col);
		
		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditBusiness/{auto_buisness_id}" style="color:#000000; text-decoration:none">{phone}</a>';
		$col->HeaderText = "Phone";
		$grid->MasterTable->AddColumn($col);

		$col = new GridCustomColumn();
		$col->ItemTemplate = '<a href="'.base_url().'index.php/login/dashboard/EditBusiness/{auto_buisness_id}" style="color:#000000; text-decoration:none">{website}</a>';
		$col->HeaderText = "Website";
		$grid->MasterTable->AddColumn($col);
		
		$column = new GridDropDownColumn();
		$column->AddItem("Yes","Yes");
		$column->AddItem("No","No");
		$column->Filter = array("Value"=>"Yes","Exp"=>"Equal");
		$column->HeaderText = "Active";	
		$column->DataField = "active";
		$grid->MasterTable->AddColumn($column);
		
					
		$grid->Process();	
		/*if(isset($_POST["ExportToCSV"]))
		{
		ob_end_clean();
		$grid->GetInstanceMasterTable()->ExportToCSV();
		}*/
		$data["grid"] = $grid->Render();
		$data["ajax"] = $koolajax->Render();
		$data["filter"] = "yes";
	
		$Login_Details = $this->session->userdata('login');
		$username = $Login_Details["username"];
		$record['search'] = $this->common_models->getRecordByIdDescLimitOne('tbl_defaults','userid',$username);
		//print_r($record['search']);
		
		if(count($record['search'])>0){
				$data['txtcategory']		=	$record['search'][0]->category;
				$data['txtstate']			=	 $record['search'][0]->state;
				$data['txtcity']			=	$record['search'][0]->city;
				$data['txtcallcomments']	=	$record['search'][0]->callstatus;
		}else{
			$category_session        =   $this->session->userdata('txtcategory');
			 $state_session			=	$this->session->userdata('txtstate');
			 $city_session			=	$this->session->userdata('txtcity');
			 $status_session	=	$this->session->userdata('txtcallcomments');
			 
				$data['txtcategory']		=	$category_session;
				$data['txtstate']			=	 $state_session;
				$data['txtcity']			=	$city_session;
				$data['txtcallcomments']	=	$status_session;
		}
		
		$data['title']		= 'Telemarketing - Business List';
		$data['add_new'] 	= 'index.php/login/dashboard/AddBusiness';
		$menus['menu']		= 'businesslist';
		
		
		$data['category']	= $this->common_models->getAllRecordsinclause($category_id); 
		$data['states']		= $this->common_models->getAllRecords2('kcb_tbstates');
		$data['city']		= $this->common_models->getAllRecordsDist('business_lists','city');
		//$data['city']		= $this->common_models->getAllRecords('business_lists');
		$data['callcomments']= $this->common_models->getAllRecords3('call_comments');
		
		
		$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
		$this->load->view('login/business_list_grid',$data);
	    $this->load->view('includes/footer');
	}
	
	public function Ajaxstate()
	{
		
        $this->load->model('common_models');
		$this->common_models->delete_cache_memory();
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$category_id  		= $this->input->post('category_id');
		
		$records['states']		= $this->common_models->getAllDistinctRecordwhere1('business_lists','state','category',$category_id);
		
	  	
	    $this->load->view('login/business_state',$records);
	    
	}
	
	public function Ajaxcatcity()
	{
		
        $this->load->model('common_models');
		$this->common_models->delete_cache_memory();
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$category_id  		= $this->input->post('category_id');
		
		$records['city']		= $this->common_models->getAllDistinctRecordwhere1('business_lists','city','category',$category_id);
		
	  	
	    $this->load->view('login/business_city',$records);
	    
	}
	
	
	public function Ajaxcity()
	{
		
        $this->load->model('common_models');
		$this->common_models->delete_cache_memory();
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$txtstate  		= $this->input->post('txtstate');
		$category_id  		= $this->input->post('category_id');
	
		$records['city']		= $this->common_models->getAllDistinctRecordwhere('business_lists','city','state','category',$txtstate,$category_id );
		
	    $this->load->view('login/business_city',$records);
	    
	}
	
	
	
	
	public function search_businesslist($link='')
	{
		
		if($this->session->userdata('login') == FALSE)
		{
			redirect('login/login','location');
		}
		$this->load->library('session');
		$this->load->helper("url");
		$this->load->library('pagination');
		$Login_Details = $this->session->userdata('login');
		$userpermission = $Login_Details["user_permission"];
		$category_id = $Login_Details["category_id"];
		$this->load->model('common_models');

		if(isset($_POST['search_post'])){
			$sdate = date('Y-m-d H:i:s');
			 $txtcategory  		= $this->input->post('category');
			 $txtstate  		= $this->input->post('txtstate');
			 $txtcity  			= $this->input->post('txtcity');
			 $txtcallcomments  	= $this->input->post('callcomments');
			 $screen           = "list_screen";
			$Login_Details    = $this->session->userdata('login');
			$username         = $Login_Details["username"];
			$values 	      =							array('userid' 	  => $username,
														  'screen' 	  => $screen,
														  'category' 	  => $txtcategory,
														  'state' 	  => $txtstate,
														  'city' 	      => $txtcity,
														  'callstatus'  => $txtcallcomments,
														  'createddt'   => $sdate
														);
									
			//print_r($values );die;
	     	$this->db->insert('tbl_defaults',$values);
			$Insert_id  = $this->db->insert_id();

			 if($txtstate=='')
			 {
				  $txtstate  		= $this->input->post('txtstate1');
			 }
			 
			  if($txtcity=='')
			 {
				  $txtcity  		= $this->input->post('txtcity1');
			 }
			 
			 $sess_array = array(
                    'txtcategory'        =>  $txtcategory,
                    'txtstate'           =>  $txtstate,
                    'txtcity'            =>  $txtcity,
					'txtcallcomments'    =>  $txtcallcomments,
                );
				
				
				
		$this->session->set_userdata($sess_array);
		}else{
		 $txtcategory  =   $this->session->userdata('txtcategory');
			$txtstate			=	$this->session->userdata('txtstate');
			$txtcity			=	$this->session->userdata('txtcity');
			$txtcallcomments	=	$this->session->userdata('txtcallcomments');
			
		$data['txtcategory']	 =	$txtcategory;
		$data['txtstate']		 =	$txtstate;
		$data['txtcity']		 =	$txtcity;
		$data['txtcallcomments'] =	$txtcallcomments;
		
		}
		
		if(trim($txtcategory) != ""){
			 $formctrl1 = "'".trim($txtcategory)."'";
		}else{
			 $formctrl1 = 'NULL';
		}
		if(trim($txtstate) != ""){
			$formctrl2 = "'".trim($txtstate)."'";
		}else{
			$formctrl2 = 'NULL';
		}
		if(trim($txtcity) != ""){
			$formctrl3 = "'".trim($txtcity)."'";
		}else{
			$formctrl3 = 'NULL';
		}
		if(trim($txtcallcomments) != ""){
			 $formctrl4 = "'".trim($txtcallcomments)."'";
		}else{
			 $formctrl4 = 'NULL';
		}
			
		$data['txtcategory']	 =	$this->input->post('category');
		$data['txtstate']		 =	$this->input->post('txtstate');
		$data['txtcity']		 =	$this->input->post('txtcity');
		$data['txtcallcomments'] =	$this->input->post('callcomments');
		if($data['txtstate']=='')
		{
		$data['txtstate']		 =	$this->input->post('txtstate1');	
		}
		if($data['txtcity']=='')
		{
		$data['txtcity']		 =	$this->input->post('txtcity');	
		}
		
		
		$config = array();
        $config['base_url'] = base_url()."index.php/login/dashboard/search_businesslist";
		
		if($userpermission==1){
			if(isset($formctrl4) && $formctrl4 !='NULL'){
				$config['total_rows_cnt'] =  $this->common_models->business_search1($formctrl1,$formctrl2,$formctrl3,$formctrl4);
				$config['total_rows']     =  count($config['total_rows_cnt']);
			}else{
				$config['total_rows_cnt'] =  $this->common_models->business_search2($formctrl1,$formctrl2,$formctrl3);
				$config['total_rows']     =  count($config['total_rows_cnt']);
			}
		}else{
			if(isset($formctrl4) && $formctrl4 !='NULL'){
				$config['total_rows_cnt'] =  $this->common_models->business_search3($formctrl1,$formctrl2,$formctrl3,$formctrl4);
				$config['total_rows']     =  count($config['total_rows_cnt']);
			}else{
				$config['total_rows_cnt'] =  $this->common_models->business_search4($formctrl1,$formctrl2,$formctrl3);
				$config['total_rows']     =  count($config['total_rows_cnt']);
			}
		}

        $config['per_page'] = 30;
        $config['uri_segment'] = 4;
		
		$config["num_links"] 			  = 4;//round($choice);
		$config['first_link'] 			  = "<<First"; 
		$config['last_link'] 			  = "Last>>"; 
		$config['prev_link']			  = "< Previous"; 
		$config['next_link']			  = "Next >"; 
 
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

//print_r("page is under construction");
		
		if($userpermission==1){
			if(isset($formctrl4) && $formctrl4 !='NULL'){
				$data['results'] =  $this->common_models->business_search11($formctrl1,$formctrl2,$formctrl3,$formctrl4,$config['per_page'],$page);
			}else{
				$data['results'] =  $this->common_models->business_search21($formctrl1,$formctrl2,$formctrl3,$config['per_page'],$page);
			}
		}else{
			if(isset($formctrl4) && $formctrl4 !='NULL'){
				$data['results'] =  $this->common_models->business_search31($formctrl1,$formctrl2,$formctrl3,$formctrl4,$config['per_page'],$page);
			}else{
				$data['results'] =  $this->common_models->business_search41($formctrl1,$formctrl2,$formctrl3,$config['per_page'],$page);
			}
		}
		//print_r(count($data['results']));
		//print_r($data['results']);
		//die;
		
		//die;
        $data['links'] = $this->pagination->create_links();
 
		
		$data['title']		= 'Telemarketing - Business List';
		$data['add_new'] 	= 'index.php/login/dashboard/AddBusiness';
		$menus['menu']		= 'businesslist';
		
		//$data['category']	= $this->common_models->getAllRecords1('tbl_category');
		$data['category']	= $this->common_models->getAllRecordsinclause($category_id);
		$data['states']		= $this->common_models->getAllDistinctRecordwhere1('business_lists','state','category',$txtcategory);
		
		//$data['city']		= $this->common_models->getAllDistinctRecordwhere('business_lists','city','state',$txtstate);
		$data['city']		= $this->common_models->getAllDistinctRecordwhere('business_lists','city','state','category',$txtstate,$txtcategory);
		//$data['states']		= $this->common_models->getAllRecords2('kcb_tbstates');
		//$data['city']		= $this->common_models->getAllRecordsDist('business_lists','city');
		
		
		
		
		$data['callcomments']= $this->common_models->getAllRecords3('call_comments');
		

		
		$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
		$this->load->view('login/business_list',$data);
	    $this->load->view('includes/footer');
	}
	
	public function AddBusiness()
	{
		
        $this->load->model('common_models');
		$this->common_models->delete_cache_memory();
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$data['title'] 				= 'Business';
		$data['add_new'] 			= 'index.php/login/dashboard/AddBusiness';
		$records['states']		    = $this->common_models->getAllRecords('kcb_tbstates');
		$records['categorys']	= $this->common_models->getAllRecordsAsc('tbl_category','ccate_name');
		$records['statuss']	= $this->common_models->getAllRecordsAsc('call_comments','comment_title');
		//print_r($records['state']);die;
		$records['script']		= $this->common_models->getAllRecords('script');
		$records['buisness']	= '';
		$records['user'] 	= '';
		$menus['menu']	= 'business'; 
		$data["grid"]	= '';
		$data["ajax"] 	= '';
		$data['add_new'] = '';
	  	$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
	    $this->load->view('login/business',$records);
	    $this->load->view('includes/footer');
	}
	
	public function EditBusiness($link)
	{
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$this->load->library('session');
        $data['title'] = 'Telemarketing - User';
		$this->load->model('common_models');
		$Login_Details = $this->session->userdata('login');
		$userpermission = $Login_Details["user_permission"];
		$category_id = $Login_Details["category_id"];
		$user_id = $Login_Details["user_id"];
		
		$records['script']		= $this->common_models->getAllRecords('script');
		$records['user']	= $this->common_models->getRecordById('users','auto_user_id',$user_id);
		
		$records['states']		= $this->common_models->getAllRecords('kcb_tbstates');
		//$records['categorys']	= $this->common_models->getAllRecordsAsc('tbl_category','ccate_name');
		$records['categorys']	= $this->common_models->getAllRecordsinclause($category_id);
		//$records['statuss']	= $this->common_models->getAllRecordsAscId('call_comments','status','Yes');
		$records['statuss']		= $this->common_models->getAllRecordsAsc('call_comments','comment_title');
		
		$records['buisness']	= $this->common_models->getRecordById('business_lists','auto_buisness_id',$link);

		$menus['menu']	= 'business'; 
		
		$records['buisness_id']	= $link;
		$records['website']	= $records['buisness'][0]->website;
		
		
		//$this->load->view('website_status_new',$records);
		
	  	$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
	    $this->load->view('login/business',$records);
	    $this->load->view('includes/footer');
	}
	
	public function BusinessInsert($link1)
    {
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$this->load->model('common_models');
		$Login_Details = $this->session->userdata('login');
		//print_r($Login_Details);die;
		$salesperson_id = $Login_Details["user_id"];
		$salesperson_name = $Login_Details["name"];
				
		$buisness_id	 	= trim($this->input->post('buisness_id'));
		$company_name	 	= trim($this->input->post('company_name'));
		$first_name 	    = trim($this->input->post('first_name'));
		$last_name	 		= trim($this->input->post('last_name'));
		$address1	 		= trim($this->input->post('address1'));
		$address2 	    	= trim($this->input->post('address2'));
		$city	 			= trim($this->input->post('city'));
		$state	 			= trim($this->input->post('state'));
		$country	 		= trim($this->input->post('country'));
		$zip	 			= trim($this->input->post('zip'));
		$email	 			= trim($this->input->post('email'));
		$secondary_email	= trim($this->input->post('secondary_email'));
		$phone_number	 	= trim($this->input->post('phone_number'));
		$secondary_phone_number	= trim($this->input->post('secondary_phone_number'));
		$fax	 			= trim($this->input->post('fax'));
		$website	 		= trim($this->input->post('website'));
		$status	 			= trim($this->input->post('status'));
		$category	 		= trim($this->input->post('category'));
		$notes	 			= trim($this->input->post('notes'));
		$type_of_lead		= trim($this->input->post('type_of_lead'));
		
		/* Get sales manager & person id based on category id start*/
			$records['sales_team']	= $this->common_models->getRecordById('tbl_category','nauto_cate_id',$category);
			$sales_manager =$records['sales_team'][0]->sales_manager;	
			$sales_person =$records['sales_team'][0]->sales_person;	
			$mail_template_id =$records['sales_team'][0]->mail_template_id;
	/* Get sales manager & person id based on category id start*/
		
		/*santhosh*/
		//echo "fsdfsdf";
		$status_active 	   = $this->common_models->getRecordById('call_comments','comment_title',$status);
		//print_r($status_active);
		//die;
		if(isset($status_active) && $status_active!= ""){
			$sta_active = $status_active[0]->status;
			if(isset($sta_active) && $sta_active =="Yes"){
				$active_stat = "Yes";
			}else{
				$active_stat = "No";
			}
		}else{
				$active_stat = "Yes";
			}
		/*santhosh*/
		if($status =='Follow Up'){$follow_date	= trim($this->input->post('follow_date'));}else{$follow_date=date('m/d/Y');}
		
		$mobile 	= trim($this->input->post('mobilefriendly'));
		$browser	= trim($this->input->post('allbrowser'));
		$seo	 	= trim($this->input->post('seofriendly'));
		$design 	= trim($this->input->post('designseem'));
		
		if($mobile=='on'){$mobilefriendly='Yes';}else{$mobilefriendly='No';}
		if($browser=='on'){$allbrowser='Yes';}else{$allbrowser='No';}
		if($seo=='on'){$seofriendly='Yes';}else{$seofriendly='No';}
		if($design=='on'){$designseem='Yes';}else{$designseem='No';}
		
		$mobilefriendlynotes = $this->input->post('mobilefriendlynotes');
		$allbrowsernotes= $this->input->post('allbrowsernotes');
		$seofriendlynotes=$this->input->post('seofriendlynotes');
		$designseemnotes=$this->input->post('designseemnotes');
		

				
		if($buisness_id  != ""){
										$values = array('company_name' 	 	 => $company_name,
														'first_name' 	 	 => $first_name,
														'last_name' 	 	 => $last_name,
														'address1' 		 	 => $address1,
														'address2' 	     	 => $address2,
														'city' 		    	  => $city,
														'state' 		 	 => $state,
														'country' 			  => $country,
														'zipcode' 			  => $zip,
														'primary_email'  	 => $email,
		                    	  					  	'secondary_email' 	=> $secondary_email,
														'phone'  		  	=> $phone_number,
														'secondary_phone'	 => $secondary_phone_number,
														'fax' 		      	=> $fax,
														'website' 		  	=> $website,
														'status' 		  	=> $status,
														'follow_up_date'  	=> $follow_date,
														'category' 	  	 	 => $category,
														'notes' 	  	 	 => $notes,
														'mobile_friendly'	 => $mobilefriendly,
														'browser_support' 	=> $allbrowser,
														'seo_friendly' 	  	=> $seofriendly,
														'design_status'   	=> $designseem,
														'mobile_friendlynotes' => $mobilefriendlynotes,
														'browser_supportnotes' => $allbrowsernotes,
														'seo_friendlynotes' 	  => $seofriendlynotes,
														'design_statusnotes'   => $designseemnotes,
														'active'   => $active_stat,
														'sales_person_name'=>$salesperson_name,
														'sales_person_id'=>$salesperson_id,
														'type_of_lead'=>$type_of_lead,
														'sales_manager'=>$sales_manager,
														'sales_person'=>$sales_person);
		
			//print_r($values );die;
			$this->db->where('auto_buisness_id', $buisness_id);								
			$this->db->update('business_lists', $values);
			$Insert_id = $buisness_id;
			
			date_default_timezone_set('America/New_York');
			$script_tz 			= date_default_timezone_get();
			$endtime = date('H:i:s');
			$dt      = date('Y-m-d');
			$Login_Details = $this->session->userdata('login');
			$username = $Login_Details["username"];
			$unique_id = $Login_Details["unique_id"];
									
			/*$record['callexist'] = $this->common_models->threeWhereConditions('calltracking','companyid','createdby','createddt',$buisness_id,$username,$dt);
			
			if(count($record['callexist'])>0){
				$starttime    = $record['callexist'][0]->callstarttime;
				$to_time      = strtotime($endtime);
				$from_time    = strtotime($starttime);
				$time_diff    = $to_time - $from_time;
				$callduration = gmdate('H:i:s', $time_diff);
				$values 	  = array('callendtime'  => $endtime,
									  'callduration' => $callduration,
									  'createddt' 	 => $dt,
									  'createdby'    => $username);

				$this->db->where('companyid', $buisness_id);
				$this->db->where('createdby', $username);		
				$this->db->where('createddt', $dt);							
				$this->db->update('calltracking', $values);

				$Insert_id1 = $buisness_id;
			}*/	

	    if($status == 'Interested'){
		/*$urls = "http://ws.virtual-crm.com/ServiceVCRM.svc/SaveToVirtualCRMTeleMarketing?strLSID=telemarketing&pid=$Insert_id&str1=telemarketingdb&str2=tele_user&str3=tele_pass&str4=business_lists";
		
		//redirect($urls,'location');
		$proxy = '74.208.106.12:80';
		//echo "update";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		curl_setopt($ch, CURLOPT_URL,$urls);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		$cev = curl_exec($ch); */
		
		$records['virtual_crm_data']	= $this->common_models->getRecordById('business_lists','auto_buisness_id',$Insert_id);
		$company_name                   =$records['virtual_crm_data'][0]->company_name;
		$first_name                   =$records['virtual_crm_data'][0]->first_name;
		$last_name                   =$records['virtual_crm_data'][0]->last_name;
		$phone                   =$records['virtual_crm_data'][0]->phone;
		$notes                   =$records['virtual_crm_data'][0]->notes;
		$follow_up_date                   =$records['virtual_crm_data'][0]->follow_up_date;
		$sales_manager                   =$records['virtual_crm_data'][0]->sales_manager;
		$sales_person                   =$records['virtual_crm_data'][0]->sales_person;
		$lead_date                   =$records['virtual_crm_data'][0]->lead_date;
		$address1                   =$records['virtual_crm_data'][0]->address1;
		$address2                   =$records['virtual_crm_data'][0]->address2;
		$city                   =$records['virtual_crm_data'][0]->city;
		$state                   =$records['virtual_crm_data'][0]->state;
		$country                   =$records['virtual_crm_data'][0]->country;
		$zipcode                   =$records['virtual_crm_data'][0]->zipcode;
		$secondary_phone                   =$records['virtual_crm_data'][0]->secondary_phone;
		$fax                   =$records['virtual_crm_data'][0]->fax;
		$primary_email                   =$records['virtual_crm_data'][0]->primary_email;
		$website                   =$records['virtual_crm_data'][0]->website;
		
		$virtual_data_post = array('company_name'=>$company_name,
							'first_name'=>$first_name,
							'last_name'=>$last_name,
							'phone'=>$phone,
							'notes'=>$notes,
							'follow_up_date'=>$follow_up_date,
							'sales_manager'=>$sales_manager,
							'sales_person'=>$sales_person,
							'unique_id'=>$unique_id,
							'lead_date'=>$lead_date,
							'address1'=>$address1,
							'address2'=>$address2,
							'city'=>$city,
							'state'=>$state,
							'country'=>$country,
							'zipcode'=>$zipcode,
							'secondary_phone'=>$secondary_phone,
							'fax'=>$fax,
							'primary_email'=>$primary_email,
							'website'=>$website);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'http://telemark.carpetscleaners.us/mssql_api/telemarkapi.php?action=leadinsert');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $virtual_data_post);
			$virtual_data_exec= curl_exec($ch);
			curl_close($ch);
		//print_r($cev);
		//die;

       /* servicepro leads*/
	  /* $new_address = $address1.','.$address2;
		
		$dataespi = array('company_id' => 1,'subscriber_id' => 'desss','company_name' => $company_name,'firstname' => $first_name,'lastname' => $last_name,'phone_number' => $phone_number,'lead_by' => 'telemarketing','new_address' => $new_address,'city' => $city,'state' => $state,'zip' => $zip,'cell_phone' => $secondary_phone_number,'email' => $email);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://servicepro.carpetscleaners.us/serviceproapi.php?action=telemarketing_leads");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataespi);
		$curl_espi= curl_exec($ch);
		curl_close($ch);*/
		

		/*$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://ws.virtual-crm.com/ServiceVCRM.svc/SaveToVirtualCRMTeleMarketing?strLSID=telemarketing&pid=80422&str1=telemarketingdb&str2=tele_user&str3=tele_pass&str4=business_lists");
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array('HeaderName: HeaderValue'));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept: application/json'));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
$result = curl_exec($ch);
print_r($result);*/

		//die;
				
		if(isset($email) && $email!=""){
			$records['mail_temp']	= $this->common_models->get_interested_mail_content($mail_template_id);
						$mailTemplateName   =$records['mail_temp'][0]->mailTemplateName;	
						$mailTemplateContent =$records['mail_temp'][0]->mailTemplateContent;	
						$shortcode = array("%%FIRST_NAME%%", "%%LAST_NAME%%");
						$orgstring   = array($first_name, $last_name);
						$mail_cont = str_replace($shortcode, $orgstring, $mailTemplateContent);

		$send=$mail_cont;
		
		

		$from='info@desss.com';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		$headers .= 'From:'. $from . "\r\n";
		
		$INCLUDE_DIR = "includes/mailer/";
		
		require($INCLUDE_DIR . "class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();                                   // send via SMTP
		$mail->Host     = "smtp.1and1.com"; // SMTP servers
		$mail->Port     = 587 ; // SMTP Port
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->Username = $from;  // SMTP username
		$mail->Password = "earth05"; // SMTP password
		$mail->From     = "info@desss.com";
		$mail->FromName = "Telemarketing";
		//$mail->AddAddress("chandrasekar@desss.com"); 
		$mail->AddAddress($email); 
		//$mail->AddBCC("chandrasekar@desss.com");       
		$mail->AddBCC("santhosh.s@desss.com");  
		$mail->AddBCC("dev@desss.com");  
		$subject = $mailTemplateName;
		$mail->IsHTML(true);                               // send as HTML
		$mail->Subject  =  $subject;
		$mail->Body     =  $send;	
		 if(!$mail->Send())
			{
				//echo "mail not sent";
			}
			else
			{
				//echo "mail sent";
			}
		}
	
				}
						
		}else{
									$values 	= array('company_name' 	  		=> $company_name,
														'first_name' 	  		=> $first_name,
														'last_name' 	 		=> $last_name,
														'address1' 		 		=> $address1,
														'address2' 	    		=> $address2,
														'city' 		    		=> $city,
														'state' 		 		=> $state,
														'country' 		 		=> $country,
														'zipcode' 		 		=> $zip,
														'primary_email'  		=> $email,
		                    	  					  	'secondary_email' 		=> $secondary_email,
														'phone'  		  		=> $phone_number,
														'secondary_phone' 		=> $secondary_phone_number,
														'fax' 		      		=> $fax,
														'website' 		  		=> $website,
														'status' 		  		=> $status,
														'follow_up_date'  		=> $follow_date,
														'category' 	 	  		=> $category,
														'notes' 	 	 		=> $notes,
														'mobile_friendly'		=> $mobilefriendly,
														'browser_support' 		=> $allbrowser,
														'seo_friendly' 	  		=> $seofriendly,
														'design_status'  		=> $designseem,
														'mobile_friendlynotes'  => $mobilefriendlynotes,
														'browser_supportnotes'  => $allbrowsernotes,
														'seo_friendlynotes'     => $seofriendlynotes,
														'design_statusnotes'    => $designseemnotes,
														'active'                => $active_stat,
														'sales_person_name'		=>$salesperson_name,
														'sales_person_id'		=>$salesperson_id,
														'type_of_lead'=>$type_of_lead,
														'sales_manager'=>$sales_manager,
														'sales_person'=>$sales_person);
									
			//print_r($values );die;
	     	$this->db->insert('business_lists',$values);
			$Insert_id  = $this->db->insert_id();

			
			if($status == 'Interested'){
					  
			
		/* $urls = "http://ws.virtual-crm.com/ServiceVCRM.svc/SaveToVirtualCRMTeleMarketing?strLSID=telemarketing&pid=$Insert_id&str1=telemarketingdb&str2=tele_user&str3=tele_pass&str4=business_lists";
		//redirect($urls,'location');
		$proxy = '74.208.106.12:80';
		//echo "insert";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		curl_setopt($ch, CURLOPT_URL,$urls);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		$cev = curl_exec($ch); */
		
		$records['virtual_crm_data']	= $this->common_models->getRecordById('business_lists','auto_buisness_id',$Insert_id);
		$company_name                   =$records['virtual_crm_data'][0]->company_name;
		$first_name                   =$records['virtual_crm_data'][0]->first_name;
		$last_name                   =$records['virtual_crm_data'][0]->last_name;
		$phone                   =$records['virtual_crm_data'][0]->phone;
		$notes                   =$records['virtual_crm_data'][0]->notes;
		$follow_up_date                   =$records['virtual_crm_data'][0]->follow_up_date;
		$sales_manager                   =$records['virtual_crm_data'][0]->sales_manager;
		$sales_person                   =$records['virtual_crm_data'][0]->sales_person;
		$lead_date                   =$records['virtual_crm_data'][0]->lead_date;
		$address1                   =$records['virtual_crm_data'][0]->address1;
		$address2                   =$records['virtual_crm_data'][0]->address2;
		$city                   =$records['virtual_crm_data'][0]->city;
		$state                   =$records['virtual_crm_data'][0]->state;
		$country                   =$records['virtual_crm_data'][0]->country;
		$zipcode                   =$records['virtual_crm_data'][0]->zipcode;
		$secondary_phone                   =$records['virtual_crm_data'][0]->secondary_phone;
		$fax                   =$records['virtual_crm_data'][0]->fax;
		$primary_email                   =$records['virtual_crm_data'][0]->primary_email;
		$website                   =$records['virtual_crm_data'][0]->website;
		
		$virtual_data_post = array('company_name'=>$company_name,
							'first_name'=>$first_name,
							'last_name'=>$last_name,
							'phone'=>$phone,
							'notes'=>$notes,
							'follow_up_date'=>$follow_up_date,
							'sales_manager'=>$sales_manager,
							'sales_person'=>$sales_person,
							'unique_id'=>$unique_id,
							'lead_date'=>$lead_date,
							'address1'=>$address1,
							'address2'=>$address2,
							'city'=>$city,
							'state'=>$state,
							'country'=>$country,
							'zipcode'=>$zipcode,
							'secondary_phone'=>$secondary_phone,
							'fax'=>$fax,
							'primary_email'=>$primary_email,
							'website'=>$website);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'http://telemark.carpetscleaners.us/mssql_api/telemarkapi.php?action=leadinsert');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $virtual_data_post);
			$virtual_data_exec= curl_exec($ch);
			curl_close($ch);
		//print_r($cev);

       /* servicepro leads*/
	  /* $new_address = $address1.','.$address2;
		
		$dataespi = array('company_id' => 1,'subscriber_id' => 'desss','company_name' => $company_name,'firstname' => $first_name,'lastname' => $last_name,'phone_number' => $phone_number,'lead_by' => 'telemarketing','new_address' => $new_address,'city' => $city,'state' => $state,'zip' => $zip,'cell_phone' => $secondary_phone_number,'email' => $email);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://servicepro.carpetscleaners.us/serviceproapi.php?action=telemarketing_leads");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataespi);
		$curl_espi= curl_exec($ch);
		curl_close($ch);*/
		

		/*$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://ws.virtual-crm.com/ServiceVCRM.svc/SaveToVirtualCRMTeleMarketing?strLSID=telemarketing&pid=80422&str1=telemarketingdb&str2=tele_user&str3=tele_pass&str4=business_lists");
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array('HeaderName: HeaderValue'));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept: application/json'));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
$result = curl_exec($ch);
print_r($result);*/

		//die;
				
		if(isset($email) && $email!=""){
			$records['mail_temp']	= $this->common_models->get_interested_mail_content($mail_template_id);
						$mailTemplateName   =$records['mail_temp'][0]->mailTemplateName;	
						$mailTemplateContent =$records['mail_temp'][0]->mailTemplateContent;	
						$shortcode = array("%%FIRST_NAME%%", "%%LAST_NAME%%");
						$orgstring   = array($first_name, $last_name);
						$mail_cont = str_replace($shortcode, $orgstring, $mailTemplateContent);

		$send=$mail_cont;
		

		$from='info@desss.com';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		$headers .= 'From:'. $from . "\r\n";
		
		$INCLUDE_DIR = "includes/mailer/";
		
		require($INCLUDE_DIR . "class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();                                   // send via SMTP
		$mail->Host     = "smtp.1and1.com"; // SMTP servers
		$mail->Port     = 587 ; // SMTP Port
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->Username = $from;  // SMTP username
		$mail->Password = "earth05"; // SMTP password
		$mail->From     = "info@desss.com";
		$mail->FromName = "Telemarketing";
		//$mail->AddAddress("chandrasekar@desss.com"); 
		$mail->AddAddress($email); 
		//$mail->AddBCC("chandrasekar@desss.com");       
		$mail->AddBCC("santhosh.s@desss.com");  
		$mail->AddBCC("dev@desss.com");  
		$subject = $mailTemplateName;
		$mail->IsHTML(true);                               // send as HTML
		$mail->Subject  =  $subject;
		$mail->Body     =  $send;	
		 if(!$mail->Send())
			{
				//echo "mail not sent";
			}
			else
			{
				//echo "mail sent";
			}
		}
	
				}
		}
		//$technology =  $this->input->post('technology');
		
				
		$customattribut_data = $this->input->post('customattribut');
		if(isset($customattribut_data) && $customattribut_data !=""){
		 if(count($this->input->post('customattribut')) > 0){
		  foreach( $this->input->post('customattribut') as  $key=>$value) {
			  $getval = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$key);
			  $techid = $this->common_models->getRecordById('tbl_technologies','tech_name',str_replace('_',' ',$getval[1]));
			  $tech_id = $techid[0]->tech_id;
			  $this->common_models->update_custom_values($getval[0],$value,$buisness_id,$tech_id); 
		  }
		 }
	    }
		
		$valuefinal ="";
		$i=0;
	    $customattributmultiple_data = $this->input->post('customattributmultiple');
		//print_r($customattributmultiple_data);die;
		if(isset($customattributmultiple_data) && $customattributmultiple_data !=""){
			
		  if(count($this->input->post('customattributmultiple')) >0 ) {
			  foreach($this->input->post('customattributmultiple') as  $key=>$value) {
				 	$getval = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$key);
			  		$techid = $this->common_models->getRecordById('tbl_technologies','tech_name',str_replace('_',' ',$getval[1]));
			   		$tech_id = $techid[0]->tech_id;
					$base_attribut = $getval[0];
				  foreach( $value as  $key=>$value) {	
					  $key1 = $key;
					  $valuefinal .= $value.';';
					  $i++;
				  }
				  $this->common_models->update_custom_values($base_attribut,$valuefinal,$buisness_id,$tech_id);	
			  }
		  }
		}
			



		 $category_session        =   $this->session->userdata('txtcategory');
			 $state_session			=	$this->session->userdata('txtstate');
			 $city_session			=	$this->session->userdata('txtcity');
			 $status_session	=	$this->session->userdata('txtcallcomments');
		
		if(trim($category_session) != ""){
			$formctrl1 = "'".trim($category_session)."'";
		}else{
			$formctrl1 = 'NULL';
		}
		if(trim($state_session) != ""){
			$formctrl2 = "'".trim($state_session)."'";
		}else{
			$formctrl2 = 'NULL';
		}
		if(trim($city_session) != ""){
			$formctrl3 = "'".trim($city_session)."'";
		}else{
			$formctrl3 = 'NULL';
		}
		if(trim($status_session) != ""){
			$formctrl4 = "'".trim($status_session)."'";
		}else{
			$formctrl4 = 'NULL';
		}
			
			if($link1 == 'save'){
				redirect('login/dashboard/EditBusiness/'.$Insert_id,'location');	
			}elseif($link1 == 'saveClose'){
				redirect('login/dashboard/businesslist','location');		
			}elseif($link1 == 'saveNew'){
				redirect('login/dashboard/AddBusiness','location');			
			}elseif($link1 == 'next'){
				$record['ct_track'] = $this->common_models->ct_track($buisness_id,$formctrl1,$formctrl2,$formctrl3,$formctrl4);
				if(count($record['ct_track'])>0){
				 	$ct_track_id = $record['ct_track'][0]->auto_buisness_id;
					redirect('login/dashboard/EditBusiness/'.$ct_track_id,'location');
				}else{
					$record['ct_track'] = $this->common_models->ct_track_ID($buisness_id);
						if(count($record['ct_track'])>0){
							$ct_track_id = $record['ct_track'][0]->auto_buisness_id;
							redirect('login/dashboard/EditBusiness/'.$ct_track_id,'location');
						}
				}
				

			}elseif($link1 == 'prev'){
				$record['ct_track'] = $this->common_models->ct_track_prev($buisness_id,$formctrl1,$formctrl2,$formctrl3,$formctrl4);
				if(count($record['ct_track'])>0){
				 	$ct_track_id = $record['ct_track'][0]->auto_buisness_id;
					redirect('login/dashboard/EditBusiness/'.$ct_track_id,'location');
				}else{
					$record['ct_track'] = $this->common_models->ct_track_prev_ID($buisness_id);
						if(count($record['ct_track'])>0){
							$ct_track_id = $record['ct_track'][0]->auto_buisness_id;
							redirect('login/dashboard/EditBusiness/'.$ct_track_id,'location');
						}
				}
				
				
						
			}
		
	}
	public function BusinessnotInsert($link1)
    {
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$this->load->model('common_models');
		$Login_Details 		= $this->session->userdata('login');
		$salesperson_id 	= $Login_Details["user_id"];
		$salesperson_name 	= $Login_Details["name"];
		$buisness_id	 	= trim($this->input->post('buisness_id'));
				
		$category_session   =   $this->session->userdata('txtcategory');
		$state_session		=	$this->session->userdata('txtstate');
		$city_session		=	$this->session->userdata('txtcity');
		$status_session		=	$this->session->userdata('txtcallcomments');
		
		if(trim($category_session) != ""){
			$formctrl1 = "'".trim($category_session)."'";
		}else{
			$formctrl1 = 'NULL';
		}
		if(trim($state_session) != ""){
			$formctrl2 = "'".trim($state_session)."'";
		}else{
			$formctrl2 = 'NULL';
		}
		if(trim($city_session) != ""){
			$formctrl3 = "'".trim($city_session)."'";
		}else{
			$formctrl3 = 'NULL';
		}
		if(trim($status_session) != ""){
			$formctrl4 = "'".trim($status_session)."'";
		}else{
			$formctrl4 = 'NULL';
		}
		if($link1 == 'next'){
			$record['ct_track'] = $this->common_models->ct_track($buisness_id,$formctrl1,$formctrl2,$formctrl3,$formctrl4);
			if(count($record['ct_track'])>0){
				 $ct_track_id = $record['ct_track'][0]->auto_buisness_id;
				 redirect('login/dashboard/EditBusiness/'.$ct_track_id,'location');
			}
		}elseif($link1 == 'prev'){
			$record['ct_track'] = $this->common_models->ct_track_prev($buisness_id,$formctrl1,$formctrl2,$formctrl3,$formctrl4);
			if(count($record['ct_track'])>0){
				 $ct_track_id = $record['ct_track'][0]->auto_buisness_id;
				 redirect('login/dashboard/EditBusiness/'.$ct_track_id,'location');
			}
		}
	}
	public function savedefault()
	{
        $this->load->model('common_models');
		$this->common_models->delete_cache_memory();
		if($this->session->userdata('login') == FALSE)
		{
			redirect('home/home','location');
		}
		$data['title'] 				= 'Business';
		$data['add_new'] 			= 'index.php/login/dashboard/AddBusiness';
		$records['states']		    = $this->common_models->getAllRecords('kcb_tbstates');
		$records['categorys']		= $this->common_models->getAllRecords('tbl_category');
		$records['statuss']	= $this->common_models->getAllRecords('call_comments');
		//print_r($records['state']);die;
		$records['script']		= $this->common_models->getAllRecords('script');
		$records['buisness']	= '';
		$records['user'] 	= '';
		$menus['menu']	= 'business'; 
		$data["grid"]	= '';
		$data["ajax"] 	= '';
		$data['add_new'] = '';
		
		if(isset($_POST['save'])){
			ob_start();
			if(isset($opportunities1)){
				$this->session->unset_userdata('opportunities1');
			}
			$txtcategory    = $this->input->post('category');
			$txtstate  		= $this->input->post('txtstate');
			$txtcity  		= $this->input->post('txtcity');
			$txtcallcomments  	= $this->input->post('callcomments');
		    $opportunities1	= 	$this->session->userdata('opportunities1');	
		    $opportunities1	= array("opportunities1" => array('txtcategory1' => $txtcategory, 'txtstate1'=> $txtstate, 'txtcity1'=> $txtcity, 'txtcallcomments1'=> $txtcallcomments));
		    $this->session->set_userdata($opportunities1);
		}	
		    //print_r($opportunities1);die;
		    $sdate            = date('Y-m-d H:i:s');
			$txtcategory  	  = $this->input->post('category');
			$txtstate  		  = $this->input->post('txtstate');
			$txtcity  		  = $this->input->post('txtcity');
			$txtcallcomments  = $this->input->post('callcomments');
			$screen           = "list_screen";
			$Login_Details    = $this->session->userdata('login');
			$username         = $Login_Details["username"];
			$values 	      =							array('userid' 	  => $username,
														  'screen' 	  => $screen,
														  'category' 	  => $txtcategory,
														  'state' 	  => $txtstate,
														  'city' 	      => $txtcity,
														  'callstatus'  => $txtcallcomments,
														  'createddt'   => $sdate
														);
									
			//print_r($values );die;
	     	$this->db->insert('tbl_defaults',$values);
			$Insert_id  = $this->db->insert_id();
			
		$data['txtcategory']		=	$_POST['category'];
		$data['txtstate']		=	$_POST['txtstate'];
		$data['txtcity']		=	$_POST['txtcity'];
		$data['txtcallcomments']	=	$_POST['callcomments'];		
			
	 	redirect('login/dashboard/businesslist','location');		
	}
	public function Business_Check_Availability()
	{
		
		$this->load->model('common_models');
		$user_name = $this->input->post('user_name');
		$user_id = $this->input->post('user_id');
		
			if($user_id == '')
			{
				$record['user'] = $this->common_models->getRecordById('users','username',$user_name);
				if($record['user'] != '')
				{
						echo "no";
				}else{
						echo "yes";
				}
			}else{	
			  $record['user'] = $this->common_models->getRecordByEditDuplicateValues('users','auto_user_id','username',$user_id,$user_name);
			  if($record['user'])
			  {
				 echo "no";
			  }else{
				  echo "yes";
			  }
		   } 	
	}
	
	
	/*****************************santhosh end***************************************/
	
	/*****************************ramya 6th september  start***************************************/
	public function calltracking()
	{
		
		if($this->session->userdata('login') == FALSE)
		{
			redirect('login/login','location');
		}
		ob_start();
		$this->load->model('common_models');
		$this->load->file('KoolControls/KoolGrid/koolgrid.php') ;
		include "KoolControls/KoolAjax/koolajax.php";
		include "KoolControls/KoolAjax/dbconnect.php";
		$koolajax->scriptFolder = base_url()."KoolControls/KoolAjax";
		$ds = new MySQLDataSource($db_con);
		
			
			$txtusername  			= $this->input->post('txtusername');
			$from_date  			= $this->input->post('txtfromdate');
			$to_date  			= $this->input->post('txttodate');
		
		
		if(isset($_POST['search'])){
		
			ob_start();
			$this->session->unset_userdata('opportunities1');
			$this->session->unset_userdata('opportunities2');
			$this->session->unset_userdata('opportunities3');
			$this->session->unset_userdata('opportunities4');
			
			if(isset($opportunities3)){
				$this->session->unset_userdata('opportunities3');
			}
			$from_date  	= date("Y-m-d", strtotime(str_replace("-","/",$this->input->post('txtfromdate'))));
			$to_date  		= date("Y-m-d", strtotime(str_replace("-","/",$this->input->post('txttodate'))));
			$txtusername  	= $this->input->post('txtusername');
			
			$opportunities3	= array("opportunities3" => array('from_date' => $from_date, 'to_date'=> $to_date, 'txtusername'=> $txtusername));
			$this->session->set_userdata($opportunities3);
			
			$data['from_date']		=	$this->input->post('txtfromdate');
			$data['to_date']		=	$this->input->post('txttodate');
			$data['txtusername']	=	$txtusername;		

		}elseif(isset($opportunities3) != ''){
		
			$from_date		=	$this->input->post('txtfromdate');
			$to_date		=	$this->input->post('txttodate');
			$txtusername  	= 	$txtusername;
			
			$data['from_date']		=	$from_date;
			$data['to_date']		=	$to_date;
			$data['txtusername']	=	$txtusername;	
		
		}else{
			
		$data['from_date']		=	'';
		$data['to_date']		=	'';
		$data['txtusername']	=	'';		
		}	
			
		
		
		
		
		$ds->SelectCommand = "SELECT B.company_name,A.createddt,A.createdby,A.callstarttime,A.callendtime,A.callduration FROM calltracking as A join business_lists as B on A.companyid = B.auto_buisness_id WHERE A.createddt >= '".$from_date."' AND A.createddt <= '".$to_date."' AND A.createdby='".$txtusername."'";
		
		
		
		$grid = new KoolGrid("grid");
		$grid->styleFolder="office2010blue";
		$grid->DataSource = $ds;
		$grid->AllowResizing = true;	
		$grid->MasterTable->ShowFunctionPanel = true;	
		$grid->MasterTable->InsertSettings->ColumnNumber = 2;
		$grid->RowAlternative = true;
		$grid->AllowMultiSelecting = true;
		//$grid->AllowEditing = true;
		$grid->AllowDeleting = true;
		$grid->AjaxEnabled = true;
		$grid->AjaxLoadingImage =  "KoolControls/KoolAjax/loading/5.gif";
		$grid->AllowHovering = true;
		$grid->AllowSorting = true;//Enable sorting for all rows;
		$grid->SingleColumnSorting = true;
		$grid->AllowFiltering = false;//Enable filtering for all rows;
		$grid->AllowResizing = true;
		$grid->AllowInserting = false;
		$grid->PageSize  = 500;
		//$grid->AutoGenerateDeleteColumn = true;
		//$grid->AutoGenerateEditColumn = true;	
		$grid->MasterTable->EditSettings->Mode = "form";
		//$grid->MasterTable->EditSettings->InputFocus = "HideGrid";//You can test the "BlurGrid"
		//$grid->AutoGenerateRowSelectColumn = true;
		$grid->MasterTable->Pager = new GridPrevNextAndNumericPager();
		
		
		$column = new GridBoundColumn();
		$column->DataField = "createdby";
		$column->HeaderText = "User Name";	
		$grid->MasterTable->AddColumn($column);
	
		$column = new GridBoundColumn();
		$column->DataField = "company_name";
		$column->HeaderText = "Company Name";
		$grid->MasterTable->AddColumn($column);
		
		$column = new GridDateTimeColumn();
		$column->DataField  = "createddt";
		$column->HeaderText = "Date";	
		$column->FormatString = "m/d/Y";
		$grid->MasterTable->AddColumn($column);
	
		$column = new GridBoundColumn();
		$column->DataField = "callstarttime";
		$column->HeaderText = "Start Time";	
		$grid->MasterTable->AddColumn($column);
	
		$column = new GridBoundColumn();
		$column->DataField = "callendtime";
		$column->HeaderText = "End Time";	
		$grid->MasterTable->AddColumn($column);
	
		$column = new GridBoundColumn();
		$column->DataField = "callduration";
		$column->HeaderText = "Call Duration";	
		$grid->MasterTable->AddColumn($column);
		
		$grid->Process();	
		/*if(isset($_POST["ExportToCSV"]))
		{
		ob_end_clean();
		$grid->GetInstanceMasterTable()->ExportToCSV();
		}*/
		$data["grid"] = $grid->Render();
		$data["ajax"] = $koolajax->Render();
	
	
		if(isset($_POST['search'])){
		$data['from_date']		=	$this->input->post('txtfromdate');
		$data['to_date']		=	$this->input->post('txttodate');	
		$data['txtusername']	=	$this->input->post('txtusername');;	
		}
		else{
		$data['from_date']		=	'';
		$data['to_date']		=	'';
		$data['txtusername']	=	'';	
		}
	
		
		$data['title']= 'Telemarketing - Call Tracking';
		$data['add_new'] = '';
		$menus['menu']	= 'calltracking';
		$data['user'] = $this->common_models->getRecordById('users','user_permission','2');
		$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
		$this->load->view('login/calltracking_list',$data);
	    $this->load->view('includes/footer');
	}
	
	/*****************************santhosh 6th september  start***************************************/
	public function system_reports()
	{
		
		if($this->session->userdata('login') == FALSE)
		{
			redirect('login/login','location');
		}
		ob_start();
		$this->load->model('common_models');
		$this->load->file('KoolControls/KoolGrid/koolgrid.php') ;
		include "KoolControls/KoolAjax/koolajax.php";
		include "KoolControls/KoolAjax/dbconnect.php";
		$koolajax->scriptFolder = base_url()."KoolControls/KoolAjax";
		$ds = new MySQLDataSource($db_con);
		
			
			$txtusername  			= $this->input->post('txtusername');
			$from_date  			= $this->input->post('txtfromdate');
			$to_date  			    = $this->input->post('txttodate');
			$calltype  			    = $this->input->post('calltype');
			
			
			if(isset($txtusername) && $txtusername!=""){
			$In_user                = " AND (A.createdby='" . implode("' OR A.createdby='", $txtusername) . "') ";
			}else{
			$In_user                = "";
			}
			if(isset($calltype) && $calltype!=""){
			$In_calltype                = " AND (B.status='" . implode("' OR B.status='", $calltype) . "') ";
			}else{
			$In_calltype                = "";
			}
			
		if(isset($_POST['search'])){
		
			ob_start();
			$this->session->unset_userdata('opportunities1');
			$this->session->unset_userdata('opportunities2');
			$this->session->unset_userdata('opportunities3');
			$this->session->unset_userdata('opportunities4');
			
			if(isset($opportunities3)){
				$this->session->unset_userdata('opportunities3');
			}
			$from_date  	= date("Y-m-d", strtotime(str_replace("-","/",$this->input->post('txtfromdate'))));
			$to_date  		= date("Y-m-d", strtotime(str_replace("-","/",$this->input->post('txttodate'))));
			$txtusername  	= $this->input->post('txtusername');
			$calltype  			= $this->input->post('calltype');
			
			$opportunities3	= array("opportunities3" => array('from_date' => $from_date, 'to_date'=> $to_date, 'txtusername'=> $txtusername, 'calltype'=> $calltype));
			$this->session->set_userdata($opportunities3);
			
			$data['from_date']		=	$this->input->post('txtfromdate');
			$data['to_date']		=	$this->input->post('txttodate');
			$data['txtusername']	=	$txtusername;		
			$data['calltype']		= $this->input->post('calltype');

		}elseif(isset($opportunities3) != ''){
		
			$from_date		=	$this->input->post('txtfromdate');
			$to_date		=	$this->input->post('txttodate');
			$txtusername  	= 	$txtusername;
			$calltype  			= $this->input->post('calltype');
			
			$data['from_date']		=	$from_date;
			$data['to_date']		=	$to_date;
			$data['txtusername']	=	$txtusername;	
			$data['calltype']	    =	$calltype;	
		
		}else{
			
		$data['from_date']		=	'';
		$data['to_date']		=	'';
		$data['txtusername']	=	'';	
		$data['calltype']	    =	'';		
		}	
			
		
		
		
		
	   $ds->SelectCommand = "SELECT B.company_name,B.status,B.follow_up_date,A.createddt,A.createdby,A.callstarttime,A.callendtime,A.callduration FROM calltracking as A join business_lists as B on A.companyid = B.auto_buisness_id WHERE A.createddt >= '".$from_date."' AND A.createddt <= '".$to_date."'".$In_user."".$In_calltype."";
		

		
		$grid = new KoolGrid("grid");
		$grid->styleFolder="office2010blue";
		$grid->DataSource = $ds;
		$grid->AllowResizing = true;	
		$grid->MasterTable->ShowFunctionPanel = true;	
		$grid->MasterTable->InsertSettings->ColumnNumber = 2;
		$grid->RowAlternative = true;
		$grid->AllowMultiSelecting = true;
		//$grid->AllowEditing = true;
		$grid->AllowDeleting = true;
		$grid->AjaxEnabled = true;
		$grid->AjaxLoadingImage =  "KoolControls/KoolAjax/loading/5.gif";
		$grid->AllowHovering = true;
		$grid->AllowSorting = true;//Enable sorting for all rows;
		$grid->SingleColumnSorting = true;
		//$grid->AllowFiltering = true;//Enable filtering for all rows;
		$grid->AllowFiltering = false;
		$grid->AllowResizing = true;
		$grid->AllowInserting = false;
		$grid->PageSize  = 500;
		//$grid->AutoGenerateDeleteColumn = true;
		//$grid->AutoGenerateEditColumn = true;	
		$grid->MasterTable->EditSettings->Mode = "form";
		//$grid->MasterTable->EditSettings->InputFocus = "HideGrid";//You can test the "BlurGrid"
		//$grid->AutoGenerateRowSelectColumn = true;
		$grid->MasterTable->Pager = new GridPrevNextAndNumericPager();
		
		
		$column = new GridBoundColumn();
		$column->DataField = "createdby";
		$column->HeaderText = "User Name";	
		$grid->MasterTable->AddColumn($column);
	
		$column = new GridBoundColumn();
		$column->DataField = "company_name";
		$column->HeaderText = "Client Name";
		$grid->MasterTable->AddColumn($column);
		
		$column = new GridDateTimeColumn();
		$column->DataField  = "createddt";
		$column->HeaderText = "Date";	
		$column->FormatString = "m/d/Y";
		$grid->MasterTable->AddColumn($column);
	
		$column = new GridBoundColumn();
		$column->DataField = "callstarttime";
		$column->HeaderText = "Start Time";	
		$grid->MasterTable->AddColumn($column);
	
		$column = new GridBoundColumn();
		$column->DataField = "callendtime";
		$column->HeaderText = "End Time";	
		$grid->MasterTable->AddColumn($column);
	
		$column = new GridBoundColumn();
		$column->DataField = "callduration";
		$column->HeaderText = "Call Duration";	
		$grid->MasterTable->AddColumn($column);
		
		$column = new GridBoundColumn();
		$column->DataField = "status";
		$column->HeaderText = "Call Status";	
		$grid->MasterTable->AddColumn($column);
		
		$column = new GridBoundColumn();
		$column->DataField = "follow_up_date";
		$column->HeaderText = "Follow up date";	
		$grid->MasterTable->AddColumn($column);
		
		$grid->Process();	
		/*if(isset($_POST["ExportToCSV"]))
		{
		ob_end_clean();
		$grid->GetInstanceMasterTable()->ExportToCSV();
		}*/
		$data["grid"] = $grid->Render();
		$data["ajax"] = $koolajax->Render();
	
	
		if(isset($_POST['search'])){
		$data['from_date']		=	$this->input->post('txtfromdate');
		$data['to_date']		=	$this->input->post('txttodate');	
		$data['txtusername']	=	$this->input->post('txtusername');
		$data['calltype']	=	$this->input->post('calltype');
		}
		else{
		$data['from_date']		=	'';
		$data['to_date']		=	'';
		$data['txtusername']	=	'';	
		$data['calltype']	=	'';
		}
	
		
		$data['title']= 'Telemarketing - System Reports';
		$data['add_new'] = '';
		$menus['menu']	= 'systemreports';
		$data['user'] = $this->common_models->getRecordById('users','user_permission','2');
		$data['call_comments'] = $this->common_models->getRecordById('call_comments','status','Yes');
		$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
		$this->load->view('login/system_reports',$data);
	    $this->load->view('includes/footer');
	}
	
	public function system_summary()
	{
		
		if($this->session->userdata('login') == FALSE)
		{
			redirect('login/login','location');
		}
		ob_start();
		$this->load->model('common_models');
		$this->load->file('KoolControls/KoolGrid/koolgrid.php') ;
		include "KoolControls/KoolAjax/koolajax.php";
		include "KoolControls/KoolAjax/dbconnect.php";
		$koolajax->scriptFolder = base_url()."KoolControls/KoolAjax";
		$ds = new MySQLDataSource($db_con);
		
			
			$txtusername  			= $this->input->post('txtusername');
			$from_date  			= $this->input->post('txtfromdate');
			$to_date  			    = $this->input->post('txttodate');
			$calltype  			    = $this->input->post('calltype');
			$type_of_lead  			= $this->input->post('type_of_lead');

			if(isset($txtusername) && $txtusername!=""){
			$In_user                = "A.createdby='" . implode("' OR A.createdby='", $txtusername) . "'";
			}else{
			$In_user                = "A.createdby=''";
			}

			if(isset($calltype) && $calltype!=""){
			$In_calltype                = "B.status='" . implode("' OR B.status='", $calltype) . "'";
			}else{
			$In_calltype                = "B.status=''";
			}
			
			if(isset($type_of_lead) && $type_of_lead!=""){
			$type_of_lead_qry                = "B.type_of_lead='".$type_of_lead."'";
			}else{
			$type_of_lead_qry                = "B.type_of_lead=''";
			}
			
		if(isset($_POST['search'])){
		
			ob_start();
			$this->session->unset_userdata('opportunities1');
			$this->session->unset_userdata('opportunities2');
			$this->session->unset_userdata('opportunities3');
			$this->session->unset_userdata('opportunities4');
			
			if(isset($opportunities3)){
				$this->session->unset_userdata('opportunities3');
			}
			$from_date  	= date("Y-m-d", strtotime(str_replace("-","/",$this->input->post('txtfromdate'))));
			$to_date  		= date("Y-m-d", strtotime(str_replace("-","/",$this->input->post('txttodate'))));
			$txtusername  	= $this->input->post('txtusername');
			$calltype  		= $this->input->post('calltype');
			$type_of_lead  			    = $this->input->post('type_of_lead');
			
			$opportunities3	= array("opportunities3" => array('from_date' => $from_date, 'to_date'=> $to_date, 'txtusername'=> $txtusername, 'calltype'=> $calltype, 'type_of_lead'=> $type_of_lead));
			$this->session->set_userdata($opportunities3);
			
			$data['from_date']		=	$this->input->post('txtfromdate');
			$data['to_date']		=	$this->input->post('txttodate');
			$data['txtusername']	=	$txtusername;	
			$calltype  		        = $this->input->post('calltype');
			$data['type_of_lead']  			    = $this->input->post('type_of_lead');

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"http://ws.virtual-crm.com/ServiceVCRM.svc/SaveToVirtualCRMTeleMarketing?strLSID=telemarketing&from_date=$from_date&to_date=$to_date&type_of_lead=$type_of_lead&str1=telemarketingdb&str2=tele_user&str3=tele_pass&str4=business_lists");
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_exec($ch); 	


		}elseif(isset($opportunities3) != ''){
		
			$from_date		=	$this->input->post('txtfromdate');
			$to_date		=	$this->input->post('txttodate');
			$txtusername  	= 	$txtusername;
			$calltype  		= $this->input->post('calltype');
			$type_of_lead  			    = $this->input->post('type_of_lead');

			
			$data['from_date']		=	$from_date;
			$data['to_date']		=	$to_date;
			$data['txtusername']	=	$txtusername;	
			$data['calltype']	=	$calltype;
			$data['type_of_lead']  			    = $type_of_lead;		

		
		}else{
			
		$data['from_date']		=	'';
		$data['to_date']		=	'';
		$data['txtusername']	=	'';	
		$data['calltype']	=	'';	
		$data['type_of_lead']  			    ='';		
	
		}	
	   
	   
	   $ds->SelectCommand = "SELECT B.auto_buisness_id,B.company_name, B.status, B.follow_up_date, A.createddt, A.createdby, A.callstarttime, A.callendtime, A.callduration, COUNT(B.status) as st_cnt,SEC_TO_TIME( SUM( TIME_TO_SEC( `callduration` ) ) ) as time_cnt 
FROM calltracking AS A
JOIN business_lists AS B ON A.companyid = B.auto_buisness_id
WHERE A.createddt >= '".$from_date."'
AND A.createddt <= '".$to_date."' AND (".$In_user.") AND (".$In_calltype.") AND (".$type_of_lead_qry.") GROUP BY B.status";
		

		
		$grid = new KoolGrid("grid");
		$grid->styleFolder="office2010blue";
		$grid->DataSource = $ds;
		$grid->AllowResizing = true;	
		$grid->MasterTable->ShowFunctionPanel = true;	
		$grid->MasterTable->InsertSettings->ColumnNumber = 2;
		$grid->RowAlternative = true;
		$grid->AllowMultiSelecting = true;
		//$grid->AllowEditing = true;
		$grid->AllowDeleting = true;
		$grid->AjaxEnabled = true;
		$grid->AjaxLoadingImage =  "KoolControls/KoolAjax/loading/5.gif";
		$grid->AllowHovering = true;
		$grid->AllowSorting = true;//Enable sorting for all rows;
		$grid->SingleColumnSorting = true;
		//$grid->AllowFiltering = true;//Enable filtering for all rows;
		$grid->AllowFiltering = false;
		$grid->AllowResizing = true;
		$grid->AllowInserting = false;
		$grid->PageSize  = 500;
		//$grid->AutoGenerateDeleteColumn = true;
		//$grid->AutoGenerateEditColumn = true;	
		$grid->MasterTable->EditSettings->Mode = "form";
		//$grid->MasterTable->EditSettings->InputFocus = "HideGrid";//You can test the "BlurGrid"
		//$grid->AutoGenerateRowSelectColumn = true;
		$grid->MasterTable->Pager = new GridPrevNextAndNumericPager();
		
		
		$column = new GridBoundColumn();
		$column->DataField = "status";
		$column->HeaderText = "Type of Call";	
		$grid->MasterTable->AddColumn($column);
	
		$column = new GridBoundColumn();
		$column->DataField = "st_cnt";
		$column->HeaderText = "Number of call";
		$grid->MasterTable->AddColumn($column);
		
		$column = new GridBoundColumn();
		$column->DataField  = "time_cnt";
		$column->HeaderText = "Time consumed";	
		$grid->MasterTable->AddColumn($column);
		
				
		$grid->Process();	
		/*if(isset($_POST["ExportToCSV"]))
		{
		ob_end_clean();
		$grid->GetInstanceMasterTable()->ExportToCSV();
		}*/
		$data["grid"] = $grid->Render();
		$data["ajax"] = $koolajax->Render();
	
	
		if(isset($_POST['search'])){
		$data['from_date']		=	$this->input->post('txtfromdate');
		$data['to_date']		=	$this->input->post('txttodate');	
		$data['txtusername']	=	$this->input->post('txtusername');
		$data['calltype']	=	$this->input->post('calltype');
		$data['type_of_lead']  			    = $this->input->post('type_of_lead');		

		}
		else{
		$data['from_date']		=	'';
		$data['to_date']		=	'';
		$data['txtusername']	=	'';	
		$data['calltype']	=	'';
		$data['type_of_lead']  			    = '';		

		}
	
		
		$data['title']= 'Telemarketing - System Summary';
		$data['add_new'] = '';
		$menus['menu']	= 'system_summary';
		$data['user'] = $this->common_models->getRecordById('users','user_permission','2');
		$data['call_comments'] = $this->common_models->getRecordById('call_comments','status','Yes');
		$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
		$this->load->view('login/system_summary',$data);
	    $this->load->view('includes/footer');
	}

	public function callreports()
	{
		
		if($this->session->userdata('login') == FALSE)
		{
			redirect('login/login','location');
		}
		ob_start();
		$this->load->model('common_models');
		$this->load->file('KoolControls/KoolGrid/koolgrid.php') ;
		include "KoolControls/KoolAjax/koolajax.php";
		include "KoolControls/KoolAjax/dbconnect.php";
		$koolajax->scriptFolder = base_url()."KoolControls/KoolAjax";
		$ds = new MySQLDataSource($db_con);
		
			
			$txtusername  			= $this->input->post('txtusername');
			$from_date  			= $this->input->post('txtfromdate');
			
		
		if(isset($_POST['search'])){
		
			ob_start();
			$this->session->unset_userdata('opportunities1');
			$this->session->unset_userdata('opportunities2');
			$this->session->unset_userdata('opportunities3');
			$this->session->unset_userdata('opportunities4');
			if(isset($opportunities4)){
				$this->session->unset_userdata('opportunities4');
			}
			$from_date  	= date("Y-m-d", strtotime(str_replace("-","/",$this->input->post('txtfromdate'))));
			$txtusername  	= $this->input->post('txtusername');
			
			$opportunities4	= array("opportunities4" => array('from_date' => $from_date,'txtusername'=> $txtusername));
			$this->session->set_userdata($opportunities4);
			
			$data['from_date']		=	$this->input->post('txtfromdate');
			$data['txtusername']	=	$txtusername;		

		}elseif(isset($opportunities4) != ''){
		
			$from_date		=	$this->input->post('txtfromdate');
			$txtusername  	= 	$txtusername;
			
			$data['from_date']		=	$from_date;
			$data['txtusername']	=	$txtusername;	
		
		}else{
			
		$data['from_date']		=	'';
		$data['txtusername']	=	'';		
		}	
			
		
		
		
		if(isset($_POST['search'])){
		$ds->SelectCommand = "SELECT createddt,createdby,SEC_TO_TIME(SUM(TIME_TO_SEC(callduration))) as totalcallduration FROM calltracking where createdby = '".$txtusername."' and createddt='".$from_date."'";
		
		
		$grid = new KoolGrid("grid");
		$grid->styleFolder="office2010blue";
		$grid->DataSource = $ds;
		$grid->AllowResizing = true;	
		$grid->MasterTable->ShowFunctionPanel = true;	
		$grid->MasterTable->InsertSettings->ColumnNumber = 2;
		$grid->RowAlternative = true;
		$grid->AllowMultiSelecting = true;
		//$grid->AllowEditing = true;
		$grid->AllowDeleting = true;
		$grid->AjaxEnabled = true;
		$grid->AjaxLoadingImage =  "KoolControls/KoolAjax/loading/5.gif";
		$grid->AllowHovering = true;
		$grid->AllowSorting = true;//Enable sorting for all rows;
		$grid->SingleColumnSorting = true;
	//	$grid->AllowFiltering = true;//Enable filtering for all rows;
	  $grid->AllowFiltering = false;
		$grid->AllowResizing = true;
		$grid->AllowInserting = false;
		$grid->PageSize  = 500;
		//$grid->AutoGenerateDeleteColumn = true;
		//$grid->AutoGenerateEditColumn = true;	
		$grid->MasterTable->EditSettings->Mode = "form";
		//$grid->MasterTable->EditSettings->InputFocus = "HideGrid";//You can test the "BlurGrid"
		//$grid->AutoGenerateRowSelectColumn = true;
		$grid->MasterTable->Pager = new GridPrevNextAndNumericPager();
		
		
		$column = new GridBoundColumn();
		$column->DataField = "createdby";
		$column->HeaderText = "User Name";	
		$grid->MasterTable->AddColumn($column);
	
		$column = new GridDateTimeColumn();
		$column->DataField  = "createddt";
		$column->HeaderText = "Date";	
		$column->FormatString = "m/d/Y";
		$grid->MasterTable->AddColumn($column);
	
		$column = new GridBoundColumn();
		$column->DataField = "totalcallduration";
		$column->HeaderText = "Call Duration";	
		$grid->MasterTable->AddColumn($column);
		
		$grid->Process();	
		/*if(isset($_POST["ExportToCSV"]))
		{
		ob_end_clean();
		$grid->GetInstanceMasterTable()->ExportToCSV();
		}*/
		$data["grid"] = $grid->Render();
		$data["ajax"] = $koolajax->Render();
	}else{
		$data["grid"] = '';
		$data["ajax"] = '';
	}
		if(isset($_POST['search'])){
		$data['from_date']		=	$this->input->post('txtfromdate');
		$data['txtusername']	=	$this->input->post('txtusername');;	
		}
		else{
		$data['from_date']		=	'';
		$data['txtusername']	=	'';	
		}
	
		
		
		$data['title']= 'Telemarketing - Call Reports';
		$data['add_new'] = '';
		$menus['menu']	= 'callreports';
		$data['user'] = $this->common_models->getRecordById('users','user_permission','2');
		$this->load->view('includes/header',$data);
		$this->load->view('includes/menu',$menus);
		$this->load->view('login/callreports_list',$data);
	    $this->load->view('includes/footer');
	}
	
	/*****************************ramya 6th september   end***************************************/
	
	
	public function follow_up_hide(){
		$this->load->model('common_models');
		$callstatus = $this->input->post('callstatus');
		if($callstatus != ''){
			$record['callstatus'] = $this->common_models->getRecordById('call_comments','comment_id',$callstatus);
			if($record['callstatus'] != ''){
						echo $record['callstatus'][0]->follow_up_details;
						
			}
		}	
	}
	public function Appointment($link,$link2 = ''){
		if($this->session->userdata('login') == FALSE)
		{
			redirect('login/login','location');
		}
		
		$this->load->model('common_models');
		$Login_Details = $this->session->userdata('login');
$username = $Login_Details["username"];
		
	$records['buisness']	= $this->common_models->getRecordById('business_lists','auto_buisness_id',$link);
	$records['statuss']		= $this->common_models->getAllRecordsAsc('call_comments','comment_title');
    $records['buisness_id']=$link;
	
	if(isset($link2) && $link2!=""){
	$records['santhoshnext']	= $this->common_models->followup_next($username,$link2);
	$san_nextreccount = count($records['santhoshnext']);
	if(isset($san_nextreccount) && $san_nextreccount !=0){
		 $next_companyid = $records['santhoshnext'][0]->companyid;
		 $AutoId 		= $records['santhoshnext'][0]->AutoId;
		
		$records['sant_next_rec_count'] = $san_nextreccount;
		$records['sant_next_companyid'] = $next_companyid;
		$records['sant_AutoId'] = $AutoId;
	}
	}


		$this->load->view('login/appointment.php',$records);
	}
	public function delete_ajax_business($link){
		$this->load->model('common_models');
		$this->db->where('auto_buisness_id',$link);
		$this->db->delete('business_lists');
	}
}

