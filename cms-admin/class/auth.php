<?php 
session_start();
ob_start(); 
if(!isset($_SESSION['SESS_FORMULA_APPS_ID']) || (trim($_SESSION['SESS_FORMULA_APPS_ID']) == '')) 
{
		$error_data[] = 'Login Session Expired Please Login';
		$error_flag = true;
		if($error_flag) 
		{
			$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
			session_write_close();
			header("location: login.php");
			exit();
		}
}
$input_by=$_SESSION['SESS_FORMULA_APPS_ID'];
$input_datetime=date('Y-m-d');
include('db_Class.php');	
$obj = new db_class();
$formula_user=$_SESSION['SESS_FORMULA_APPS_NAME'];
$formula_id=$_SESSION['SESS_FORMULA_APPS_ID'];

$thisFile=$obj->filename();
$pagePermission = $obj->FlyQuery("SELECT 
                            upam.id,
                            upam.page_name, 
                            upam.page_link_file_name 
                            FROM user_access_role as uar
                            LEFT JOIN user_page_access_mapping as upam ON uar.user_type_id=upam.user_type_id 
                            WHERE uar.user_id='".$formula_id."' AND upam.page_link_file_name='".$thisFile."'");

$pagePermissionMatch = $obj->FlyQuery("SELECT 
                            upam.id,
                            upam.page_name, 
                            upam.page_link_file_name 
                            FROM user_access_role as uar
                            LEFT JOIN user_page_access_mapping as upam ON uar.user_type_id=upam.user_type_id 
                            WHERE upam.page_link_file_name='".$thisFile."'");

if(empty($pagePermission) && !empty($pagePermissionMatch))
{
    $error_data[] = 'Failed, You dont have permission to access this page.';
    $error_flag = true;
    if($error_flag) 
    {
            $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
            session_write_close();
            header("location: index.php");
            exit();
    }
}

?>