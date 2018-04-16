function copyToClipboard(ctl) {
		ctl.focus();
		ctl.select();
		var txt = ctl.val();
	
		if(window.clipboardData) {
			window.clipboardData.clearData();
			window.clipboardData.setData("Text", txt);
		} else if(navigator.userAgent.indexOf("Opera") != -1) {
			window.location = txt;
		} else if(window.netscape) {
			try {
				netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
			} catch(e) {
				/*alert("input 'about:config' in address box and setup 'signed.applets.codebase_principal_support' to 'true'"); */
				alert($('#js_copy_error').text());
				return;
			}
			var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
			if(!clip)
				return;
			var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
			if(!trans)
				return;
			trans.addDataFlavor('text/unicode');
			var str = new Object();
			var len = new Object();
			var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
			var copytext = txt;
			str.data = copytext;
			trans.setTransferData("text/unicode", str, copytext.length * 2);
			var clipid = Components.interfaces.nsIClipboard;
			if(!clip)
				return false;
			clip.setData(trans, null, clipid.kGlobalClipboard);
		}
		layer.msg($('#js_copy_success').text());
	}
if (navigator.appName != 'Microsoft Internet Explorer'){
ZeroClipboard.setMoviePath('/static/ZeroClipboard/ZeroClipboard.swf');
$('.copytxtlink').each(function(){
      var linksrc = this.getAttribute('linksrc');
      var linkid = this.getAttribute('linkid');
      var clip = new ZeroClipboard.Client();
      clip.setHandCursor(true);
      clip.setText($('#'+linksrc).val());
      clip.glue(this, linkid);

      clip.addEventListener('complete', function (client, text) {
         layer.msg($('#js_copy_success').text())
      });
      
});
}
