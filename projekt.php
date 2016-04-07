<?php
session_start();
  require_once('load.php');
  require_once('database.php');
if(!$_SESSION['logged_in']){
  header("Location: index.php");
  exit;
}
elseif($_SESSION['logged_in']){

$_SESSION['adressenid'] = isset($_POST['adressenid'])?$_POST['adressenid']:NULL;
$_SESSION['adresse'] = isset($_POST['adresse'])?$_POST['adresse']:NULL;
echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
	echo "<title>Projekt</title>";
echo "</head>";
	echo "<body>";
		echo "<div class='container-fluid'>";
    require_once('nav.php');
			echo "<div class='row'>";
				echo "<div class='col-md-12'>";
          echo "<div class='col-sm-8'>";
					  echo "<h1>Projekte der Firma: '" . $_SESSION['adresse'] ."'</h1>";
          echo "</div>";
          echo "<div class='col-sm-4'>";
            echo "<input type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#new' value='Neuer Eintrag'>";
            require_once('new.php');
          echo "</div>";
				echo "</div>";
			echo "</div>";
			echo "<div class='row'>";
        echo "<div class='col-md-12'>";
						echo get_projekte($_SESSION['adressenid']);
        echo "</div>";
		  echo "</div>";
	 	echo "</div>";

  echo "<script src='js/bootstrap.min.js'></script>";
echo "</body>";
echo "</html>";
}
?>
