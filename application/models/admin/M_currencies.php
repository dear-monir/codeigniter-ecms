<?php
class m_currencies extends CI_Model{
    private $language_id;
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->db->query ("set character_set_results='utf8'");
    }

    public function insert($data)
    {
        $this->db->set('last_modified','NOW()',false);
        $q = $this->db->insert('currencies', $data);
        if($q)
        {
            return $this->db->insert_id();
        }

    }
    public function getAll()
    {
        $q = $this->db->get('currencies');
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getById($id)
    {
        $q = "select * from currencies where currency_id = $id";
        $query = $this->db->query($q);
        return  $query->first_row();
    }

    public function update($id,$data)
    {
        $this->db->set('last_modified','NOW()',false);
        $this->db->where('currency_id', $id);
        $this->db->update('currencies', $data);
    }

    public function delete($id)
    {
        $this->db->delete("currencies","currency_id = $id");
    }
}