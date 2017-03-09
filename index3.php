<?php
require_once "lib/php/vendor/autoload.php";

function rotatePDF($file, $degrees, $page = 'all'){

    $pdf = new \TCPDI(); 
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    $pagecount = $pdf->setSourceFile($file);

    // rotate each page
    if($page=="all"){
        for ($i = 1; $i <= $pagecount; $i++) { 
            $pageformat = array('Rotate'=>$degrees);
            $tpage = $pdf->importPage($i);
            $size = $pdf->getTemplateSize($tpage);
            //$info = $pdf->getPageDimensions();
            $orientation = $size['w'] > $size['h'] ? 'L' : 'P';

            $pdf->AddPage($orientation,$pageformat);
            $pdf->useTemplate($tpage);      
        }
    }else{
        $rotateFlag = 0;
        for ($i = 1; $i <= $pagecount; $i++) { 
            if($page == $i){
                $pageformat = array('Rotate'=>$degrees);
                $tpage = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpage);
                //$info = $pdf->getPageDimensions();
                $orientation = $size['w'] > $size['h'] ? 'L' : 'P';

                $pdf->AddPage($orientation,$pageformat);
                $pdf->useTemplate($tpage);
                $rotateFlag = 1;
            }else{
                if($rotateFlag==1){
                    // page after rotation; restore rotation
                    $rotateFlag = 0;
                    $pageformat = array('Rotate'=>0);

                    $tpage = $pdf->importPage($i);
                    $pdf->AddPage($orientation,$pageformat);
                    $pdf->useTemplate($tpage);
                }else{
                    // pages before rotation and after restoring rotation
                    $tpage = $pdf->importPage($i);
                    $pdf->AddPage();
                    $pdf->useTemplate($tpage);
                }
            }
        }
    }
    $out = realpath($file);

    if(rename($file,"test.bak")){
        $result = $pdf->Output($out, "F"); 
        if($result == "" ){
            echo "ok";
        }
    }else{
        echo "Failed to rename old PDF";
        die;
    }
}

$file = "doc.pdf";
rotatePDF($file,90); // rotating all works fine
rotatePDF($file,180,3); // rotates only page 3
