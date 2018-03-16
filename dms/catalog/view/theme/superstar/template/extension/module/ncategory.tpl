<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
	
	<div class="box-content">
		<div class="box-information">
			<ul>
   
				<li> <a href="<?php echo $headlines; ?>"><?php echo $button_headlines; ?></a></li>
				<?php if ($ncategories) { ?>
					<?php foreach ($ncategories as $ncategory) { ?>
					  <?php if ($ncategory['ncategory_id'] == $ncategory_id) { ?>
					  <li><a href="<?php echo $ncategory['href']; ?>"><?php echo $ncategory['name']; ?></a></li>
					  <?php if ($ncategory['children']) { ?>
						<?php foreach ($ncategory['children'] as $child) { ?>
						  <?php if ($child['ncategory_id'] == $child_id) { ?>
						  <li><a href="<?php echo $child['href']; ?>"> - <?php echo $child['name']; ?></a></li>
						  <?php } else { ?>
						  <li><a href="<?php echo $child['href']; ?>"> - <?php echo $child['name']; ?></a></li>
						  <?php } ?>
						<?php } ?>
					  <?php } ?>
					  <?php } else { ?>
					  <li><a href="<?php echo $ncategory['href']; ?>"><?php echo $ncategory['name']; ?></a></li>
					  <?php } ?>
					  
					  <?php } ?>
					<?php } ?>	
			</ul>
		</div>
    </div>		
</div>	
	