<?php
class Subkriteria_model extends CI_Model {
    // ambil data kriteria
    public function dataKriteria($searchTerm=""){

        // data kriteria
        $this->db->select('*');
        $this->db->or_like(array("kode_kriteria" => $searchTerm, "nama_kriteria" => $searchTerm));
        $fetched_records = $this->db->get('kriteria');
        $datakriteria = $fetched_records->result_array();

        // Initialize Array with fetched data
        $data = array();
        foreach($datakriteria as $value){
            $data[] = array("id"=>$value['id_kriteria'], "text"=>"(".$value['kode_kriteria'].") ".$value['nama_kriteria']);
        }
        return $data;
    }

    var $table = "subkriteria";  
    var $order_column = array(null, "kode_sub_kriteria", null);  
    function make_query()  
    {  
        $this->db->select('subkriteria.*, kriteria.kode_kriteria');  
        $this->db->join('kriteria', 'kriteria.id_kriteria = subkriteria.kriteria_id', 'left');
        $this->db->from($this->table);  
        if(isset($_POST["search"]["value"]))  
        {  
            $this->db->like("kode_sub_kriteria", $_POST["search"]["value"]);  
            $this->db->or_like("kriteria.kode_kriteria", $_POST["search"]["value"]);  
        }  
        if(isset($_POST["order"]))  
        {  
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }  
        else  
        {  
            $this->db->order_by('id_sub_kriteria', 'ASC');  
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
    
    public function simpan($data,$table){
        $this->db->insert($table,$data);
    }

    public function edit($where, $table){
        $this->db->select('subkriteria.*, kriteria.kode_kriteria, kriteria.nama_kriteria');  
        $this->db->join('kriteria', 'kriteria.id_kriteria = subkriteria.kriteria_id', 'left');
        $this->db->from($table);
        $this->db->where($where);
        return $this->db->get();
    }

    public function perbarui($where, $data, $table){
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function hapus($where, $table){
        $this->db->where($where);
        $this->db->delete($table);
    }
}
?>