<?php

session_start ();


if(empty($_COOKIE['first_time'])){
	$idioma =substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
	setcookie("first_time", 1, time()+157680000);
}else{
	if(isset($idioma)){
  	$_SESSION["idiomas"] = $idioma;
	}
	elseif (!$_SESSION["idiomas"]){
 		$_SESSION ["idiomas"] = "es";
	}
}



//incluyendo nuestro idioma
include("lang_".$_SESSION["idiomas"].".php");

?>