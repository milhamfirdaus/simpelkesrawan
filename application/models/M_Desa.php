<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Desa extends CI_Model {
    private $tbl_ = 'tb_desa';
    
    public function rules(){
    }

    public function insert($data)
    {
        $res = $this->db->insert($this->tbl_,$data);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    public function delete($id)
    {
        $res = $this->db->delete($this->tbl_,$id);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    public function update($id,$data)
    {
        $this->db->where('desaID',$id);
        $res = $this->db->update($this->tbl_,$data);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    public function getTotalRowDesa()
    {
        $res = $this->db->get('tb_desa');
        return $res->num_rows();
    }
    public function gDataTable()
    {
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
            $this->db->like("namaDesa",$search);
        }
        /*Lanjutkan pencarian ke database*/
        $this->db->limit($length,$start);
        /*Urutkan dari alphabet paling terkahir*/
        $this->db->join('tb_kecamatan','tb_kecamatan.kecamatanID=tb_desa.parent_id',"left");
        $this->db->order_by("{$this->tbl_}.desaID",'DESC');
        $query=$this->db->get($this->tbl_);
        
        /*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai
         dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
         yang mengandung keyword tertentu
         */
        if($search!=""){
            $this->db->like("namaDesa",$search);
            $jum=$this->db->get($this->tbl_);
            $output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
        }
        
        $nomor_urut=$start+1;
        foreach ($query->result_array() as $data) {
            $output['data'][]=array(
                    $nomor_urut,
                    $data['namaDesa'],
                    $data['kecamatanNama'],
                    "<button class='edit btn btn-sm btn-success waves-effect waves-light' data-id='{$data['desaID']}'> Edit</button>
                    <button class='hapus btn btn-danger btn-sm waves-effect waves-light' data-id='{$data['desaID']}'> Hapus</button>"
                );
            $nomor_urut++;
        }
        echo json_encode($output);
    }
    public function getID($id){
        $this->db->where('desaID',$id);
        $this->db->limit(1);
        $res = $this->db->get($this->tbl_);
        if($res->num_rows() > 0){
            return $res->result()[0];
        }else{
            return false;
        }
    }
    ######################################
    public function getAllDesa()
    {
        $res = $this->db->get($this->tbl_);
        if($res->num_rows() > 0){
            return $res->result();
        }
        return false;
    }

    public function getByKecamatan($kecamatan=NULL)
    {   
        $method = 'result';
        $this->db->where('parent_id',$kecamatan);
        $this->db->order_by('desaID','DESC');
        return $this->db->get($this->tbl_)->$method();
    }
    
}