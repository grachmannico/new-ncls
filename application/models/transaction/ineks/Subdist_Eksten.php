<?php 

class Subdist_Eksten extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data = array())
  {
    $query = $this->db->set($data)->get_compiled_insert('subdist_eksten');
    $this->db->query($query);
  }

}