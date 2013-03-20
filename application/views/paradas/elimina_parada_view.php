	<div>
		<label for="autobuses">Autobuses</label>
		<select id="AutobusesPEliminar" name="autobuses">
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
	<button id="parada-eliminar">Eliminar</button>