<?php
class Kriteria_model extends CI_Model {

    public function simpan($data,$table){
        $this->db->insert($table,$data);
    }

    public function edit($where, $table){
        return $this->db->get_where($table,$where);
    }

    public function perbarui($where, $data, $table){
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function cekSubkriteria($id){
        $this->db->from('subkriteria');
        $this->db->where('kriteria_id', $id);
        return $this->db->get();
    }

    public function hapus($where, $table){
        $this->db->where($where);
        $this->db->delete($table);
    }
  
    var $table = "kriteria";  
    var $select_column = array("id_kriteria", "kode_kriteria", "nama_kriteria", "nilai_kriteria");  
    var $order_column = array(null, "kode_kriteria", "nama_kriteria", null);  
    function make_query()  
    {  
        $this->db->select($this->select_column);  
        $this->db->from($this->table);  
        if(isset($_POST["search"]["value"]))  
        {  
            $this->db->like("kode_kriteria", $_POST["search"]["value"]);  
            $this->db->or_like("nama_kriteria", $_POST["search"]["value"]);  
        }  
        if(isset($_POST["order"]))  
        {  
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }  
        else  
        {  
            $this->db->order_by('id_kriteria', 'ASC');  
        }  
    }  
    function make_datatables(){  
        $this->make_query();  
        if($_POST["length"] != -1)  
        {  
            $this->db->limit($_POST['length'], $_POST['start']);  
        }  
        $query = $this->db->get();  
        return $query->result();  
    }  
    function get_filtered_data(){  
        $this->make_query();  
        $query = $this->db->get();  
        return $query->num_rows();  
    }       
    function get_all_data()  
    {  
        $this->db->select("*");  
        $this->db->from($this->table);  
        return $this->db->count_all_results();  
    }  

    // untuk pengambilan semua data 
    public function data() {
        return $this->db->get('kriteria');
    }

    
    // new main
    function dataMain(){
		return $query = $this->db->get('kriteria')->result();		
	}
}
?>