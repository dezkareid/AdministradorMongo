<?php
Class Parada extends CI_Model{

  function __construct(){
    parent::__construct();
  }

  public function actualizarParadas($_id,$paradas)
  {
  	$autobus = array(
      'Paradas'=> $paradas
       );
  	 return $this->mongo_db->where(array(
    '_id'=> $_id
    ))->update("Autobuses",$autobus);
  }

  public function getParadas($_id)
  {

    $this->mongo_db->where(array('_id'=> $_id));
    $this->mongo_db->select(array('Paradas'));
    return $this->mongo_db->get('Autobuses');
  }


}
?>
