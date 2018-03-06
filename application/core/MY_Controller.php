<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    require(APPPATH . 'third_party/Twig_Extensions/Assets_Extension.php');

    $this->load->helper('route_helper');
    $config = [
        'paths' => [
          APPPATH . 'views/'
        ]
      ];
    $config['cache'] = false;
    $this->load->library('twig', $config);
    $this->twig->getTwig()->addExtension(new Assets_Extension());
    $this->twig->addGlobal('this', $this);

    $this->data = array();
  }
}
