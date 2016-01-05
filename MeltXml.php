<?php

    class MeltXml extends XMLWriter {
    
        private $content;
        
        public function __construct($content){
            $this->openURI('./tmp/mlt.xml');
            $this->setIndent(true);
            $this->setIndentString('    ');
            $this->startDocument('1.0', 'utf-8');
                $this->startElement('mlt');
                    $this->writeAttribute('title', 'Popcorn');  
                    $i = 0;
                    foreach ($content as $image) {
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
                                $this->writeAttribute('length', 100);       
                            $this->endElement();
                            $this->startElement('entry');
                                $this->writeAttribute('producer', 'producer'.$i);       
                            $this->endElement();                            
                        $this->endElement();                    
                        $i++;
                    }     
                    $this->startElement('tractor');
                        $this->writeAttribute('id', 'tractor0');  
                        $this->writeAttribute('in', 0);  
                        $this->writeAttribute('out', 630);  
                        $this->startElement('multitrack');
                            $this->writeAttribute('id', 'multitrack0');
                            $this->startElement('track');
                                $this->writeAttribute('producer', 'playlist0');
                            $this->endElement();
                            $this->startElement('track');
                                $this->writeAttribute('producer', 'playlist1');
                            $this->endElement();
/*                            $this->startElement('track');
                                $this->writeAttribute('producer', 'playlist2');
                            $this->endElement();  
                            $this->startElement('track');
                                $this->writeAttribute('producer', 'playlist3');
                            $this->endElement();   */                            
                        $this->endElement();
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
/*                            $this->startElement('property');
                                $this->writeAttribute('name', 'c_track');
                                $this->text(2); 
                            $this->endElement();   
                            $this->startElement('property');
                                $this->writeAttribute('name', 'd_track');
                                $this->text(3); 
                            $this->endElement(); */                            
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
/*                            $this->startElement('property');
                                $this->writeAttribute('name', 'c_track');
                                $this->text(2); 
                            $this->endElement();
                            $this->startElement('property');
                                $this->writeAttribute('name', 'd_track');
                                $this->text(3); 
                            $this->endElement();*/                              
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
                    $this->endElement();
                $this->endElement(); 
            $this->endDocument(); 
            exec('cd ./tmp/ && melt6 mlt.xml --verbose');
        } 

    }
    
// <mlt title="Popcorn">
//     <producer id="producer0">
//         <property name="resource">avatar-smalls.jpg</property>
//     </producer>
//     <playlist id="playlist0">
//         <entry producer="producer0"/>
//     </playlist>    
//     <producer id="producer1">
//         <property name="resource">1488111_10201244195366305_1980227798_n.jpg</property>
//     </producer>
//     <playlist id="playlist1">
//         <blank length="50"/>
//         <entry producer="producer1"/>
//     </playlist>
//     <tractor id="tractor0" in="0" out="315">
//         <multitrack id="multitrack0">
//             <track producer="playlist0"/>
//             <track producer="playlist1"/>
//         </multitrack>
//         <transition id="transition0" in="50" out="74">
//             <property name="a_track">0</property>
//             <property name="b_track">1</property>
//             <property name="mlt_service">luma</property>
//         </transition>
//         <transition id="transition1" in="50" out="74">
//             <property name="a_track">0</property>
//             <property name="b_track">1</property>
//             <property name="mlt_service">mix</property>
//             <property name="start">0.0</property>
//             <property name="end">1.0</property>
//         </transition>
//     </tractor>
// </mlt>
