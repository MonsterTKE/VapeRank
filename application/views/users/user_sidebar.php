<?php if($sidebar_count):?>
<script type="text/javascript"> //Click to copy.
function SelectAll(id)
{
    document.getElementById(id).focus();
    document.getElementById(id).select();
}
</script>
<div class="span4">
	<h1>Your Banners</h1>
	<?php foreach($sidebar as $row):?>
        <div class="row-fluid">
        	<div class="span12">
        		<a href="<?php echo base_url();?>banner/show_banner/<?php echo $row->b_user_id;?>/<?php echo $row->b_juice_id;?>" title="Thumbnail" target="_blank"><img src="<?=base_url();?>banner/show_banner/<?php echo $row->b_user_id;?>/<?php echo $row->b_juice_id;?>" alt="Thumbnail" height="50" width="350"/></a>
        	<span>These images will update 4 times daily.</span><form><input type="button" value="delete banner" onClick="location.href='<?php echo base_url("banner/delete_banner/{$row->b_user_id}/{$row->b_juice_id}") ?>'"></form><br /><br />
        	<label>BBCode - Click into text-box, right click, copy and paste onto your favorite forum.</label>
        	<textarea rows="6" id="txtarea_<?php echo $row->b_juice_id;?>" readonly="readonly" onClick="SelectAll('txtarea_<?php echo $row->b_juice_id;?>');" style="width:350px" >[url=<?=base_url();?>vendors/individual/<?php echo $row->b_juice_id;?>][img]<?=base_url();?>banner/show_banner/<?php echo $row->b_user_id;?>/<?php echo $row->b_juice_id;?>[/img][/url]</textarea>
        	<label>HTML - Click into text-box, right click, copy and paste onto your favorite forum.</label>
        	<textarea rows="6" id="txtarea2_<?php echo $row->b_juice_id;?>" readonly="readonly" onClick="SelectAll('txtarea2_<?php echo $row->b_juice_id;?>');" style="width:350px" ><a href="<?=base_url();?>vendors/individual/<?php echo $row->b_juice_id;?>" target="_blank"><img src="<?=base_url();?>banner/show_banner/<?php echo $row->b_user_id;?>/<?php echo $row->b_juice_id;?>" border="0"/></a></textarea></div></div>
<?php endforeach;?>


<?php else: ?>
<div class="span4">
	<h1>Your Banners</h1>
		<div class="user_sidebar_blocks">
        	<h3>It seems that you dont have any banners yet. <br /> Click on your favorite juices "Make new banner" link to make up to 3.</h3>
        </div>
    </div>

<?php endif;?>