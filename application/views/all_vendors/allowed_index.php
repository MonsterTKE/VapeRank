<div class="container-fluid">
	<div class="row-fluid">
<div class="span1"></div>
<div class="span5">
<?php foreach($allowed_vendors as $row):?>
<div class="row-fluid">
	<div class="span12">
<div class="thumbnail">
		<div><h2><a href="<?php echo base_url("listed_vendors/individual_vendor/{$row->allowed_id}"); ?>" title="View all of <?php echo $row->allowed_name;?>'s juices."><?php echo $row->allowed_name;?></a></h2></div>
<br/>
				<div class ="vendor_allowed_image"><img src="<?php echo $row->allowed_image_url;?>" height="150" width="150"/></div>
						<?php $c = $this->Vendor_model->count_all_allowed_juices($row->allowed_id); if($c == 0 ) :?>
							<div class ="vendor_link"><span>Sorry no juices added yet.</span></div>
						<?php elseif($c >=1) :?>
						<div class ="vendor_link"><span><?php echo $c;?> Juices from this vendor.</span></div>
					<?php endif;?>

		<div class ="vendor_link"><?php echo $row->allowed_url;?></div>
		<div class ="vendor_tagline"><?php echo $row->allowed_tagline;?></div>
		<br/>
	</div>
</div>
</div>
<br/>
<?php endforeach;?>

</div>
<?php $this->load->view('templates/sidebar');?>
</div>
</div>
