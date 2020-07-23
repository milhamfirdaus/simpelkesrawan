<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('sess_admin_') AND !$this->session->userdata('sess_member_')){
            redirect('auth');
        }else{
            $this->load->model('M_Hewan');
            $this->load->model('M_Post');
            $this->load->model('M_Kecamatan');
            $this->load->model('M_Desa');
            $this->load->model('M_Spesies');
        }
    }
	public function index()
	{
	    $data['jumlahHewan'] = $this->M_Hewan->getTotalRow();
	    $data['jumlahPost'] = $this->M_Post->getTotalRowPost();
	    $data['jumlahSpesies'] = $this->M_Spesies->getTotalRowSpesies();
	    $data['jumlahKecamatan'] = $this->M_Kecamatan->getTotalRowKecamatan();
	    $data['jumlahDesa'] = $this->M_Desa->getTotalRowDesa();
        
        
        if($this->session->userdata('sess_admin_') AND !$this->session->userdata('sess_member_')){
            $this->load->view('admin/dashboard',$data);
        }

        else if($this->session->userdata('sess_komunitas') AND !$this->session->userdata('sess_member_')){
            $this->load->view('komunitas/dashboard',$data);
        }
        
        else{
            $this->load->view('member/dashboard',$data);
        }
	}
}
