<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Post');
        $this->load->library('upload');
        if(!$this->session->userdata('sess_admin_')){
            redirect('Auth/index');
        }
    }
	public function index()
	{
	    $data['title'] = 1;
	    
	    $data['page'] = 'Post';
		$this->load->view('admin/dtPost',$data);
	}
	public function gDataTablePost()
	{
        $this->M_Post->gDataTable();
    }
    public function insertKategori()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kategoriNama', 
        '', 'required',array('required'=>'Nama Kategori Tidak Boleh Kosong'));
        
        if ($this->form_validation->run() == false) :
        $json = array(
            'kategoriNama'=> form_error('kategoriNama', '', ''),
            
        );
        echo json_encode($json);
        else :
        $data = array(
            'kategoriNama'=> $this->input->post('kategoriNama'),
        );
        if($this->M_Post->insertKategori($data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
        endif;
    }
    public function updateKategori()
	{
	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('kategoriNama',
	        '', 'required',array('required'=>'Nama Kategori Tidak Boleh Kosong'));
	    
	    if ($this->form_validation->run() == false) :
	    $json = array(
	        'kategoriNama'=> form_error('kategoriNama', '', ''),
	    );
	    echo json_encode($json);
	    else :
	    $data = array(
	        'kategoriNama'=> $this->input->post('kategoriNama'),
	    );
	    $id = $this->input->post('kategoriID');
	    if($this->M_Post->updateKategori($id,$data)){
	        echo DATA_BERHASIL_DISIMPAN;
	    }else{
	        echo DATA_GAGAL_DISIMPAN;
	    }
	    endif;
	}
    public function getKategoriByID()
    {
        $id = $this->input->post('id');
        echo json_encode($this->M_Post->getKategoriByID($id));
    }
    public function gDataTableKategori()
	{
        $this->M_Post->gDataTableKategori();
    }
    public function getIDPost()
    {
        $id = $this->input->post('postID');
        echo json_encode($this->M_Post->getID($id));
    }
    public function insertPost()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('postJudul', 
        '', 'required',array('required'=>'Judul Postingan Tidak Boleh Kosong'));
        
        if ($this->form_validation->run() == false) :
        $json = array(
            'postJudul'=> form_error('postJudul', '', ''),
        );
        echo json_encode($json);
        else :

        $config['upload_path'] = './assets/img/post/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        
        $this->upload->initialize($config);
        $data = array();
        if(!empty($_FILES['featuredImage']['name']))
        {
            if ($this->upload->do_upload('featuredImage'))
            {
                $gbr = $this->upload->data();
                $data['postFeaturedImage'] = $gbr['file_name']; //Mengambil file name dari gambar yang diupload
            }else{
                echo "Gambar Gagal Upload. Gambar harus bertipe gif|jpg|png|jpeg|bmp";
            }
            
        }else{
            $data['postFeaturedImage'] = 'default.jpg';
        }
        $data['postJudul'] = $this->input->post('postJudul');
        $data['postKonten']= $this->input->post('postKonten');
        $data['kategori'] = $this->input->post('kategori');
        $data['video'] = $this->input->post('postYoutube');
        $data['publish'] = "1";
        $data['postTanggalInsert'] = date('Y-m-d H:i:s');
        if($this->M_Post->insert($data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
        endif;
    }
    public function deleteKategori(){
	    $data = array(
        'kategoriID'      =>   $this->input->post('id'),
	    );
        if($this->M_Post->deleteKategori($data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
	}
    public function deletePost(){
	    $data = array(
        'postID'      =>   $this->input->post('postID'),
	    );
        if($this->M_Post->delete($data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
	}
    public function updatePost()
	{
	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('postJudul',
	        '', 'required',array('required'=>'Judul Postingan Tidak Boleh Kosong'));
	    
	    if ($this->form_validation->run() == false) :
	    $json = array(
	        'postJudul'=> form_error('postJudul', '', ''),
	        
	    );
	    echo json_encode($json);
	    else :
	    $config['upload_path'] = './assets/img/post/'; //path folder
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	    $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
	    
	    $this->upload->initialize($config);
	    $data = array();
	    if(!empty($_FILES['featuredImage']['name']))
	    {
	        if ($this->upload->do_upload('featuredImage'))
	        {
                unlink(realpath('./').'/assets/img/post/'.$this->input->post('old_foto'));
	            $gbr = $this->upload->data();
	            $data['postFeaturedImage'] = $gbr['file_name']; //Mengambil file name dari gambar yang diupload
	        }else{
	            echo "Gambar Gagal Upload. Gambar harus bertipe gif|jpg|png|jpeg|bmp";
	        }
	        
	    }
	    $data['postJudul'] = $this->input->post('postJudul');
	    $data['postKonten']= $this->input->post('postKonten');
	    $data['kategori'] = $this->input->post('kategori');
	    $data['video'] = $this->input->post('postYoutube');
	    $data['publish'] = "1";
	    $data['postTanggalInsert'] = date('Y-m-d H:i:s');
	    $id = $this->input->post('postID');
	    if($this->M_Post->update($id,$data)){
	        echo DATA_BERHASIL_DISIMPAN;
	    }else{
	        echo DATA_GAGAL_DISIMPAN;
	    }
	    endif;
	}
	###################
	public function buatPost()
	{
	    $data['page'] = 'POST';
	    $data['kategori'] = $this->M_Post->getAllKategori();
	    $this->load->view('admin/buatPost',$data);
	}
	public function editPost($postID)
	{
	    $data['page'] = 'Edit POST';
	    $data['kategori'] = $this->M_Post->getAllKategori();
	    $data['dataPost'] = $this->M_Post->getID($postID);
	    $this->load->view('admin/editPost',$data);
	}
	public function previewPost($postID)
	{
	    $data['page'] = 'Post';
	    $data['dataPost'] = $this->M_Post->getID($postID);
	    $this->load->view('admin/previewPost',$data);
	}
	public function kategori()
	{
	    $data['page'] = 'Kategori';
	    $this->load->view('admin/dtKategori',$data);
	}
}
