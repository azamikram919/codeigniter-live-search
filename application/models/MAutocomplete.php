<?php
class MAutocomplete extends CI_Model
{


	//search db
	public function _search($query)
	{
		$q=$this->db->select('*')
					->from('country')
					->like('printable_name',$query,'both')
					->get();
					if ($q->num_rows()>0) 
					{
						return $q->result();
					}
					else
					{
						return FALSE;
					}
	}

    function lookup($keyword){
        $this->db->select('*')->from('country');
        $this->db->like('printable_name',$keyword,'both');
        $query = $this->db->get();
        return $query->result();
    }
}