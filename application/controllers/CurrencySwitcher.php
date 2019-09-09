<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CurrencySwitcher extends CI_Controller
{
    function switchCurrency($currency = "") {
        
        $currency = ($currency != "") ? $currency : "usd";
        $this->session->set_userdata('site_currency', $currency);
        if($currency != 'usd'){
        	$site_currency = $this->iploader->change_visitor_currency('usd', $currency);
 			$change = strtoupper('usd_'.$currency);
			$this->session->set_userdata('site_currencyConverter', $site_currency);
			$this->session->set_userdata('site_currencySymbol', $this->iploader->Currency_symbol($currency));
        }
        $this->session->set_userdata('site_currencySymbol', $this->iploader->Currency_symbol($currency));
        redirect($_SERVER['HTTP_REFERER']);
        
    }
}