document.getElementById("submit").addEventListener("click", function(event) {
			event.preventDefault();
			console.log('prevent called'+event.defaultPrevented);
			//disable post content div
			//$("#postContent").prop('disable', 'true');
     
  		var fileSelect=document.getElementById("fileToUpload");
  		var files = fileSelect.files;
  		//get the post Content
  		var content=$("#postContent").text();
  		if((files===undefined)&&(content.trim().length==0)){
  			var feedback = document.getElementById("posting-feedback");
  				feedback.innerHTML="<b>Cannot Publish Empty Content!</b>";
  				feedback.style.color = "red";
  				console.log("postSubmit return because of empty post");
  				return;
  		}
		// Create a new FormData object.
		var formData = new FormData();
	  		// Add the file to the request.
	  		formData.append('fileToUpload', files[0]);
	  		formData.append('postContent',content);
			//formData.append("text", "text message");
	  	var xhr = new XMLHttpRequest();
	  	xhr.open("POST","upload.php",true);
	  	xhr.onreadystatechange = function () {
		  	if (this.status == 200 && this.readyState==4) {
			    document.getElementById("posting-feedback").innerHTML = this.responseText;
			     $('#postModal').modal('hide');
			     $('body').removeClass('modal-open');
				 $('.modal-backdrop').remove();
			    console.log('reday status==4 here');
			  } else {
			  	console.log('new round-----------------' );
			    console.log('status is: ' +this.status);
			    console.log('readyState: ' +this.readyState);
			  }
		};
		 xhr.send(formData);
	});