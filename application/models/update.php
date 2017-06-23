<?php
class update extends CI_Model {
	public function __construct()
        {
            $this->load->database();
        }


        //Modifica estado de vehiculo por patente.
        public function modifica_estado($idveh=FALSE,$estado=FALSE,$tabla)
        {
            
            $sql="update ". $tabla ." set estado='". $estado ."' where patente='". $idveh ."'";
            $this->db->query($sql);
        }

}