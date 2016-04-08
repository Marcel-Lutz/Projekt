<?php
  $host = 'localhost';
  $username='testuser';
  $password='password';
  $connect = mysql_pconnect($host, $username, $password)or die(mysql_error());
  $dbselect = mysql_select_db('local', $connect);
  if (!$dbselect) {
    die ('Tabelle Projekt kann nicht benutzt werden : ' . mysql_error());
  }

  function get_adressen($search){
  $sSQL="SELECT A.ADRESSENID, A.SUCHCODE, A.STRASSE, A.PLZSTR, A.ORT, A.TELEFON1 FROM TBLADRESSEN A";
  if (!$search == ''){
    $sSQL.=" WHERE A.SUCHCODE_U LIKE '".strtoupper($search)."%'";
    }
  $sSQL.=" ORDER BY A.SUCHCODE LIMIT 15";
  $result = get_result($sSQL);
  $adressen ='';
  while($row = mysql_fetch_object($result)){
    $adressen.="<div class='col-sm-6 col-lg-4'><div class='col-xs-12 adresse'>";
    $adressen.="<h3>".$row->SUCHCODE."</h3><p>".$row->STRASSE."</p>";
    $adressen.="<p>".$row->PLZSTR." ".$row->ORT."</p>";
    $adressen.="<form class='form' action='projekt.php' method='POST'>";
    $adressen.="<input type='hidden' name='adresse' value='".$row->SUCHCODE."'>";
    $adressen.="<input type='hidden' name='adressenid' value='".$row->ADRESSENID."'>";
    $adressen.="<input type='submit' class='btn btn-info btn-lg' name='projektsubmit' value='Projekte'></form>";
    $adressen.= get_adressenpartner($row->ADRESSENID);
    $adressen.="</div></div>";
    }
    return $adressen;
  };

  function get_adressenpartner($adressenid){
    $sSQL=  "SELECT P.VORNAME, P.PARTNER, P.DURCHWAHL, P.DURCHEMAIL, P.PARTNERID FROM TBLADRESSENPARTNER P";
    $sSQL.=" LEFT JOIN TBLADRESSEN A ON P.ADRESSENID = A.ADRESSENID";
    $sSQL.=" WHERE A.ADRESSENID = '". $adressenid ."' ORDER BY P.PARTNER;";
    $result = get_result($sSQL);
    $adpartner ='';
    while($row = mysql_fetch_object($result)){
      $adpartner.="<input type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#".$row->PARTNERID."' value='".$row->VORNAME ." ". $row->PARTNER."'>";
      $adpartner.="<div id='".$row->PARTNERID."' class='modal fade' role='dialog'><div class='modal-dialog'>";
      $adpartner.="<div class='modal-content'><div class='modal-header'>";
      $adpartner.="<button type='button' class='close' data-dismiss='modal'>&times;</button>";
      $adpartner.="<h4 class='modal-title'>".$row->VORNAME ." ". $row->PARTNER."</h4>";
      $adpartner.="</div><div class='modal-body'><p>".$row->DURCHWAHL ."</p> <p>".$row->DURCHEMAIL ."</p></div><div class='modal-footer'>";
      $adpartner.="<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button></div></div></div></div>";
    }
    return $adpartner;
  };

  function get_projekte($adressenid){
    $sSQL=  "SELECT PR.PROJEKTID, PR.PROJEKT, PR.AKTION, PR.STATUS,";
    $sSQL.=" PR.ADRESSENSUCHCODE, PR.ADRESSENID, PR.BEARBEITER, PR.AKTIONDATUM,";
    $sSQL.=" PR.AKTIONDATUMZEIT, PR.WVDATUM, PR.AKTIONZEITII,";
    $sSQL.=" PR. WVZEIT, PR.AKTIONZEITVON, PR.AKTIONZEITBIS, PR.ERLEDIGT, PR.AKTIONSCRIPT";
    $sSQL.=" FROM TBLPROJEKT PR";
      if (!$adressenid == ''){
      $sSQL.=" WHERE PR.ADRESSENID LIKE '".$adressenid."'";
      }
    $sSQL.=" ORDER BY PR.ERLEDIGT";
    $result = get_result($sSQL);
    $projekte ='';
    while($row = mysql_fetch_object($result)){
      $projekte.="<div class='row'>";
      $projekte.="<div class='col-sm-12 projekt'>";
      $projekte.="<div class='col-md-3'>";
      $projekte.="<h3>".strtoupper($row->BEARBEITER)."</h3>";
      $projekte.="<p>Projektdatum: </p>";
      $projekte.="<p>".$row->AKTIONDATUM." - ".get_time($row->AKTIONDATUMZEIT)."</p>";
      $projekte.="<p>Wiedervorlage: </p>";
      $projekte.="<p>".$row->WVDATUM." - ".get_time($row->WVZEIT)."</p>";
      $projekte.="</div>";
      $projekte.="<div class='col-md-6'>";
      $projekte.="<h3>Kunde: ".$row->ADRESSENSUCHCODE."</h3>";
      $projekte.="<p>Projekt: ".$row->PROJEKT." -/- ".$row->AKTION."</p>";
      $projekte.="<p>Aktion: ".$row->AKTIONSCRIPT."</p>";
      $projekte.="<p>Status: ".$row->STATUS."</p>";
      $projekte.="</div>";
      $projekte.="<div class='col-md-3'>";
      $projekte.="<h3>Zeiterfassung</h3>";
      $projekte.="<p>".get_time($row->AKTIONZEITVON)." - ".get_time($row->AKTIONZEITBIS)."</p>";
      $projekte.="<p>Dauer: ".get_time($row->AKTIONZEITII)."</p>";
      $projekte.="<p>Erledigt: ".$row->ERLEDIGT."</p>";
      $projekte.="</div>";
      $projekte.="<div class='col-sm-12'>";
      $projekte.="<div class='col-sm-6'><input type='button' name='update' class='btn btn-info btn-lg' value='Update'></div>";
      $projekte.="<div class='col-sm-6'><input type='button' name='delete' id='".$row->PROJEKTID."'class='btn btn-info btn-lg' value='Delete'></div>";
      $projekte.="</div>";
      $projekte.="</div>";
      $projekte.="</div>";
      }
      return $projekte;
  };

  function get_time($str){
    if(!$str == 0){
      $strminutes = substr($str, -2);
      $strhour = substr($str,0, -2);
      if(strlen($strhour)==1) {
        $strhour = "0". $strhour;
      }
      $time = $strhour.":".$strminutes;
      return $time;
    }
    else {
      return "n.A.";
    }
  }

  function get_aktion(){
    $sSQL = "SELECT OPTIONEN FROM TBLPROJEKTOPT WHERE OPTTYP = 'Aktion' ORDER BY OPTIONEN;";
    $result = get_result($sSQL);
    return get_auswahl($result, 'Aktion', 'OPTIONEN');
  }

  function get_status(){
    $sSQL = "SELECT OPTIONEN FROM TBLPROJEKTOPT WHERE OPTTYP = 'Status' ORDER BY OPTIONEN;";
    $result = get_result($sSQL);
    return get_auswahl($result, 'Status', 'OPTIONEN');
  }

  function get_adressensuchcode(){
    $sSQL = "SELECT SUCHCODE, ADRESSENID FROM TBLADRESSEN ORDER BY SUCHCODE_U;";
    $result = get_result($sSQL);
    return get_auswahl($result, 'Adressensuchcode', 'SUCHCODE');
  }

  function get_adressenid($suchcode){
    $sSQL = "SELECT ADRESSENID FROM TBLADRESSEN WHERE SUCHCODE = '".$suchcode."';";
    $result = get_result($sSQL);
    return $result;
  }

  function get_auswahl($result, $id, $feld){
    $options ='';
    $options ="<div class='form-group col-md-6'><label for='#".$id."'>".$id.":</label><select class='selectpicker' id='".$id."'>";
    while($row = mysql_fetch_object($result)){
      $options.="<option>".$row->$feld."</option>";
    }
    $options.="</select></div>";
    return $options;
  }

  function get_result($sSQL){
    $result = mysql_query($sSQL);
  return $result;
  }
?>
