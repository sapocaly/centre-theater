$(document).ready(function() {
    $(".thumbnail").hover(
        function() {
            $(this).find('.main').hide();
            $(this).find('.alt').show();
        },
        function() {
            $(this).find('.alt').hide();
            $(this).find('.main').show();
        }
    );
});




/*
    Dropdown with Multiple checkbox select with jQuery - May 27, 2013
    (c) 2013 @ElmahdiMahmoud
    license: http://www.opensource.org/licenses/mit-license.php
*/
$(".dropdown dt a").on('click', function() {
    //$(".dropdown dd ul").slideToggle('fast');
    //$(this).parentElement.parentElement.style.display = 'None';
    $(this).parent().parent().find('dd').find('ul').slideToggle('fast');
    //window.alert(x);
});






