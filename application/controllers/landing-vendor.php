<?php
defined('BASEPATH') or exit('No direct script access allowed');


class landingVendor extends CI_Controller
{
 
    public function index()
    {
    
        $this->load->view('vendor/landing');
    }
}
