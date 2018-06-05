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

    $rawData = json_decode($this->curl->get(API_ADDRESS . 'system/getRawData', ['token' => $this->session->userdata('token'), 'since_days' => 30]), true);
    $scheduleInformations = json_decode($this->curl->get(API_ADDRESS . 'schedule', ['token' => $this->session->userdata('token')]), true);

    $last_days = [];
    for ($i = 0; $i < 30; $i++) {
      $day = date_format(date_modify(date_create(date('Y-m-d')), "- " . (30 - $i) . " day"), 'd/m');
      $last_days[] = $day;
    }
    $this->data['last_days'] = json_encode($last_days);

    //var_dump($curlCall);

    $this->twig->display('monitoring/consumption', $this->data);
  }

}
