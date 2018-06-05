<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Management extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function edit_schedule()
  {
    $this->data['title'] = 'Édition du programme';
    $this->data['schedule'] = json_decode($this->curl->get(API_ADDRESS . 'schedule', ['token' => $this->session->userdata('token')]), true);

    $this->twig->display('management/edit_schedule', $this->data);
  }


}
