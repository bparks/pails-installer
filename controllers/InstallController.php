<?php
define('CONFIG_FILE', 'config/application.php');

class InstallController extends Pails\Controller
{
	use FormBuilder;

	function index()
	{
		$url = parse_url($_SERVER['REQUEST_URI']);
		if (strstr($url['path'], 'install') === false)
		{
			$this->model = '/install';
			return 302;
		}
	}

	function step2() // Enter database details
	{
		global $CONNECTION_STRINGS;

		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			//Do the configuration
			// if (!is_writable('config/application.php'))
			// {
			// 	$this->model = '/install/step3';
			// 	return 307;
			// }

			$connection_strings = "\$CONNECTION_STRINGS = array(\n";
			foreach ($CONNECTION_STRINGS as $key => $value) {
				if ($key == Pails\Application::environment()) continue;
				$connection_strings .= "\t\t'".$key."' => '".$value."',\n";
			}
			$connection_strings .= sprintf("\t\t'%s' => 'mysql://%s:%s@%s/%s'\n",
				Pails\Application::environment(), //key
				$_POST['username'], //username
				$_POST['password'], //password
				$_POST['hostname'], //db host
				$_POST['dbname']); //db name
			$connection_strings .= "\t);";

			//Get existing config
			$config = '';
			if (file_exists(CONFIG_FILE))
				$config = file_get_contents(CONFIG_FILE);

			//Modify config
			if (strstr($config, '$CONNECTION_STRINGS') !== false)
				$config = preg_replace('/\$CONNECTION_STRINGS\s*=.*?\);/s', $connection_strings, $config);
			else
				$config .= "\n\n".$connection_strings;

			//Write new config
			file_put_contents(CONFIG_FILE, $config);

			//Redirect
			$this->model = '/install/step3';
			return 302;
		}
	}

	function step3() // All done?
	{
		//
	}
}