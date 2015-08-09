$( document ).ready(function() {


    $('#tender-agreement').on('change', function() {
        if($(this).prop('checked'))
        {
            $('#tender-cost, #tender-priceby').prop('disabled', true);
        }else{

            $('#tender-cost, #tender-priceby').prop('disabled', false);
        }
    });



//Modal update user profile
    $(function(){
        $('#modelButton').click(function(){
            $('#modal').modal('show')
                .find('#modelContent')
                .load($(this).attr('value'));
        });
    });









});