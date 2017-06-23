<?php
class cliente extends CI_Controller {
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
   //el cliente selecciona el vehiculo de los trabajos
    public function seltrab($iduser=NULL)
    {
    	//$this->load->helper('checkbox');
        $data['title'] = 'Seleccionar trabajos';
        $data['vehiculos']=$this->search->busqueda(false,'vehiculo','listo',false, false,false);
           
        $this->load->view('templates/header',$data);
        $this->load->view('seltra',$data);
        $this->load->view('templates/footer');
    }

    //se aceptan trabajos. ver la condicion si no se selecciona nada 
    public function acetrab($idveh=null)
    {
        
    	        //teniendo el ejecutivo todo revisado

        $this->update->modifica_estado($idveh,'aceptado','trabajo');//el coche cambia de estado
        $this->update->modifica_estado($idveh,'aceptado','vehiculo');//el coche cambia de estado
        
        //$this->usuario_bdd->estado_trabajo($idveh,'confirmar');//el trabajo cambia de estado
        
        $this->load->view('avisos/cheqlisto');


    }



}
