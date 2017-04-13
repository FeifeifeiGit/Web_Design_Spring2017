
var track_page = 1; //track user scroll as page number, right now page number is 1
var loading  = false; //prevents multiple loads

$('.loading-info').hide(); 

$(window).scroll(function() { //detect page scroll
if(loading===false)	{
		if(($(window).scrollTop() + $(window).height()) >= $(document).height()) { //if user scrolled to bottom of the page
			 //page number increment
			 track_page++;
			 console.log("track_page is==" + track_page);
			console.log("$(window).scrollTop() is =="+ $(window).scrollTop());
			console.log("$(window).height()  is =="+ $(window).height() );
			console.log("$(document).height()  is =="+ $(document).height() );
			load_contents(track_page); //load content	
			
		}
	}
});		
//Ajax load function
function load_contents(track_page){
    if(loading === false){
		loading = true;  //set loading flag on
		$('.loading-info').show(); //show loading animation 
		$.post( 'reloadPost.php', {'page': track_page}, function(data){
			loading = false; //set loading flag off once the content is loaded
			if(data.trim().length === 0){
				//notify user if nothing to load
				$('.loading-info').html("No more posts!");
				//load_infor.html("No more posts!");
				loading=true;//stop calling load_contents() after no data available
				return;
			}
			$('.loading-info').hide(); //hide loading animation once data is received
			//$("#center-col").append(data); //append data into #results element
			$('.loading-info').before(data);
		
		}).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
			alert(thrownError); //alert with HTTP error
		});
	}
}