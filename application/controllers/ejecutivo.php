<?php
class ejecutivo extends CI_Controller {
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


             public function selvehi()
    {
        $data['title'] = 'Seleccionar vehiculo';   
        //select,from,estado,column,id,union
        $data['vehiculos']=$this->search->busqueda(false,'vehiculo','listo',false, false,false);
        $this->load->view('templates/header',$data);
        $this->load->view('vehlisto',$data);
        $this->load->view('templates/footer');
    }
    
    public function vehavi($idveh=null)
    {
        
                //teniendo el ejecutivo todo revisado

        $this->update->modifica_estado($idveh,'avisar','vehiculo');//el coche cambia de estado
        $this->load->view('avisos/cheqlisto');


    }

             public function aviveh()
    {
        $data['title'] = 'Seleccionar vehiculo';   
        //select,from,estado,column,id,union
        $data['vehiculos']=$this->search->busqueda(false,'vehiculo','avisar',false, false,false);
        $this->load->view('templates/header',$data);
        $this->load->view('vehavisado',$data);
        $this->load->view('templates/footer');
    }


 public function vehent($idveh=null)
    {
        
                //teniendo el ejecutivo todo revisado

        $this->update->modifica_estado($idveh,'libre','vehiculo');//el coche cambia de estado
        $this->load->view('avisos/cheqlisto');


    }

    }