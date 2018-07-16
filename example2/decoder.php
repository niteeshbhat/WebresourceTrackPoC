<?php

$sessionId=$_POST['sessionId'];
$trackFilename = $sessionId.'/track.xml';

//Simply read the XML track file in DOM
$trackData = getTrackDataFromTrackFile($trackFilename);

//Get some relevant parameters
$sampleCount=$trackData->getElementsByTagName('sampleCount')->item(0)->nodeValue;

//Extract the segment template
$template=$trackData->getElementsByTagName('template')->item(0)->nodeValue;

//Extract the initial webpage, save
$initHTML=$trackData->getElementsByTagName('html')->item(0);
$initalHTMLFile = $sessionId.'/init.html';
file_put_contents($initalHTMLFile,$trackData->saveXML($initHTML));
replaceSpecialStrings($initalHTMLFile);//Replace the &lt; etc. in file

/*Extract (decode) all samples at their decode times and write to server*/
for($sampleNumber=1;$sampleNumber<=(int)($sampleCount);$sampleNumber+=1)
{
    $sample=$trackData->documentElement->childNodes->item(($sampleNumber*2)+1); //Indexing and addressing of child node caters for extra "text" nodes
    $sampleFileName=$sessionId . '/' . str_replace('$Number$', strval($sampleNumber), $template); //Create sample file name from template
    file_put_contents($sampleFileName,$trackData->saveXML($sample->firstChild->nextSibling));
    replaceSpecialStrings($sampleFileName);//Replace the &lt; etc. in file
    
    //Extract the decode duration of this sample, sleep the duration before decoding next sample.
    $decodeDur=$sample->firstChild->nextSibling->getAttribute('decodeDur');
    sleep($decodeDur);
}
    
echo "Decoding completed";

/*Other helper methods*/
function getTrackDataFromTrackFile($fileName)
{
    $load=simplexml_load_file($fileName);

    if($load !== FALSE){
        $dom_abs = dom_import_simplexml($load);
        $abs = new DOMDocument('1.0');
        $dom_abs = $abs->importNode($dom_abs, true); //create dom element to contain mpd 
        $dom_abs = $abs->appendChild($dom_abs);
        $trackData = $abs;
    }
    else
        echo "Track data not found";
    
    return $abs;
}

function replaceSpecialStrings($fileName)
{
    //read the entire string
    $str=file_get_contents($fileName);

    //replace something in the file string
    $str=str_replace("&lt;", "<", $str);
    $str=str_replace("&gt;", ">", $str);
    $str=str_replace("&amp;", "&", $str);

    //write the entire string
    file_put_contents($fileName, $str);
}

?>  
