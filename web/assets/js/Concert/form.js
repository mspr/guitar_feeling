function displayCalendar(idInputDate)
{
    $('#' + idInputDate).datetimepicker({
      format:'d/m/Y H:i'
    });
}

displayCalendar('concert_date');
