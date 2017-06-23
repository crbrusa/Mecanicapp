<?php
class Mecanicapp extends CI_Controller {
            public function __construct()
        {
                 parent::__construct();
        $this->load->model('usuario_bdd');
        $this->load->model('insert');
        $this->load->model('search');
        $this->load->model('update');

        $this->load->model('mail');
       
        
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->helper('cookie');
        $this->load->library('auth_user');



        }
//Se queda
public function menu(){
    

$data['title']='Bienvenido a MecanicApp, ' . $this->session->userdata('nombre');

        $data['subtitle1'] = 'Seleccione funcion';

        $this->load->view('templates/header',$data);

        switch ($this->session->userdata('user')) {


            
            case 'administrador':

                    $this->load->view('/menus/menprinadm',$data);    
                    break;
            case 'ejecutivo':

                    $this->load->view('/menus/menprineje',$data);    
                    break;  
            case 'mecanico':

                    $this->load->view('/menus/menprinmec',$data);    
                    break;
            case 'cliente':                   

                    $this->load->view('/menus/menprincli',$data);    
                    break;

            case 'desarrollador':
                    //$data['subtitle1'] = 'Administrador';
                    $this->load->view('/menus/menprinadm',$data);
                    
                    //$data['subtitle1'] = 'Ejecutivo';                    
                    $this->load->view('/menus/menprineje',$data);                   
                    
                    //$data['subtitle1'] = 'Mecanico';
                    $this->load->view('/menus/menprinmec',$data);
                    
                    //$data['subtitle1'] = 'Cliente';
                    $this->load->view('/menus/menprincli',$data);    
                    break; 

            default:
                    Show_404();
                    break;

        }

        $this->load->view('templates/footer');
        
    }
//Se queda
public function logout()
    {
        $array_items = array('auth', 'id','nombre','mail','user');
        $this->session->unset_userdata($array_items);
        $this->session->sess_destroy();
        //$this->index();
        redirect('/');

    }


  //Se queda
    //inicio pagina con lista de opcione separadas por tipo de usuario
    public function index()
    {

        $array_items = array('auth', 'id','nombre','mail','user');
        if(!empty($this->session->userdata('auth'))){
            $this->session->sess_destroy();
        }
        //$this->session->unset_userdata($array_items);
        //$this->session->sess_destroy();
        //set_cookie('hola','hola');

        $data['title']='MecanicApp';

        $data['subtitle1'] = 'Ingrese su mail y pass';

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('mail', 'mail', 'required');
        $this->form_validation->set_rules('pass', 'pass', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/headerindex',$data);
        
       
            $this->load->view('entrada',$data);
        
            $this->load->view('templates/footerindex');

        }

        else{

            $mail = $this->input->post('mail');
            $pass = $this->input->post('pass') ;

            $us=$this->usuario_bdd->get_user($mail);

            //$us=$this->usuario_bdd->get_user($mail);

            if($us != null){
                /*
                 $this->load->library('bcrypt');

                if($this->bcrypt->check_password( $pass, $us->password ) ) {
                */ 
                
                
                if(password_verify($pass, $us->password)) //$pass == $us->password)
                {

                    
                    $this->session->set_userdata('auth',true);
                    //$this->session->set_userdata('id',$us->id);
                    $this->session->set_userdata('nombre',$us->nombre);
                    //$this->session->set_userdata('mail',$mail);
                    $this->session->set_userdata('user',$us->acceso);
                    /*
                    $data = array(
                        'id'=>$us->id.
                        'nombre' => $us->nombre,
                        'mail' => $mail,                        
                        'user' => $us->acceso
                        );


                    $this->session->set_userdata($data);
                    */
                   redirect(base_url().'mecanicapp/menu');
                }
                else{
                    $this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
            
                    redirect('/');
                }

            }
            else{
                $this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
            
                redirect('/');
            }




        }


	}
	
//se va donde administrador
    //Registra servicios.     
    public function regserv()
    {

    $this->load->helper('form');
    $this->load->library('form_validation');

    $data['title'] = 'Registro de servicios';

    $data['subtitle1'] = 'Ingrese el servicio';
    $this->form_validation->set_rules('nombre', 'nombre', 'required');
    $this->form_validation->set_rules('descripcion', 'descripcion', '');
    $this->form_validation->set_rules('costo', 'costo', 'required');
    $this->form_validation->set_rules('duracion', 'duracion', '');
    
    if ($this->form_validation->run() === FALSE)
    {

        $this->load->view('templates/header',$data);
        
       
        $this->load->view('registro/regiservicio',$data);
        //Falta agregar visor de todos los servicios    
       
        $this->load->view('templates/footer');
    }
    
    else
    {
        
        $this->insert->ingresar_servicio();
        $this->load->view('avisos/servicio_agregado');
    }

    }

//se queda
    //Registra cualquier tipo de usuario.     
    public function reguser($user=NULL)
    {

    //$usuario = $this->session->userdata('user');
    //$auth = $this->session->userdata('auth');
    
    /*
    print_r($usuario);
    var_dump($auth);
    die();
    */
    $this->load->helper('form');
    $this->load->library('form_validation');

    $data['title'] = 'Registro de usarios';

    $data['subtitle1'] = 'Ingrese el usuario';
    $this->form_validation->set_rules('rut', 'rut', 'required');
    $this->form_validation->set_rules('nombre', 'nombre', 'required');
    $this->form_validation->set_rules('apellido', 'apellido', 'required');
    $this->form_validation->set_rules('email', 'email', 'required');
    $this->form_validation->set_rules('pass', 'pass', 'required');

            $checked = $this->input->post('check');
            if(isset($checked) )
            {
                
    $this->form_validation->set_rules('patente', 'patente', 'required');
    $this->form_validation->set_rules('marca', 'marca', 'required');
    $this->form_validation->set_rules('modelo', 'modelo', 'required');
    $this->form_validation->set_rules('ano', 'ano', 'required');
    $this->form_validation->set_rules('color', 'color', '');

            }
    
    if ($this->form_validation->run() === FALSE)
    {

       
        
        if (empty($user)){
            $this->load->view('templates/header',$data);
            $this->load->view('registro/regisuser',$data);
            
        }
        else{
             $this->load->view('templates/headerindex',$data);
             $this->load->view('registro/regiscli',$data);


        }
        $this->load->view('templates/footer');
    }
    
    else
    {
        $password = ( isset( $_POST['pass'] ) ? $_POST['pass'] : '' );
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $this->insert->ingresar_usuario($user,$hash);

        if(isset($checked))
            {
                $this->insert->ingresar_vehiculo($iduser);
            }

        $this->load->view('avisos/usuario_agregado');
    }

    }
    

