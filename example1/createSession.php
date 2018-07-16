<?php

/* 
 * Helper method to create folder
 */
$sessionId=$_POST['sessionId'];

mkdir($sessionId);
exec("sudo chmod -R 0777 ".$sessionId."/");
copy("track.xml",$sessionId."/track.xml"); 
echo "Session created "."$sessionId";

?> 
