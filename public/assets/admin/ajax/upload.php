<?php

if (isset($_FILES["file"]["name"])) {
    if (isset($_FILES["file"]["error"])) {
        $title = $_POST["code"].'_'.mt_rand(100,9999);
        $extension = explode(".", $_FILES["file"]["name"]);
        $file = $title.".".$extension[1];
        $destiny = '../../../'.$_POST["folder"].'/'.$file; 
        $source = $_FILES["file"]["tmp_name"];
        move_uploaded_file($source, $destiny);
        echo $_POST["route"].'/uploads/img/temp/'.$file;
    } else {
        echo $mensaje = "Ooops! The temporary file couldn't been added: ".$_FILES["file"]["error"];
    }
}