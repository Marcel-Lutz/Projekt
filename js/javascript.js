$(document).ready(function() {
  function time() {
    $('.timepicker').timepicker( {
      showAnim: 'blind'
  })};
});

$(document).ready(function() {
  function date() {
    $('.datepicker').datepicker( {
  })};
});

$(document).ready(function() {
      $(function ajaxCall() {
        $('form').on('submit', function (e) {
          e.preventDefault();
          $.ajax({
            type: 'post',
            url: 'projekt_insert.php',
            data: $('form').serialize(),
            success: function () {
              alert('Daten wurden übertragen');
            }
          });
          return false;
        });
      });
});
