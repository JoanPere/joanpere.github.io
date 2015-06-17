// <?php
// if($_POST["name2"] && $_POST["email2"] != ""){
// 	$de = $_POST["name2"];
// 	$destino = "joanperenules@gmail.com";
// 	$asunto = "FORMULARIO";
// 	$mensaje .= "FORMULARIO."."\n";
// 	$mensaje .= "\n";
// 	$mensaje .= "NOMBRE: " . utf8_decode($_POST["name2"]) ."\n";
// 	$mensaje .= "\n";
// 	$mensaje .= "EMAIL: " . utf8_decode($_POST["email2"]) ."\n";
// 	$mensaje .= "\n" . utf8_decode($_POST["message2"]) ."\n";
//     $emailheader = "From: JoanPereGIS <joanperenules@gmail.com>\r\n";
// mail($destino, $asunto, $mensaje, $emailheader) or die ("Lo sentimos, tu solicitud no ha sido enviada.<br/>Intentelo de nuevo.");
// echo utf8_decode(utf8_encode('Tu consulta ha sido enviada correctamente.'));
// 	} else {
//     if($_POST["name2"] == ""){
//     echo utf8_encode ('Por favor, indica tu nombre.');
//     exit; }
//     if($_POST["email"] == ""){
//     echo utf8_encode ('Por favor, indica un email de contacto.');
//     exit; }
// }
// 



include 'recaptchalib.php';
$publickey = "6Ld_2f4SAAAAACXsn7ORlvcr3ouBPlDbo9oueDyL";
$privatekey = "6Ld_2f4SAAAAAADyUVlsoQSt0rB-QjOC7pp3BwxX";

//datos para enviar el email
$para = 'joanperenules@gmail.com';
$asunto = 'Consulta - Formulario WEB';
 
//If somebody has posted data, we run verification
if ( isset($_POST['name']) ) { 
	 
	//Captcha Validation
	$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
	if (!$resp->is_valid) {
	if ( $resp->error=='incorrect-captcha-sol' ) $errors[] = 'El captcha que se ha introducido es incorrecto. Por favor pruebe de nuevo.';
	else $errors[] = $resp->error;
	}
	 
	//Se comprueba que no tiene errores para enviar el email
	if ( !isset($errors) ) {
		//Se redacta el mensaje	
		$mensaje = "Nombre: " . $_POST['name'] . "\r\n";
		//$mensaje .= "Apellidos: " . $_POST['apellidos'] . "\r\n";
		//$mensaje .= "Empresa: " . $_POST['empresa'] . " \r\n";
		//$mensaje .= "Teléfono: " . $_POST['telefono'] . " \r\n";
		$mensaje .= "Email: " . $_POST['email'] . " \r\n";
		$mensaje .= "Mensaje: " . $_POST['message'] . " \r\n";
		$mensaje .= "Enviado el " . date('d/m/Y', time());		 

		//Se crea la informacion que nos llegará del remitente
		$header = 'From: ' . $email . " \r\n";
		$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
		$header .= "Mime-Version: 1.0 \r\n";
		$header .= "Content-Type: text/plain";
		 
		//Enviar el email
		if(mail($para, $asunto, utf8_decode($mensaje), $header)){
			header('Location: index.html');
		} else {
			echo '<script language="javascript">';
			echo alert('Fallo al enviar el formulario, vuelve a intentarlo por favor');
			echo </script>;

			header('Location: index.html');
		}
	}
}



?>