/*!
 * OKHQB mobile site auth script
 * require [ zepto.js ]
 */

(function( w ){
	var M_auth = {
		launch: function(){
			this.authenticate();
		},
		authenticate: function(){
			var $_this = this;
				$.ajax({
					url: 'http://login.okhqb.com/member/getLoginInfo.json',
					type: 'GET',
					dataType: 'jsonp',
					jsonpCallback: 'mobileGetAuthInfo',
					success: function( result ){
						if( result.code == 200 ){
							var result_data = $.parseJSON( result.data );
							if( result_data.logined != 0 ){
								$_this.render_sign_in_status_element( result_data );
								console.log(1);
							}
						}
					}
				});
		},
		render_sign_in_status_element: function( auth_info ){
			function prune_nick( str ){
				if( str.length > 6 ){
					str = str.substring( 0, 6 ) + '...';
				}
				return str;
			}
			var sign_pannel = $('.ok_footer_tool'),
			    nick_name = prune_nick( auth_info.nickname );
			sign_pannel.find('#username').html(nick_name).attr('href','http://m.okhqb.com/my/member.html');
			sign_pannel.find('#signout').html('退出').attr('href','http://m.okhqb.com/member/logout.html');
			$('.ok_login').attr('href','http://m.okhqb.com/my/member.html');
		}
	};
	w.M_auth = M_auth;
})( window );
$(document).ready(function(){ M_auth.launch(); });

