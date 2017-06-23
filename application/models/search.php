<?php
class search extends CI_Model {
	public function __construct()
        {
            $this->load->database();
          
        }
//select,from,estado,column,id,union
        public function busqueda($select,$from,$estado,$column,$id,$union)
        {
        	if ($select != FALSE)
        	{
        		$this->db->select($select);
        	}

			if ($estado != FALSE)
        	{
        		$this->db->where('estado',$estado);
        	}
        	
        	if ($column != FALSE)
        	{
        		$this->db->where($column,$id);
        	}

			
        	if ($union != FALSE)
        	{
        		$this->db->join('servicio',$union);
        	}


        	/*
            if ($idveh === FALSE)
            {   
                $query = $this->db->get_where($tabla, array('estado' => $estado));
                return $query->result_array();  
            } 
            */
            //SELECT

            //FROM

            //WHERE

            $this->db->from($from);           
            
            $query = $this->db->get();//
            return $query->result_array();
            
        }

 public function get_user($mail,$pass)
    {

        $query = $this->db->get_where('usuario', array('email' => $mail));
            if ($query->num_rows() == 1)
            {
                $row=$query->row();

                if (password_verify($pass, $row->password)) 
                {
                    return TRUE;

                } else {
                    return FALSE;

                }
            }
            else{
                return FALSE;

            }

    }





}
