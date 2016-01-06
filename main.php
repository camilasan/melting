<?php

    require 'MeltXml.php';
    
    $data = array();
    
    foreach ($_FILES['file']['name'] as $key => $name) {
        $name = $_FILES['file']['name'][$key];
        $tmp_name = $_FILES['file']['tmp_name'][$key];
        move_uploaded_file($tmp_name, './tmp/'.$name);
        $data[$name] = $name;
    }
    
    $xml = new MeltXml($data);
    //$xml->outputMemory()
    echo '<video width="320" height="240" controls><source src="tmp/output.mp4" type="video/mp4"><source src="output.mp4" type="video/mp4">Your browser does not support the video tag.</video>';

