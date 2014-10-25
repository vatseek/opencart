<?php echo $header; ?>
<div id="content">
	<div class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
		<?php } ?>
	</div>
	<div class="box">
		<div class="heading">
			<h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
			<div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
		</div>
		<div class="content">
		  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
			<table class="form">
			  <tr>
				<td colspan="2"><?php echo $text_description; ?></td>
			  </tr>
			  <tr>
				<td><?php echo $entry_status; ?></td>
				<td><select name="buypack_status">
					<?php if ($buypack_status) { ?>
					<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
					<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
					<option value="1"><?php echo $text_enabled; ?></option>
					<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
					<?php } ?>
				  </select></td>
			  </tr>
			</table>
		  </form>
		</div>		
	</div>
</div>
<?php echo $footer; ?>