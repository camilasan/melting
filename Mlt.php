<?php

    class Mlt extends XMLWriter {
    
        private $content;
        private $title;
        
        public function __construct($content, $title){
            $this->content = $content;
            $this->title = $title;
            $this->processXML();
        } 
        
        public function processXML(){
            $this->openURI('./tmp/'.$this->title.'.xml');
            $this->setIndent(true);
            $this->setIndentString('    ');
            $this->startDocument('1.0', 'utf-8');
                $this->startElement('mlt');
                    $this->writeAttribute('title', $this->title);  
                    $this->setPlaylists();
                    $this->startElement('tractor');
                        $this->writeAttribute('id', 'tractor0');  
                        $this->writeAttribute('in', 0);  
                        $this->writeAttribute('out', 630);  
                        $this->setTracks();
                        $this->setTransitions();                       
                    $this->endElement();
                $this->endElement(); 
            $this->endDocument(); 
            $this->publishVideo();        
        }
        
        public function setPlaylists(){
            $i = 0;
            foreach ($this->content as $image) {
                $this->startElement('producer');
                    $this->writeAttribute('id', 'producer'.$i);  
                    $this->startElement('property');
                        $this->writeAttribute('name', 'resource');
                        $this->text($image);         
                    $this->endElement();
                $this->endElement();
                $this->startElement('playlist');
                    $this->writeAttribute('id', 'playlist'.$i);  
                    $this->startElement('blank');
                        $this->writeAttribute('length', 1);       
                    $this->endElement();
                    $this->startElement('entry');
                        $this->writeAttribute('producer', 'producer'.$i);       
                    $this->endElement();                            
                $this->endElement();                    
                $i++;
            }            
        }    
        
        public function setTracks(){
            $this->startElement('multitrack');
                $this->writeAttribute('id', 'multitrack0');
                $this->startElement('track');
                    $this->writeAttribute('producer', 'playlist0');
                $this->endElement();
                $this->startElement('track');
                    $this->writeAttribute('producer', 'playlist1');
                $this->endElement();                       
            $this->endElement();        
        }        
        
        public function setTransitions(){
            $this->startElement('transition');
                $this->writeAttribute('id', 'transition0');  
                $this->writeAttribute('in', 100);
                $this->writeAttribute('out', 200);
                $this->startElement('property');
                    $this->writeAttribute('name', 'a_track');
                    $this->text(0); 
                $this->endElement();
                $this->startElement('property');
                    $this->writeAttribute('name', 'b_track');
                    $this->text(1); 
                $this->endElement();                          
                $this->startElement('property');
                    $this->writeAttribute('name', 'mlt_service');
                    $this->text('luma'); 
                $this->endElement();                            
            $this->endElement();   
            $this->startElement('transition');
                $this->writeAttribute('id', 'transition1');  
                $this->writeAttribute('in', 100);
                $this->writeAttribute('out', 200);
                $this->startElement('property');
                    $this->writeAttribute('name', 'a_track');
                    $this->text(0); 
                $this->endElement();
                $this->startElement('property');
                    $this->writeAttribute('name', 'b_track');
                    $this->text(1); 
                $this->endElement();                            
                $this->startElement('property');
                    $this->writeAttribute('name', 'mlt_service');
                    $this->text('mix'); 
                $this->endElement();  
                $this->startElement('property');
                    $this->writeAttribute('name', 'start');
                    $this->text(0.1); 
                $this->endElement();  
                $this->startElement('property');
                    $this->writeAttribute('name', 'end');
                    $this->text(2.0); 
                $this->endElement();                              
            $this->endElement();            
        }
        
        public function publishVideo(){
            exec('cd ./tmp/ && melt6 -producer xml:mlt.xml -consumer avformat:'.$this->title.'.mp4');
        }        
    }
    
