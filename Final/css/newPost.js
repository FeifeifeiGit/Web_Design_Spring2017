$(document).ready(function() {

	$("#submit").click(function() {
		console.log("newPost() is called");
		var content= $("#postContent").text();
		
		
		
      
		var userInfo = $("#user-infor").find("a:first");
		var userHref = userInfo.attr("href");
		var userName = userInfo.text();
		var userImage = userInfo.find("img:first").attr("src");
	//	var time = $.datepicker.formatDate( "M, dd, yy",new Date());
	    var time = new Date($.now()); 
	    time = time.toString();
	    var timeDisplay= time.slice(0, 21); 


		console.log("userHref===" + userHref);
		console.log("userName===" + userName);
		console.log("userImage===" + userImage);
		console.log("time===" + timeDisplay);

		//clone a single post
		var newPost = $(".single-post").first().clone(true);
		console.log("newpost is :" + newPost.html() );
		newPost.find("img:first").attr("src", userImage);
		newPost.find("a:first").attr("href", userHref).text(userName);	
		newPost.find(".post-infor").children("p:first").text(timeDisplay);
        newPost.find(".post-text").children("p:first").text(content);
        console.log("newpost is :" + newPost.html() );
       
       var file = document.querySelector('#fileToUpload').files[0]; 
		if((file===undefined)&&(content.trim().length==0)){
			console.log("empty post ");
			return;
		}
		//create a text only post
		 if((file===undefined)&&(content.trim().length>0)){
		 	//insert the new post after newPost section
		 	newPost.insertAfter(".new-post:first");
		 	newPost.find(".post-pic").css("display", "none");
		 	return;
		 }
		 //create a picture only post
		 
			
			console.log(file);
        	var reader  = new FileReader();
        	reader.onloadend = function () {
          	 newPost.find(".post-pic").find(".img-responsive").attr('src', reader.result);
       			};
       		 reader.readAsDataURL(file); 			
			newPost.insertAfter(".new-post:first");
			if(content.trim().length==0){
		 		newPost.find(".post-text").css("display", "none");
		     }
		 	
	});
});