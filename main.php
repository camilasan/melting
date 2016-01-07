<?php

    require 'FilesList.php';
    require 'Mlt.php';
    
    $data = array();
    $images = array();

    if($_FILES['file']){
        $files_list = new FilesList($_FILES['file']['name'], $_FILES['file']['tmp_name']);
        $images = $files_list->processFilesList();
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
        $xml->processXML();
        $data['title'] = $title;
        $data['video'] = '<video width="600" height="400" controls><source src="tmp/'.$title.'.mp4" type="video/mp4"><source src="'.$title.'.mp4" type="video/mp4">Your browser does not support the video tag.</video>';
    }
    
    echo json_encode($data);

