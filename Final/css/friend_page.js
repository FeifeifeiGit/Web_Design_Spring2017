$(document).ready(function() {
  $("#about_link").click(function() {
    $("#about").show();
    $("#home").hide();
    $("#friends").hide();
    $("#photos").hide();
  });
  $("#home_link").click(function() {
    $("#home").show();
    $("#about").hide();
    $("#friends").hide();
    $("#photos").hide();
  });
  $(".friend_link").click(function() {
    $("#friends").show();
    $("#about").hide();
    $("#home").hide();
    $("#photos").hide();
  });
  $("#photo_link").click(function() {
    $("#photos").show();
    $("#about").hide();
    $("#home").hide();
    $("#friends").hide();
  });



  $('#comment_form').submit(function(event) {
    event.preventDefault();
    //var comment = $.trim($(this).find('input').val());
    //var comment = $.trim($('.comment').val());
    if (!$.trim($(this).find('.comment').val())) {
      alert($(this).find('.comment'));
      //$('.comment').attr("placeholder", "Please Enter Something...").placeholder();
      $(this).find('.comment').attr("placeholder", "Please Enter Something...").placeholder();
      return false;
    }
  });

  $(".comment").blur(function() {
    $(this).attr("placeholder", "Enter your comment").placeholder();
  });

  $("form input").keypress(function(event) {
    if (event.which == 13) {
      event.preventDefault();
      $("form").submit();
    }
  });

  $(".comment_link").click(function() {
    //e.preventDefault();
    $(".comment").focus();
    return false;
  });



  $('.getSrc_small').click(function(){
      var src = $(this).attr('src');
      $('.showPic_small').attr('src', src);

  });

  $('.getSrc').click(function(){
      var src = $(this).attr('src');
      $('.showPic').attr('src', src);
  });

  $('#myModel_small').appendTo("body");

  $('#active li a').click(function() {
         $('#active li').removeClass();
         $(this).parent().addClass('active');
      });

})
