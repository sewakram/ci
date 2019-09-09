<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CountrySwitcher extends CI_Controller
{
    public function __construct() {
        parent::__construct();
    }
 
    function switchcountry($country = "") {
        
        $country = ($country != "") ? $country : 1;
        $this->session->set_userdata('site_country', $country);
        
        redirect($_SERVER['HTTP_REFERER']);
        
    }
}