    //Lista de usuarios. Temporal y para seleccionar auarios para dirigirse a la funcion
    public function lista_usuarios($fun=NULL)
    {
        $this->auth_user->tipo_usuario('cliente');

        If ($fun==NULL)
         {
                 Show_404 ();
         }
         $data['fun']=$fun;

        $data['usuarios']=$this->usuario_bdd->busca_usuarios();

        $data['title']='Lista de usuarios';

        $this->load->view('templates/header',$data);
        $this->load->view('listuser',$data);
        $this->load->view('templates/footer');        
        
    }

    //seva donde clientes
    //Registro de vehiculo
    public function regveh($iduser=NULL)
    {

    If ($iduser==NULL)
         {
                 Show_404 ();
         }
    $data['iduser']=$iduser;

    $this->load->helper('form');
    $this->load->library('form_validation');

    $data['title'] = 'Registro de vehiculo';

    $data['subtitle1'] = 'Ingrese el vehiculo';
    

    $this->form_validation->set_rules('patente', 'patente', 'required');
    $this->form_validation->set_rules('marca', 'marca', '');
    $this->form_validation->set_rules('modelo', 'modelo', '');
    $this->form_validation->set_rules('ano', 'ano', '');
    $this->form_validation->set_rules('color', 'color', '');
    
    if ($this->form_validation->run() === FALSE)
    {

        $this->load->view('templates/header',$data);
        $this->load->view('registro/regisvehiculo',$data);
        $this->load->view('templates/footer');
    }
    
    else
    {
        $this->insert->ingresar_vehiculo($iduser);
        $this->load->view('avisos/vehiculo_agregado');
    }

    }

