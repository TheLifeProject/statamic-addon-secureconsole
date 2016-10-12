<?php

namespace Statamic\Addons\SecureConsole;

use Illuminate\Http\Response;
use Statamic\Data\Users\User;
use Statamic\Extend\Listener;

class SecureConsoleListener extends Listener
{
    /**
     * The events to be listened for, and the methods to call.
     *
     * @var array
     */
    public $events = [
	    'cp.add_to_head' => 'cp_head',              // Only on cp requests
	    'response.created' => 'response_created',   // Only on public side requests.
    ];

	public function cp_head()
	{
		// Prevent access to the CP area on production sites.
		if( app()->environment() == 'production' )
			$this->canonical_quit('Access denied');
	}

	public function response_created(Response $response)
	{
		// Only allow access to the site for logged in users if the environment is not production.
		if( app()->environment() != 'production' )
		{
			/** @var User $user */
			$user = \Auth::user();
			if( !$user OR !( $user->hasPermission('cp:access') AND $user->hasPermission('pages:edit') ) )
			{
				$this->canonical_quit('Access Denied');
			}

		}
	}

	private function canonical_quit($message='')
	{
		$path = $this->get_path();
		die("<html>
<head>
<link rel=\"canonical\" href=\"{$path}\" />
</head>
<body>
{$message}
</body>
</html>");
	}

	private function get_path()
	{
		$url = request()->fullUrl();
		$path = trim(request()->path(), "/ \t\n\r\0\x0B");
		$base_url = str_replace($path, '', $url);
		$public_host = trim($this->getConfig('app_base_uri', $base_url), "/ \t\n\r\0\x0B") . '/';
		return $public_host . ($path ? $path . '/' : '');
	}
}
