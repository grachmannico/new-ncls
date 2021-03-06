<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Outlet extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data_ou = $this->Outlet->get_all();
    $rows = $data_ou['data']->num_rows();
    $id = 'ot' . $this->nsu->zerofill_generator(7, $rows);

    $data['outlet'] = $this->Outlet->get_outlet_aktif('id, UPPER(jenis) as jenis, UPPER(alias_area) as alias_area, UPPER(nama_area) as nama_area, UPPER(nama_outlet) as nama_outlet, UPPER(kota) as kota, UPPER(nama_distributor) as nama_distributor, UPPER(alias_distributor) as alias_distributor, UPPER(nama_detailer) as nama_detailer, periode,UPPER(dispensing) as dispensing');
    $data['area'] = $this->Area->get_data('id, UPPER(nama) as nama, UPPER(alias_area) as alias_area');
    $data['distributor'] = $this->Dist_Subdist->get_data('id, UPPER(alias_distributor) as alias_distributor, UPPER(nama) as nama, UPPER(alias_area) as alias_area');
    $data['id'] = $id;
    $data['detailer'] = $this->Detailer->get_detailer_aktif('id, UPPER(nama_detailer) as nama_detailer, UPPER(alias_area) as alias_area');

    if ($data['outlet']['status'] == 'error') {
      $this->session->set_flashdata('query_msg', $data['outlet']['data']);
    }

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/master/outlet', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function store($operation = null)
  {
    $this->db->trans_begin();
    if ($operation == 'edit') {
      # code...
    } elseif ($operation == 'delete') {
      # code...
    } else {
      $input_var = $this->input->post();
      $input_var['id'] = $this->session->userdata('id_outlet');
      
      $this->Outlet->store($input_var);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', '<strong>Failed</strong> to save new Outlet.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Outlet has been <strong>saved</strong>.');
      }
      $this->session->unset_userdata('id_outlet');
    }

    redirect('/master-outlet');
  }


}