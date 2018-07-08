<div class="buttons">
  <div class="pull-right">
    <a href="<?php echo $button_continue_action; ?>" class="btn btn-outline"><?php echo $button_continue; ?></a>
  </div>
</div>

<!--form method="post" action="<?php echo $action; ?>/pay?mid=<?php echo $merchantId; ?>&time=<?php echo $time; ?>&hash=<?php echo $hash; ?>">
    <input type="hidden" name="data[merchant_referenceCode]" value="<?php echo $merchant_referenceCode; ?>" />
    <input type="hidden" name="data[merchant_invoiceId]" value="<?php echo $merchant_invoiceId; ?>" />
    <input type="hidden" name="data[purchaseTotals_grandTotalAmount]" value="<?php echo $purchaseTotals_grandTotalAmount; ?>" />
    <input type="hidden" name="data[purchaseTotals_currency]" value="<?php echo $purchaseTotals_currency; ?>" />

    <?php foreach($billTo AS $key => $val){ ?>
    <input type="hidden" name="data[billTo][<?php echo $key; ?>]" value="<?php echo $val; ?>" />
    <?php } ?>

    <?php foreach($shipTo AS $key => $val){ ?>
    <input type="hidden" name="data[shipTo][<?php echo $key; ?>]" value="<?php echo $val; ?>" />
    <?php } ?>

    <?php foreach($item AS $key => $val){ ?>
    <?php foreach($val AS $k => $v){ ?>
    <input type="hidden" name="data[item][<?php echo $key; ?>][<?php echo $k; ?>]" value="<?php echo $v; ?>" />
    <?php } ?>
    <?php } ?>


    <div class="buttons">
        <div class="pull-right">
            <input type="button" onclick="submit()" value="<?php echo $button_confirm; ?>" id="button-confirm" class="btn btn-primary" data-loading-text="<?php echo $text_loading; ?>" />
        </div>
    </div>

</form-->

