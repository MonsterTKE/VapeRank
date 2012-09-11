<?php
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/auth.css" />
</head>
<body>
<div class="box">
  <div class="topleft">
  <div class="topright">
    <div>
<img src="<?=base_url()?>css/images/auth_logo.png">
<?php echo form_open($this->uri->uri_string()); ?>
<table>
	<tr>
		<td><?php echo form_label('Password', $password['id']); ?></td>
		<td><?php echo form_password($password); ?></td>
		<td style="color: red;"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></td>
	</tr>
</table>
<?php echo form_submit('cancel', 'Delete account'); ?>
<?php echo form_close(); ?>
    </div>
  </div>
  </div>

  <div class="bottomleft">
  <div class="bottomright">
  </div>
  </div>
</div>
