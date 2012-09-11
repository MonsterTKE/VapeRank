<?php $this->load->helper('text');
$this->load->helper('date');
?>
<div id="body_wrapper">
    <div id="outer_main_wrapper">
        <?php foreach ($result as $row):?>  
        <div class="listing_wrapper">
            <div class="inner_listing_wrapper">
                <div class ="vendor_juice"><h2><a href="<?php echo base_url(); echo"vendors/individual/"; echo $row->id?>"><?php echo $row->name?></a></h2></div>  
                <div class ="vendor_name"><p><a href="<?php echo $row->url_link?>"><?php echo $row->vendor_name?></a></p></div>
                <div class ="vendor_desc"><p><?php 
                $url_string = base_url(); 
                $read_more = "   ...<a href={$url_string}vendors/individual/{$row->id}>\"read more\"</a>"; 
                echo word_limiter($row->description, 20, $read_more);?></p></div>
                <div class ="vendor_catg"><?php echo $row->category?></div>
                <div class ="vendor_votes">
                    <div class="vote_box_u"><h3><a href="<?php echo base_url(); echo"rating/add/"; echo $row->id; 
                    echo "/up"?>" title="Vote '<?php echo $row->name?>' up.">
                    <img src="<?php echo base_url()?>webroot/images/OK.png" /><?php echo $row->votes_up?></a></h3></div>

                    <div class="vote_box_d"><h3><a href="<?php echo base_url(); echo"rating/add/"; echo $row->id; 
                    echo "/down"?>" title="Vote '<?php echo $row->name?>' down.">
                    <img src="<?php echo base_url()?>webroot/images/Erase.png" /><?php echo $row->votes_up?></a></h3></div>
                </div>                                         
            </div>
            <div class="vendor_date"><h6>Added on <?php $mysql = mysql_to_unix($row->created);  echo unix_to_human($mysql); ?><h6><h5><em>By <?php echo $row->username?></em></h5></div>
        </div>
    <?php endforeach;?> 
    <?php if($this->pagination->create_links()):?>
    <div id='pagination_links'><?php echo $this->pagination->create_links();?></div>
<?php endif; ?>
</div>
<?php $this->load->view('templates/sidebar');?>
</div>


