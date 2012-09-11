<?php $this->load->helper('form');?>

<h1><?php echo $ajax_message?></h1>

<?php if($switch_var == 1): ?>
<p>Feel free to leave a comment. </p>

<?php echo form_open('rating/comment'); ?>
<?php echo form_hidden('juice_id', $v_id); ?>

	<div class="form_input_wrapper">
<?php 
	$form_d = array('name' =>'comments', 'rows' =>'3', 'cols' =>'45');
	echo form_textarea($form_d);
?> <br />
</div>

<div class="form_button"><input type="submit" name="submit" value="Submit comment" /></div>
</form>

<?php endif; ?>
