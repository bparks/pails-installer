<?php

//Configuration
function installer_config($app)
{
	$app->registerRouter(function ($uri) use ($app) {
		$req = new Pails\Request();

		//Should we go to install mode?
		if (file_exists('db/migrations') && is_dir('db/migrations') && (
			($app->connection_strings() == null || !is_array($app->connection_strings()) || count($app->connection_strings()) == 0)
			//|| true //For debugging
			) && (strstr($uri, '/install') === false) || !file_exists('config/application.php'))
		{
			$req->controller = 'install';
			$req->action = 'index';
			$req->raw_parts = array($req->controller, $req->action);
			return $req;
		}

		//Are we already in install mode?
		//This is a short-circuit to avoid accidentally hitting plugins that require a
		//(potentially unconfigured) database connection
		if (strstr($uri, '/install') !== false)
		{
			$req->raw_parts = explode('/', substr($uri, 1));
			$req->controller = 'install';
			$req->action = count($req->raw_parts) > 1 ? $req->raw_parts[1] : 'index';
			return $req;
		}

		//Otherwise, we don't care
		return false;
	});
}