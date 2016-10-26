$(document).ready(function() {
   
   $( ".star-rating" ).each(function(index) {
      var level = $(this).attr("value");
      var starRatingRdbs = $(this).find('.star-rating__input');
      var starRaintsRdbCount = starRatingRdbs.length;
      var element = $(this).find('.star-rating__input')[starRaintsRdbCount - level];
      $(element).attr("checked", true);
   });
   
   $('.star-rating__ico').attr("disabled", true);
   $('.star-rating__input').attr("disabled", true);
});

$("div[class~='item']").click(function() {
   window.location.href = $(this).attr("data-path");
});
