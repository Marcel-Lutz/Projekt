<?php
  echo "<div id='new' class='modal fade' role='dialog'>";
    echo "<div class='modal-dialog'>";
      echo "<div class='modal-content'>";
        echo "<div class='modal-header'>";
          echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
            echo "<h4 class='modal-title'>Neuen Eintrag hinzufügen</h4>";
        echo "</div>";
        echo "<div class='modal-body'>";

        echo "<form class='form-inline' name='new'>";
            echo "<div class='row'>";
              echo get_aktion();
              echo get_status();
            echo "</div>";
            echo "<div class='row'>";
              echo get_adressensuchcode();
            echo "</div>";
            echo "<div class='row'>";
              echo "<div class='form-group md-col-6'>";
                echo "<label class='label' for='aktiondatum'>Datum</label>";
                echo "<input type='text' class='form-control datepicker' name='aktiondatum' onclick='date()' >";
              echo "</div>";
              echo "<div class='form-group md-col-6'>";
                echo "<label class='label' for='aktiondatumzeit'>Zeit</label>";
                echo "<input class='form-control timepicker' name='aktiondatumzeit' type='text' onclick='time()' value='10:00'>";
              echo "</div>";
            echo "</div>";
            echo "<div class='row'>";
              echo "<div class='form-group md-col-6'>";
                echo "<label class='label' for='aktiondatum'>WV</label>";
                echo "<input type='text' class='form-control datepicker' name='wvdatum' onclick='date()' >";
              echo "</div>";
              echo "<div class='form-group md-col-6'>";
                echo "<label class='label' for='aktiondatumzeit'>Zeit</label>";
                echo "<input type='text' class='form-control timepicker' name='wvzeit' onclick='time()' value='10:00'>";
              echo "</div>";
            echo "</div>";
            echo "<div class='row'>";
              echo "<div class='form-group md-col-12'>";
                echo "<label class='label' for='projekt'>Projektthema:</label>";
                echo "<input type='text' name='projekt' class='input-xlarge'>";
              echo "</div>";

              echo "<div class='form-group md-col-12'>";
                echo "<label class='label' for='aktion'>Aktion:</label>";
                echo "<input type='text' name='aktion' class='input-xlarge'>";
              echo "</div>";
            echo "</div>";
          echo "</form>";
          echo "<script type='text/javascript'>
                  function time() {
              		$('.timepicker').timepicker( {
        							showAnim: 'blind'
            			})};
        	    </script>";
        echo "</div>"; //Modal Body
        echo "<div class='modal-footer'>";
        echo "<input class='btn btn-success' type='submit' value='Send!' id='submit'>";
        echo "<a href='#' class='btn' data-dismiss='modal'>Close</a>";
        echo "</div>"; //Modal-Footer
      echo "</div>"; //Modal-Content
    echo "</div>"; //Modal-Dialog
  echo "</div>"; //Modal
?>
