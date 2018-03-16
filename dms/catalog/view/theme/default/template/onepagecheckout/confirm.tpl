<div class="extrow">
	<div class="extsm-12 margintb">
		<textarea name="comment" class="form-control" placeholder="Add Comment"><?php echo $comment; ?></textarea>
	</div>
	
	<div class="extsm-12">
		<?php if ($agree) { ?>
		<input type="checkbox" name="agree" value="1" checked="checked" />
		<?php } else { ?>
		<input type="checkbox" name="agree" value="1" />
		<?php } ?>
		<?php echo $text_agree; ?>
	</div>
	
	<div class="extsm-6">
		<?php if($button_type != 'confirm') { ?>
		<div class="buttons">
			<div class="pull-left">
				<a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_shopping; ?></a>
			</div>
		</div>
		<?php } ?>
	</div>
	
	<div class="extsm-6 text-right">
		<?php if($button_type == 'register') { ?>
		<?php if (empty($redirect)) { ?>
		<div class="buttons">
			<div class="">
				<button class="btn btn-primary" rel="register" id="button-register"><?php echo $button_checkout_order; ?></button>
			</div>
		</div>
		<?php } ?>
		
		<?php } else if($button_type == 'guest') { ?>
		<?php if (empty($redirect)) { ?>
		<div class="buttons">
			<div class="">
				<button class="btn btn-primary" rel="guest" id="button-guest"><?php echo $button_checkout_order; ?></button>
			</div>
		</div>
		<?php } ?>
		
		
		<?php } else if($button_type == 'login') { ?>
		<?php if (empty($redirect)) { ?>
		<div class="buttons">
			<div class="">
				<button class="btn btn-primary button-login" rel="login" id="button-checkout-order"><?php echo $button_checkout_order; ?></button>
			</div>
		</div>
		<?php } ?>
			
			
		<?php } else if($button_type == 'logged'){ ?>
		<?php if (empty($redirect)) { ?>
		<div class="buttons">
			<div class="">
				<button class="btn btn-primary" rel="loggedorder" id="button-loggedorder"><?php echo $button_checkout_order; ?></button>
			</div>
		</div>
		<?php } ?>
		<?php } else if($button_type == 'confirm') { ?>
		<?php if (empty($redirect)) { ?>
		
			<?php echo $payment; ?>
			<script type="text/javascript"><!--
				<?php if($button_type == 'confirm') { ?>
					<?php if($autotrigger){ ?>
					$('#button-confirm').trigger('click');
					<?php } ?>
				<?php } ?>
			//--></script>
		<?php } ?>
		
		<?php } ?>
	</div>
	
</div>