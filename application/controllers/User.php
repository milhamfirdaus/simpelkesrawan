<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    private $dataKecamatan;
    private $dataJenis;
    private $dataPost;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Spesies');
        $this->load->model('M_Kecamatan');
        $this->load->model('M_Desa');
        $this->load->model('M_Hewan');
        $this->load->model('M_Post');
        $this->load->helper('custom_helper');
        $this->dataJenis = $this->M_Spesies->getAllSpesies();
        $this->dataKecamatan = $this->M_Kecamatan->getAllKecamatan();
        $this->dataDesa = $this->M_Desa->getAllDesa();
    }
    
	public function index()
	{
	    $data['text_head'] = 'SICCAT BLOG';
	    $data['sub_text_head'] = 'Semua yang diinginkan pencinta kucing ada disinis';
	    $data['dataPost'] = $this->M_Post->getEvent(13);
	    $this->load->view('welcome_message');
	}

	public function beranda()
	{
	    $data['text_head'] = 'SCL';
	    $data['sub_text_head'] = 'All what needs to a traveler in Florence...Easly find places, guides, directions, info....';
	    $data['spesiesList'] = $this->dataJenis;
	    $data['desaList'] = $this->dataDesa;
	    $data['kecamatanList'] = $this->dataKecamatan;
	    $data['kategori'] = $this->M_Post->getAllKategori();
	    $this->load->view('user/home',$data);
	}

	public function getData()
	{
		if(!$this->session->userdata('sess_admin_') AND !$this->session->userdata('sess_member_')){
            redirect('member');
        }
	    $data['search_url'] = 'getData';
	    $this->load->library('pagination');
	    
	    $config['full_tag_open'] = '<ul class="pagination">';
	    $config['full_tag_close'] = '</ul>';
	    
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    
	    $config['cur_tag_open'] = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
	    
	    $config['first_link'] = '<i class="icon-angle-double-left"></i>';
	    $config['first_tag_open'] = '<li><span aria-hidden="true">';
	    $config['first_tag_close'] = '</span></li>';
	    
	    $config['last_link'] = '<i class="icon-angle-double-right"></i>';
	    $config['last_tag_open'] = '<li><span aria-hidden="true">';
	    $config['last_tag_close'] = '</span></li>';
	    
	    $config['prev_link'] = '<i class="icon-angle-left"></i>';
	    $config['prev_tag_open'] = '<li><span aria-hidden="true">';
	    $config['prev_tag_close'] = '</span></li>';
	    
	    $config['next_link'] = '<i class="icon-angle-right"></i>';
	    $config['next_tag_open'] = '<li><span aria-hidden="true">';
	    $config['next_tag_close'] = '</span></a></li>';
	    
	    $config['base_url'] = site_url('User/getData/');
	    $config['total_rows'] = $this->M_Hewan->getTotalRow();
	    $config['per_page'] = 8;
	    $this->pagination->initialize($config);		
	    $config['uri_segment'] =  ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	    
	    $data['spesiesList'] = $this->dataJenis;
	    $data['kecamatanList'] = $this->dataKecamatan;
	    $data['desaList'] = $this->dataDesa;
	    if($this->input->post('search')){
	        $data['dataBySpesiesID'] = $this->M_Hewan->getDataBySearch($config['per_page'],$config['uri_segment'],$this->input->post('search'));
	        $data['semuaDataHewan'] = $this->M_Hewan->getDataAllBySearch($this->input->post('search'));
	    }else{
    	    $data['dataBySpesiesID'] = $this->M_Hewan->getData($config['per_page'],$config['uri_segment']);
    	    $data['semuaDataHewan'] = $this->M_Hewan->getDataAll();
	    }
	    $this->load->view('user/dtHewan',$data);
	}
	public function byKecamatan($kecamatanID)
	{
	    $config['use_page_numbers'] = TRUE;
	    $config['reuse_query_string'] = TRUE;
	    
	    $config['full_tag_open'] = '<ul class="pagination">';
	    $config['full_tag_close'] = '</ul>';
	    
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    
	    $config['cur_tag_open'] = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
	    
	    $config['first_link'] = '<i class="icon-angle-double-left"></i>';
	    $config['first_tag_open'] = '<li><span aria-hidden="true">';
	    $config['first_tag_close'] = '</span></li>';
	    
	    $config['last_link'] = '<i class="icon-angle-double-right"></i>';
	    $config['last_tag_open'] = '<li><span aria-hidden="true">';
	    $config['last_tag_close'] = '</span></li>';
	    
	    $config['prev_link'] = '<i class="icon-angle-left"></i>';
	    $config['prev_tag_open'] = '<li><span aria-hidden="true">';
	    $config['prev_tag_close'] = '</span></li>';
	    
	    $config['next_link'] = '<i class="icon-angle-right"></i>';
	    $config['next_tag_open'] = '<li><span aria-hidden="true">';
	    $config['next_tag_close'] = '</span></a></li>';
	    /* $data is not changed */
	    $this->load->library('pagination');
	    $config['base_url'] = site_url('User/byKecamatan/').$kecamatanID.'/0';
	    $config['total_rows'] = $this->M_Kucing->getTotalRowByKecamatanID($kecamatanID);
	    $config['per_page'] = 4;
	    $this->pagination->initialize($config);
	    $config['uri_segment'] =  ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
	    $data['spesiesList'] = $this->dataJenis;
		$data['kecamatanList'] = $this->dataKecamatan;
	    $data['desaList'] = $this->dataDesa;
	    $data['dataByKecamatanID'] = $this->M_Kucing->getKecamatan($kecamatanID,$config['per_page'],$config['uri_segment']);
	    $this->load->view('user/byKecamatan',$data);
	}
	public function byDesa($desaID)
	{
	    $config['use_page_numbers'] = TRUE;
	    $config['reuse_query_string'] = TRUE;
	    
	    $config['full_tag_open'] = '<ul class="pagination">';
	    $config['full_tag_close'] = '</ul>';
	    
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    
	    $config['cur_tag_open'] = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
	    
	    $config['first_link'] = '<i class="icon-angle-double-left"></i>';
	    $config['first_tag_open'] = '<li><span aria-hidden="true">';
	    $config['first_tag_close'] = '</span></li>';
	    
	    $config['last_link'] = '<i class="icon-angle-double-right"></i>';
	    $config['last_tag_open'] = '<li><span aria-hidden="true">';
	    $config['last_tag_close'] = '</span></li>';
	    
	    $config['prev_link'] = '<i class="icon-angle-left"></i>';
	    $config['prev_tag_open'] = '<li><span aria-hidden="true">';
	    $config['prev_tag_close'] = '</span></li>';
	    
	    $config['next_link'] = '<i class="icon-angle-right"></i>';
	    $config['next_tag_open'] = '<li><span aria-hidden="true">';
	    $config['next_tag_close'] = '</span></a></li>';
	    /* $data is not changed */
	    $this->load->library('pagination');
	    $config['base_url'] = site_url('User/byKecamatan/').$kecamatanID.'/0';
	    $config['total_rows'] = $this->M_Kucing->getTotalRowByKecamatanID($kecamatanID);
	    $config['per_page'] = 4;
	    $this->pagination->initialize($config);
	    $config['uri_segment'] =  ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
	    $data['spesiesList'] = $this->dataJenis;
		$data['kecamatanList'] = $this->dataKecamatan;
	    $data['desaList'] = $this->dataDesa;
	    $data['dataByKecamatanID'] = $this->M_Kucing->getKecamatan($kecamatanID,$config['per_page'],$config['uri_segment']);
	    $this->load->view('user/byKecamatan',$data);
	}
	public function post()
	{
	    $data['search_url'] = 'post';
	    $this->load->library('pagination');
	    $config['full_tag_open'] = '<ul class="pagination">';
	    $config['full_tag_close'] = '</ul>';
	    
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    
	    $config['cur_tag_open'] = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
	    
	    $config['first_link'] = '<i class="icon-angle-double-left"></i>';
	    $config['first_tag_open'] = '<li><span aria-hidden="true">';
	    $config['first_tag_close'] = '</span></li>';
	    
	    $config['last_link'] = '<i class="icon-angle-double-right"></i>';
	    $config['last_tag_open'] = '<li><span aria-hidden="true">';
	    $config['last_tag_close'] = '</span></li>';
	    
	    $config['prev_link'] = '<i class="icon-angle-left"></i>';
	    $config['prev_tag_open'] = '<li><span aria-hidden="true">';
	    $config['prev_tag_close'] = '</span></li>';
	    
	    $config['next_link'] = '<i class="icon-angle-right"></i>';
	    $config['next_tag_open'] = '<li><span aria-hidden="true">';
	    $config['next_tag_close'] = '</span></a></li>';
	    
	    $config['base_url'] = site_url('User/post/');
	    $config['total_rows'] = $this->M_Post->getTotalRowPost();
	    $config['per_page'] = 4;
	    $this->pagination->initialize($config);
	    $config['uri_segment'] =  ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	    
	    $data['text_head'] = 'SICCAT BLOG';
	    $data['sub_text_head'] = 'Semua yang diinginkan pencinta kucing ada disinis';
	    $data['spesiesList'] = $this->dataJenis;
	    $data['kecamatanList'] = $this->dataKecamatan;
	    $data['kategori'] = $this->M_Post->getAllKategori();
	    if($this->input->post('search')){
	        $data['dataPost'] = $this->M_Post->getAllBySearch($config['per_page'],$config['uri_segment'],$this->input->post('search'));
	    }else{
    	    $data['dataPost'] = $this->M_Post->getAll($config['per_page'],$config['uri_segment']);
	    }
	    $this->load->view('user/post',$data);
	}
	public function event()
	{
	    $config['use_page_numbers'] = TRUE;
	    $config['reuse_query_string'] = TRUE;
	    
	    $config['full_tag_open'] = '<ul class="pagination">';
	    $config['full_tag_close'] = '</ul>';
	    
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    
	    $config['cur_tag_open'] = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
	    
	    $config['first_link'] = '<i class="icon-angle-double-left"></i>';
	    $config['first_tag_open'] = '<li><span aria-hidden="true">';
	    $config['first_tag_close'] = '</span></li>';
	    
	    $config['last_link'] = '<i class="icon-angle-double-right"></i>';
	    $config['last_tag_open'] = '<li><span aria-hidden="true">';
	    $config['last_tag_close'] = '</span></li>';
	    
	    $config['prev_link'] = '<i class="icon-angle-left"></i>';
	    $config['prev_tag_open'] = '<li><span aria-hidden="true">';
	    $config['prev_tag_close'] = '</span></li>';
	    
	    $config['next_link'] = '<i class="icon-angle-right"></i>';
	    $config['next_tag_open'] = '<li><span aria-hidden="true">';
	    $config['next_tag_close'] = '</span></a></li>';
	    /* $data is not changed */
	    $this->load->library('pagination');
	    $config['base_url'] = site_url('User/event/');
	    $config['total_rows'] = $this->M_Post->getTotalRowPostEvent();
	    $this->pagination->initialize($config);
	    $config['per_page'] = 4;
	    $data['text_head'] = 'SICCAT BLOG';
	    $data['sub_text_head'] = 'Semua yang diinginkan pencinta kucing ada disinis';
	    $data['spesiesList'] = $this->dataJenis;
	    $data['kecamatanList'] = $this->dataKecamatan;
	    $data['kategori'] = $this->M_Post->getAllKategori();
	    $data['dataPost'] = $this->M_Post->getPostByKat(13);
	    $this->load->view('user/event',$data);
	}
	public function kategori($kategoriID)
	{
	    $config['use_page_numbers'] = TRUE;
	    $config['reuse_query_string'] = TRUE;
	    
	    $config['full_tag_open'] = '<ul class="pagination">';
	    $config['full_tag_close'] = '</ul>';
	    
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    
	    $config['cur_tag_open'] = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
	    
	    $config['first_link'] = '<i class="icon-angle-double-left"></i>';
	    $config['first_tag_open'] = '<li><span aria-hidden="true">';
	    $config['first_tag_close'] = '</span></li>';
	    
	    $config['last_link'] = '<i class="icon-angle-double-right"></i>';
	    $config['last_tag_open'] = '<li><span aria-hidden="true">';
	    $config['last_tag_close'] = '</span></li>';
	    
	    $config['prev_link'] = '<i class="icon-angle-left"></i>';
	    $config['prev_tag_open'] = '<li><span aria-hidden="true">';
	    $config['prev_tag_close'] = '</span></li>';
	    
	    $config['next_link'] = '<i class="icon-angle-right"></i>';
	    $config['next_tag_open'] = '<li><span aria-hidden="true">';
	    $config['next_tag_close'] = '</span></a></li>';
	    /* $data is not changed */
	    $this->load->library('pagination');
	    $config['base_url'] = site_url('User/kategori/'.$kategoriID.'/0');
	    $config['total_rows'] = $this->M_Post->getTotalRowKategori($kategoriID);
	    $config['per_page'] = 4;
	    $this->pagination->initialize($config);
	    $data['text_head'] = 'Kategori';
	    $data['sub_text_head'] = 'Semua yang diinginkan pencinta kucing ada disinis';
	    $data['spesiesList'] = $this->dataJenis;
	    $data['kecamatanList'] = $this->dataKecamatan;
	    $data['kategori'] = $this->M_Post->getAllKategori();
	    $data['gKategoriNamaByID'] = $this->M_Post->gKategoriNamaByID($kategoriID);
	    $data['dataPost'] = $this->M_Post->getPostByKat($kategoriID);
	    $this->load->view('user/kategori',$data);
	}
	public function detailhewan($hewanID)
	{	
		if(!$this->session->userdata('sess_admin_') AND !$this->session->userdata('sess_member_')){
            redirect('member	');
        }
	    $data['text_head'] = 'Kategori';
	    $data['sub_text_head'] = 'Semua yang diinginkan pencinta kucing ada disini';
	    $data['spesiesList'] = $this->dataJenis;
	    $data['kecamatanList'] = $this->dataKecamatan;
	    $data['kategori'] = $this->M_Post->getAllKategori();
	    $data['dataHewan'] = $this->M_Hewan->getID($hewanID);
		$this->load->view('user/detailhewan',$data);
		
	}
	public function singlePost($postID=NULL)
	{
	    $data['search_url'] = 'singlePost';
	    $data['text_head'] = 'Kategori';
	    $data['sub_text_head'] = 'Semua yang diinginkan pencinta kucing ada disini';
	    $data['spesiesList'] = $this->dataJenis;
	    $data['kecamatanList'] = $this->dataKecamatan;
	    $data['kategori'] = $this->M_Post->getAllKategori();
	    $get= $data['dataPost'] = $this->M_Post->getID($postID);
	    $kategori = $get->kategori;
	    $data['dataRelated'] = $this->M_Post->getRelatedPost($kategori);
	    $this->load->view('user/singlePost',$data);
	}
	
}
