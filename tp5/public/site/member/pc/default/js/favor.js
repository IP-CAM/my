/**
 * Created by admin on 2017/7/14.
 * To do.
 * Description : 收藏商品与浏览记录商品
 */

$(".btn-off").click(function() {
    $.ajax({
         type: "POST",
         url: $(this).attr('data-url'),
         data: {},
         dataType: "json",
         success: function(res){
             if(res.code){
                 location.reload();
             }
            console.log(res);return false;
         }
     });
});

// 清空用户浏览足迹
$('.empty').click(function() {
    var url = $(this).data('url');
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data.code) {
                window.location.reload();
            } else {
                layer.msg(data.msg, {
                    skin: 'layer-ext-blue',
                    icon: 0,
                    time: 2000,
                    shade: 0.3
                }, function () {
                    window.location.href = data.url;
                });

            }
        }
    });
});