<h2>You're all set</h2>

<p><strong>Congratulations!</strong> Your pails installation is all set up.
Here are some places you may want to go:</p>

<ul>
<li><a href="/">Home Page</a></li>
<?php if (in_array('admin', $this->plugin_paths)): ?>
<li><a href="/admin">Admin Pages</a></li>
<?php endif; ?>
</ul>

<p>You should also either remove the <code>installer</code> plugin (if this is a production environment)
or make <code>config/application.php</code> read-only (to avoid trouncing the file in development).
In general, <code>config/application.php</code> should never be writable by the web server user.</p> 