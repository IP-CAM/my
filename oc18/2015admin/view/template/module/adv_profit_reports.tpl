<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title_main; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
	<?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>  
	<?php } ?>   
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>    
      <div class="panel-body">
          <ul class="nav nav-tabs">
          <li class="active"><a id="about" href="#tab-about" data-toggle="tab"><?php echo $tab_about; ?></a></li>
      	  </ul>     
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
     		<div id="adv_sale_profit"></div>
     		<div id="adv_product_profit"></div>
     		<div id="adv_customer_profit"></div>
     		<div id="adv_inventory_stock_value"></div>
			<div align="center"><img src="view/image/adv_reports/adv_logo.jpg" /></div>
			</div>
          </div>
	  </div>
    </div>
  </div>
</div> 
<?php if ($adv_sop_ext_version && $adv_sop_version && $adv_sop_version['version'] != $adv_sop_current_version) { ?>  
<script type="text/javascript"><!--
$('#about').append('&nbsp;<i class=\"fa fa-exclamation-circle\"></i>'); 
$('#about').css({'background-color': '#FFD1D1','border': '1px solid #F8ACAC','color': 'red','text-decoration': 'blink'});
//--></script> 
<?php } elseif ($adv_ppp_ext_version && $adv_ppp_version && $adv_ppp_version['version'] != $adv_ppp_current_version) { ?>  
<script type="text/javascript"><!--
$('#about').append('&nbsp;<i class=\"fa fa-exclamation-circle\"></i>'); 
$('#about').css({'background-color': '#FFD1D1','border': '1px solid #F8ACAC','color': 'red','text-decoration': 'blink'});
//--></script> 
<?php } elseif ($adv_cop_ext_version && $adv_cop_version && $adv_cop_version['version'] != $adv_cop_current_version) { ?>  
<script type="text/javascript"><!--
$('#about').append('&nbsp;<i class=\"fa fa-exclamation-circle\"></i>'); 
$('#about').css({'background-color': '#FFD1D1','border': '1px solid #F8ACAC','color': 'red','text-decoration': 'blink'});
//--></script> 
<?php } elseif ($adv_invsv_ext_version && $adv_invsv_version && $adv_invsv_version['version'] != $adv_invsv_current_version) { ?>  
<script type="text/javascript"><!--
$('#about').append('&nbsp;<i class=\"fa fa-exclamation-circle\"></i>'); 
$('#about').css({'background-color': '#FFD1D1','border': '1px solid #F8ACAC','color': 'red','text-decoration': 'blink'});
//--></script> 
<?php } ?>
<?php echo $footer; ?>