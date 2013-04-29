<?php
Class Autobus extends CI_Model{

  function __construct(){
    parent::__construct();
  }

  public function agregar($_id,$linea, $descripcion, $trayecto, $primeraSalida, $ultimaSalida, $tiempoEspera)
  {
  	$autobus = array('_id' => $_id,
      'Linea' => $linea, 
      'Descripcion'=>$descripcion,
      'Trayecto'=> $trayecto,
      'PrimeraSalida'=>$primeraSalida,
      'UltimaSalida'=>$ultimaSalida,
      'TiempoEspera' => (int) $tiempoEspera,
      'Paradas'=> array()
       );
  	return $this->mongo_db->save("Autobuses",$autobus);
  }

  public function actualizarAutobus($_id,$linea, $descripcion, $trayecto, $primeraSalida, $ultimaSalida, $tiempoEspera)
  {
    $autobus = array(
      'Linea' => $linea, 
      'Descripcion'=>$descripcion,
      'Trayecto'=> $trayecto,
      'PrimeraSalida'=>$primeraSalida,
      'UltimaSalida'=>$ultimaSalida,
      'TiempoEspera' => $tiempoEspera,
       );
    return $this->mongo_db->where(array(
    '_id'=> $_id
    ))->update("Autobuses",$autobus);

  }

  public function eliminaAutobus($id)
  {
    return $this->mongo_db->where(array(
    '_id'=> $id
    ))->delete("Autobuses");
  }


  public function getUltimoId()
  {

  	$this->mongo_db->order_by(array('_id'=>'desc'));
  	$this->mongo_db->select(array('_id'));
  	$this->mongo_db->limit('1');
    return $this->mongo_db->get('Autobuses');
  }

  public function getAutobuses()
  {
    $this->mongo_db->order_by(array('Linea'=>'ASC'));
    $this->mongo_db->select(array('_id','Linea'));
    return $this->mongo_db->get('Autobuses');
  }

  public function getAutobus($id)
  {
    $datos=$this->mongo_db->where(array(
    '_id'=> $id
    ))->get('Autobuses');

    return $datos;
  }

}
?>
