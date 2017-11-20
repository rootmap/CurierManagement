<?php
$filename = $_POST['name'];
$path = "./";
if (!mkdir($path . $filename, 0777, true)) {
    die('Failed to create folders...');
} else {
    echo $filename;
}