
<!--This is logic for the navigation bar.-->
<?php if (isset($load_breadcrumbs)): ?>
<div class="container-fluid">
<div class="row-fluid ">
        <div class="span1"></div>
        <div class="span10 roundPad">
<ul class="nav nav-pills">
        <li class="nav-header"><h4>Currently showing: <?php echo $sort_order ?> <?php echo $total_results;?> total listings.</h4></li>
        <li class="dropdown active">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sort By<b class="caret"></b></a>
                <ul class="dropdown-menu">
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
        </li>

</ul>

</div>
</div>
</div>
 <?php elseif(isset($breadcrumbs_set)): ?>
 <div class="container-fluid">
<div class="row-fluid ">
        <div class="span1"></div>
        <div class="span10 roundPad">
<h2><?php echo $breadcrumbs_set ?></h2>
</div>
</div>
</div>

<?php else: ?>
<div class="container-fluid">
<div class="row-fluid ">
        <div class="span1"></div>
        <div class="span10 roundPad">
<h2>Vote for "<?php echo $juice_result[0]->name;?>" now.</h2>
</div>
</div>
</div>



<?php endif ?>