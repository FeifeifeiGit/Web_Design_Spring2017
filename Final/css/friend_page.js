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



  // $('.comment_form').submit(function(event) {
  //   event.preventDefault();
  //   //var comment = $.trim($('.comment').val());
  //   var comment = $.trim($(this).children().val());
  //   if (comment == '') {
  //     alert($(this).children().attr("class"));
  //     //$('.comment').attr("placeholder", "Please Enter Something...").placeholder();
  //     $(this).children().attr("placeholder", "Please Enter Something...").placeholder();
  //     return false;
  //   }
  // });

  $(".comment").blur(function() {
    $(this).attr("placeholder", "Enter your comment").placeholder();
  });

  $(".comment_form .comment").keypress(function(event) {
    if (event.which == 13) {
      event.preventDefault();
      if(!$(this).val()){
        //alert($(this).attr("placeholder"));
          $(this).attr("placeholder", "Please Enter Something...").placeholder();
          return false;
      }
      $(this).parent().submit();
    }
  });

  $(".comment_link").click(function() {
    //e.preventDefault();
    //alert($(this).siblings(".comment_div").attr('class'));
    $(this).siblings(".comment_div").children(".comment_form").children(".comment").focus();
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
