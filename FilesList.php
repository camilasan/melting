<?php 
    
    class FilesList {
        private $files_name;
        private $files_tmp_name;
        
        public function __construct($files_name, $files_tmp_name){
            $this->files_name = $files_name;
            $this->files_tmp_name = $files_tmp_name;
        } 
        
        public function processFilesList(){
            $images = array();
            $n = count($this->files_name);
            for($i = 0;$i < $n;$i++) {
                $name = $this->files_name[$i];
                $tmp_name = $this->files_tmp_name[$i];
                move_uploaded_file($tmp_name, './tmp/'.$name);
                $images[$name] = $name;
            } 
            return $images;
        }
        
    }