    //Incompleto. Listado de vehiculos, pueden ser todos o un usuario. Falta que aparezca solo una vez e auto
    public function listvehiculo($iduser=NULL)
    {

        If ($iduser==NULL)
        {
            Show_404 ();
        }
    
        //$data['iduser']=$iduser;
        $data['title'] = 'Listado de vehiculos';

        $data['vehiculos']=$this->usuario_bdd->busca_vehiculos($iduser);

        $this->load->view('templates/header',$data);
        $this->load->view('listvehiculo',$data);
        $this->load->view('templates/footer');


    }
//se va donde el cliente
    //Solicitud de hora. Servira para mejorar listvehiculo, pero habra que hacer muchos cambios
    public function solhora($iduser=NULL)
    {

        If ($iduser==NULL)
        {
            Show_404 ();
        }
    
        //$data['iduser']=$iduser;
        $data['title'] = 'Elegir vehiculo para  agendamiento';

        $data['vehiculos']=$this->usuario_bdd->busca_vehiculos($iduser); //modificar para buscar sin el estado de reparando

        $this->load->view('templates/header',$data);
        $this->load->view('vehiculosolicitud',$data); //igual que listvehiculo, asi que mejorarlo
        $this->load->view('templates/footer');


    }

//se va donde cliente
    //Pedir hora. sirve para modificar el estado del vehiculo a solicitar
    public function pediragen($idveh=NULL)
    {
        If ($idveh==NULL)
        {
            Show_404 ();
        }
    
        $this->usuario_bdd->modifica_estado($idveh,'solicita');
        $this->load->view('avisos/vehiculo_solicitado');
    }

//se pede quedar, pero no se si el cliente es el unico en usarlo
    //Hace llamado al historial del vehiculo
    public function estvehiculo($idveh=NULL)
    {

        If ($idveh==NULL)
        {
            Show_404 ();
        }
    
        //$data['iduser']=$iduser;
        $data['title'] = 'Estado de vehiculo';
        //Falta mejorar
        $data['vehiculos']=$this->usuario_bdd->estado_vehiculo($idveh);

        $this->load->view('templates/header',$data);
        $this->load->view('estvehiculo',$data);
        $this->load->view('templates/footer');


    }

    //Se va al Ejecutivo

    //Agendamienta de vehiculo. Muesta los vehiculos con el estado solicita
    public function ageveh()
    {

            $data['title'] = 'Agendamiento de vehiculo';
        //$data['fun']=

            $data['vehiculos']=$this->usuario_bdd->busqueda('vehiculo','solicita',FALSE);

            $this->load->view('templates/header',$data);
            $this->load->view('listsol',$data);
            $this->load->view('templates/footer');
        
        

    }

    //Se va al ejecutivo
     //Momento de dar fecha y hora al vehiculo 
    public function vehfec($idveh=NULL)
    {

        if ($idveh==NULL)
        {
            Show_404 ();
        }
    
        //$data['iduser']=$iduser;
        $data['title'] = 'Hora y fecha de entrega';
        $data['idveh'] = $idveh;
        //$data['vehiculos']=$this->usuario_bdd->busqueda('vehiculo','solicita',$idveh);

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('fecha', 'fecha', 'required');
        $this->form_validation->set_rules('hora', 'hora', 'required');
    

        if ($this->form_validation->run() === FALSE)
        {

            $this->load->view('templates/header',$data);
            $this->load->view('horafe',$data);
            $this->load->view('templates/footer');

        }
        else
        {
            $this->usuario_bdd->modifica_estado($idveh,'agendado');
            $this->insert->agendar_vehiculo($idveh);
            $this->load->view('avisos/vehiculo_agendado');

    
        }


    }

    //se va donde el ejecutivo
     //Momento de dar fecha y hora al vehiculo 
    public function entveh($iduser=NULL)
    {
        //$this->auth_user->comprobar('cliente');
        if ($iduser==NULL)
        {
            Show_404 ();
        }

        $data['title'] = 'Fecha agendada';        
        $data['vehiculos']=$this->usuario_bdd->vehiculos_agendados($iduser,'agendado');

        $this->load->view('templates/header',$data);
        $this->load->view('fechage',$data);
        $this->load->view('templates/footer');
    }

//se va donde cliente
    //Se toma la decision sobre el agendamiento
    public function entrega($decision=FALSE, $idveh=NULL)
    {
        if ($idveh==NULL)
        {
            Show_404 ();
        }

        if ($decision === FALSE){ //Falta arregla esto que no lo reconoce
            $this->usuario_bdd->modifica_estado($idveh,'liberado');
            $this->usuario_bdd->eliminar_agenda($idveh);
            $this->load->view('avisos/rechazar_agenda');
        }
        $this->usuario_bdd->modifica_estado($idveh,'recibir');
        //$this->usuario_bdd->agendar_vehiculo($idveh);
        $this->load->view('avisos/aceptar_agenda');
        


    }
    
//se va donde el ejecutivo
    //Se notifica la recepcion del vehiculo

    //Selecciona los vehiculos recibidos
    public function lisvehrec()
    {
        $data['title'] = 'Vehiculos por recepcionar';   
        $data['vehiculos']=$this->usuario_bdd->vehiculos_agendados(FALSE,'recibir');//$this->usuario_bdd->busqueda('vehiculo','recibir',FALSE);

        $this->load->view('templates/header',$data);
        $this->load->view('listrec',$data);
        $this->load->view('templates/footer');
    }

