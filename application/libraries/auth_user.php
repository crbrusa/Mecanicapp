<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth_user {
	 protected $CI;

        // We'll use a constructor, as you can't directly call a function
        // from a property definition.
        public function __construct()
        {
                // Assign the CodeIgniter super-object
                $this->CI=&get_instance();
                //$this->comprobar();
        }

    public function comprobar()
    {
    	if($this->CI->session->userdata('auth')){
            echo "Buena";
        }else{
            echo "mala";
            die();
        }


    }
    public function tipo_usuario($usuario)
    {
        if($this->CI->session->userdata('user')!=$usuario && $this->CI->session->userdata('user')=='administrador'){
            //echo base_url().'mecanincapp/menu';
            //die();
            redirect(base_url().'mecanicapp/menu');
        }
    }
}