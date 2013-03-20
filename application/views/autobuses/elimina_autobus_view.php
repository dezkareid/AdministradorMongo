	<div>
		<label for="Autobuses">Autobuses</label>
		<select id="Autobuses" name="Autobuses">
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

	<button id="autobus-eliminar">Eliminar</button>