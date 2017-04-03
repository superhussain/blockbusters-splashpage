$(document).ready(function () {
  modal();
  submitQuestion();
});

function modal() {
  $('.details').on('click', function(e) {
    $('.modal-overlay').fadeIn();
    $('#modal-details').fadeIn();
    e.preventDefault();
  });

  $('.modal #close-button').on('click', function() {
    $('.modal-overlay').fadeOut();
    $('.modal').fadeOut();
  });

  $('.modal-overlay').on('click', function() {
    $('.modal-overlay').fadeOut();
    $('.modal').fadeOut();
  });

  $(document).keyup(function(e) {
    if (e.keyCode == 27) { // escape key maps to keycode `27`
      $('.modal-overlay').fadeOut();
      $('.modal').fadeOut();
    }
  });
}

function submitQuestion() {
  $('#question-form').submit(function() {
    var fields = $(this).serialize();
    console.log(fields);
    $.ajax({
      type: "POST",
      url: "submit_question.php",
      data: fields,
      dataType: 'json',
      success: function(response) {
        if (response.status) {
          $('#question-form input[type=text], #question-form select').val('');
        }
        $('#message').empty().html(response.html);
      }
    });
    return false;
  });
}
