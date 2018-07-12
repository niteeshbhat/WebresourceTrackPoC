<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sessionId=$_POST['sessionId'];

mkdir("temp/".$sessionId);
//chmod("temp/".$sessionId."/", 0777);
exec("sudo chmod -R 0777 temp/".$sessionId."/");

copy("track.xml","temp/".$sessionId."/track.xml"); 


echo "Session created "."$sessionId";



?>
