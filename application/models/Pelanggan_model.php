<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelanggan_model extends CI_Model
{

    public $table = 'pelanggan';
    public $id = 'id_pelanggan';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_pelanggan', $q);
	$this->db->or_like('kd_pelanggan', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('id_wilayah', $q);
	$this->db->or_like('id_rt', $q);
	$this->db->or_like('id_rw', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('telp', $q);
	$this->db->or_like('biaya_daftar', $q);
	$this->db->or_like('id_layanan', $q);
	$this->db->or_like('tahun_tagihan_aktif', $q);
	$this->db->or_like('bulan_tagihan_aktif', $q);
	$this->db->or_like('tanggal_daftar', $q);
	$this->db->or_like('tanggal_nonaktif', $q);
	$this->db->or_like('aktif', $q);
	$this->db->or_like('ket', $q);
	$this->db->or_like('created_at', $q);
	$this->db->or_like('created_by', $q);
	$this->db->or_like('updated_at', $q);
	$this->db->or_like('updated_by', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_pelanggan', $q);
	$this->db->or_like('kd_pelanggan', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('id_wilayah', $q);
	$this->db->or_like('id_rt', $q);
	$this->db->or_like('id_rw', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('telp', $q);
	$this->db->or_like('biaya_daftar', $q);
	$this->db->or_like('id_layanan', $q);
	$this->db->or_like('tahun_tagihan_aktif', $q);
	$this->db->or_like('bulan_tagihan_aktif', $q);
	$this->db->or_like('tanggal_daftar', $q);
	$this->db->or_like('tanggal_nonaktif', $q);
	$this->db->or_like('aktif', $q);
	$this->db->or_like('ket', $q);
	$this->db->or_like('created_at', $q);
	$this->db->or_like('created_by', $q);
	$this->db->or_like('updated_at', $q);
	$this->db->or_like('updated_by', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Pelanggan_model.php */
/* Location: ./application/models/Pelanggan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-08-03 18:21:42 */
/* http://harviacode.com */