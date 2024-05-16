$( document ).ready(function() {
    if( $('.message_container').length ) {
        $('.message_container').addClass("show_msg");
        setTimeout(() => {
            $('.message_container').removeClass("show_msg");
        }, 5000);
    }
});