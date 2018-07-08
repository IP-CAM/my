<img src="catalog/view/theme/megashop/image/loading.gif" /> <?php echo $text_wait; ?>
<form method="post" name="E_FORM" action="https://Pay3.chinabank.com.cn/PayGate?encoding=UTF-8">
	<input type="hidden" name="v_mid"         value="<?php echo $mid;?>">
	<input type="hidden" name="v_oid"         value="<?php echo $oid;?>">
	<input type="hidden" name="v_amount"      value="<?php echo $amount;?>">
	<input type="hidden" name="v_moneytype"   value="CNY">
	<input type="hidden" name="v_url"         value="<?php echo $return_url;?>">
	<input type="hidden" name="v_md5info"     value="<?php echo $md5info;?>">
 
 <!--以下几项项为网上支付完成后，随支付反馈信息一同传给信息接收页 -->	
	
	<input type="hidden" name="remark1"       value="<?php echo $order_id;?>">
	<input type="hidden" name="remark2"       value="<?php echo $notify_url;?>">

</form>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
<script type="text/javascript"><!--
	$('form').submit();
//--></script>