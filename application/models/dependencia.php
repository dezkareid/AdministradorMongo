<?php
Class Dependencia extends CI_Model{

  function __construct(){
    parent::__construct();
  }

  public function agregar($_id,$unidad, $nombre, $calle, $colonia, $cp,$numero,$pagina,$telefono,$latitud, $longitud)
  {
  	$dependencia = array('_id' => $_id,
      'UNIDAD' => $unidad, 
      'NOMBRE'=>$nombre,
      'CALLE'=> $calle,
      'COLONIA'=>$colonia,
      'COD_POSTAL'=>$cp,
      'NUMERO' => $numero,
      'WWW'=>$pagina,
      'TELEFONO'=>$telefono,
      'LATITUD'=>$latitud,
      'LONGITUD'=>$longitud
       );
  	return $this->mongo_db->save("Dependencias",$dependencia);
  }

  public function actualizarDependencia($_id,$unidad, $nombre, $calle, $colonia, $cp,$numero,$pagina,$telefono,$latitud, $longitud)
  {
    $dependencia = array(
      'UNIDAD' => $unidad, 
      'NOMBRE'=>$nombre,
      'CALLE'=> $calle,
      'COLONIA'=>$colonia,
      'COD_POSTAL'=>$cp,
      'NUMERO' => $numero,
      'WWW'=>$pagina,
      'TELEFONO'=>$telefono,
      'LATITUD'=>$latitud,
      'LONGITUD'=>$longitud
       );
    return $this->mongo_db->where(array(
    '_id'=> $_id
    ))->update("Dependencias",$dependencia);

  }

  public function eliminaDependencia($id)
  {
    return $this->mongo_db->where(array(
    '_id'=> $id
    ))->delete("Dependencias");
  }

  public function getUltimoId()
  {

  	$this->mongo_db->order_by(array('_id'=>'desc'));
  	$this->mongo_db->select(array('_id'));
  	$this->mongo_db->limit('1');
    return $this->mongo_db->get('Dependencias');
  }

  public function getDependencias()
  {
    $this->mongo_db->order_by(array('NOMBRE'=>'ASC'));
    $this->mongo_db->select(array('_id','NOMBRE'));
    return $this->mongo_db->get('Dependencias');
  }

  public function getDependencia($id)
  {
    $datos=$this->mongo_db->where(array(
    '_id'=> $id
    ))->get('Dependencias');

    return $datos;
  }

}
?>
