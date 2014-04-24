/**
 * Scrolling back to the top of the page
 */
$(document).ready(function(){
    
    $(window).scroll(function () {
        
        if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    
    $('#back-to-top').click(function () {
        
        $('#back-to-top').tooltip('hide');
        
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        
        return false;
    });

    $('#back-to-top').tooltip('show');
});


/**
 * Handle our search requests
 */
$("#apt-search").submit(function(e) {
    
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    
    $.ajax({
        url : formURL,
        type: "POST",
        data : postData,
        success: function(data) {
            $('#container').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {}
    });
    
    e.preventDefault();
});