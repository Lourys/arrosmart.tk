<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->data['title'] = 'Authentification';

    $this->twig->display('auth/index', $this->data);
  }
}
