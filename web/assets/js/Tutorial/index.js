$(document).ready(function() {
   
   $( ".star-rating" ).each(function(index) {
      var name = $(this).attr("name");
      var level = $(this).attr("value");
      var starRatingRdbs = $(this).find('.star-rating__input');
      var starRaintsRdbCount = starRatingRdbs.length;
      var element = $(this).find('.star-rating__input')[starRaintsRdbCount - level];
      $(element).attr("checked", true);
   });
   
   $('.star-rating__ico').attr("disabled", true);
   $('.star-rating__input').attr("disabled", true);
});
