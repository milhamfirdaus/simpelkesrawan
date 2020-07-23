<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Hewan extends CI_Model {
    private $tbl_ = 'tb_hewan';
    
    public function insert($data){
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
        $this->db->where('hewanID',$id);
        $res = $this->db->update($this->tbl_,$data);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    public function getHewan()
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
        if($this->session->has_userdata('sess_member_')){
            $this->db->where('memberID',$this->session->sess_member_->memberID);
        }
        if($search!=""){
            $this->db->like("hewanNama",$search);
        }
        /*Lanjutkan pencarian ke database*/
        $this->db->where("publish","1");
        $this->db->limit($length,$start);
        /*Urutkan dari alphabet paling terkahir*/
        $this->db->join('tb_member','tb_member.memberID=tb_hewan.memberID',"left");
        $this->db->join('tb_spesies','tb_spesies.spesiesID=tb_hewan.spesiesID',"left");
        $this->db->order_by("{$this->tbl_}.hewanID",'DESC');
        $query=$this->db->get($this->tbl_);
        
        /*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai
         dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
         yang mengandung keyword tertentu
         */
        if($search!=""){
            $this->db->like("hewanNama",$search);
            $jum=$this->db->get($this->tbl_);
            $output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
        }
        
        $nomor_urut=$start+1;
        foreach ($query->result_array() as $data) {
            $output['data'][]=array(
                    $nomor_urut,
                    $data['hewanNama'],
                    ($data['spesiesID'] =='' ? '<span class="text-info">Unk</span>':$data['spesiesNama']),
                    ($data['memberID'] =='' ? '<span class="text-info">Admin</span>':$data['memberUsername']),
                    "<button class='edit btn btn-sm btn-success waves-effect waves-light' data-id='{$data['hewanID']}'> Edit</button>
                    <button class='hapus btn btn-danger btn-sm waves-effect waves-light' gambar-nama='{$data['hewanGambar']}' data-id='{$data['hewanID']}'> Hapus</button>"
                );
            $nomor_urut++;
        }
        echo json_encode($output);
    }
    public function gDataTableMember()
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
        if($this->session->has_userdata('sess_member_')){
            $this->db->where('tb_hewan.memberID',$this->session->sess_member_->memberID);
        }
        if($search!=""){
            $this->db->like("hewanNama",$search);
        }
        /*Lanjutkan pencarian ke database*/
        $this->db->limit($length,$start);

        $this->db->join('tb_member','tb_member.memberID=tb_hewan.memberID',"left");
        $this->db->join('tb_spesies','tb_spesies.spesiesID=tb_hewan.spesiesID',"left");
        /*Urutkan dari alphabet paling terkahir*/
        $this->db->order_by("{$this->tbl_}.hewanID",'DESC');
        $query=$this->db->get($this->tbl_);
        
        /*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai
         dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
         yang mengandung keyword tertentu
         */
        if($search!=""){
            $this->db->like("hewanNama",$search);
            $jum=$this->db->get($this->tbl_);
            $output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
        }
        
        $nomor_urut=$start+1;
        foreach ($query->result_array() as $data) {

            if ($data['publish'] == 1){
                $print = '<span class="text-success"><strong>Data Valid</strong></span>';
                $button = "<a href='".site_url('master/preview/')."{$data['hewanID']}' class='btn btn-sm btn-info waves-effect waves-light'> Preview</a>
                    <button class='edit btn btn-sm btn-success waves-effect waves-light' data-id='{$data['hewanID']}'> Edit</button>
                    <button class='hapus btn btn-danger btn-sm waves-effect waves-light' gambar-nama='{$data['hewanGambar']}' data-id='{$data['hewanID']}'> Hapus</button>";
            } 
            else if($data['publish'] == 0){
                $print = '<span class="text-info">Menunggu Validasi oleh Admin</span>';
                $button = "<a href='".site_url('master/preview/')."{$data['hewanID']}' class=' btn btn-sm btn-info waves-effect waves-light'> Preview</a>
                    <button class='edit btn btn-sm btn-success waves-effect waves-light' data-id='{$data['hewanID']}'> Edit</button>
                    <button class='hapus btn btn-danger btn-sm waves-effect waves-light' gambar-nama='{$data['hewanGambar']}' data-id='{$data['hewanID']}'> Hapus</button>";
            }
            else if($data['publish'] == 2){
                $print = '<span class="text-danger"><strike>Data tidak Valid</strike></span>';
                $button = "<a href='".site_url('master/preview/')."{$data['hewanID']}' class='btn btn-sm btn-info waves-effect waves-light'> Preview</a>
                    <button class='hapus btn btn-danger btn-sm waves-effect waves-light' gambar-nama='{$data['hewanGambar']}' data-id='{$data['hewanID']}'> Hapus</button>";
            }

            $output['data'][]=array(
                    $nomor_urut,
                    ($data['uniqueID']),
                    $data['hewanNama'],
                    ($data['spesiesID'] =='' ? '<span class="text-info">Unk</span>':$data['spesiesNama']),
                    ($data['memberID'] =='' ? '<span class="text-info">Admin</span>':$data['memberUsername']),
                    ($print),
                    ($button)
                );
            $nomor_urut++;
        }
        echo json_encode($output);
    }
    public function getID($id){
        $this->db->select('tb_hewan.* , tb_desa.*,tb_kecamatan.*,spesiesNama,tb_member.*');
        $this->db->join('tb_member','tb_member.memberID=tb_hewan.memberID','left');
        $this->db->join('tb_spesies','tb_spesies.spesiesID=tb_hewan.spesiesID','left');
        $this->db->join('tb_desa','tb_desa.desaID=tb_hewan.desaID','left');
        $this->db->join('tb_kecamatan','tb_kecamatan.kecamatanID = tb_desa.parent_id','left');
        $this->db->where('hewanID',$id);
        $this->db->limit(1);
        $res = $this->db->get($this->tbl_);
        if($res->num_rows() > 0){
            return $res->result()[0];
        }else{
            return false;
        }
    }
    public function getData($number,$offset)
    {
        $this->db->join('tb_member','tb_member.memberID=tb_hewan.memberID','left');
        $this->db->join('tb_spesies','tb_spesies.spesiesID=tb_hewan.spesiesID');
        $this->db->join('tb_desa','tb_desa.desaID=tb_hewan.desaID','left');
        $this->db->join('tb_kecamatan','tb_kecamatan.kecamatanID=tb_desa.parent_id','left');
        $this->db->where("publish","1");
        $res = $this->db->get('tb_hewan',$number,$offset);
        if($res->num_rows() > 0)
        {
            return $res->result();
        }else{
            return false;
        }
    }
    public function getDataBySearch($number,$offset,$search)
    {
        $this->db->join('tb_spesies','tb_spesies.spesiesID=tb_hewan.spesiesID');
        $this->db->join('tb_desa','tb_desa.desaID=tb_hewan.desaID','left');
        $this->db->join('tb_kecamatan','tb_kecamatan.kecamatanID=tb_desa.parent_id','left');
        $this->db->like('tb_hewan.hewanNama',$search);
        $this->db->where("publish","1");
        $res = $this->db->get('tb_hewan',$number,$offset);
        if($res->num_rows() > 0)
        {
            return $res->result();
        }else{
            return false;
        }
    }
    public function getDataAll()
    {
        $this->db->select('tb_hewan.* , tb_desa.*,tb_kecamatan.*,spesiesNama');
        $this->db->join('tb_spesies','tb_spesies.spesiesID=tb_hewan.spesiesID');
        $this->db->join('tb_desa','tb_desa.desaID=tb_hewan.desaID','left');
        $this->db->join('tb_kecamatan','tb_kecamatan.kecamatanID=tb_desa.parent_id','left');
        $this->db->where("publish","1");
        $res = $this->db->get('tb_hewan');
        if($res->num_rows() > 0)
        {
            return $res->result();
        }else{
            return false;
        }
    }
    public function getDataAllBySearch($search){
        $this->db->join('tb_spesies','tb_spesies.spesiesID=tb_hewan.spesiesID');
        $this->db->join('tb_desa','tb_desa.desaID=tb_hewan.desaID','left');
        $this->db->join('tb_kecamatan','tb_kecamatan.kecamatanID=tb_desa.parent_id','left');
        $this->db->like('tb_hewan.hewanNama',$search);
        $this->db->where("publish","1");
        $res = $this->db->get('tb_hewan');
        if($res->num_rows() > 0)
        {
            return $res->result();
        }else{
            return false;
        }
    }

    public function getTotalRow(){   
        $this->db->where("publish","1");
        $res = $this->db->get('tb_hewan');
        return $res->num_rows();
    }

    public function getTotalRowSpesies(){
        $res = $this->db->get('tb_spesies');
        return $res->num_rows();
    }
    
    public function getTotalRowByKecamatanID($kecamatanID){
        $this->db->where('kecamatanID',$kecamatanID);
         $this->db->where("publish","1");
        $res = $this->db->get('tb_hewan');
        return $res->num_rows();
    }
    
    public function getKecamatan($kecamatanID,$number,$offset){
        $this->db->join('tb_spesies','tb_spesies.spesiesID=tb_hewan.spesiesID','left');
        $this->db->where('tb_hewan.kecamatanID',$kecamatanID);
        $res = $this->db->get('tb_hewan',$number,$offset);
        if($res->num_rows() > 0){
            return $res->result();
        }else{
            return false;
        }
    }
    
    public function vDataTable(){
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
        $total=$this->db->where("publish","0")->or_where("publish","2")->from($this->tbl_)->count_all_results();
        
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
            $this->db->like("hewanNama",$search)->or_like("hewanKeterangan",$search);
        }

        /*Lanjutkan pencarian ke database*/ 

        $this->db->join('tb_member','tb_member.memberID=tb_hewan.memberID',"left");
        $this->db->join('tb_spesies','tb_spesies.spesiesID=tb_hewan.spesiesID',"left");
        $this->db->where("publish","0")->or_where("publish","2");
        $this->db->limit($length,$start);
        /*Urutkan dari alphabet paling terkahir*/
        $this->db->order_by("{$this->tbl_}.hewanID",'DESC');
        $query=$this->db->get($this->tbl_);
        
        /*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai
         dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
         yang mengandung keyword tertentu
         */
        if($search!=""){
            $this->db->like("hewanNama",$search)->or_like("hewanKeterangan",$search);
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
                    $data['hewanNama'],
                    ($data['spesiesID'] =='' ? '<span class="text-info">Unk</span>':$data['spesiesNama']),
                    ($data['memberID'] =='' ? '<span class="text-info">Tanpa Pemilik</span>':$data['memberNamaLengkap']),
                     $print,
                    "<a href='".site_url('verifikasi/preview/hewan/')."{$data['hewanID']}' class='edit btn btn-sm btn-info waves-effect waves-light'> Preview</a>
                    <button class='hapus btn btn-danger btn-sm waves-effect waves-light' gambar-nama='{$data['hewanGambar']}' data-id='{$data['hewanID']}'> Hapus</button>"
                );
            $nomor_urut++;
        }
        echo json_encode($output);
    }

    public function hewanSaya($memberID){
        $this->db->select('tb_hewan.* , tb_desa.*,tb_kecamatan.*,spesiesNama,tb_member.*');
        $this->db->join('tb_member','tb_member.memberID=tb_hewan.memberID','left');
        $this->db->join('tb_spesies','tb_spesies.spesiesID=tb_hewan.spesiesID');
        $this->db->join('tb_desa','tb_desa.desaID=tb_hewan.desaID','left');
        $this->db->join('tb_kecamatan','tb_kecamatan.kecamatanID=tb_desa.parent_id','left');
        $this->db->where("tb_hewan.memberID",$memberID);
        $res = $this->db->get($this->tbl_);
        if($res->num_rows() > 0)
        {
            return $res->result();
        }else{
            return false;
        }
    }

}