	<div>
		<label for="linea">Linea :</label> 
		<input alt="Linea del autobus" autofocus id="linea" name="linea" placeholder="Interbus" type="text"/>
	</div>
	<div>
		<label for="descripcion">Descripción:</label>
		<textarea alt="Descripción del autobus" id="descripcion"  name="descripcion" placeholder="Amarillo pasa por medicina"></textarea>
	</div>
	<div>
		<label for="trayecto">Trayecto:</label>
		<textarea alt="Trayecto que recorre el autobus" id="trayecto" name="trayecto" placeholder="AV. Xalapa, Av. Ávila Camacho"></textarea>
	</div>
	<div>
		<label for="primeraSalida">Primera Salida:</label>
		<input alt="Hora de la primera salida del autobus" id="primeraSalida" name="primeraSalida" placeholder="06:00" type="time"/>
	</div>
	<div>
		<label for="ultimaSalida">Última Salida:</label>
		<input alt="Hora de la ultima salida del autobus" id="ultimaSalida" name="ultimaSalida" placeholder="22:00" type="time"/>
	</div>
	<div>
		<label for="tiempoEspera">Tiempo de espera:</label>
		<input alt="Tiempo que tarda pasar cada camión" id="tiempoEspera" name="tiempoEspera" placeholder="30" type="number"/>
	</div>
	<button id="autobus-agregar">Agregar</button>
	<br/>
	<br/>
	<div class="alert alert-info">
  		<label id="msg"></label>	
  	</div>
	<script src="<?=base_url()?>js/jquery.js"></script>
	<script src="<?=base_url()?>js/fAgregaAutobus.js"></script>
