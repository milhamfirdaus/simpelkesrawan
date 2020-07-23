<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Kecamatan');
        $this->load->model('M_Desa');
        if(!$this->session->userdata('sess_admin_') AND !$this->session->userdata('sess_member_')){
            redirect('auth');
        }
        
    }

    public function index()
	{
        if(!$this->session->userdata('sess_admin_')){
            redirect('auth');
        }
	    $data['page'] = 'Kelurahan';
	    $data['data_kecamatan'] = $this->M_Kecamatan->getAllKecamatan();
	    $this->load->view('admin/dtDesa',$data);
    }
    
    public function getDesa(){
        $this->M_Desa->gDataTable();
    }

    public function insertDesa(){
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('desaNama',
        '', 'required',array('required'=>'Nama Desa Tidak Boleh Kosong'));
        $this->form_validation->set_rules('kecamatan',
        '', 'required',array('required'=>'Kecamatan Tidak Boleh Kosong'));
        
        if ($this->form_validation->run() == false) :
        $json = array(
            'desaNama'=> form_error('desaNama', '', ''),
            'kecamatan'=> form_error('kecamatan', '', ''),
        );
        echo json_encode($json);
        else :
        $data = array(
            'namaDesa'=> $this->input->post('desaNama'),
            'parent_id'=> $this->input->post('kecamatan'),
        );
        if($this->M_Desa->insert($data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
        endif;
    }

    public function updateDesa(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('desaNama',
            '', 'required',array('required'=>'Nama Desa Tidak Boleh Kosong'));
        if ($this->form_validation->run() == false) :
        $json = array(
            'desaNama'=> form_error('desaNama', '', ''),
        );
        echo json_encode($json);
        else :
        $data = array(
            'namaDesa'=> $this->input->post('desaNama'),
            'parent_id'=> $this->input->post('kecamatan'),
        );
        $id = $this->input->post('desaID');
        if($this->M_Desa->update($id,$data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
        endif;
    }
    public function deleteDesa(){
        $data = array(
            'desaID'=>$this->input->post('desaID'),
        );
        if($this->M_Desa->delete($data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
    }
    public function getDesaID(){
        $id = $this->input->post('desaID');
        echo json_encode($this->M_Desa->getID($id));
    }

    public function getByKecamatan(){
        $kecamatan = $this->input->post('kecamatan');
        echo json_encode(array('data_desa' => $this->M_Desa->getByKecamatan($kecamatan)));
    }
}