<?php
$path='';
if(isset($_POST['path']))
{
    $path=$_POST['path'];
}

$sourcePath = $_FILES['file']['tmp_name'];       // Storing source path of the file in a variable
$targetPath = "./".$path.$_FILES['file']['name']; // Target path where file is to be stored
move_uploaded_file($sourcePath,$targetPath) ;  

 echo $_FILES['file']['name'];