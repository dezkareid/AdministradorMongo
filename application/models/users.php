<?php
Class Users extends CI_Model{

  function __construct(){
    parent::__construct();
  }

  public function login($username, $password)
  {
    $datos=$this->mongo_db->where(array(
    'Usuario'=>$username,
    'Password'=>sha1($password)
    ))->get('Usuarios');

    if(sizeof($datos)>1||sizeof($datos)==0)
      return false;
    $data= array('user' =>$datos[0]['Usuario'] ,'pass'=> $datos[0]['Password']);
    $this->session->set_userdata('logueo',$data);
    return true;
  }

  public function logueado()
  {
    if(!$this->session->userdata('logueo'))
    {

     return 0;

    }

      $session_data = $this->session->userdata('logueo');
      $user = $session_data['user'];
      $pass = $session_data['pass'];
      $result=$this->users->loged($user,$pass);
      return $result;
  }

  public function loged($username, $password)
  {
    $privilegios=0;
    $datos=$this->mongo_db->where(array(
    'Usuario'=>$username,
    'Password'=>$password
    ))->get('Usuarios');

    if(sizeof($datos)==1)
      $privilegios++;
    if(!strcmp($datos[0]['Acceso'],'admin'))
      $privilegios++;
    $this->mongo_db->clear();
    return $privilegios;
  }

    public function getNumUsuarios($username)
  {
    $datos=$this->mongo_db->where(array('Usuario'=>$username))->get('Usuarios');
    return $datos;
  }

  public function getUsuarios()
  {
    $this->mongo_db->order_by(array('Nombre'=>'ASC'));
    return $this->mongo_db->get('Usuarios');
  }

  public function agrega($data)
  {
    return $this->mongo_db->save("Usuarios",$data);
  }

  public function actualizaUsuario($id,$usuario,$password,$nombre,$correo,$acceso)
  {
    $data=null;
    if(empty($password))
    {
      $data = array('Usuario' => $usuario,'Nombre'=> $nombre, 'Correo'=> $correo, 'Acceso'=> $acceso);
    }
    else
    {
      $data=array('Usuario' => $usuario,'Password'=> sha1($password),'Nombre'=> $nombre, 'Correo'=> $correo, 'Acceso'=> $acceso);
    }
    return $this->mongo_db->where(array(
    '_id'=> new MongoId($id)
    ))->update("Usuarios",$data);
  }


  public function eliminaUsuario($id)
  {
    return $this->mongo_db->where(array(
    '_id'=> new MongoId($id)
    ))->delete("Usuarios");
  }

  public function getUsuario($id)
  {
    $datos=$this->mongo_db->where(array(
    '_id'=> new MongoId($id)
    ))->get('Usuarios');

    return $datos;
  }
}
?>
