<script type="text/javascript">
function submit()
{
document.forms["vendor_dropdown"].submit();
}
</script>


<?php $attributes = array('id' => 'vendor_dropdown', 'value' => $post_data, 'label' => 'derp'); echo form_open(current_url(), $attributes);?>

<?php $js = 'onchange = "submit();"'; echo form_dropdown('vendors', $result, 'Sort by vendor', $js);?>

<?php echo form_close();?>


<?php if(isset($post_data))
{
	echo $post_data;
}
else
{
	echo 'derp';
}
?>