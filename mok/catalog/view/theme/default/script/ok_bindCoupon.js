$(function(){
    $('.weui-search-bar__cancel-btn').click(function(){
       var num = $("#searchInput").val();
        $.ajax({
            url : "http://mok.localweb.com/index.php?route=account/coupon/getCoupon",
            dataType: "json",
            data : {
                'couponId' : num
            },
            type : "POST",
            success : function (msg) {
                alert(msg);
            },
            error : function(msg){
                alert(msg);
            }
        });
    });
})