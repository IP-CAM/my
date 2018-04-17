var _W = document.documentElement.clientWidth || document.body.clientWidth,
    $html = document.getElementsByTagName('html')[0];
_W = _W > 750 ? 750 : _W;
$html.style.fontSize = _W/7.5+'px';
document.attachEvent ? document.attachEvent('onreadystatechange') : document.onreadystatechange = function(){
    if(document.readyState == 'complete'){
    	document.querySelector('#load').style.display = 'none';
    }
}