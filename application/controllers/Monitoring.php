<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function consumption()
  {
    $this->data['title'] = 'Consommation';

    $this->twig->display('monitoring/consumption', $this->data);
  }

}
