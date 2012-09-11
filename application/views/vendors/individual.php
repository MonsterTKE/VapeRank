<?php $this->load->helper('text');
$this->load->helper('date');
$this->load->model('Rating_model');
?>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span1"></div>
        <div class="span5">

        <div class="row-fluid">
        <div class="span12">
        <div class="thumbnail elementBackground">
            <div class="row-fluid">
              <div class="span8">
                  <h1><a href="<?php echo base_url(); echo"vendors/individual/"; echo $juice_result[0]->id?>"><?php echo $juice_result[0]->name?></a></h1>
                  <a class="btn btn-mini btn-inverse" href="<?php echo $juice_result[0]->allowed_url?>" target="blank"><?php echo $juice_result[0]->allowed_name?></a>
              </div>
<br/>
              <div class="span4">
                <a class="btn btn-success pull-right imagePad" href="#" id=<?php echo "up_{$juice_result[0]->id}";?> title="Vote '<?php echo $juice_result[0]->name?>' up.">
                  <img style="padding-right:3px;" src="<?php echo base_url()?>webroot/images/OK.png" /><span id="vote_up_<?php echo $juice_result[0]->id;?>" class="badge badge-success"><?php echo $juice_result[0]->votes_up?></span></a>
                  <a class="btn btn-danger pull-right imagePad" href="#" id=<?php echo "down_{$juice_result[0]->id}";?> title="Vote '<?php echo $juice_result[0]->name?>' down.">
                  <img style="padding-right:3px;" src="<?php echo base_url()?>webroot/images/Erase.png" /><span id="vote_down_<?php echo $juice_result[0]->id;?>" class="badge badge-important"><?php echo $juice_result[0]->votes_down?></span></a>
              </div>
            </div>
<script type="text/javascript">
$("#<?php echo "up_{$juice_result[0]->id}";?>").voteModal("#<?php echo "up_{$juice_result[0]->id}";?>", "<?php echo $juice_result[0]->name?>",'<?php echo $juice_result[0]->id;?>',"#vote_up_<?php echo $juice_result[0]->id;?>", 'up');
$("#<?php echo "down_{$juice_result[0]->id}";?>").voteModal("#<?php echo "down_{$juice_result[0]->id}";?>", "<?php echo $juice_result[0]->name?>",'<?php echo $juice_result[0]->id;?>',"#vote_down_<?php echo $juice_result[0]->id;?>", 'down');
</script>
<br/>
            <div class="row-fluid">
                <div class="span8 elementGray imagePad">
                  <h5><?php
                      $url_string = base_url();
                      $read_more = "   ...<a href={$url_string}vendors/individual/{$juice_result[0]->id}>\"read more\"</a>";
                      echo $juice_result[0]->description;?></h5>
                </div>

                    <div class="span2">
                            <a class="thumbnail" href ="<?php echo $juice_result[0]->allowed_url?>"><img src="<?php echo $juice_result[0]->allowed_image_url?>" /></a>
                    </div>
                    <div class="span2">
                            <a class="thumbnail" href ="<?php echo $juice_result[0]->allowed_url?>"><img src="<?php echo $juice_result[0]->categories_image_url?>" /></a>
                    </div>

            </div>
<br/>
            <div class="row-fluid">
                <div class="span8">
                    <div class="btn-toolbar">
                    <div class="btn-group">
                        <p class="btn btn-info"><?php echo $juice_result[0]->categories_category;?></p>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-info" id="user_link" href ="<?php echo base_url("banner/bannergen/{$juice_result[0]->id}")?>">Make new banner</a>

                        <?php $c = count($this->Rating_model->count_all_comments($juice_result[0]->id)); if($c == 1 ) :?>
                            <a class="btn btn-warning" href="<?php echo base_url(); echo"vendors/individual/"; echo $juice_result[0]->id?>" title="Vote to add comments"><?php echo $c;?> comment.</a>
                        <?php elseif($c > 1):?>
                            <a class="btn btn-warning" href="<?php echo base_url(); echo"vendors/individual/"; echo $juice_result[0]->id?>" title="Vote to add comments"><?php echo $c;?> comments.</a>
                        <?php else:?>
                            <p class="btn btn-danger">Vote to comment.</p>
                        <?php endif;?>

                    </div>
                    </div>
                </div>

                <div class="span4">
                    <h6>Added on <?php $mysql = mysql_to_unix($juice_result[0]->created);  echo unix_to_human($mysql); ?><h6><h5><em>By <?php echo $juice_result[0]->username?></em></h5>
                </div>
            </div>

        </div>
        </div>
        </div>
        <br/>

        </div>

        <div class="span3">
        <div class="row-fluid">
            <div class="span12"><a href="#" class="thumbnail elementBackground"><img src="<?=base_url();?>webroot/images/smoke_slice_01.png" alt="Advertisements go here."/></a></div>
        </div>
        <br/>
        </div>

</div>
</div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span1"></div>
           <div class="span5">

            <?php foreach ($rating_result as $row):?>
                <div class="row-fluid">
                <div class="span12 elementGrayBorder imagePad">
                    <div class="span10 ">
                        <h6><?php echo $row->comments?></h6>
                    </div>
                    <div class="span2">
                        <h6>Added on <?php $mysql = mysql_to_unix($row->created); echo unix_to_human($mysql); ?></h6>
                        <p>By <?php echo $row->username?></p>
                    </div>
                </div>
                        </div>

                    <br/>
        <?php endforeach;?>
        </div>
        </div>
        </div>


</div>
</div>
</div>