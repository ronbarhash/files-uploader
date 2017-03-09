<?php 

require_once "lib/php/vendor/autoload.php";

$filename='ttt.pdf';

$pdf = new FPDI();

$pageCount = $pdf->setSourceFile('test.pdf');
$degrees = 90;
//  Array of pages to skip -- modify this to fit your needs
$skipPages = [1,3,4,7,12,15,17,21];

//  Add all pages of source to new document
for( $pageNo=1; $pageNo<=$pageCount; $pageNo++ )
{
	$pageformat = array('Rotate'=>90,'Orienatation'=>'L');
    //  Skip undesired pages
    if( in_array($pageNo,$skipPages) )
        continue;

    //  Add page to the document
    $templateID = $pdf->importPage($pageNo);
    $pdf->getTemplateSize($templateID);
    $pdf->addPage('L');
    $pdf->useTemplate($templateID);
}

 $pdf->Output($filename,'F');





?>