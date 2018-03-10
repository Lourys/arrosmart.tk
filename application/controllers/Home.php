<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index() {
    echo password_hash('210100', PASSWORD_BCRYPT);
  }

  public function test() {
    var_dump($this->session->userdata('token'));
  }

}
