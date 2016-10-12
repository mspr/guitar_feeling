$(document).ready(function() {
   var level = $('.star-rating').attr("value");
   var starRatingRdbs = $('.star-rating__input');
   var starRaintsRdbCount = starRatingRdbs.length;
   var element = $('.star-rating__input')[starRaintsRdbCount - level];
   $(element).attr("checked", true);
});

function getContent() {
   document.getElementById("tutorial_introduction").value = document.getElementById("introduction").innerHTML;
}
