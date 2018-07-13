<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sessionId=$_POST['sessionId'];

mkdir($sessionId);
//chmod("temp/".$sessionId."/", 0777);
exec("sudo chmod -R 0777 ".$sessionId."/");

copy("track.xml",$sessionId."/track.xml"); 


echo "Session created "."$sessionId";



?>
