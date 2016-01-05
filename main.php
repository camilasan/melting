<?php
    
    require 'Files.php';
    require 'Video.php';
    
    $data = array();
    foreach ($_FILES['file']['name'] as $key => $name) {
        $name = $_FILES['file']['name'][$key];
        $tmp_name = $_FILES['file']['tmp_name'][$key];
        move_uploaded_file($tmp_name, './tmp/'.$name);
        $data[$name] = $tmp_name;
    }
//     $data[0] = $_FILES;
//     $data[1] = $_POST;
    echo json_encode($data);
   
//     $filename = $argv[1];
//     dl("mlt.so");
//     mlt_factory_init(NULL);
//     $profile = new_profile("dv_ntsc");
//     $p = new_producer( $profile, $filename );
//     if ( $p ) {
//             $c = new_consumer( $profile, "sdl" );
//             consumer_connect( $c, $p );
//             $e = properties_setup_wait_for( $c, "consumer-stopped" );
//             consumer_start( $c );
//             properties_wait_for( $c, $e );
//             consumer_stop( $c );
//             $e = NULL;
//             $c = NULL;
//     }
//     $p = NULL;
//     $profile = NULL;
//     mlt_factory_close();
