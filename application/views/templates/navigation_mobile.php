<div id="logo_container">	
<div id="logo_top">
<div id="logo_slogan"><h2>
<?php 
$slogan = array();
$slogan[0] ="Now with more cool smoke effects.";
$slogan[1] ="Specially engineered...";
$slogan[2] ="We totally didnt steal this from Minecraft...";
$slogan[3] ="How were we supposed to know which was best?.";
$slogan[4] ="Can't have enough juice, right? ...right?";
$slogan[5] ="I bet your wondering how many of these there are.";
$slogan[6] ="Incuding the patented vote-o-meter.";
$slogan[7] ="Dozens sold....";
$slogan[8] ="For you utmost vaping pleasure.";
$slogan[9] ="To drip or not to drip?";
$slogan[10] ="The debate rages on.";
$slogan[11] ="Human readable urls, free with every click.";
$slogan[12] ="Does anyone else just want to buy all of the juice?";
$slogan[13] ="Ever had a juice that was really, really good?";

echo $slogan[array_rand($slogan)];
?>
</h2></div>
</div>
</div>

<div id="navigation_box">
<ul>
        <li><a href="<?php echo base_url();?>">Home</a></li>
        <li><a href="<?php echo base_url("vendors/submit");?>">Add Juice</a></li>
        <li><a href="<?php echo base_url("listed_vendors");?>">Vendors</a></li>
        <li><a href="<?php echo base_url('contact');?>">Contact</a></li>
        <li><a href="<?php echo base_url("links/about");?>">About</a></li>
        <li><a href="<?php echo base_url("links/irc_chat");?>">Live Chat</a></li>

	<?php if ($this->tank_auth->get_user_id()): ?>
		<li><a href="<?php echo base_url();?>auth/logout">Logout</a></li>
                <li><a href="<?php echo base_url();?>user">Account</a></li>
	<?php else: ?>
		<li><a id="login_pop" href=<?php echo base_url('auth/login'); ?>>Login</a></li>
	<?php endif; ?>
	
</ul>
</div>
<?php if (isset($load_breadcrumbs)): ?>
<div id="breadcrumbs_container">
<div id="breadcrumbs"><h2>Currently showing: <?php echo $sort_order ?></h2>
<ul id="nav">
        <li>
                <a href="#"><strong>Sort Results By:</strong></a>
                <ul>
                        <li><a href="<?=base_url();?>"><strong>Overall</strong></a></li>
                        <li><a href="/vendors/index/Tobacco"><strong>Tobacco</strong></a></li>
                        <li><a href="/vendors/index/Fruit"><strong>Fruit</strong></a></li>
                        <li><a href="/vendors/index/Sweet"><strong>Sweet</strong></a></li>
                        <li><a href="/vendors/index/Bakery"><strong>Bakery</strong></a></li>
                        <li><a href="/vendors/index/Organic"><strong>Organic</strong></a></li>
                        <li><a href="/vendors/index/Menthol"><strong>Menthol</strong></a></li>
                        <li><a href="/vendors/index/Coffee"><strong>Coffee</strong></a></li>
                        <li><a href="/vendors/index/Vg"><strong>100% Vg</strong></a></li>
                        <li><a href="/vendors/index/Other"><strong>Other/Specialty</strong></a></li>
                </ul>
        </li>

</ul>
</div>
</div>
 <?php elseif(isset($breadcrumbs_set)): ?>
        <div id="breadcrumbs_container">
        <div id="breadcrumbs"><h2><?php echo $breadcrumbs_set ?></h2></div>
        </div>
<?php else: ?>
	<div id="breadcrumbs_container">
	<div id="breadcrumbs"><h2>Vote for "<?php echo $v_j_name ?>" now.</h2></div>
	</div>
<?php endif ?>
<div id="box_stripe">