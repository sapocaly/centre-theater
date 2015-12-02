/**
 * Created by Sapocaly on 12/1/15.
 */
$('.thumbnail').on({
    'click': function(){
        $('#current_photo').attr('src',$(this).attr("src"));
    }
});