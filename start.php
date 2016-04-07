<?php
session_start();
  require_once('load.php');
  require_once('database.php');
if(!$_SESSION['logged_in']){
  header("Location: index.php");
  exit;
}
elseif($_SESSION['logged_in']){
	if(!(isset($_POST['adressen']))) {
		$adressen = '';
	}
	else {
		$adressen = $_POST['adressen'];
	}
echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
	echo "<title>Adressen</title>";
echo "</head>";
	echo "<body>";
		echo "<div class='container-fluid'>";
    require_once('nav.php');
      echo "<div class='row'>";
				echo "<div class='col-md-3'>";
					echo "<div class='row'>";
						echo "<form class='form' role='search' action='".$_SERVER['PHP_SELF']."' method='POST'>";
							echo "<div class='input-group'>";
							echo "<input  type='text' class='form-control' placeholder='Adresse suchen...' name='adressen'>";
							echo "<div class='input-group-btn'>";
								echo "<button class='btn btn-default' type='submit'><i class='fa fa-search'></i></button>";
							echo "</div>";
							echo "</div>";
						echo "</form>";
					echo "</div>";
				echo "</div>";
			echo "<div class='col-md-9'>";
			echo "<div class='row'>";
				echo "<div class='col-md-12'>";
					echo "<h1>Adressen</h1>";
					echo  (!($adressen) ? '' : "<h2>Suchanfrage nach: '" . $adressen ."'</h2>");
				echo "</div>";
			echo "</div>";
				echo "<div class='row'>";
						echo get_adressen($adressen);
	      echo	"</div>";
			echo "</div>";
	 	echo "</div>";
  echo "<script src='js/bootstrap.min.js'></script>";
  echo "<script src='js/javascript.js'></script>";
echo "</body>";
echo "</html>";
}
?>
