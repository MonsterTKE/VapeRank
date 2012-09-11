<div class="container-fluid elementBackground">
	<div class="row-fluid">
		<div class="span2"></div>
			<div class="span10">
			<br/>
			<?php $att = array('class' => 'form-inline',); echo form_open(current_url(), $att) ?>

			<div class="span4">

				<div class="control-group pull-right">
					<div class="controls">
						<label class="control-label" for="smokes">How many smokes a day? (100 or less)</label>
						<div class="input-prepend">
							<span class="add-on">#</span><input type="text" name="smokes" class="input-mini" />
						</div>
						<?php echo form_error('smokes'); ?>
					</div>
				</div>

				<div class="control-group pull-right">
					<div class="controls">
						<label class="control-label" for="cost">How much per pack? (Less than 15.00.)</label>
						<div class="input-prepend">
							<span class="add-on">$</span><input type="text" name="cost" class="input-mini" />
						</div>
						<?php echo form_error('cost'); ?>
					</div>
				</div>

			</div>

			<div class="span3">
				<?php
				$this->load->helper('date_dropdown');
				?>
				<div class="control-group pull-right">
					<div class="controls">
						<?php echo buildMonthDropdown($name='month',$value=date("m")); ?>
					</div>

					<div class="controls">
						<?php echo buildDayDropdown($name='day', date("d")); ?>
					</div>

					<div class="controls">
						<?php echo buildBetterYearDropdown($name='year',$value=date("Y")); ?>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="container-fluid elementBackground">
<div class="row-fluid">
	<div class="span2"></div>
	<div class="span10">

<div class="span5">
	<div class="controls">
		<input type="radio" name="wrapper_check" value= "1" />
		<img src="<?php echo base_url('webroot/banners/filled_banners/banner_blk.png');?>" />
		</div>
<br/>
		<div class="controls">
		<input type="radio" name="wrapper_check" value ="2" />
		<img src="<?php echo base_url('webroot/banners/filled_banners/banner_wht.png');?>" />
		</div>
<br/>
		<div class="controls">
		<input type="radio" name="wrapper_check" value ="4" />
		<img src="<?php echo base_url('webroot/banners/filled_banners/banner_cir.png');?>" />
		</div>
</div>
<div class="span5">
		<div class="controls">
		<input type="radio" name="wrapper_check" value ="5" />
		<img src="<?php echo base_url('webroot/banners/filled_banners/banner_dot.png');?>" />
		</div>
<br/>
		<div class="controls">
		<input type="radio" name="wrapper_check" value ="3" />
		<img src="<?php echo base_url('webroot/banners/filled_banners/banner_blu.png');?>" />
		</div>
<br/>
		<div class="controls">
		<input type="radio" name="wrapper_check" value ="6" />
		<img src="<?php echo base_url('webroot/banners/filled_banners/banner_stn.png');?>" />
		</div>
</div>
	</div>
</div>

<br/>
<div class="row-fluid">
	<div class="span2"></div>
	<div class="span10">
<input class="btn btn-success" type="submit" name="submit" value="Make My Banner" />
</div>
</div>
</div>
</form>

