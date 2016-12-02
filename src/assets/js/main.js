$(document).ready(function() {
    var $url = window.location.protocol + "//" + window.location.host + "/";
    $(document).on('click','.fc-day-top',function(){
      var $date = $(this).attr('data-date');
      $.get($url+'calendar/event/create',{'date':$date},function($data){
        $('#modal').modal('show')
        .find('.modal-body')
        .html($data);
      });
    });
    $(document).on('click','.modal-cancel',function(){
        $('#modal').modal('hide');
        $.get($url+'calendar/event/success',function($data){
          $.each($data,function(key,value){
            {
                $('#calendar').fullCalendar('renderEvent',value,true);
            }
          });
        });
    });

});
