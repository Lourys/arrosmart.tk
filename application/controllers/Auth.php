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

    if ($this->auth->isLogged()) {
      redirect(route('home/dashboard'));
    }

    $this->twig->display('auth/index', $this->data);
  }

  public function logout()
  {
    $this->auth->logout();
  }
}
