<?php
class usuario_bdd extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }
        
        //ejemplo de consulta
        public function get_news($slug = FALSE)
        {
            if ($slug === FALSE)
            {
                $query = $this->db->get('news');
                return $query->result_array();
            }

            $query = $this->db->get_where('new', array('slug' => $slug));
            return $query->row_array();
        }
        
        
         //Registro de servicios
         public function ingresar_servicio()
        {
            $this->load->helper('url');

            $data = array(
            'id' => Null,
            'nombre' => $this->input->post('nombre'),
            'descripcion' => $this->input->post('descripcion'),
            'costo' => $this->input->post('costo'),
            'duracion' => $this->input->post('duracion')
            );

            return $this->db->insert('servicio', $data);
        }

        //Registro de ususrios
        public function ingresar_usuario($user)
        {
            $this->load->helper('url');

            if(empty($user))
            {
                $data = array(
            'id' => Null,
            'rut' => $this->input->post('rut'),
            'nombre' => $this->input->post('nombre'),
            'apellido' => $this->input->post('apellido'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('pass'),
            'acceso' => $this->input->post('user')
            );

            }

            else{
                $data = array(
            'id' => Null,
            'rut' => $this->input->post('rut'),
            'nombre' => $this->input->post('nombre'),
            'apellido' => $this->input->post('apellido'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('pass'),
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
            'patente' => $this->input->post('patente'),
            'marca' => $this->input->post('marca'),
            'modelo' => $this->input->post('modelo'),
            'año' => $this->input->post('ano'),
            'color' => $this->input->post('color'),
            'estado' => "registrado"
            );

            return $this->db->insert('vehiculo', $data);
        }

        //Busqueda. Inicialmente  usado para consultar vehiculos con estado solicita, pero se puede mejorar
        public function busqueda($tabla,$estado,$idveh)
        {

            if ($idveh === FALSE)
            {   
                $query = $this->db->get_where($tabla, array('estado' => $estado));
                return $query->result_array();  
            } 
            
            $query = $this->db->get_where($tabla, array('estado' => $idveh));
            return $query->result_array();
            
        }

        //Busqueda de usuarios
        public function busca_usuarios()
        {
                $query = $this->db->get('usuario');
                return $query->result_array();
        }



        //Busqueda de vehiculos. Mejorar
        public function busca_vehiculos($iduser=FALSE)
        {
            if ($iduser === FALSE)
            {
                $query = $this->db->get('vehiculo');
                return $query->result_array();
            }    
            
            $query = $this->db->get_where('vehiculo', array('dueño' => $iduser));
            return $query->result_array();

        }

        //Estado de vehiculos. Hacer llamado a otras tablas
        public function estado_vehiculo($idveh=FALSE)
        {
            if ($idveh === FALSE)
            {
                $query = $this->db->get('vehiculo');
                return $query->result_array();
            }    
            
            $query = $this->db->get_where('vehiculo', array('patente' => $idveh));
            return $query->result_array();

        }

        //Modifica estado de vehiculo por patente.
        public function modifica_estado($idveh=FALSE,$estado=FALSE,$tabla=FALSE)
        {
            
            $sql="update ". $tabla ." set estado='". $estado ."' where patente='". $idveh ."'";
            $this->db->query($sql);
        }

        //Agendar vehiculo
         public function agendar_vehiculo($idveh)
        {
            $this->load->helper('url');

            $data = array(
            'id' => Null,            
            'patente' => $idveh,
            'fecha' => $this->input->post('fecha'),
            'hora' => $this->input->post('hora')
            );

            return $this->db->insert('agenda', $data);
        }

        //Muestra los vehiculos agendados
        public function vehiculos_agendados($idveh,$estado)
        {
                
            if ($idveh === FALSE)
            {
                $SqlInfo ="select * from vehiculo, agenda where vehiculo.estado='". $estado ."' and vehiculo.patente=agenda.patente";
                $query = $this->db->query($SqlInfo);

                return $query->result_array();
            }
           

            $SqlInfo ="select * from vehiculo, agenda where vehiculo.estado='". $estado ."' and vehiculo.patente=agenda.patente and vehiculo.dueño=". $idveh;
            $query = $this->db->query($SqlInfo);

            return $query->result_array();
            
            //$query = $this->db->get('vehiculo');

            //$query = $this->db->get_where('vehiculo,agenda', array('vehiculo.estado' => 'agendado', 'vehiculo.patente' => 'agenda.patente'));
           

        }

        //Muestra los vehiculos chequeados, mas los sevicios por confirmar el cliente //trabajar aqui
        public function trabajos_confirmados($idveh,$estado)
        {
                
            if ($idveh === FALSE)
            {
                $SqlInfo ="select * from servicio, trabajo where trabajo.estado='". $estado ."' and trabajo.servicio=servicio.id";
                $query = $this->db->query($SqlInfo);

                return $query->result_array();
            }
           

            $SqlInfo ="select * from servicio, trabajo where trabajo.estado='". $estado ."' and trabajo.servicio=servicio.id and trabajo.patente='". $idveh ."'";
            $query = $this->db->query($SqlInfo);

            return $query->result_array();
            
            //$query = $this->db->get('vehiculo');

            //$query = $this->db->get_where('vehiculo,agenda', array('vehiculo.estado' => 'agendado', 'vehiculo.patente' => 'agenda.patente'));
           

        }



        //Elmina el agedamiento del vehiculo        
        public function eliminar_agenda($idveh)
        {
          
          return $this->db->delete('agenda', array('patente' => $idveh));

        }

        //Lista de servicios
        public function servicios(){

            $query = $this->db->get('servicio');
            return $query->result_array();
        }

        

        public function agregar_servicio($idveh)
        {
            $this->load->helper('url');

            $data = array(
            'id' => Null,            
            'patente' => $idveh,
            'servicio' => $this->input->post('servicio'),
            'estado' => 'confirmar'
            );

            return $this->db->insert('trabajo', $data);
        }


}