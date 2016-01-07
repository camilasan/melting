<?php

    require 'Mlt.php';
    
    $data = array();
    $images = array();
    
    if($_FILES['file']){
        $n = count($_FILES['file']['name']);
        $files_name = $_FILES['file']['name'];
        $files_tmp_name = $_FILES['file']['tmp_name'];
        for($i = 0;$i < $n;$i++) {
            $name = $files_name[$i];
            $tmp_name = $files_tmp_name[$i];
            move_uploaded_file($tmp_name, './tmp/'.$name);
            $images[$name] = $name;
        }        
    }else{
        $data['file_error'] = 'Files were not uploaded.';
    }
    
    if(isset($_POST['title'])){
        $title = trim($_POST['title']);
    }else{
        $data['title_error'] = 'Title was not set.';
    }
    
    if(!isset($data['title_error']) || !isset($data['file_error'])){
        $xml = new Mlt($images, $title);
        $data['video'] = '<video width="320" height="240" controls><source src="tmp/'.$title.'.mp4" type="video/mp4"><source src="'.$title.'.mp4" type="video/mp4">Your browser does not support the video tag.</video>';
    }
    
    echo json_encode($data);

