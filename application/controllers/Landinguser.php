<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Landinguser extends CI_Controller {

    public function index()
    {
        redirect('user/home');
    }
}
