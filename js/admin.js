$(document).ready(function(){

    $('a#submit_button').click(function(){
        $('#my_form').submit();
    });


    if($('#side_bar').length == 0)
    {
        $('#records').css('width','100%');
    }
    $('.delete').click(function(event){
        if(!confirm("Are you sure you want to delete it?"))
        {
            event.preventDefault();
        }
    });

    function getDateTime()
    {
        var currentdate = new Date();
        var datetime =  currentdate.getFullYear() + "/" + prependZero((currentdate.getMonth()+1)) + "/" + prependZero(currentdate.getDate()) + " " +
            prependZero(currentdate.getHours()) + ":" + prependZero(currentdate.getMinutes()) + ":" + prependZero(currentdate.getSeconds());
        return datetime;
    }

    function prependZero(x)
    {
        if(x<10)
        {
            return "0" + x;
        }
        else
        {
            return x;
        }
    }
});
 