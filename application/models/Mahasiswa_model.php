<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model{
	
	function connect () {
		$this->db->select(['mahasiswa.*','pot.pot']);
		$this->db->join('pot', 'pot.id = mahasiswa.pot');
		return $this->db->get("mahasiswa");
	}

	function getMahasiswa(){
		return $this->db->get('mahasiswa');
	}

	function hapusData($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}
}