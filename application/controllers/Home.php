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
    $curlCall = json_decode($this->curl->get(API_ADDRESS . 'system/getData', ['token' => $this->session->userdata('token')]), true);
    $this->data['weather_data'] = $curlCall['data'];
    $this->data['last_check_since'] = $this->formatDateDiff(date_create($curlCall['checked_at']));

    //var_dump($this->data['weather_data']);

    $this->twig->display('home/dashboard', $this->data);
  }

  public function test()
  {
    var_dump($this->session->userdata('token'));
  }

  private function formatDateDiff($start, $end=null) {
    if(!($start instanceof DateTime)) {
      $start = new DateTime($start);
    }

    if($end === null) {
      $end = new DateTime();
    }

    if(!($end instanceof DateTime)) {
      $end = new DateTime($start);
    }

    $interval = $end->diff($start);
    $doPlural = function($nb,$str){return $nb>1?$str.'s':$str;}; // adds plurals

    $format = array();
    if($interval->y !== 0) {
      $format[] = "%y ".$doPlural($interval->y, "année");
    }
    if($interval->m !== 0) {
      $format[] = "%m "."mois";
    }
    if($interval->d !== 0) {
      $format[] = "%d ".$doPlural($interval->d, "jour");
    }
    if($interval->h !== 0) {
      $format[] = "%h ".$doPlural($interval->h, "heure");
    }
    if($interval->i !== 0) {
      $format[] = "%i ".$doPlural($interval->i, "minute");
    }
    if($interval->s !== 0) {
      if(!count($format)) {
        return "less than a minute ago";
      } else {
        $format[] = "%s ".$doPlural($interval->s, "seconde");
      }
    }

    // We use the two biggest parts
    if(count($format) > 1) {
      $format = array_shift($format)." et ".array_shift($format);
    } else {
      $format = array_pop($format);
    }

    // Prepend 'since ' or whatever you like
    return $interval->format($format);
  }

}
