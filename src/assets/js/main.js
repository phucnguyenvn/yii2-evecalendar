$(document).ready(function() {
    var $url = window.location.protocol + "//" + window.location.host + "/";
    //add event month view
    $(document).on('click','.btn-add-event-month',function(){
      //send also date-range of the current view to update view when CRUD events
      var $dstart = $('#calendar').fullCalendar('getView').start.format(); //start date of current view
      var $dend = $('#calendar').fullCalendar('getView').end.format(); //end date of current view
      var $date = $(this).parent('td').attr('data-date');
      $.get($url+'calendar/event/create',{date:$date,dstart:$dstart,dend:$dend},function($data){
        $('#modal').modal('show')
        .find('.modal-body')
        .html($data);
      });
    });

    //add event week/day view
    $(document).on('click','.btn-add-event-week,.btn-add-event-day',function(){
      //send also date-range of the current view to update view when CRUD events
      var $dstart = $('#calendar').fullCalendar('getView').start.format(); //start date of current view
      var $dend = $('#calendar').fullCalendar('getView').end.format(); //end date of current view
      var $date = $(this).parent('th').attr('data-date');
      $.get($url+'calendar/event/create',{date:$date,dstart:$dstart,dend:$dend},function($data){
        $('#modal').modal('show')
        .find('.modal-body')
        .html($data);
      });
    });
});
