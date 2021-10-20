<?php
class Saham_model extends CI_Model {

    var $table = "saham";  
    var $order_column = array("saham", "tanggal");  
    function make_query()  
    {  
        $this->db->select('*');
        $this->db->from($this->table);  
        if(isset($_POST["search"]["value"]))  
        {  
            $this->db->like("saham", $_POST["search"]["value"]);  
            $this->db->or_like("tanggal", $_POST["search"]["value"]);  
        }  
        if(isset($_POST["order"]))  
        {  
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }  
        else  
        {  
            $this->db->order_by('id_saham', 'ASC');  
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
        return $this->db->get_where($table,$where);
    }

    public function perbarui($where, $data, $table){
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function hapus($where, $table){
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function dataSaham() {
        return $this->db->get('saham');
    }
}
?>