<?php
function getLang() {
  $lang= 'fr';
  if (isSet($_SESSION['lang'])) {
  	$lang = $_SESSION['lang'];
  }
  else {
	  if (isset($_COOKIE['lang'])) {
	  	$_SESSION['lang'] = $_COOKIE['lang'];
	  	$lang = $_SESSION['lang'];
	  } else {
	  	$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	  	$supportedLanguages=['en','fr','it'];
	  	if(!in_array($lang,$supportedLanguages)){
	     	$lang='fr';
	  	}
		$_SESSION['lang'] =	$lang;
	  }
   }
   return $lang;
}

function setCookieLang($lang) {
	setcookie("lang", $lang);
}

?>
