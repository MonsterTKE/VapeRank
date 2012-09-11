
<div id="body_wrapper">
	<div class="form_listing_wrapper">
		<div class="form_inner_listing_wrapper">
<?php echo validation_errors(); ?>
<h2><?php echo anchor('links/about', 'Have you read the Submission Rules?', 'title="click me."'); ?></h2>
<?php echo form_open('vendors/submit') ?>


<div class="form_input_wrapper">
<label for="name">Juice Name</label>
<input type="input" name="name" value="<?php echo set_value('name'); ?>" />
</div>

<div class="form_input_wrapper">
	<span>Dont see the vendor that sells your favorite juice? <a href ="<?php echo base_url('listed_vendors/new_vendor');?>" style="color:red;">Click Here</a> to add a vendor.</span>
<label for="vendors">Vendor Name</label>
<?php echo form_dropdown('vendors', $list_form_vendors, set_value('vendors', $dropdown_default));?>
</div>

<div class="form_input_wrapper">
<?php echo form_label('Full description', 'description'); ?>
<?php echo form_textarea(array('name' => 'description', 'cols' => '50', 'rows' => '7', 'value' => set_value('description'))); ?>

</div>

<div class="form_input_wrapper">
<?php
	$form_c = array('1' => 'Tobacco',
					'2' => 'Fruit',
					'3' => 'Sweet',
					'4' => 'Bakery',
					'5' => 'Organic',
					'6' => 'Menthol',
					'7' => 'Coffee',
					'8' => '100% Vg',
					'9' => 'Other/Specialty'
					);
	echo form_label('Category', 'category');
	echo form_dropdown('category',$form_c);
?>
</div>


<div class="form_button"><input type="submit" name="submit" value="Create new listing" /></div>


</form>

</div>
</div>
</div>