var dwonload_url=false;
$(function(){
	$("#download .btn_red").click(function(){
		var content1 = $("#error").html();
		var content2 = $("#invitation").html();
		if($(this).hasClass("disabled")){
			Prompt("dialog",content1,510,240,false);
		}else{
			/*pb({
				id:"downloadDialog",
				width:450,
				height:160,
				title:"免费下载ETshop",
				ok_title:"立即下载",
				content:"<div class='items'><div class='item'><input type='text' name='tel' class='text' placeholder='请输入手机号' autocomplete='off'></div><div class='item'><input type='text' name='captcha' class='text text_2' placeholder='请输入验证码' autocomplete='off'><a href='javascript:void(0);' id='zphone' class='sms-btn'>获取</a></div></div>",
				drag:false,
				cl_cBtn:false,
				onOk:function(){
					
				}
			});*/
			window.location.href="http://runtuer.clouddn.com/runtuer_dsc2.3.1_20170825.zip";
		}
		function Prompt(divid,content,width,height,btn){
			pb({
				id:divid,
				width:width,
				height:height,
				cl_title:"取消",
				ok_title:"确定",
				content:content,
				drag:false,
				foot:true,
				cl_cBtn:btn,
				head:false,
				onOk:function(){
					if(dwonload_url)
					{
						window.location.href=dwonload_url;
					}
				}
			});
		}
	})
})

function check_invitation(invitation)
{
	if(invitation)
	{
		$.ajax({
		   type: "POST",
		   url: "index.php?m=Home&c=Index&a=download",
		   data: "invitation=" + invitation,
		   dataType:'json',
		   success: function(data){
			   if(data.status)
			   {
					dwonload_url=data.download_url;
			   }
			   $("#dialog2").find(".text_error").html(data.content);
			   $("#dialog2").find(".text_error").show();
		   }
		});
	}
}