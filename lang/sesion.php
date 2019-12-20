<?php session_start();

//Este es el que tenia inicialmente que lo va cambiando el idioma y si vas a otra ventana permenece ese idioma, pero no coge al inicio el del navegador



//Creamos una función que detecte el idioma del navegador del cliente. 
function getUserLanguage() {  
    $idioma =substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2); 
    return $idioma;  
} 
$first_time = false;
if(empty($_COOKIE['first_time'])){
	$first_time = true;
	setcookie("first_time", 1, time()+157680000);
}

if ($first_time == True){

	$user_language=getUserLanguage(); 
	$first_time == False;
	if(file_exists('./lang/'.$user_language.'.php')){
		switch($user_language){
		case 'es':
			include('./lang/es.php');
			$lang_icon = "./lang/es.png";
		break;
		case 'en':
			include('./lang/en.php');
			$lang_icon = "./lang/en.png";
		break;
		/*case 'ca':
			include('./lang/cat.php');
		break;*/
		default:
			include('./lang/es.php');
			$lang_icon = "./lang/es.png";
		break;
		}
	
	}else{
		require_once('./lang/'.$user_language.'.php');
	}
}else{

	//require_once('./lang/'.'en'.'.php');
	//$lang_icon = "./lang/en.png";

		if(!empty($_REQUEST['lang']) && (file_exists('./lang/'.$_REQUEST['lang'].'.php') || file_exists('./lang/'.$_REQUEST['lang'].'.php'))){

		  /*Entonces lo que vamos a hacer ahora, es decir que a partir de ahora,
		  nuestro idioma por defecto es este, al menos que se solicite cambiarlo de vuelta*/

		  $_SESSION['lang'] = $_REQUEST['lang'];

		  //y esto lo vamos a usar despues
		  $user_language = $_REQUEST['lang'];



		  $lang_icon = "./lang/".$user_language.".png";
		}

		//Sino se solicito ningun idioma, verificamos si quedo guardado en nuestra session

		elseif(isset($_SESSION['lang'])){
			//Lo mismo que antes, esto para despues

		  $user_language = $_SESSION['lang'];
		  $lang_icon = "./lang/".$user_language.".png";
		}


		  
		else{

			$user_language = 'es';
			$lang_icon = "./lang/".$user_language.".png";
		}

		//Y por ultimo, si nada de lo anterior cumple los requisitos, cargamos el idioma, que seria el idioma por defecto

		if(file_exists('./lang/'.$user_language.'.php')){
			require_once('./lang/'.$user_language.'.php');
			$lang_icon = "./lang/".$user_language.".png";
			
		}else{
			require_once('./lang/'.$user_language.'.php');
			$lang_icon = "./lang/".$user_language.".png";
		}
}		
?>