//rgight-sideBar searching function
function myFunction() {
    // Declare variables
    var friendsList, input, filter, items, span, i;
    input = document.getElementsByClassName('rightSideBar-footer')[0].getElementsByTagName('input')[0];
    
    friendsList = document.getElementsByClassName('usePage-friend-list')[0];
    filter = input.value.toUpperCase();
   
    items = friendsList.getElementsByClassName('friend-item');
    
    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < items.length; i++) {
        span = items[i].getElementsByTagName('span')[0];
        //alert("span innterHTML is"+span.innerHTML);
        if (span.innerHTML.toUpperCase().indexOf(filter) > -1) {
            items[i].style.display = '';
        } else {
            items[i].style.display = 'none';
        }
    }
}

 function previewFile(){
      //get the first element whose tag is 'img'
      console.log("previewFile() is called");
       var preview = document.querySelector('#preview-img'); //selects the query named img
       var file    = document.querySelector('#fileToUpload').files[0]; //sames as here
       var reader  = new FileReader();

       reader.onloadend = function () {
           preview.src = reader.result;
       };
       if (file) {
           reader.readAsDataURL(file); //reads the data as a URL
           preview.style.display="inline-block";
           console.log('preview src' + preview.src);
           console.log(reader.result);
           console.log('preview display' + preview.style.display);
       } else {
           preview.src = "";
       }
  }
