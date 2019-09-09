<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Iploader
{
		function __construct()
		{
			 $CI =& get_instance();
			if(!$CI->session->userdata('site_country'))
	        {
	        	 $CI->session->set_userdata('site_country', strtolower($this->get_visitor_location(NULL, 'countryCode')));
	        }

	        if(!$CI->session->userdata('site_currency'))
	        {
	        	 $avail = array('inr','usd','eur','gbp','sgd');
	        	 $currency = strtolower($this->get_visitor_location(NULL, 'currencyCode'));
	        	 if(in_array($currency, $avail)){
	        	 	$CI->session->set_userdata('site_currency', strtolower($currency));
	        	 	if($this->get_visitor_location(NULL, 'currencyConverter'))
	        	 	{ 
	        	 		 if($currency != 'usd'){
				        	$site_currency = $this->change_visitor_currency('usd', $currency);
				 			$change = strtoupper('usd_'.$currency);
							$CI->session->set_userdata('site_currencyConverter', $site_currency);
				        }
	        	 		$CI->session->set_userdata('site_currencySymbol', $this->Currency_symbol($currency));
	        	 	}
	        	 }
	        	 else
	        	 {
	        	 	$CI->session->set_userdata('site_currency', strtolower('usd'));
	        	 	$this->session->set_userdata('site_currencySymbol', $this->Currency_symbol($currency));
	        	 }
	        }
	        
		}
		//Magazines functionality start
		function get_visitor_location($ip = NULL, $purpose = '') {
			$ip = $_SERVER["REMOTE_ADDR"];
		   if ( !empty($ip) ) {
		      $curlSession = curl_init();
		      curl_setopt($curlSession, CURLOPT_URL, 'http://www.geoplugin.net/json.gp?ip='.$ip);
		      curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
		      curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

		      $ipdat = @json_decode(curl_exec($curlSession), true);
		      if ( is_array($ipdat) ) {
		         switch($purpose) {
		            default:
		               return $ipdat;
		            break;
		            case 'continent':
		               return $ipdat['geoplugin_continentName'];
		            break;
		            case 'continentCode':
		               return $ipdat['geoplugin_continentCode'];
		            break;
		            case 'country':
		               return $ipdat['geoplugin_countryName'];
		            break;
		            case 'countryCode':
		               return strval($ipdat['geoplugin_countryCode']);
		            break;
		            case 'timezone':
		               return $ipdat['geoplugin_timezone'];
		            break;
		            case 'currencyCode':
		               return strval($ipdat['geoplugin_currencyCode']);
		            break;
		            case 'currencyConverter':
		               return floatval($ipdat['geoplugin_currencyConverter']);
		            break;
		            case 'currencySymbol_UTF8':
		               return $ipdat['geoplugin_currencySymbol_UTF8'];
		            break;
		            case 'isEU':
		               return $ipdat['geoplugin_inEU'];
		            break;
		         }
		      }
		   }
		   return NULL;
		}

		//Magazines functionality start
		function change_visitor_currency($from = NULL, $to = NULL) {
			$from = $from;
		   if ( !empty($to) ) {
		   	  $change = strtoupper($from.'_'.$to);
		      $curlSession = curl_init();
		      curl_setopt($curlSession, CURLOPT_URL, 'https://free.currconv.com/api/v7/convert?q='.$change.'&compact=ultra&apiKey=3f84a100bb9405b50c1d');
		      curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
		      curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

		      $ipdat = @json_decode(curl_exec($curlSession), true);
		      if ( is_array($ipdat) ) {
		         switch($change) {
		            default:
		               return $ipdat["$change"];
		            break;
		         }
		      }
		   }
		   return NULL;
		}

		public function Currency_symbol($currency)
		{
					switch(strtolower($currency)) {
			            default:
			               return '&#36;';
			            break;
			            case 'inr':
			                return '&#x20B9;';
			            break;
			            case 'eur':
			                return 'EUR';
			            break;
			            case 'gbp':
			                return 'GBP';
			            break;
			            case 'sgd':
			                return 'SGD';
			            break;
			            case 'usd':
			                return '&#36;';
			            break;
			        }
		}
}
?>