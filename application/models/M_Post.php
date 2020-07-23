<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Post extends CI_Model {
    private $tbl_ = 'tb_post';
  
    public function insert($data){
        $res = $this->db->insert($this->tbl_,$data);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    public function insertKategori($data){
        $res = $this->db->insert('tb_kategori_post',$data);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    public function deleteKategori($id)
    {
        $res = $this->db->delete('tb_kategori_post',$id);
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
        $this->db->where('postID',$id);
        $res = $this->db->update($this->tbl_,$data);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    public function updateKategori($id,$data)
    {
        $this->db->where('kategoriID',$id);
        $res = $this->db->update('tb_kategori_post',$data);
        if($res){
            return true;
        }else{
            return false;
        }
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
            $this->db->like("postJudul",$search);
        }
        /*Lanjutkan pencarian ke database*/
        $this->db->limit($length,$start);
        /*Urutkan dari alphabet paling terkahir*/
        $this->db->order_by("{$this->tbl_}.postID",'DESC');
        $this->db->join('tb_kategori_post','tb_kategori_post.kategoriID=tb_post.kategori');
        $query=$this->db->get($this->tbl_);
        
        /*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai
         dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
         yang mengandung keyword tertentu
         */
        if($search!=""){
            $this->db->like("postJudul",$search);
            $jum=$this->db->get($this->tbl_);
            $output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
        }
        
        $nomor_urut=$start+1;
        foreach ($query->result_array() as $data) {
            $output['data'][]=array(
                    $nomor_urut,
                    substr($data['postJudul'],0,30).'...',
                    $data['kategoriNama'],
                    $data['postTanggalInsert'],
                    ($data['postTanggalUpdate'] == ''? '-':$data['postTanggalUpdate']),
                    "<a href='".site_url('Post/editPost/')."{$data['postID']}' class='edit btn btn-sm btn-success waves-effect waves-light'> Edit</a>
                    <a href='".site_url('Post/previewPost/')."{$data['postID']}' class='edit btn btn-sm btn-info waves-effect waves-light'> Preview</a>
                    <button class='hapus btn btn-danger btn-sm waves-effect waves-light' data-id='{$data['postID']}'> Hapus</button>"
                );
            $nomor_urut++;
        }
        echo json_encode($output);
    }
    public function getID($id){
        $this->db->select('tb_post.*,kategoriNama');
        $this->db->join('tb_kategori_post','tb_kategori_post.kategoriID=tb_post.kategori');
        $this->db->where('postID',$id);
        $this->db->limit(1);
        $res = $this->db->get($this->tbl_);
        if($res->num_rows() > 0){
            return $res->result()[0];
        }else{
            return false;
        }
    }
    public function getAllKategori()
    {
        $res = $this->db->get('tb_kategori_post');
        if($res->num_rows() > 0){
            return $res->result();
        }else{
            return false;
        }
    }
    public function getAll($number,$offset)
    {
        $this->db->join('tb_kategori_post','tb_kategori_post.kategoriID=tb_post.kategori');
        $this->db->where('publish','1');
        $res = $this->db->get('tb_post',$number,$offset);
        if($res->num_rows() > 0){
            return $res->result();
        }else{
            return false;
        }
    }
    public function getAllBySearch($number,$offset,$search)
    {   
        $this->db->join('tb_kategori_post','tb_kategori_post.kategoriID=tb_post.kategori');
        $this->db->like('tb_post.postJudul',$search);
        $this->db->where('publish','1');
        $res = $this->db->get('tb_post',$number,$offset);
        if($res->num_rows() > 0){
            return $res->result();
        }else{
            return false;
        }
    }
    public function getPostByKat($kategori)
    {
        $this->db->where('kategori',$kategori);
        $this->db->where('publish','1');
        $res = $this->db->get('tb_post');
        if($res->num_rows() > 0){
            return $res->result();
        }
    }

    public function getRelatedPost($kategori)
    {
        $this->db->where('kategori',$kategori);
        $this->db->where('publish','1');
        $this->db->limit(5);
        $res = $this->db->get('tb_post');
        if($res->num_rows() > 0){
            return $res->result();
        }
    }
    public function getTotalRowPost()
    {
        $this->db->where('publish','1');
        return $this->db->get('tb_post')->num_rows();
    }
    public function getTotalRowPostEvent()
    {
        $this->db->where('kategori',13);
        return $this->db->get('tb_post')->num_rows();
    }
    public function getTotalRowKategori($kategori)
    {
        $this->db->where('kategori',$kategori);
        return $this->db->get($this->tbl_)->num_rows();
    }
    public function getKategoriByID($id){
        $this->db->where('kategoriID',$id);
        $res = $this->db->get('tb_kategori_post');
        if($res->num_rows() > 0){
            return $res->result();
        }else{
            return false;
        }
    }
    public function gKategoriNamaByID($kat)
    {
        $this->db->where('kategoriID',$kat);
        $res = $this->db->get('tb_kategori_post');
        return $res->result()[0];
    }
    public function gDataTableKategori()
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
        $total=$this->db->count_all_results('tb_kategori_post');
        
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
            $this->db->like("kategoriNama",$search);
        }
        /*Lanjutkan pencarian ke database*/
        $this->db->limit($length,$start);
        /*Urutkan dari alphabet paling terkahir*/
        $this->db->order_by("tb_kategori_post.kategoriID",'DESC');
        $query=$this->db->get('tb_kategori_post');
        
        /*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai
         dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
         yang mengandung keyword tertentu
         */
        if($search!=""){
            $this->db->like("kategoriNama",$search);
            $jum=$this->db->get('tb_kategori_post');
            $output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
        }
        
        $nomor_urut=$start+1;
        foreach ($query->result_array() as $data) {
            $output['data'][]=array(
                    $nomor_urut,
                    $data['kategoriNama'],
                    "<button class='edit btn btn-sm btn-success waves-effect waves-light' data-id='{$data['kategoriID']}'> Edit</button>
                    <button class='hapus btn btn-danger btn-sm waves-effect waves-light' data-id='{$data['kategoriID']}'> Hapus</button>"
                );
            $nomor_urut++;
        }
        echo json_encode($output);
    }




    public function vDataTable(){
        @$draw=$_REQUEST['draw'];
        @$length=$_REQUEST['length'];
        @$start=$_REQUEST['start'];
        @$search=$_REQUEST['search']["value"];

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
            $this->db->like("postJudul",$search);
        }
        
        /*Lanjutkan pencarian ke database*/
        $this->db->where("publish","0")->or_where("publish","2");
        $this->db->limit($length,$start);
        /*Urutkan dari alphabet paling terkahir*/
        $this->db->order_by("{$this->tbl_}.postID",'DESC');
        $this->db->join('tb_kategori_post','tb_kategori_post.kategoriID=tb_post.kategori');
        $query=$this->db->get($this->tbl_);
        
        /*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai
         dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
         yang mengandung keyword tertentu
         */
        if($search!=""){
            $this->db->like("postJudul",$search);
            $jum=$this->db->get($this->tbl_);
            $output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
        }
        
        $nomor_urut=$start+1;

        foreach ($query->result_array() as $data) {

            if ($data['publish'] == 1){
                $print = '<span class="text-success"><strong>Data Valid</strong></span>';
            } 
            else if($data['publish'] == 0){
                $print = '<span class="text-info">Menunggu Validasi oleh Admin</span>';
            }
            else if($data['publish'] == 2){
                $print = '<span class="text-danger"><strike>Data tidak Valid</strike></span>';
            }

            $output['data'][]=array(
                    $nomor_urut,
                    substr($data['postJudul'],0,30).'...',
                    $data['kategoriNama'],
                    $data['postTanggalInsert'],
                    ($data['postTanggalUpdate'] == ''? '-':$data['postTanggalUpdate']),
                    $print,
                    "<a href='".site_url('Post/previewPost/')."{$data['postID']}' class='edit btn btn-sm btn-info waves-effect waves-light'> Preview</a>
                    <button class='hapus btn btn-danger btn-sm waves-effect waves-light' data-id='{$data['postID']}'> Hapus</button>"
                );
            $nomor_urut++;
        }
        echo json_encode($output);
    }

    public function getEvent($kategori){
        $this->db->where('kategori',$kategori);
        $this->db->where('publish','1');
        $this->db->limit(5);
        $res = $this->db->get('tb_post');
        if($res->num_rows() > 0){
            return $res->result();
        }
    }
}