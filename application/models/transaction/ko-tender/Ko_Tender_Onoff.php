<?php 

class Ko_Tender_Onoff extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data = array())
  {
    $query = $this->db->set($data)->get_compiled_insert('ko_tender_onoff');
    $this->db->query($query);
  }

}