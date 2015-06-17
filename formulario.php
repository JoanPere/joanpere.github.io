<?php
	$nombre = $_POST["name"];
	$correo = $_POST["email"];
	$contenido = $_POST["message"];
/*Entre las comillas de $para, después del signo igual, borre el correo vibola@inbox.ru y ponga el correo donde usted quiere recibir los mensajes enviados desde este formulario de contacto,  estos pueden ser de: 
	Gmail, Hotmail, Yahoo o cualquier otro, suba los 3 archivos que bajó al hosting que quiera y
	recibirá los mensajes correctamente, no cambie nada más; si tiene dudas me envía su pregunta a este correo:
	vibola@inbox.ru*/
	$para = "joanperenules@gmail.com";
	$asunto = "Mensaje enviado desde mi web";
	
	$mensaje = "
	Nombre del remitente: ".$nombre."
	Correo: ".$correo."
	Comentario: ".$contenido."
	";
	
	
	$header  = 'From: ' . $correo . " \r\n"; 
	$header .= "X-Mailer: PHP/".phpversion(). " \r\n"; 
	$header .= "Mime-Version: 1.0 \r\n"; 
	$header .= "Content-Type: text/plain";

	mail ($para,$asunto,$header,utf8_decode($mensaje));
	echo '<script language="javascript">';
	echo 'alert("Done!")';
	echo '</script>';

	header('Location: index.html');
?>