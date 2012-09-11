<h1>derp></h1>

<div id="body_wrapper">
	<h1>Submit a juice</h1>
	<div class="form_listing_wrapper">
		<div class="form_inner_listing_wrapper">
<?php echo validation_errors(); ?>

<?php echo form_open(current_url()); ?>

<div class="form_input_wrapper">
<?php 
	$form_d = array('comments' =>'Add a comment?', 'rows' =>'3', 'cols' =>'45');
	echo form_label('Comments', 'comments');
	echo form_textarea($form_d);
?> <br />
</div>

<div class="form_button"><input type="submit" name="submit" value="Create new listing" /></div>


<?php echo form_close()) ?>
		
</div>
</div>
</div>

