<div class="container-fluid elementBackground">
	<div class="row-fluid">
		<div class="span4"></div>
		<div class="span8">
<?php echo validation_errors(); ?>
<?php $att = array('class' => 'form-vertical',); echo form_open("user/edit_submission/{$v_id}", $att) ?>




<div class="control-group">
<label class="control-label" for="vendor_name">Juice name</label>
<input type="input" name="vendor_name" value="<?php echo set_value('vendor_name', $v_j_name); ?>" />
</div>


<div class="control-group">
<?php $l_att = array('class' => 'control-label'); echo form_label('Full description', 'description'); ?>
<?php echo form_textarea(array('name' => 'description', 'class' => 'input-xlarge', 'rows' => '7', 'value' => set_value('description', $v_desc))); ?>

</div>

<div class="control-group">
<?php
	$form_c = array('Tobacco' => 'Tobacco',
					'Fruit' => 'Fruit',
					'Sweet' => 'Sweet',
					'Bakery' => 'Bakery',
					'Organic' => 'Organic',
					'Menthol' => 'Menthol',
					'Coffee' => 'Coffee',
					'100% Vg' => '100% Vg',
					'Other/Specialty' => 'Other/Specialty'
					);
	echo form_label('Category', 'category', $l_att);
	echo form_dropdown('category',$form_c, set_value('category', $v_category));
?>
</div>


<div class="form_button"><input type="submit" name="submit" value="Edit listing" /></div>


</form>

</div>
</div>
</div>