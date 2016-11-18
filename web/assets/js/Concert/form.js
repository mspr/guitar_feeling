function displayCalendar(idInputDate)
{
    $('#' + idInputDate).datetimepicker({
      format:'d/m/Y H:i'
    });
}

displayCalendar('concert_date');

$("#concert_picture").change(function()
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
