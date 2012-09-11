<?php $this->load->helper('text');
$this->load->helper('date');
?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span1"></div>
        <div class="span5">
        <?php foreach ($results as $row):?>
        <div class="row-fluid">
        <div class="span12">
        <div class="thumbnail elementBackground">
            <div class="row-fluid">
              <div class="span8">
                  <h1><a href="<?php echo base_url(); echo"vendors/individual/"; echo $row->id?>"><?php echo $row->name?></a></h1>
                  <a class="btn btn-mini btn-inverse" href="<?php echo $row->allowed_url?>" target="blank"><?php echo $row->allowed_name?></a>
              </div>
<br/>
              <div class="span4">
                <a class="btn btn-success pull-right imagePad" href="#voteModal" id=<?php echo "up_{$row->id}";?> title="Vote '<?php echo $row->name?>' up.">
                  <img style="padding-right:3px;" src="<?php echo base_url()?>webroot/images/OK.png" /><span id="vote_up_<?php echo $row->id;?>" class="badge badge-success"><?php echo $row->votes_up?></span></a>
                  <a class="btn btn-danger pull-right imagePad" href="#voteModal" id=<?php echo "down_{$row->id}";?> title="Vote '<?php echo $row->name?>' down.">
                  <img style="padding-right:3px;" src="<?php echo base_url()?>webroot/images/Erase.png" /><span id="vote_down_<?php echo $row->id;?>" class="badge badge-important"><?php echo $row->votes_down?></span></a>
              </div>

<script type="text/javascript">
$("#<?php echo "up_{$row->id}";?>").voteModal("#<?php echo "up_{$row->id}";?>", "<?php echo $row->name?>",'<?php echo $row->id;?>',"#vote_up_<?php echo $row->id;?>", 'up');
$("#<?php echo "down_{$row->id}";?>").voteModal("#<?php echo "down_{$row->id}";?>", "<?php echo $row->name?>",'<?php echo $row->id;?>',"#vote_down_<?php echo $row->id;?>", 'down');
</script>

            </div>
<br/>
            <div class="row-fluid">
                <div class="span8 elementGray imagePad">
                  <h5><?php
                      $url_string = base_url();
                      $read_more = "   ...<a href={$url_string}vendors/individual/{$row->id}>\"read more\"</a>";
                      echo word_limiter($row->description, 40, $read_more);?></h5>
                </div>

                    <div class="span2">
                            <a class="thumbnail" href ="<?php echo $row->allowed_url?>"><img src="<?php echo $row->allowed_image_url?>" /></a>
                    </div>
                    <div class="span2">
                            <a class="thumbnail" href ="<?php echo $row->allowed_url?>"><img src="<?php echo $row->categories_image_url?>" /></a>
                    </div>

            </div>
<br/>
            <div class="row-fluid">
                <div class="span8">
                    <div class="btn-toolbar">
                    <div class="btn-group">
                        <p class="btn btn-info"><?php echo $row->categories_category?></p>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-info" id="user_link" href ="<?php echo base_url("banner/bannergen/{$row->id}")?>">Make new banner</a>

                        <?php $c = count($this->Rating_model->count_all_comments($row->id)); if($c == 1 ) :?>
                            <a class="btn btn-warning" href="<?php echo base_url(); echo"vendors/individual/"; echo $row->id?>" title="Vote to add comments"><?php echo $c;?> comment.</a>
                        <?php elseif($c > 1):?>
                            <a class="btn btn-warning" href="<?php echo base_url(); echo"vendors/individual/"; echo $row->id?>" title="Vote to add comments"><?php echo $c;?> comments.</a>
                        <?php else:?>
                            <p class="btn btn-danger">Vote to comment.</p>
                        <?php endif;?>
                    </div>
                    </div>
                </div>

                <div class="span4">
                    <h6>Added on <?php $mysql = mysql_to_unix($row->created);  echo unix_to_human($mysql); ?><h6><h5><em>By <?php echo $row->username?></em></h5>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span8">
                    <div class="btn-toolbar">
                        <div class="btn-group">
                                <a class="btn btn-danger" href ="<?php echo base_url(); echo"user/edit_submission/"; echo $row->id?>">Edit this Juice</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
        </div>
        <br/>
                        <?php endforeach;?>
        </div>

<?php if($sidebar_count):?>
<script type="text/javascript"> //Click to copy.
function SelectAll(id)
{
    document.getElementById(id).focus();
    document.getElementById(id).select();
}
</script>
<div class="span3">
        <div class="row-fluid">
        <div class="span12">
        <div class="span12"><h1>Your Banners</h1></div>
        <?php foreach($sidebar as $row):?>
        <div class="row-fluid">
                <div class="span12">
                        <div class="thumbnail">
                        <a href="<?php echo base_url();?>banner/show_banner/<?php echo $row->b_user_id;?>/<?php echo $row->b_juice_id;?>" title="Thumbnail" target="_blank"><img src="<?=base_url();?>banner/show_banner/<?php echo $row->b_user_id;?>/<?php echo $row->b_juice_id;?>" alt="Thumbnail" /></a>
                        </div>
                <p>These images will update 4 times daily.</p>
                <br/>
                <form class="form-inline">
                        <input type="button" class="btn btn-danger" value="delete this banner" onClick="location.href='<?php echo base_url("banner/delete_banner/{$row->b_user_id}/{$row->b_juice_id}") ?>'">
                </form>
                <fieldset>
                <div class="control-group">
                <label class="control-label span8" for="txtarea_<?php echo $row->b_juice_id;?>">
                BBCode - Click into text-box, right click, copy and paste onto your favorite forum.
                </label>
                <textarea class="input-xlarge" rows="6" id="txtarea_<?php echo $row->b_juice_id;?>" readonly="readonly" onClick="SelectAll('txtarea_<?php echo $row->b_juice_id;?>');">[url=<?=base_url();?>vendors/individual/<?php echo $row->b_juice_id;?>][img]<?=base_url();?>banner/show_banner/<?php echo $row->b_user_id;?>/<?php echo $row->b_juice_id;?>[/img][/url]</textarea>
                </div>
                </fieldset>

                <fieldset>
                <div class="control-group">
                <label class="control-label span8" for="txtarea_<?php echo $row->b_juice_id;?>">
                HTML - Click into text-box, right click, copy and paste onto your favorite forum.
                </label>
                <textarea class="input-xlarge" rows="6" id="txtarea2_<?php echo $row->b_juice_id;?>" readonly="readonly" onClick="SelectAll('txtarea2_<?php echo $row->b_juice_id;?>');"><a href="<?=base_url();?>vendors/individual/<?php echo $row->b_juice_id;?>" target="_blank"><img src="<?=base_url();?>banner/show_banner/<?php echo $row->b_user_id;?>/<?php echo $row->b_juice_id;?>" border="0"/></a></textarea></div></div>
                </div>
                </fieldset>
</div>
</div>
<?php endforeach;?>
</div>

<?php else: ?>
<div class="span4">
        <div class="row-fluid">
        <div class="span12">
        <h1>Your Banners</h1>
                <div class="user_sidebar_blocks">
                <h3>It seems that you dont have any banners yet. <br /> Click on your favorite juices "Make new banner" link to make up to 3.</h3>
        </div>
    </div>
</div>
<?php endif;?>

</div>
</div>
</div>
</div>
</div>




