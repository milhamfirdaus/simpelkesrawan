<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Auth extends CI_Model {

    private $tbl_user_admin = 'tb_admin';
    private $tbl_ = 'tb_admin';
    private $tbl_member = 'tb_member';
    
    
    /**
     * @param string $username
     * @param string $password
     * @param string $opsi
     * @return object|boolean
     * @desc untuk memproses login dengan mencocokan data login dengan data yang terdapat di database
     */
    public function prosessLogin($username,$password,$statusLogin=false)
    {
        $this->tbl_ = $statusLogin !='member' ? $this->tbl_user_admin : $this->tbl_member;
        if($statusLogin != 'member'){
            $this->db->where(array(
                'adminUsername' => $username,
                'adminPassword' => sha1(sha1($password))
            ));
        }else{
            $this->db->where(array(
                'memberUsername' => $username,
                'memberPassword' => sha1(sha1($password))
            ))->or_where(array(
                'memberNIK' => $username,
                'memberPassword' => sha1(sha1($password))
            ));
        }
        $this->db->limit(1);
        $res = $this->db->get($this->tbl_);
        if($res->num_rows() > 0)
        {
            return $res->result()[0];
        }else{
            return false;
        }
    }
    
    public function registrasiMember($memberData)
    {
        $ins = $this->db->insert($this->tbl_member,$memberData);
        if($ins){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
    }
    
}
