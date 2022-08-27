import './bootstrap';


$(document).ready(function(){
    $(document).on('click','#send_message',function(e){
        e.preventDefault();
        let username = $('#username').val();
        let message = $('#message').val();
        alert(username+message);
    })
})