    //se va donde el ejecutivo
    public function porchec($idveh)
    {
        $this->usuario_bdd->modifica_estado($idveh,'chequear');
        //$this->usuario_bdd->agendar_vehiculo($idveh);
        $this->load->view('avisos/vehrec');
        

    }

//se va donde el mecanico
    //Lista de vehiculos por chequear
    public function cheveh()
    {
         $data['title'] = 'Vehiculos por chequear';   
        $data['vehiculos']=$this->usuario_bdd->vehiculos_agendados(FALSE,'chequear');//$this->usuario_bdd->busqueda('vehiculo','recibir',FALSE);

        $this->load->view('templates/header',$data);
        $this->load->view('listche',$data);
        $this->load->view('templates/footer');
    }

//se va donde el mecanico
    //Se insertan los servicios por hacer. se debe mejorar esta version
    public function vehchec($idveh)
    {
        $data['title'] = 'Seleccione servicio';
        $data['servicios']=$this->usuario_bdd->servicios();
        $data['idveh']=$idveh;


        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('servicio', 'servicio', 'required');
    

        if ($this->form_validation->run() === FALSE)
        {

            $this->load->view('templates/header',$data);
            $this->load->view('serv',$data);
            $this->load->view('templates/footer');

        }
        else
        {
            //$this->usuario_bdd->modifica_estado($idveh,'agendado');
            $this->insert->agregar_servicio($idveh);

            //$this->load->view('avisos/vehiculo_agendado');
            $this->load->view('templates/header',$data);
            $this->load->view('serv',$data);
            $this->load->view('templates/footer');

    
        }


    }

//se va donde el mecanico
    //el vehiculo se termina de chequear y ahora el ejecutivo revisa los costos    
    public function finche($idveh)
    {
        $this->usuario_bdd->modifica_estado($idveh,'costear');
        $this->load->view('avisos/cheqlisto');
            
    }


//se va donde el ejecutivo
    //lista de vehiculos a costear
    public function listconf()
    {
        $data['title'] = 'Verificar costos';   
        $data['vehiculos']=$this->usuario_bdd->vehiculos_confirmados(FALSE,'costear');

        $this->load->view('templates/header',$data);
        $this->load->view('liscon',$data);
        $this->load->view('templates/footer');

    }


    //falta agregar la funcion que muestre los servicios por revizar y asi modificar

//se va donde el ejecutivo    
    public function conftrab($idveh)
    {

        //teniendo el ejecutivo todo revisado

        $this->usuario_bdd->modifica_estado($idveh,'confirmar');//el coche cambia de estado
        $this->usuario_bdd->estado_trabajo($idveh,'confirmar');//el trabajo cambia de estado
        
        $this->load->view('avisos/cheqlisto');
            
    }


    //Busqueda general. todos pueden realizar busqueda
    //el cliente selecciona el vehiculo de los trabajos

//se queda
    //se puede mejorar el llamado
    
    public function selvehi($iduser=NULL)
    {
        $data['title'] = 'Seleccionar vehiculo';   
        $data['vehiculos']=$this->search->busqueda(false,'vehiculo','confirmar','dueño', $iduser,FALSE);
        //select, from, where
        $this->load->view('templates/header',$data);
        $this->load->view('selveh',$data);
        $this->load->view('templates/footer');
    }

//se queda
     public function selvehi2($fun=NULL)
    {

        $data['title'] = 'Seleccionar vehiculo';   
        $data['vehiculos']=$this->search->busqueda(false,'vehiculo','confirmar',FALSE, FALSE,FALSE);
        
        $this->load->view('templates/header',$data);
        $this->load->view('selveh',$data);
        $this->load->view('templates/footer');
    }

    //se queda
    //se recupera pass indicando el mail
    public function recpass($mensaje=FALSE)
    {
        

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('mail', 'mail', 'required');

        $data['title'] = 'Recuperar Contraseña';
        
        $data['mensaje'] = null;
        if($mensaje)
        {
            $data['mensaje'] = 'Usuario no existe';
        }



        if ($this->form_validation->run() === FALSE)
        {

            $this->load->view('templates/headerindex',$data);
            $this->load->view('consultas/recupass',$data);
            $this->load->view('templates/footerindex');
        }
        else
        {
            $data['usuario']=$this->security->xss_clean($this->search->busqueda('email,nombre,apellido,password','usuario',FALSE,'email',$this->input->post('mail'),FALSE));

            //print_r($data['usuario']) ;
            if ($data['usuario']!= null)
            {
                $mensaje=FALSE;

                $this->mail->enviarmail();
                redirect('/');
       
            }
            else
            {
                $mensaje=TRUE;
                 redirect(base_url().'mecanicapp/recpass/'. $mensaje);

            }
                //print_r($mensaje);
              
            
        }
    }


}