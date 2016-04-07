<?php
session_start();
  require_once('load.php');
  require_once('database.php');
if(!$_SESSION['logged_in']){
  header("Location: index.php");
  exit;
}
elseif($_SESSION['logged_in']){

  if(isset($_REQUEST))
  {
    $sSQL="DELETE * TBLPROJEKT WHERE PROJEKTID = 'id';"
    //$result=mysql_query($sSQL);
    if($result){
      echo "Der folgende SQL würde hier ausgeführt werden:" $sSQL;
      alert "Der Datensatz wurde gelöscht.";
      header ('start.php')
    }
  }

}
?>
