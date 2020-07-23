<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komunitas extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model(array('M_Auth'));
        $this->load->library('upload');
    }

	public function index(){
    	$this->load->view('komunitas/login');
    }

    public function prosessLogin($opsi = false){
        $this->form_validation->set_rules('adminUsername','','trim|required',
            array(
                'required'  => 'Maaf username tidak boleh kosong !',
            )
        );
        $this->form_validation->set_rules('adminPassword','','trim|required',
            array(
                'required'  => 'Maaf password tidak boleh kosong !',
            )
        );
        if($this->form_validation->run() == false)
        {
            $json = array(
                'adminUsername'  => form_error('adminUsername', '', ''),
                'adminPassword'  => form_error('adminPassword', '', '')
            );
            echo json_encode($json);
        }else{
            $res = $this->M_Auth->prosessLogin($this->input->post('adminUsername'),$this->input->post('adminPassword'));
            if(!$res){
                echo LOGIN_GAGAL;
            }else{
                $this->session->unset_userdata('sess_member_');
                $this->session->unset_userdata('sess_admin_');
                $this->session->set_userdata(array('sess_komunitas_'=>$res));
                echo LOGIN_BERHASIL;
            }
        }
    }

    public function logout(){
        $this->session->unset_userdata('sess_admin_');
        $this->session->unset_userdata('sess_member_');
        $this->session->unset_userdata('sess_komunitas_');
        redirect(site_url());
    }

    public function getSession(){
        print '<pre>';
        print_r($_SESSION);
        print '</pre>';
    }

}
