<?php
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/auth.css" />
<style>
.box {
	width: 50em;
	margin: 50px auto;
}
</style>
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
	<tr>
		<td><?php echo form_label('New email address', $email['id']); ?></td>
		<td><?php echo form_input($email); ?></td>
		<td style="color: red;"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></td>
	</tr>
</table>
<?php echo form_submit('change', 'Send confirmation email'); ?>
<?php echo form_close(); ?>
    </div>
  </div>
  </div>

  <div class="bottomleft">
  <div class="bottomright">
  </div>
  </div>
</div>
