<?php
  echo "<div id='new' class='modal fade' role='dialog'>";
    echo "<div class='modal-dialog'>";
      echo "<div class='modal-content'>";
        echo "<div class='modal-header'>";
          echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
            echo "<h4 class='modal-title'>Neuen Eintrag hinzufügen</h4>";
        echo "</div>";
        echo "<div class='modal-body'>";

        echo "<form role='form' action='projekt_insert.php' method='POST' class='form-inline' name='projekt'>";
            echo "<div class='row'>";
              echo get_aktion();
              echo get_status();
            echo "</div>";
            echo "<div class='row'>";
              echo get_adressensuchcode();
            echo "</div>";
            echo "<div class='row'>";
              echo "<div class='form-group form-inline md-col-6'>";
                echo "<label class='label' for='aktiondatum'>Datum</label>";
                echo "<input class='form-control datepicker' name='aktiondatum' onclick='date()' type='text'>";
              echo "</div>";
              echo "<div class='form-group form-inline md-col-6'>";
                echo "<label class='label' for='aktiondatumzeit'>Zeit</label>";
                echo "<input class='form-control timepicker' name='aktiondatumzeit' type='text' onclick='time()' value='10:00'>";
              echo "</div>";
            echo "</div>";
            echo "<div class='row'>";
              echo "<div class='form-group form-inline xs-col-12'>";
                echo "<label class='label' for='projekt'>Projektthema:</label>";
                echo "<input type='text' name='projekt' class='input-xlarge'>";
              echo "</div>";
            echo "</div>";
            echo "<div class='row'>";
              echo "<div class='form-group xs-col-12'>";
                echo "<label class='label' for='aktionscript'>Beschreibung:</label>";
                echo "<input type='text' name='aktionscript' class='input-xlarge'>";
              echo "</div>";
            echo "</div>";
          echo "</form>";
        echo "</div>"; //Modal Body
        echo "<div class='modal-footer'>";
        echo "<input class='btn btn-success' type='submit' id='submit' value='Senden!'>";
        echo "<a href='#' class='btn' data-dismiss='modal'>Close</a>";
        echo "</div>"; //Modal-Footer
      echo "</div>"; //Modal-Content
    echo "</div>"; //Modal-Dialog
  echo "</div>"; //Modal
?>
