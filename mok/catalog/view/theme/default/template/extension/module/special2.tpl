<?php if($specials) { ?>
<div class="ok_cs_box">
	<?php foreach($specials as $special) { ?>
    <div class="ok_spec_item">
		<?php if($special['href']) { ?>
        <a href="<?php echo $special['href']; ?>">
			<?php if($special['alt'] && $special['src']) { ?>
            <img class="lazy" data-original="<?php echo $special['src']; ?>" src="catalog/view/theme/default/images/public/lazy.png" width="100%"/>
            <p class="ok_spec_info"><?php echo $special['alt']; ?></p>
			<?php } ?>
			<?php if($special['alt']) { ?>
            <p class="ok_spec_price"><?php echo $special['alt2']; ?></p>
			<?php } ?>
        </a>
		<?php } ?>
    </div>
	<?php } ?>
</div>
<?php } ?>