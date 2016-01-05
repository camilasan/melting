<?php

    class MeltXml extends XMLWriter {
    
        private $content;
        
        public function __construct($content){
            $this->openURI('./tmp/mlt.xml');
            $this->setIndent(true);
            $this->setIndentString(' ');
            $this->startElement('mlt');
            foreach ($content as $image) {
                $this->startElement('producer');
                $this->writeAttribute('id', 'producer'.$image);                  
                $this->startElement('property');
                    $this->writeAttribute('name', 'resource');
                    $this->text($image);         
                $this->endElement();
                $this->endElement();
            }                 
            $this->endElement(); 
            $this->endDocument(); 
        } 

    }
    
    
//     <mlt>
//      <producer id="producer0">
//        <property name="resource">clip1.mpeg</property>
//        <property name="audio_track">1</property>
//      </producer>
//    </mlt>