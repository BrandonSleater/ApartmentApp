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
        
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        
        return false;
    });

    $(function() {
        $('.flexslider').flexslider();
    });
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
            $('#reslt').show();
            $('html, body').animate({ scrollTop: $('#reslt').offset().top }, 500);
            $('#search-results').html(data);
        },
        error: function() {}
    });
    
    e.preventDefault();
});


/**
 * Handle our search requests
 */
$("#create-form").submit(function(e) {
    
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    
    $.ajax({
        url : formURL,
        type: "POST",
        data : postData,
        success: function(data) {
            $("#create-form").removeClass("col-md-offset-3");
            $('#new-apt').html(data);
            $('#create-form')[0].reset();
        },
        error: function() {}
    });
    
    e.preventDefault();
});

$("#create-apt").click(function() {
    $('#create-result').style.display = "block";
});
