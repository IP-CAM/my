$(function(){
    var $resume = {
        init: function () {
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize', _W / 7.5 + 'px');
            this.surePassword();
        },
        //选择日期
        surePassword:function () {
            var _text = '*';
            $('.ok_input').change(function(e){
               var $this = $(this),
                   _str1 = '',
                   _str2 = '',
                   $siblings = $this.siblings('input[type="hidden"]');
            });
        }
    };
    $resume.init();
});
