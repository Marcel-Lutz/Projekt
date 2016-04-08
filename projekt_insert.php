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
    $sql= "UPDATE OR INSERT INTO TBLPROJEKT(ADRESSENSUCHCODE, ADRESSENID, PROJEKT, AKTION, STATUS,";
    $sql.=" AKTIONDATUM, AKTIONDATUMZEIT, WVDATUM, WVZEIT, AKTIONSCRIPT)";
    $sql.=" VALUES('$_SESSION['Adressensuchcode']','".$_SESSION['adressenid']."','$_POST['projekt']',";
    $sql.=" '$_POST['Aktion']','$_POST['Status']', '$_POST['aktiondatum']','$_POST['aktiondatumzeit']',";
    $sql.=" '$_POST['wvdatum']','$_POST['wvzeit']','$_POST['aktionscript']');"
    //$result=get_result($sql);if($result)
      echo "Das Projekt: ". $_POST['projekt'] . " wurde erfolgreich eingetragen;
      echo "sSQL";
  }
}
?>
