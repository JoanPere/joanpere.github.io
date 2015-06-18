<?php

$email_to = "joanperenules@gmail.com";
$email_subject = "Contacto desde MI sitio web";




$siteKey = '6LfjgQgTAAAAAMUZrVd6mn97WZlB_t12JFCo03pF';
$secret = '6LfjgQgTAAAAAJogjo0AmDhgja5EvpjrP1OvjXhn';

// Register API keys at https://www.google.com/recaptcha/admin


        $name;$email;$comment;$captcha;
        if(isset($_POST['name'])){
          $name=$_POST['name'];
        }if(isset($_POST['email'])){
          $email=$_POST['email'];
        }if(isset($_POST['message'])){
          $comment=$_POST['message'];
        }if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
 			echo "<script languaje='javascript'>alert('Dale al checkbox del recaptcha')</script>";
        	echo '<script language="javascript">';
			echo 'history.go(-1);';
			echo '</script>';
        	exit;
        }
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfjgQgTAAAAAJogjo0AmDhgja5EvpjrP1OvjXhn&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false)
        {
           echo '<h2>You are spammer ! Get the @$%K out</h2>';
        }else{

			$email_message = "Detalles del formulario de contacto:\n\n";
			$email_message .= "Nombre: " . $name. "\n";
			$email_message .= "E-mail: " . $email . "\n";
			$email_message .= "Comentarios: " . $comment . "\n\n";


			// Ahora se envía el e-mail usando la función mail() de PHP
			$headers = 'From: '.$email_from."\r\n".
			'Reply-To: '.$email_from."\r\n" .
			'X-Mailer: PHP/' . phpversion();

			@mail($email_to, $email_subject, $email_message, $headers);



          	

          	header('Location: index.html');
          	//echo "<script languaje='javascript'>alert('Gracias por ponerse en contacto!')</script>";
        }





?>