<?php
class delete extends CI_Model {
	public function __construct()
        {
            $this->load->database();
        }


        //Elmina el agedamiento del vehiculo        
        public function eliminar_agenda($idveh)
        {
          
          return $this->db->delete('agenda', array('patente' => $idveh));

        }




}