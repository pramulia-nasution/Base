<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_1 extends CI_Controller {

	private $parents = 'Menu_1';
	private $icon	 = 'fa fa-database';
	var $table 		 = 'pengguna';

	function __construct(){
		parent::__construct();

		is_login();
		get_breadcrumb();
		$this->load->model('M_'.$this->parents,'mod');
		$this->load->library('form_validation');
		$this->load->library('Datatables'); 
	}

	public function index(){

		$this->breadcrumb->append_crumb('SIM ','Beranda');
		$this->breadcrumb->append_crumb($this->parents,$this->parents);

		$data['title']	= $this->parents.' | SIM ';
		$data['judul']	= $this->parents;
		$data['icon']	= $this->icon;

	$this->template->views('v_'.$this->parents,$data);
	}

	function getData (){
		header('Content-Type:application/json');
		echo $this->mod->getAllData();
	}


	public function edit($id){
		$data = $this->M_General->getByID($this->table,'id',$id,'id')->row();
		echo json_encode($data);
	}

	function Simpan(){
        $insert = array(
                    'nama'  	=> filter_string(ucwords($this->input->post('nama'),TRUE)),
                    'gender'	=> $this->input->post('gender',TRUE),
                    'agama' 	=> $this->input->post('agama',TRUE),
                    'tanggal'	=> filter_string($this->input->post('tanggal',TRUE))
                );

        if (!empty($_FILES['gambar']['name'])){
        	$gambar = $this->_upload_gambar();
        	$insert['gambar'] = $gambar;
        }
        $insert = $this->M_General->insert($this->table,$insert);
        $data['status'] = TRUE;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function _upload_gambar (){
		$this->load->library('upload');
        $config['upload_path'] 	 = './assets/images/';
        $config['max_size']      = 1024;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->upload->initialize($config);
        if(!empty($_FILES['gambar']['name'])){
        	if($this->upload->do_upload('gambar')){
        		$gbr = $this->upload->data();
        		return $gbr['file_name'];
        	}else{
        		$this->session->set_flashdata('error',$this->upload->dsisplay_errors());
        	}
        }else{
        	 return '';
        }
    }

	function Ubah(){
        $insert = array(
                    'nama'  	=> filter_string(ucwords($this->input->post('nama'),TRUE)),
                    'gender'	=> $this->input->post('gender',TRUE),
                    'agama' 	=> $this->input->post('agama',TRUE),
                    'tanggal'	=> filter_string($this->input->post('tanggal',TRUE))
                );
        $insert = $this->M_General->update($this->table,$insert,'id',$this->input->post('id'));
        $data['status'] = TRUE;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function Hapus($id){
		$data = $this->M_General->getByID($this->table,'id',$id,'id')->row_array();
		if (file_exists($path ='./assets/images/'.$data['gambar'])){ 	
        	unlink($path);
        }
		$this->M_General->delete($this->table,'id',$id);
		$data['status'] = TRUE;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}

/* End of file Menu-1.php */
/* Location: ./application/controllers/Menu-1.php */