<div id="container-fluid">
	<div class="row-fluid">
		<div class="span1"></div>
		<div class="span8">
<br/>
<?php
$hidden = array('delete' => 1);
$att = array('class' => 'form-vertical');
echo form_open(current_url(), '', $hidden) ?>


<img src="<?php echo base_url("banner/show_banner/{$form_user_id}/{$form_juice_id}");?>" />
</div>
</div>

	<div class="row-fluid">
		<div class="span1"></div>
		<div class="span8">
<input class="btn btn-danger" type="submit" name="submit" value="Delete this banner" />
</div>
</div>

</form>
</div>
<hr/>