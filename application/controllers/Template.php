<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Template extends CI_Controller
{
 
    public function index()
    {
    
        $this->load->view('template_v');
    }
}
