<?php
class mecanico extends CI_Controller {
    public function __construct()
        {
                 parent::__construct();
        //$this->load->model('usuario_bdd');
        //$this->load->model('insert');
        $this->load->model('search');
        $this->load->model('update');
        
        $this->load->helper('url_helper');
        //$this->load->library('session');
        $this->load->helper('cookie');
        $this->load->library('auth_user');

        }
   
   //Lista de trabajos del vehiculos. Aqui el mecanico modifica el estado del trabajo. por ahora no se usa
    public function listrab($iduser=NULL)
    {
    	$data['title'] = 'Estado de trabajos';
        //'patente, nombre, descripcion, costo, duracion'

        //select,from,estado,column,id,union
        $data['vehiculos']=$this->search->busqueda(false,'trabajo,servicio',false,'patente', $iduser,'trabajo.servicio=servicio.id');
           
        $this->load->view('templates/header',$data);
        $this->load->view('seltra',$data);
        $this->load->view('templates/footer');

    }

    
     public function selvehi()
    {
        $data['title'] = 'Seleccionar vehiculo';   
        //select,from,estado,column,id,union
        $data['vehiculos']=$this->search->busqueda(false,'trabajo','aceptado',false, false,'trabajo.servicio=servicio.id');
        $this->load->view('templates/header',$data);
        $this->load->view('traveh',$data);
        $this->load->view('templates/footer');
    }
    
    public function trablis($idveh=null)
    {
        
                //teniendo el ejecutivo todo revisado

        $this->update->modifica_estado($idveh,'listo','trabajo');//el coche cambia de estado
        $this->update->modifica_estado($idveh,'listo','vehiculo');//el coche cambia de estado
        
        //$this->usuario_bdd->estado_trabajo($idveh,'confirmar');//el trabajo cambia de estado
        
        $this->load->view('avisos/cheqlisto');


    }


}