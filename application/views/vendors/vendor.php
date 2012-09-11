<?php $this->load->helper('text');
$this->load->helper('date');
$this->load->model('Rating_model');
?>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span1"></div>
        <div class="span5">
        <?php foreach ($result as $row):?>
        <div class="row-fluid">
        <div class="span12">
        <div class="thumbnail elementBackground">
            <div class="row-fluid">
              <div class="span8">
                  <h1><a href="<?php echo base_url(); echo"vendors/individual/"; echo $row->id?>"><?php echo $row->name?></a></h1>
                  <a class="btn btn-large btn-primary" href="<?php echo $row->allowed_url?>" target="blank"><?php echo $row->allowed_name?></a>
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

        </div>
        </div>
        </div>
        <br/>
                        <?php endforeach;?>
        </div>

<?php $this->load->view('templates/sidebar');?>

</div>
</div>
</div>
</div>
</div>
