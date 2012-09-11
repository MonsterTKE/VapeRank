<div id="body_wrapper">
	<div class="form_listing_wrapper">
		<div class="form_inner_listing_wrapper">
	<?php 
		if(isset($status)):
			echo $status;
		else: 
	?>
	<?php echo form_open('contact/index', array('id' => 'contact_form', 'class' => 'form label-inline uniform')); ?>
	<h2>Contact Information</h2>
	<div class="form_input_wrapper">
		<label for="user_name">Your Name </label> 
			<?php echo form_input(array('name' => 'user_name', 'id' => 'user_name', 'class' => 'medium', 'size' => '50', 'maxlength' => '60', 'value' => set_value('user_name'))); ?>
			<?php echo form_error('user_name', '<p class="input_error">', '</p>'); ?>
	</div>
	
	<div class="form_input_wrapper">
		<label for="user_email">Your Email Address </label> 
			<?php echo form_input(array('name' => 'user_email', 'id' => 'user_email', 'class' => 'medium', 'size' => '50', 'maxlength' => '60', 'value' => set_value('user_email'))); ?>
			<?php echo form_error('user_email', '<p class="input_error">', '</p>'); ?>
	</div>
	
	<div class="form_input_wrapper">
		<label for="message">Your Message</label> 
		<?php echo form_textarea(array('name' => 'message', 'id' => 'message', 'cols' => '50', 'rows' => '7', 'value' => set_value('message'))); ?>
		<?php echo form_error('message', '<span class="error_message">', '</span>'); ?>
		<p class="field_help">[ limit <span id="message_char_limit">1000</span> characters incl. spaces ]</p>
	</div>
	
		<p>As much as we appreciate the offers for cheap viagra and herbal supplements to regrow our hair, please fill out the reCaptcha, thanks.</p>
	<div class="form_input_wrapper">
		<?php echo form_error('recaptcha_response_field', '<p class="input_error">', '</p>'); ?>
		<?php echo $recaptcha; ?>
	</div>
							
	<br />
	<div class="form_button">
		<?php echo form_submit(array('name' => 'submit_contact_input', 'id' => 'submit_contact_input', 'class' => 'btn btn-black'), 'Submit'); ?>
	</div>
	
	<?php echo form_close(); ?>
		<?php endif; ?>
	
		</div>
	</div>
</div>
