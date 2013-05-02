<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validador {

	public function __construct() {
	
	}

	public function eliminaCaracteresEspeciales($cadena)
	{
		$cadena=preg_replace("/!|;|-|{|}|\t|\n|\r/","",$cadena);
		filter_var($cadena FILTER_SANITIZE_STRING,FILTER_SANITIZE_STRIPPED);
	}

	public function eliminaEspacios($cadena)
	{
		$cadena= trim($cadena);
		$cadena = preg_replace("/ +/"," ",$cadena);	
		return $cadena;
	}

	public function validaNombre($cadena)
	{
		return preg_match('/^[a-z áéíóúñ]/i', $cadena);
	}

	public function validaUsuario($cadena)
	{
		# code...
	}

	public function validaPassword($value='')
	{
		
	}

	public function validaEmail($cadena)
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	public function validaNumero($cadena)
	{
		return filter_var($nume, FILTER_VALIDATE_INT);
	}

	public function validaFlotante($cadena)
	{
		$puntos=substr_count($cadena, '.');
		if($puntos==0||$puntos>1)
			return false;
		return filter_var($nume, FILTER_VALIDATE_FLOAT);

	}

}

?>