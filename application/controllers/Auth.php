<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    private $statusUser;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_Auth');

        
    }
    /**
     * @param boolean $opsi
     * 
     */
    public function index()
    {   
        $user_session = $this->session->userdata;
        if(isset($user_session['sess_admin_'])){
            redirect('dashboard');
        }
        else if(isset($user_session['sess_member_'])){
            redirect('dashboard');
        }
        $this->load->view('auth');
        
    }

    public function login()
    {   
        $user_session = $this->session->userdata;
        if(isset($user_session['sess_admin_'])){
            redirect('dashboard');
        }
        else if(isset($user_session['sess_member_'])){
            redirect('dashboard');
        }
        $this->load->view('admin/login');
        
    }

    /**
     * @param boolean $opsi
     * @desc memproses data login oleh siswa dan admin
     */
    public function prosessLogin($opsi = false)
    {
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
                $this->session->set_userdata(array('sess_admin_'=>$res));
                echo LOGIN_BERHASIL;
            }
        }
    }
    /**
     * @desc untuk menghapus/destroying session
     */
    public function logout()
    {
        $this->session->unset_userdata('sess_member_');
        $this->session->unset_userdata('sess_admin_');
        redirect(site_url());
    }
    /**
     * @desc mendapatkan informasi session
     */
    public function getSession()
    {
        print '<pre>';
        print_r($_SESSION);
        print '</pre>';
    }
}
