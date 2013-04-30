	<div>
		<label for="dependencias">Dependencias</label>
		<select id="Dependencias" name="dependencias">
			<option value="">Elige una dependencia </option>
			<?
				foreach ($dependencias as $key => $value) {
				?>
				<option value=<? echo $value["_id"];?>> <? echo $value["NOMBRE"]; ?> </option>
				<?
				}
			?>
		</select>
	</div>

	<button id="dependencia-eliminar">Eliminar</button>
	<br/>
	<label id="msg"></label>