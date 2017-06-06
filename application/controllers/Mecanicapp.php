<?php
class Mecanicapp extends CI_Controller {
            public function __construct()
        {
                parent::__construct();
                $this->load->model('usuario_bdd');
                $this->load->helper('url_helper');

        }
  
    //inicio pagina con lista de opcione separadas por tipo de usuario
    public function index()
    {
        
    $data['title']='Bienvenido a MecanicApp';

	$this->load->view('templates/header',$data);
	$this->load->view('bienvenida');
	$this->load->view('templates/footer');
	}
	

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
        
        $this->usuario_bdd->ingresar_servicio();
        $this->load->view('avisos/servicio_agregado');
    }

    }

    //Registra cualquier tipo de usuario.     
    public function reguser($user=NULL)
    {
    $this->load->helper('form');
    $this->load->library('form_validation');

    $data['title'] = 'Registro de usarios';

    $data['subtitle1'] = 'Ingrese el usuario';
    $this->form_validation->set_rules('rut', 'rut', 'required');
    $this->form_validation->set_rules('nombre', 'nombre', 'required');
    $this->form_validation->set_rules('apellido', 'apellido', 'required');
    $this->form_validation->set_rules('email', 'email', 'required');
    $this->form_validation->set_rules('pass', 'pass', 'required');
    
    if ($this->form_validation->run() === FALSE)
    {

        $this->load->view('templates/header',$data);
        
        if (empty($user)){
        $this->load->view('registro/regisuser',$data);
            
        }
        else{
             $this->load->view('registro/regiscli',$data);
        }
        $this->load->view('templates/footer');
    }
    
    else
    {
        
        $this->usuario_bdd->ingresar_usuario($user);
        $this->load->view('avisos/usuario_agregado');
    }

    }
    
    //Lista de usuarios. Temporal y para seleccionar auarios para dirigirse a la funcion
    public function lista_usuarios($fun=NULL)
    {
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
        $this->usuario_bdd->ingresar_vehiculo($iduser);
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

    //Pedir hora. sirve para modificar el estado del vehiculo a solicitar
    public function pediragen($idveh=NULL)
    {
        If ($idveh==NULL)
        {
            Show_404 ();
        }
    
        $this->usuario_bdd->modifica_estado($idveh,'solicita','vehiculo');
        $this->load->view('avisos/vehiculo_solicitado');
    }

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

    //Ejecutivo

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
            $this->usuario_bdd->modifica_estado($idveh,'agendado','vehiculo');
            $this->usuario_bdd->agendar_vehiculo($idveh);
            $this->load->view('avisos/vehiculo_agendado');

    
        }


    }

    
     //Momento de dar fecha y hora al vehiculo 
    public function entveh($iduser=NULL)
    {
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

    //Se toma la decision sobre el agendamiento
    public function entrega($decision=FALSE, $idveh=NULL)
    {
        if ($idveh==NULL)
        {
            Show_404 ();
        }

        if ($decision === FALSE){ //Falta arregla esto que no lo reconoce
            $this->usuario_bdd->modifica_estado($idveh,'liberado','vehiculo');
            $this->usuario_bdd->eliminar_agenda($idveh);
            $this->load->view('avisos/rechazar_agenda');
        }
        $this->usuario_bdd->modifica_estado($idveh,'recibir','vehiculo');
        //$this->usuario_bdd->agendar_vehiculo($idveh);
        $this->load->view('avisos/aceptar_agenda');
        


    }
    

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

    
    public function porchec($idveh)
    {
        $this->usuario_bdd->modifica_estado($idveh,'chequear','vehiculo');
        //$this->usuario_bdd->agendar_vehiculo($idveh);
        $this->load->view('avisos/vehrec');
        

    }

    //Lista de vehiculos por chequear
    public function cheveh()
    {
         $data['title'] = 'Vehiculos por chequear';   
        $data['vehiculos']=$this->usuario_bdd->vehiculos_agendados(FALSE,'chequear');//$this->usuario_bdd->busqueda('vehiculo','recibir',FALSE);

        $this->load->view('templates/header',$data);
        $this->load->view('listche',$data);
        $this->load->view('templates/footer');
    }

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
            $this->usuario_bdd->agregar_servicio($idveh);
            //$this->load->view('avisos/vehiculo_agendado');
            $this->load->view('templates/header',$data);
            $this->load->view('serv',$data);
            $this->load->view('templates/footer');

    
        }


    }
    
    public function finche($idveh)
    {
        $this->usuario_bdd->modifica_estado($idveh,'confirmar','vehiculo');
        $this->load->view('avisos/cheqlisto');
            
    }

    public function listconf()
    {
        $data['title'] = 'Verificar costos';   
        $data['vehiculos']=$this->usuario_bdd->vehiculos_agendados(FALSE,'confirmar');//busqueda('vehiculo','confirmar',FALSE);

        $this->load->view('templates/header',$data);
        $this->load->view('liscon',$data);
        $this->load->view('templates/footer');

    }


    public function costotal($idveh)
    {
        $data['title'] = 'Lista de trabajos';
        $data['trabajos']=$this->usuario_bdd->trabajos_confirmados($idveh,'confirmar');

        $this->load->view('templates/header',$data);
        $this->load->view('listcosto',$data);
        $this->load->view('templates/footer');
  
    }

    public function preapro($idveh)
    {

        $this->usuario_bdd->modifica_estado($idveh,'preaprobado','trabajo');
        $this->load->view('avisos/cheqlisto');
    }

}