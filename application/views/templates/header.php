<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>VapeRank | <?php if(isset($page_title)) { echo $page_title;} ?></title>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<meta name="description" content="">
<meta name="author" content="">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(),'css/bootstrap.css';?>"/>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url("js/bootstrap.min.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("js/jquery.ui.1.8.22.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("js/vote_pop.js")?>"></script>

</head>
<body>

<div class="container-fluid elementNavy">
	<div class="row-fluid">
		<div class="span1"></div>
		<div class="span10">
			<img src="<?php echo base_url("css/css_assets/Vapelogo.png")?>">
<?php
$slogan = array();
$slogan[0] ="Now with more cool smoke effects.";
$slogan[1] ="Specially engineered...";
$slogan[2] ="We totally didnt steal this from Minecraft...";
$slogan[3] ="How were we supposed to know which was best?.";
$slogan[4] ="Can't have enough juice, right? ...right?";
$slogan[5] ="I bet your wondering how many of these there are.";
$slogan[6] ="Including the patented vote-o-meter.";
$slogan[7] ="Dozens sold....";
$slogan[8] ="For your utmost vaping pleasure.";
$slogan[9] ="To drip or not to drip?";
$slogan[10] ="The debate rages on.";
$slogan[11] ="Human readable urls, free with every click.";
$slogan[12] ="Does anyone else just want to buy all of the juice?";
$slogan[13] ="Ever had a juice that was really, really good?";
$slogan[14] ="No white text on a black background!";
?>


<div class="navbar">
  <div class="navbar-inner">
    <div class="container">
    	<ul class="nav">
    		<li><a href="<?php echo base_url();?>">Home</a></li>
                <li class="divider-vertical"></li>
    		<li><a href="<?php echo base_url("vendors/submit");?>">Add Juice</a></li>
                <li class="divider-vertical"></li>
    		<li><a href="<?php echo base_url("listed_vendors");?>">Vendors</a></li>
                <li class="divider-vertical"></li>
    		<li><a href="<?php echo base_url('contact');?>">Contact</a></li>
                <li class="divider-vertical"></li>
    		<li><a href="<?php echo base_url("links/about");?>">About</a></li>
                <li class="divider-vertical"></li>
    		<li><a href="<?php echo base_url("links/irc_chat");?>">Live Chat</a></li>
    	</ul>
    		<ul class="nav pull-right">
    		<?php if ($this->tank_auth->get_user_id()): ?>
    		<li><p class="navbar-text">Hello, <?php echo $this->tank_auth->get_username();?></p></li>
                <li class="divider-vertical"></li>
    		<li><a href="<?php echo base_url();?>auth/logout">Logout</a></li>
                <li class="divider-vertical"></li>
    		<li><a href="<?php echo base_url();?>user">Account</a></li>
    	<?php else: ?>
            <li class="divider-vertical"></li>
    	<li><a id="loginModalbutton" href="#loginModal">Login</a></li>
    <?php endif; ?>

</ul>
   	</div>
  </div>

</div>
<span class="label label-mustard"><?php echo $slogan[array_rand($slogan)];?></span>
</div>

	</div>

		</div>
