$(document).ready(function() {
   var level = $('.star-rating').attr("value");
   var starRatingRdbs = $('.star-rating__input');
   var starRaintsRdbCount = starRatingRdbs.length;
   var element = $('.star-rating__input')[starRaintsRdbCount - level];
   $(element).attr("checked", true);
});

function getContent(){
   document.getElementById("tutorial_introduction").value = document.getElementById("introduction").innerHTML;
}

$("#tutorial_picture").change(function()
{
   readURL(this);
});

function readURL(input)
{
   if (input.files && input.files[0])
   {
      var reader = new FileReader();
      reader.onload = function (e)
      {
         $('#pictureViewer')
            .attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
   }
}
