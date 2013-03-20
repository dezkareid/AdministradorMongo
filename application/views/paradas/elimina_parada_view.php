	<div>
		<label for="autobuses">Autobuses</label>
		<select id="AutobusesPEditar" name="autobuses">
			<option value="">Elige una autobus </option>
			<?
				foreach ($autobuses as $key => $value) {
				?>
				<option value=<? echo $value["_id"];?>> <? echo $value["Linea"]; ?> </option>
				<?
				}

			?>
		</select>
	</div>
	<div>
		<label for="indice">Indice :</label> 
		<select id="indicePEliminar" name="indice"></select>
	</div>
	<div>
		<label for="latitud">Latitud :</label> 
		<input alt="Latitud de la parada" id="latitud" name="latitud" placeholder="19.xxxxxx" type="text"/>
	</div>
	<div>
		<label for="longitud">Longitud :</label> 
		<input alt="Longitud de la parada" id="longitud" name="longitud" placeholder="-96.xxxxxx" type="text"/>
	</div>
	<button id="eliminar-parada">Eliminar</button>