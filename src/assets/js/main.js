$(document).ready(function() {
    $(document).on('click','.fc-day',function(){
      var date = $(this).attr('data-date');
      $.get('/event/create',{'date':date},function(data){
        $('#modal').modal('show')
        .find('.modal-body')
        .html(data);
      });
    });
});
