<div id="body_wrapper">
	<div class="form_listing_wrapper">
		<div class="form_inner_listing_wrapper">

<h2><?php echo anchor('contact', 'Vendors, do you see an inaccuracy?', 'title="click me."'); ?></h2>

<?php echo "<br />"; echo validation_errors();?>
<br/>

<?php echo form_open_multipart('listed_vendors/new_vendor') ?>


<div class="form_input_wrapper">
<label for="vendor_name">Vendor Name</label>
<input type="input" name="vendor_name" value="<?php echo set_value('vendor_name'); ?>" /> 
</div>

<div class="form_input_wrapper">
<label for="url_link">Link to Vendor's page.</label>
<input type="input" name="url_link" value="<?php echo set_value('url_link');?>" />
</div>

<div class="form_input_wrapper">
<?php echo form_label('Vendors tagline', 'tagline'); ?>
<span style="color:red;font-size:8pt";>This will be displayed on the main vendors list</span>
<?php echo form_input(array('name' => 'tagline', 'size' => '50', 'value' => set_value('tagline'))); ?>
</div>

<div class="form_input_wrapper">
<?php echo form_label('Vendor Body', 'allowed_body'); ?>
<span style="color:red;font-size:8pt";>Vendors, verify your username to gain access to the advanced editor for this section. <a style="color:blue;" href="contact">click here</a></span>
<?php echo form_textarea(array('name' => 'allowed_body', 'id' => 'content', 'cols' => '50', 'rows' => '7', 'value' => set_value('tagline'))); ?>
</div>

<div class="form_input_wrapper">
	<label for="userfile">Upload your vendors logo.</label>
	<span style="color:red;font-size:8pt";>150 x 150px, gif, jpg and png only.</span>
<input type="file" name="userfile" size="20" />
<hr/>
	<label for="image_url_link">or provide the full URL path to your vendors logo.</label>
<input type="input" name="image_url_link" value="<?php echo set_value('image_url_link');?>"/>
</div>

<div class="form_button"><input type="submit" name="submit" value="Create new vendor" /></div>


</form>

</div>
</div>
</div>