$(document).ready(function() {
    var $url = window.location.protocol + "//" + window.location.host + "/";
    $(document).on('click','.btn-add-event',function(){
      var $date = $(this).parent('td').attr('data-date');
      $.get($url+'calendar/event/create',{'date':$date},function($data){
        $('#modal').modal('show')
        .find('.modal-body')
        .html($data);
      });
    });
    //cancel button
    $(document).on('click','.modal-cancel',function(){
        $('#modal').modal('hide');
    });
    //add event button
    $(document).on('click','button',function(){
      $('.btn-add-event').remove();
      $('.fc-day-top').append("<div class='btn-add-event'></div>");
    });
});
