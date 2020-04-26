<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Menu_1 extends CI_Model {

	function getAllData(){
		$this->datatables->select('id,nama,gender,tanggal,agama');
		$this->datatables->from('pengguna');
		$this->datatables->add_column('view','<center><a href="javascript:void(0)" onclick="Ubah($1)" class="btn btn-warning btn-xs"> Ubah</a> <a href="javascript:void(0)" class="btn btn-danger btn-xs" onclick="Hapus($1)"> Hapus</a></center> ','id');
		return $this->datatables->generate();
	}
	

}

/* End of file m_Menu_1.php */
/* Location: ./application/models/m_Menu_1.php */