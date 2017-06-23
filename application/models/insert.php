<?php
class insert extends CI_Model {
	public function __construct()
        {
            $this->load->database();
        }

        //Registro de servicios
         public function ingresar_servicio()
        {
            $this->load->helper('url');

            $data = array(
            'id' => Null,
            'nombre' => $this->security->xss_clean($this->input->post('nombre')),
            'descripcion' => $this->security->xss_clean($this->input->post('descripcion')),
            'costo' => $this->security->xss_clean($this->input->post('costo')),
            'duracion' => $this->security->xss_clean($this->input->post('duracion'))
            );

            return $this->db->insert('servicio', $data);
        }

        //Registro de ususrios
        public function ingresar_usuario($user, $hash)
        {
            $this->load->helper('url');
            //parte del bcrypt
            //$this->load->library('bcrypt');
/*
            $password = ( isset( $_POST['pass'] ) ? $_POST['pass'] : '' );
 
            if ( $password ) {
                $hash = password_hash("rasmuslerdorf", PASSWORD_DEFAULT);//$this->bcrypt->hash_password($password);

            
            }*/
            //

            if(empty($user))
            {
                $data = array(
            'id' => Null,
            'rut' => $this->security->xss_clean($this->input->post('rut')),
            'nombre' => $this->security->xss_clean($this->input->post('nombre')),
            'apellido' => $this->security->xss_clean($this->input->post('apellido')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'password' => $hash,
            //'password' => $this->input->post('pass'),
            'acceso' => $this->input->post('user')
            );

            }

            else{
                $data = array(
            'id' => Null,
            'rut' => $this->security->xss_clean($this->input->post('rut')),
            'nombre' => $this->security->xss_clean($this->input->post('nombre')),
            'apellido' => $this->security->xss_clean($this->input->post('apellido')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'password' => $hash,
            //'password' => $this->input->post('pass'),
            'acceso' => 'cliente'
            );
            }
            

            return $this->db->insert('usuario', $data);
        }

        //Registro de vehiculos
         public function ingresar_vehiculo($iduser)
        {
            $this->load->helper('url');

            $data = array(
            'id' => Null,
            'dueño' => $iduser,
            'patente' => $this->security->xss_clean($this->input->post('patente')),
            'marca' => $this->security->xss_clean($this->input->post('marca')),
            'modelo' => $this->security->xss_clean($this->input->post('modelo')),
            'año' => $this->security->xss_clean($this->input->post('ano')),
            'color' => $this->security->xss_clean($this->input->post('color')),
            'estado' => "registrado"
            );

            return $this->db->insert('vehiculo', $data);
        }

        //Agendar vehiculo
         public function agendar_vehiculo($idveh)
        {
            $this->load->helper('url');

            $data = array(
            'id' => Null,            
            'patente' => $this->security->xss_clean($idveh),
            'fecha' => $this->security->xss_clean($this->input->post('fecha')),
            'hora' => $this->security->xss_clean($this->input->post('hora'))
            );

            return $this->db->insert('agenda', $data);
        }

        public function agregar_servicio($idveh)
        {
            $this->load->helper('url');

            $data = array(
            'id' => Null,            
            'patente' => $idveh,
            'servicio' => $this->security->xss_clean($this->input->post('servicio')),
            'estado' => 'costear'
            );

            return $this->db->insert('trabajo', $data);
        }


}