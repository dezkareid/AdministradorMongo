<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validador {

	public function __construct() {
	
	}

	function estaVacia($cadena)
	{
		return empty($cadena);
	}


	public function eliminaCaracteresEspeciales($cadena)
	{
		$cadena=preg_replace("/!|;|-|{|}|\t|\n|\r/","",$cadena);
		filter_var($cadena, FILTER_SANITIZE_STRING,FILTER_SANITIZE_STRIPPED);
		return $cadena;
	}

	public function eliminaEspacios($cadena)
	{
		$cadena= trim($cadena);
		$cadena = preg_replace("/ +/"," ",$cadena);	
		return $cadena;
	}

	public function limpieza($cadena)
	{
		$cadena= $this->eliminaCaracteresEspeciales($cadena);
		$cadena= $this->eliminaEspacios($cadena);
		return $cadena;
	}
	
	public function validaAcceso($cadena)
	{
		$b=$this->estaVacia($cadena)||strlen($cadena)>20;
		return !$b;		
	}

	public function validaActualizarDependencia($unidad, $nombre, $calle, $colonia, $cp,$numero,$pagina,$telefono,$latitud, $longitud)
	{
	}

	public function validaActualizarUsuario($usuario,$password,$nombre,$correo,$acceso,$accion)
	{
		$a= $this->validaNombreUsuario($usuario)&&$this->validaNombre($nombre);
		$b= $this->validaEmail($correo)&&$this->validaAcceso($acceso);
		if($accion==1)
			$c= strlen($password)<40;
		else
			$c= $this->validaPassword($password); 
		if($a&&$b&&$c)
		return true;
		return false;
	}

	public function validaCoordenada($cadena)
	{
		return filter_var($cadena, FILTER_VALIDATE_FLOAT);
	}

	public function validaNombre($cadena)
	{

		return preg_match('/^[a-z áéíóúñ]+$/i', $cadena)&&strlen($cadena)<80;
	}

	public function validaNombreUsuario($cadena)
	{
		$b=$this->estaVacia($cadena)||strlen($cadena)>80;

		return preg_match('/^[a-z\d_]{4,28}$/i', $cadena)&&!$b;
	}

	public function validaPassword($cadena)
	{
		$b=$this->estaVacia($cadena)||strlen($cadena)>80;

		return preg_match('/^[a-z\d_]{4,28}$/i', $cadena)||!$b;
	}

	public function validaEmail($cadena)
	{ 
		$b=strlen($cadena)>80;

		return filter_var($cadena, FILTER_VALIDATE_EMAIL)&&!$b;
	}
		

	public function validaNumero($cadena)
	{
		$b=strlen($cadena)>80;
		return filter_var($cadena, FILTER_VALIDATE_INT)&&!$b;
	}

	public function validaFlotante($cadena)
	{
		$puntos=substr_count($cadena, '.');
		if($puntos==0||$puntos>1)
			return false;
		$b=strlen($cadena)>80;
		return filter_var($cadena, FILTER_VALIDATE_FLOAT)&&!$b;

	}

	public function validaUrl($cadena)
	{
		$b=strlen($cadena)>80;
		return filter_var($cadena, FILTER_VALIDATE_URL)&&!$b;
	}

}

/* End of file Validador.php */
?>