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
      return true;
  }

  public function getUsuarios()
  {
    $this->mongo_db->select(array('_id','Usuario'));
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
