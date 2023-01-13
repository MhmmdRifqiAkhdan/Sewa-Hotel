<?php
defined('BASEPATH') or exit ('No Direct Script Access Allowed');

class M_hotel extends CI_Model{
	function edit_data($where,$table){
		return $this->db->get_where($table,$where);
	}

	function get_data($table){
		return $this->db->get($table);
	}

	function insert_data($data,$table){
		$this->db->insert($table,$data);
	}

	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	function delete_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	function kode_otomatis(){
		$this->db->select('right(id_sewa,3) as kode', false);
		$this->db->order_by('id_sewa','desc');
		$this->db->limit(1);
		$query=$this->db->get('penyewaan');
		if($query->num_rows()<>0){
			$data=$query->row();
			$kode=intval($data->kode)+1;
		}else{
			$kode=1;
		}

		$kodemax=str_pad($kode,3,"0", STR_PAD_LEFT);
		$kodejadi='PJ'.$kodemax;

		return $kodejadi;
	}

}