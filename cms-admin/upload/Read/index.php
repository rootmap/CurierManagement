<?php

function print_thumb($src, $desired_width = 80) {
    /* read the source image */
    $source_image = imagecreatefromjpeg($src);
    $width = imagesx($source_image);
    $height = imagesy($source_image);

    /* find the "desired height" of this thumbnail, relative to the desired width  */
    $desired_height = floor($height * ($desired_width / $width));

    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);


    // Set the content type header - in this case image/jpeg
    header('Content-Type: image/jpeg');

    // Output the image
    imagepng($virtual_image);
}

if (isset($_GET['path'])) {
    //header("Content-type: image/png"); 
    //readfile('http://localhost:83/formula-cms-quriar/upload/Read/foo.jpg');
    //createImage("test.jpg", 120, "thumb.jpg");
    //header("Content-Type: image/png");
    //imagejpeg('http://localhost:83/formula-cms-quriar/upload/Read/foo.jpg','',100); // Output to Browser 
    //echo "foo.jpg";
    $source = 'http://localhost:83/formula-cms-quriar/upload/Read/' . $_GET['path'];
    //exit();
    //$arg = "$source,,400,300,80,resize";
    //new pg_image($arg);

    readfile(print_thumb($source));
} else {

    function Get_ImagesToFolder($dir) {
        $ImagesArray = [];



        $scan = glob($dir . "*", GLOB_ONLYDIR);

        foreach ($scan as $nsc):
            $ImagesArray[] = array("name" => str_replace("./", "", $nsc), "type" => "d", "path" => str_replace("./", "", $nsc));
        endforeach;

        $file_display = ['jpg', 'jpeg', 'png', 'gif'];

        if (file_exists($dir) == false) {
            return ["Directory \'', $dir, '\' not found!"];
        } else {
            $dir_contents = scandir($dir);
            foreach ($dir_contents as $file) {
                $file_type = pathinfo($file, PATHINFO_EXTENSION);

                if (in_array($file_type, $file_display) == true) {
                    $file_size = 0;
                    if ($file_type=="gif") {
                        $file_size = 1000;
                    } else {
                        @$file_size = filesize($file);
                    }
                    $ImagesArray[] = array("name" => $file, "type" => "f", "size" => $file_size?$file_size:0);
                }
            }
            return $ImagesArray;
        }
    }

    if (isset($_POST['path'])) {
        $dir = './' . $_POST['path'];
        $ImagesA = Get_ImagesToFolder($dir);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($ImagesA);
    } else {
        $dir = './';
        $ImagesA = Get_ImagesToFolder($dir);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($ImagesA);
    }
}
