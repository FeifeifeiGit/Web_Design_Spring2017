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



  $('.comment_form').submit(function(event) {
        event.preventDefault();
        //alert($(this).siblings(".comment_area").attr('class'));
        var form = $(this);
        var post_url = form.attr('action');
        var post_data = form.serialize();
        //$('#loader3', form).html('<img src="../../images/ajax-loader.gif" />       Please wait...');
        $.ajax({
            type: 'POST',
            url: post_url,
            data: post_data,
            success: function(msg) {
                $(form).fadeOut(200, function() {
                    form.siblings(".comment_area").html(msg).fadeIn().delay(100);
                    form.children(".comment").val("");
                    //form.children(".comment").css('background-color' , none);
                    form.css("display", "block");
                    //console.log($(this).parent().attr('id'));
                });
            }
        });
    });

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

  //ajax to send add friend request
  $('.addFriend').click(function(){
    var id=$(this).attr("id");
    $.ajax({

      type: "GET",
      url: "friend_page-action.php",
      data: "addFriend="+id,
      cache: false,
      success:function(html){
        //change the button style, set it show request send button
        $(".cover_button #"+id+"").text("request send");
        $(".cover_button #"+id+"").addClass("btn-default").removeClass("btn-primary addFriend");
        $("#"+id+" span").text("RequestSend");
      }
    });
  });

  //ajax to delete friend 
  $('.deleteFriend').click(function(){
    var id=$(this).attr("id");
    $.ajax({

      type: "GET",
      url: "friend_page-action.php",
      data: "unfriend="+id,
      cache: false,
      success:function(html){
        //$(".cover_button #"+id+"").text("add to frined");
        //$(".cover_button #"+id+"").addClass("btn-primary addFriend").removeClass("btn-danger deleteFriend");
        $(".cover_button").load("friend_page.php .cover_button");
      }
    });
  });

  //ajax to delete friend
  $('.deleteFriendInPanel').click(function(){
    var id=$(this).attr("id");
    $.ajax({

      type: "GET",
      url: "friend_page-action.php",
      data: "unfriend="+id,
      cache: false,
      success:function(html){
        //$(".cover_button #"+id+"").text("add to frined");
        //$(".cover_button #"+id+"").addClass("btn-primary addFriend").removeClass("btn-danger deleteFriend");
        $("#"+id+" span").text("Follow");
        
      }
    });
  });

  $('.deleteFriendInUserPage').click(function(){
    var id=$(this).attr("id");
    $.ajax({

      type: "GET",
      url: "friend_page-action.php",
      data: "unfriend="+id,
      cache: false,
      success:function(html){

        $("#deleteThisFriend"+id).fadeOut('fast');
        
      }
    });
  });


})
