<?php
class Produk extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }
    public function get_all($column = '*')
    {
        $this->db->select($column);
        $result = $this->db->get('produk');
        if (!$result) {
            $ret_val = array(
                'status' => 'error',
                'data'   => $this->db->error(),
            );
        } else {
            $ret_val = array(
                'status' => 'success',
                'data'   => $result,
            );
        }
        return $ret_val;
    }
    public function get_data($column = '*')
    {
        $this->db->select($column);
        $this->db->where('hapus', null);
        $result = $this->db->get('v_produk');
        if (!$result) {
            $ret_val = array(
                'status' => 'error',
                'data'   => $this->db->error(),
            );
        } else {
            $ret_val = array(
                'status' => 'success',
                'data'   => $result,
            );
        }
        return $ret_val;
    }
    public function get_produk_harga($value='')
    {
        $this->db->select($column);
        $this->db->where('hapus', null);
        $result = $this->db->get('v_produk_harga');
        if (!$result) {
            $ret_val = array(
                'status' => 'error',
                'data'   => $this->db->error(),
            );
        } else {
            $ret_val = array(
                'status' => 'success',
                'data'   => $result,
            );
        }
        return $ret_val;
    }
    public function store($data = array())
    {
        $query = $this->db->set($data)->get_compiled_insert('produk');
        $this->db->query($query);
    }
    public function update($id, $data = array())
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $query = $this->db->get_compiled_insert('produk');
        $this->db->query($query);
    }
    public function destroy($id)
    {
        $this->db->set('hapus', date('Y-m-d'));
        $this->db->where('id', $id);
        $query = $this->db->get_compiled_insert('produk');
        $this->db->query($query);
    }
}
