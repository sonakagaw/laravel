/*global $*/
$(function(){

    $('.kensaku').click(function(){
        $('.kensaku2').toggleClass('open');
        $(this).toggleClass('on');
    });

    $('.kakikomi').click(function(){
        $('.kakikomi2').toggleClass('open');
        $(this).toggleClass('on');
    });

    $('.sakujo').click(function(){
        $('.sakujo2').toggleClass('open');
        $(this).toggleClass('on');
    });     

    $('.passHyoji').change(function() {
        if ( $(this).prop('checked') ) {
            $('.passWord').attr('type','text');
        } else {
            $('.passWord').attr('type','password');
        }
    });

    ktgrChange();
});

function ktgrChange(){
    $(function() {
      var $children = $('.children');
      var original = $children.html();
    
      $('.parent').change(function() {
        var val1 = $(this).val();
    
        $children.html(original).find('option').each(function() {
          var val2 = $(this).data('val');
          if (val1 != val2) {
            $(this).not('.msg').remove();
          }
        });
    
        if ($(this).val() === '') {
          $children.attr('disabled', 'disabled');
        } else {
          $children.removeAttr('disabled');
        }
    
      });
    });
}