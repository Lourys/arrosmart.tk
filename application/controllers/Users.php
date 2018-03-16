<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function account()
  {
    $this->data['title'] = 'Mes informations';
    $this->data['user'] = json_decode($this->curl->get(API_ADDRESS . 'user', [
      'token' => $this->session->userdata('token'),
      'fields' => 'last_name,first_name,department,email'
    ]), true);

    $this->twig->display('users/account', $this->data);
  }

  public function settings()
  {
    $this->data['title'] = 'Paramètres';

    $this->twig->display('users/settings', $this->data);
  }


}
