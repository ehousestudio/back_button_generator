<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Back Button Generator Class
 *
 * @package		ExpressionEngine
 * @category	Plugin
 * @author		Ryan Shrum
 * @copyright	Copyright (c) 2013, Ryan Shrum
 * @link		http://www.ehousestudio.com
 */

$plugin_info = array(
  'pi_name'         => 'Back Button URL Generator',
  'pi_version'      => '1.0.1',
  'pi_author'       => 'Ryan Shrum',
  'pi_author_url'   => 'http://www.ehousestudio.com',
  'pi_description'  => 'This plugin generates a URL based on previous page. This is especially useful with ExpressionEngine\'s native pagination and/or people coming rom external sources.'
);

class ehs_back_button {

	public $return_data = '';
	
	public function __construct()
	{

		// we will check the server variable to see what the referal was
		$referal_url = htmlspecialchars($_SERVER['HTTP_REFERER']);
		
		// set the haystack to be the previous URL
		$haystack = $referal_url;

		// set the needle based on what you want it to be
		// would be the URL for the site, generally speaking
		$needle = $this->EE->TMPL->fetch_param('url');
		
		// if the needle is not in the haystack, we will send them here (ie. user came from an external source)
		$redirect = $this->EE->TMPL->fetch_param('redirect');
		
		// set a bool based on whether or not the haystack contains the needle		
		$local_bool = strpos( $haystack, $needle );

		if ( $local_bool == true ) {
			
			// if it does, we just want to send to the user back to
			// the previous page they were viewing with in the site (ie. paginated news roll)
			$return = $referal_url;

		} else {

			// if the user came from external source, we should just send them back to the
			// landing page for the section in question (ie. /news)
			$return = $redirect;

		}

		// returns the absolute or relative URL based on iterating through the above function
		$this->return_data = $return;

	}
	
}

/* End of file pi.ehs_back_button.php */
/* Location: ./system/expressionengine/third_party/ehs_back_button/pi.ehs_back_button.php */