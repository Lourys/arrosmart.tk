<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    redirect(route('home/dashboard'));
  }

  public function dashboard()
  {
    $this->data['title'] = 'Tableau de bord';

    $this->twig->display('home/dashboard', $this->data);
  }

  public function test()
  {
    var_dump($this->session->userdata('token'));
  }

}
