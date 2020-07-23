<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_User extends CI_Model {
    private $tbl_ = 'tb_member';
    
    public function insert($data){
        $res = $this->db->insert($this->tbl_,$data);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    public function delete($id){
        $res = $this->db->delete($this->tbl_,$id);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    public function update($id,$data){
        $this->db->where('memberID',$id);
        $res = $this->db->update($this->tbl_,$data);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    public function getTotalRowMember(){
        $res = $this->db->get('tb_member');
        return $res->num_rows();
    }
    public function getMember(){
        /*Menagkap semua data yang dikirimkan oleh client*/
        
        /*Sebagai token yang yang dikrimkan oleh client, dan nantinya akan
         server kirimkan balik. Gunanya untuk memastikan bahwa user mengklik paging
         sesuai dengan urutan yang sebenarnya */
        @$draw=$_REQUEST['draw'];
        
        /*Jumlah baris yang akan ditampilkan pada setiap page*/
        @$length=$_REQUEST['length'];
        
        /*Offset yang akan digunakan untuk memberitahu database
         dari baris mana data yang harus ditampilkan untuk masing masing page
         */
        @$start=$_REQUEST['start'];
        
        /*Keyword yang diketikan oleh user pada field pencarian*/
        @$search=$_REQUEST['search']["value"];
        
        /*Menghitung total desa didalam database*/
        $total=$this->db->count_all_results($this->tbl_);
        
        /*Mempersiapkan array tempat kita akan menampung semua data
         yang nantinya akan server kirimkan ke client*/
        $output=array();
        
        /*Token yang dikrimkan client, akan dikirim balik ke client*/
        $output['draw']=$draw;
        /*
         $output['recordsTotal'] adalah total data sebelum difilter
         $output['recordsFiltered'] adalah total data ketika difilter
         Biasanya kedua duanya bernilai sama, maka kita assignment
         keduaduanya dengan nilai dari $total
         */
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        
        /*disini nantinya akan memuat data yang akan kita tampilkan
         pada table client*/
        $output['data']=array();
        
        /*Jika $search mengandung nilai, berarti user sedang telah
         memasukan keyword didalam filed pencarian*/
        if($search!=""){
            $this->db->like("memberNamaLengkap",$search);
        }
        /*Lanjutkan pencarian ke database*/
        $this->db->where("verified","1");
        $this->db->limit($length,$start);
        /*Urutkan dari alphabet paling terkahir*/
        $this->db->join('tb_desa','tb_desa.desaID=tb_member.desaID',"left");
        $this->db->order_by("{$this->tbl_}.memberID",'DESC');
        $query=$this->db->get($this->tbl_);
        
        /*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai
         dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
         yang mengandung keyword tertentu
         */
        if($search!=""){
            $this->db->like("memberNamaLengkap",$search);
            $jum=$this->db->get($this->tbl_);
            $output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
        }
        
        $nomor_urut=$start+1;
        foreach ($query->result_array() as $data) {
            $output['data'][]=array(
                    $nomor_urut,
                    $data['memberNIK'],
                    $data['memberNamaLengkap'],
                    "0".$data['memberHandphone'],
                    $data['desaID'],
                    "<button class='edit btn btn-sm btn-success waves-effect waves-light' data-id='{$data['memberID']}'> Edit</button>
                    <button class='hapus btn btn-danger btn-sm waves-effect waves-light' data-id='{$data['memberID']}'> Hapus</button>"
                );
            $nomor_urut++;
        }
        echo json_encode($output);
    }
    public function getID($id){

        $this->db->select('tb_member.*,tb_desa.*,kecamatanNama');
        $this->db->join('tb_desa','tb_desa.desaID=tb_member.desaID','left');
        $this->db->join('tb_kecamatan','tb_kecamatan.kecamatanID=tb_desa.parent_id','left');
        $this->db->where('memberID',$id);
        $this->db->limit(1);
        $res = $this->db->get($this->tbl_);
        if($res->num_rows() > 0){
            return $res->result()[0];
        }else{
            return false;
        }
    }
    ######################################
    public function getAllMember(){
        $res = $this->db->get($this->tbl_);
        if($res->num_rows() > 0){
            return $res->result();
        }
        return false;
    }
    public function vMember(){
        /*Menagkap semua data yang dikirimkan oleh client*/
        
        /*Sebagai token yang yang dikrimkan oleh client, dan nantinya akan
         server kirimkan balik. Gunanya untuk memastikan bahwa user mengklik paging
         sesuai dengan urutan yang sebenarnya */
        @$draw=$_REQUEST['draw'];
        
        /*Jumlah baris yang akan ditampilkan pada setiap page*/
        @$length=$_REQUEST['length'];
        
        /*Offset yang akan digunakan untuk memberitahu database
         dari baris mana data yang harus ditampilkan untuk masing masing page
         */
        @$start=$_REQUEST['start'];
        
        /*Keyword yang diketikan oleh user pada field pencarian*/
        @$search=$_REQUEST['search']["value"];
        
        /*Menghitung total desa didalam database*/
        $total=$this->db->count_all_results($this->tbl_);
        
        /*Mempersiapkan array tempat kita akan menampung semua data
         yang nantinya akan server kirimkan ke client*/
        $output=array();
        
        /*Token yang dikrimkan client, akan dikirim balik ke client*/
        $output['draw']=$draw;
        /*
         $output['recordsTotal'] adalah total data sebelum difilter
         $output['recordsFiltered'] adalah total data ketika difilter
         Biasanya kedua duanya bernilai sama, maka kita assignment
         keduaduanya dengan nilai dari $total
         */
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        
        /*disini nantinya akan memuat data yang akan kita tampilkan
         pada table client*/
        $output['data']=array();
        
        /*Jika $search mengandung nilai, berarti user sedang telah
         memasukan keyword didalam filed pencarian*/
        if($search!=""){
            $this->db->like("memberNamaLengkap",$search);
        }
        /*Lanjutkan pencarian ke database*/
        $this->db->where("verified","0")->or_where("verified","2");
        $this->db->limit($length,$start);
        /*Urutkan dari alphabet paling terkahir*/
        $this->db->join('tb_desa','tb_desa.desaID=tb_member.desaID',"left");
        $this->db->order_by("{$this->tbl_}.memberID",'DESC');
        $query=$this->db->get($this->tbl_);
        
        /*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai
         dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
         yang mengandung keyword tertentu
         */
        if($search!=""){
            $this->db->like("memberNamaLengkap",$search);
            $jum=$this->db->get($this->tbl_);
            $output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
        }
        
        $nomor_urut=$start+1;
        foreach ($query->result_array() as $data) {
            
            if ($data['verified'] == 1){
                $print = '<span class="text-success"><strong>Data Valid</strong></span>';
            } 
            else if($data['verified'] == 0){
                $print = '<span class="text-info">Menunggu Validasi oleh Admin</span>';
            }
            else if($data['verified'] == 2){
                $print = '<span class="text-danger"><strike>Data tidak Valid</strike></span>';
            }

            $output['data'][]=array(
                    $nomor_urut,
                    $data['memberNIK'],
                    $data['memberNamaLengkap'],
                    $data['memberHandphone'],
                    $data['desaID'],
                    "<a href='".site_url('verifikasi/previewMember/')."{$data['memberID']}' class='edit btn btn-sm btn-info waves-effect waves-light'> Preview</a>
                    <button class='hapus btn btn-danger btn-sm waves-effect waves-light' data-id='{$data['memberID']}'> Hapus</button>"
                );
            $nomor_urut++;
        }
        echo json_encode($output);
    }
}