<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<link href="view/javascript/bootstrap/css/bootstrap.css" rel="stylesheet" media="all" />
<script type="text/javascript" src="view/javascript/bootstrap/js/bootstrap.min.js"></script>
<link href="view/javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<link type="text/css" href="view/stylesheet/stylesheet.css" rel="stylesheet" media="all" />
<style type="text/css">
<!--
.style1 {
	font-size: x-large;
	font-weight: bold;
}
.style2 {font-size: x-large}
.style4 {font-size: xx-large; font-weight: bold; color: #0000FF; }
.style6 {font-size: xx-large; color: #0000FF; }
-->
</style>
</head>
<body>
<div class="container">
  <?php foreach ($orders as $order) { ?>
  <div style="page-break-after: always;">
    <h1><?php echo $text_picklist; ?> #<?php echo $order['order_id']; ?></h1>
    <table style="width:100%; margin-bottom:15px; font-size:16px;">
        <tr>
          <td>
		  	<b><?php echo $text_date_added; ?></b> <?php echo $order['date_added']; ?>
            <?php if ($order['invoice_no']) { ?>
            <b><?php echo $text_invoice_no; ?></b> <?php echo $order['invoice_no']; ?>
            <?php } ?>
            <b><?php echo $text_order_id; ?></b> <?php echo $order['order_id']; ?>
			<b><?php echo $text_shipping_method; ?></b><?php echo $order['shipping_method']; ?></td>
		  </td>
        </tr>
	</table>
  
    <table class="table table-bordered" style="font-size:16px;">
      <thead>
        <tr>
          <td><b><?php echo $column_location; ?></b></td>
          <td><?php echo $column_model; ?></td>
          <td class="text-right"><?php echo $column_quantity; ?></td>
          <!--<td><b><?php echo $column_reference; ?></b></td>-->
          <td><b><?php echo $column_image; ?></b></td>
          <td><b><?php echo $column_product; ?></b></td>
          <!--<td><b><?php echo $column_weight; ?></b></td>-->
        </tr>
      </thead>
      <tbody>
        <?php foreach ($order['product'] as $product) { ?>
        <tr>
          <td><?php echo $product['location']; ?></td>
          <td><?php echo $product['model']; ?></td>
          <td class="text-right"><span class="style6"><?php echo $product['quantity']; ?></span></td>
          <!--<td><?php if ($product['sku']) { ?>
            <?php echo $text_sku; ?> <?php echo $product['sku']; ?><br />
            <?php } ?>
            <?php if ($product['upc']) { ?>
            <?php echo $text_upc; ?> <?php echo $product['upc']; ?><br />
            <?php } ?>
            <?php if ($product['ean']) { ?>
            <?php echo $text_ean; ?> <?php echo $product['ean']; ?><br />
            <?php } ?>
            <?php if ($product['jan']) { ?>
            <?php echo $text_jan; ?> <?php echo $product['jan']; ?><br />
            <?php } ?>
            <?php if ($product['isbn']) { ?>
            <?php echo $text_isbn; ?> <?php echo $product['isbn']; ?><br />
            <?php } ?>
            <?php if ($product['mpn']) { ?>
            <?php echo $text_mpn; ?><?php echo $product['mpn']; ?><br />
            <?php } ?></td>-->
          <td><img src="<?php echo $product['image']; ?>" width="80" height="auto" /></td>
          <td><?php echo $product['name']; ?>
            <?php foreach ($product['option'] as $option) { ?>
            <br />
            &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
            <?php } ?></td>
          <!--<td><?php echo $product['weight']; ?></td>-->
        </tr>
        <?php } ?>
      </tbody>
    </table>
     <table class="table table-bordered" style="font-size:16px;">
      <thead>
        <tr>
          <td style="width: 50%;"><b><?php echo $column_comment; ?></b></td>
          <td style="width: 50%;"><b><?php echo $text_shipping; ?></b></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
		  	<?php if (in_array($order['order_status_id'], $config_print_shipping)) { ?>
		  	<b><?php echo $order['payment_method']; ?>: <font style="color:#FF3366; text-decoration:underline;"><?php echo $order['total']; ?></font></b>
			<br /><br />
			<?php } ?>
			<?php echo $order['comment']; ?></td>
          <td><b><?php echo $text_telephone; ?></b> <?php echo $order['telephone']; ?><br />
			<?php echo $order['shipping_address']; ?></td>
        </tr>
      </tbody>
    </table>
	<?php if ($order['comment_hide']) { ?>
    <table class="table table-bordered" style="font-size:16px;">
		<tr>
		<td style="color:#F00; font-weight:bold; font-size:14px;"><?php echo $order['comment_hide']; ?></td>
        </tr>
    </table>
	<?php } ?>
  </div>
     <?php } ?>
</div>
</body>
</html>