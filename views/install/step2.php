<h2>Enter your database details</h2>

<p>Enter the following information for your MySQL database. If you're installing pails on
a hosting plan, this information will have been given to you by your hosting provider</p>

<form action="/install/step2" method="POST">
<?php echo $this->input_for('hostname', 'Host'); ?>
<?php echo $this->input_for('username', 'Username'); ?>
<?php echo $this->input_for('password', 'Password', array('type' => 'password')); ?>
<?php echo $this->input_for('dbname', 'Database Name'); ?>
<input type="submit" value="Continue" />
</form>