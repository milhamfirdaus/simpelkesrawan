<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
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

        $this->load->view('member/login');
        
    }

    public function registrasi()
    {
        $user_session = $this->session->userdata;
        if(isset($user_session['sess_admin_'])){
            redirect('dashboard');
        }
        else if(isset($user_session['sess_member_'])){
            redirect('dashboard');
        }
        $this->load->view('member/registrasi');
    }

    public function prosesRegistrasi(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('memberNamaLengkap','','trim|required',array('required' => 'Nama Lengkap Tidak Boleh Kosong !'));
        $this->form_validation->set_rules('memberEmail','','trim|required|valid_email|is_unique[tb_member.memberEmail]',array('required' => 'Email Tidak Boleh Kosong !','valid_email'=>'Email tidak valid','is_unique'=>'Email ini sudah terdaftar, gunakan Email yang lain '));
        $this->form_validation->set_rules('memberUsername','','trim|required|is_unique[tb_member.memberUsername]',array('required' => 'Username Tidak Boleh Kosong !','is_unique'=>'Username sudah digunakan, silahkan gunakan username yang lain'));
        $this->form_validation->set_rules('memberPassword','','trim|required',array('required' => 'Password Tidak Boleh Kosong !'));
        $this->form_validation->set_rules('memberNIK','','trim|required|is_unique[tb_member.memberNIK]|min_length[16]|numeric',array('required' => 'NIK Tidak Boleh Kosong !','is_unique'=>'NIK sudah terdaftar, silahkan hubungi Puskeswan apabila ada kesalahan','min_length' => 'Harap input NIK sesuai yang tercantum pada KTP','numeric' => 'NIK yang di input harus berupa angka!'));
        $this->form_validation->set_rules('memberHandphone','','trim|required|min_length[10]|numeric',array('required' => 'Handphone Tidak Boleh Kosong !','min_length' => 'Harap input Nomor Handphone dengan benar','numeric' => 'Input Angka!'));
        if($this->form_validation->run() == false){
            $json = array(
                'memberNamaLengkap' => form_error('memberNamaLengkap','',''),
                'memberNIK' => form_error('memberNIK','',''),
                'memberEmail' => form_error('memberEmail','',''),
                'memberUsername' => form_error('memberUsername','',''),
                'memberPassword' => form_error('memberPassword','',''),
                'memberHandphone' => form_error('memberHandphone','','')
            );
            echo json_encode($json);
        }else{
            $data = array(
                'memberNamaLengkap' => $this->input->post('memberNamaLengkap'),
                'memberNIK' => $this->input->post('memberNIK'),
                'memberEmail' => $this->input->post('memberEmail'),
                'memberUsername' => $this->input->post('memberUsername'),
                'memberPassword' => sha1(sha1($this->input->post('memberPassword'))),
                'memberHandphone' => $this->input->post('memberHandphone')
            );
            $this->M_Auth->registrasiMember($data);
        }
    }
    /**
     * @param boolean $opsi
     * @desc memproses data login oleh siswa dan admin
     */
    public function prosessLogin($opsi = false)
    {
        $res = $this->M_Auth->prosessLogin($this->input->post('memberUsername'),$this->input->post('memberPassword'),'member');
        $status=$res->verified;

        if(!$res){
            echo LOGIN_GAGAL;
        }
        else if($status!="1"){
            echo NOT_VERIFIED;
        }
        else{
            $this->session->unset_userdata('sess_admin_');
            $this->session->set_userdata(array('sess_member_'=>$res));
            echo LOGIN_BERHASIL;
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
