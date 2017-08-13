/**
 * Created by Administrator on 2017/8/13.
 */
$(function(){
    $('#get_telcode').click(function(){
        //启用输入框
        $('#tel_code').prop('disabled', false);
        var time = 60;
        var html = '获取验证码';
        var interval = setInterval(function () {
            time--;
            if (time <= 0) {
                clearInterval(interval);
                html = '获取验证码';

                $('#tel_code').prop('disabled', false);
            } else {
                html = time + ' 秒后再次获取';
                $('#tel_code').prop('disabled', true);
            }
            $('#get_telcode').val(html);
        }, 1000);
    });
    //当点击获取验证码按钮的时候,弹出layer层,禁用按钮,60秒钟后启用按钮
    $('.captcha').click(function(){
        $(this).attr('src','/index.php?r=site/captcha&refresh='+new Date().getTime());
    });
    function send_sms(){

    }

});
