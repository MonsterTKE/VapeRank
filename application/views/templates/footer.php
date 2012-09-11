

<?php if($this->pagination->create_links()):?>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span1"></div>
      <div class="span6">
<div class="navbar">
  <div class="navbar-inner">
  <div class="container-fluid">
    <ul class="nav">
  <li><h1>More vendors</h1></li>
  <li class="divider-vertical"></li>
</ul>
<?php echo $this->pagination->create_links();?>
</div>
</div>

</div>
<?php endif;?>

</div>
</div>

    <div class="row-fluid">
      <div class="span1"></div>
      <div class="span10">
<h6><em>&copy 2012 Monstercraft</em></h6>
</div>
</div>

</div>
</body>
</html>