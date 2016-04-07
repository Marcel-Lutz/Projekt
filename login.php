<?php
require_once('load.php');  //Ausgelagerte Links und Datenbankanbindung
require_once('database.php');
/*** KONFIGURATION ***/
//Konstanten
define('ENCRYPT', 'ripemd256'); // Genutzte Verschlüsselung für Passwort.
define('SUCCESS_URL', 'start.php'); // URL, zu welcher nach Login umgeleitet wird.
define('LOGIN_FORM_URL', 'login.php'); // URL mit Anmeldeformular

	$sSQL="SELECT BENUTZERID, BENUTZERNAME, PASSWORT FROM TBL_BENUTZER";

	$result = mysql_query($sSQL) or die(mysql_error());
	$usrdata = array();
	// Array mit Benutzerdaten:
	for ($i=0; $row = mysql_fetch_object($result); $i++) {
		$usrdata[$i] = array(
											"id" => $row->BENUTZERID ,
											"usr" => $row->BENUTZERNAME ,
											"pwd" => $row->PASSWORT
										);
	};

	header("Content-Type: text/html; charset=utf-8"); // Melde Browser die Zeichenkodierung

	session_start(); // PHP-Session starten und aktuellen Stand abfragen
	$_SESSION['logged_in'] = (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) ? true : false;
	$_SESSION['usr'] = (isset($_SESSION['usr'])) ? $_SESSION['usr'] : '';

	$error = array();
	if(!isset($_POST['submit'])){
    header('Location: '.LOGIN_FORM_URL);
	}else{
    $usr = (!empty($_POST['username']) && trim($_POST['username']) != '') ? $_POST['username'] : false;
    $pwd = (!empty($_POST['password']) && trim($_POST['password']) != '') ? $_POST['password'] : false;
    if(!$usr || !$pwd){
    	if(count($error) == 0)
      	$error[] = "Bitte geben Sie Benutzername und Passwort ein.";
    }else{
			$pwd1 = $pwd;
      $pwd_hash = hash('ripemd256', $pwd, 0 );// Passwort hashen
      foreach($usrdata as $ud){ // Benutzerabgleich
        if($usr != $ud['usr'] || $pwd_hash != $ud['pwd']){
          if(count($error) == 0)
            $error[] = "Benutzername und/oder Passwort nicht korrekt.";
        }else{
          $_SESSION['logged_in'] = true;
          $_SESSION['usr'] = $usr;
					$_SESSION['id'] = $id;
          header('Location: '.SUCCESS_URL);
        }
      }
    }
	}

?>
<!Doctype html>
<html>
    <head>
        <meta name="content-type" content="text/html; charset=utf-8" />
        <title>Login-Fehler</title>
    </head>
    <body>
        <div class="form">
        <?php
        foreach($error as $out){
            echo "<h2>" . $out . "</h2>";
        		}?>
        <p><a href="<?php echo LOGIN_FORM_URL; ?>">Zur Anmeldeseite</a></p>
				</div>
    </body>
</html>
