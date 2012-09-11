<div class="container-fluid">
	<div class="row-fluid">
		<div class="span1"></div>
			<div class="span5 thumbnail">

							<div class ="span6"><img src="<?php echo $allowed_image_url;?>" height="150" width="150"/></div>
								<?php $c = $this->Vendor_model->count_all_allowed_juices($allowed_id); if($c == 0 ) :?>
									<div class ="span6"><p>Sorry no juices added yet.</p></div>
								<?php elseif($c >=1) :?>
								<div class ="vendor_link"><span><?php echo $c;?> Juices from this vendor.</span></div>
							<?php endif;?>
							<hr/>
						<div class ="span12"><p><?php echo $allowed_url;?></p></div>
						<div class ="span12"><a href="<?php echo $allowed_url;?>"><h1><?php echo $allowed_tagline;?></h1></a></div>
						<div class ="span12"><p><?php echo $allowed_body;?></p></div>
				<br/>
			</div>
<?php $this->load->view('templates/sidebar');?>
</div>
</div>