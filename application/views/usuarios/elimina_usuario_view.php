	<div>
		<label for="usuarios">Usuarios</label>
		<select id="listaUsuarios" name="usuarios">
			<option value="">Elige a un usuario </option>
			<?
				foreach ($usuarios as $key => $value) {
				?>
				<option value=<? echo $value["_id"];?>> <? echo $value["Usuario"]; ?> </option>
				<?
				}
			?>
		</select>
	</div>
	<button id="eliminar">Eliminar</button>
	<br/>
	<label id="msg"></label>

	<script src="<?=base_url()?>js/jquery.js"></script>
	<script src="<?=base_url()?>js/fEliminarUsuarios.js"></script>