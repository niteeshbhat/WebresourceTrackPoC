<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sessionId=$_POST['sessionId'];

$load=simplexml_load_file('temp/'.$sessionId.'/track.xml');

if($load !== FALSE){
    $dom_abs = dom_import_simplexml($load);
    $abs = new DOMDocument('1.0');
    $dom_abs = $abs->importNode($dom_abs, true); //create dom element to contain mpd 
        
    $dom_abs = $abs->appendChild($dom_abs);
    
    $trackData = $abs->getElementsByTagName('trackData')->item(0);
}
else
    echo "Track data not found";

$init=$trackData->getElementsByTagName('init')->item(0);
$template=$init->getElementsByTagName('template')->item(0)->nodeValue;
$sampleCount=$init->getElementsByTagName('sampleCount')->item(0)->nodeValue;

//As xml load removes html tags, init page is not possible to save this way
//Hence other file read option is used to save init webpage to a file.
$fullFile= file_get_contents('temp/'.$sessionId.'/track.xml');
$fullFile=str_replace("&lt;", "<", $fullFile);
$fullFile=str_replace("&amp;", "&", $fullFile);
//$fullFile=str_replace("temp/sample", "temp/".$sessionId."/sample", $fullFile);

$startPos=strpos($fullFile, "<html>");
$endPos=strpos($fullFile,"</html>");

$fileHandle=fopen("temp/".$sessionId."/init.html","w");
fwrite($fileHandle,substr($fullFile,$startPos,$endPos-$startPos+1+6));//To include till end of </html>
fclose($fileHandle);


for($i=1;$i<=(int)$sampleCount;$i++)
{
    $sample=$trackData->getElementsByTagName('sample'.$i.'.x')->item(0);
    $decodeDur=$sample->getAttribute('decodeDur');
    $script=$sample->getElementsByTagName('script')->item(0);
    $fileHandle=fopen('temp/'.$sessionId.'/sample'.$i.'.x',"w");
    fwrite($fileHandle,$decodeDur."\n");
    fwrite($fileHandle,$script->nodeValue);
    sleep($decodeDur);

}
echo "Decoding completed";

?> 
