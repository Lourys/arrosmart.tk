<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

  public function index()
	{

    echo password_hash('210100', PASSWORD_BCRYPT);
	}
  
}
