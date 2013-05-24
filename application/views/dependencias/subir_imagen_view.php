<?php echo $error;?>
<?php echo form_open_multipart('dependencias/guardar_imagen');?>
	<label for="dependencia">Dependencias</label>
	<select required name="dependencia">
		<option value="">Elige una dependencia </option>
			<?
				foreach ($dependencias as $key => $value) {
			?>
		<option value=<? echo $value["_id"];?>> <? echo $value["NOMBRE"]; ?> </option>
			<?
				}
			?>
	</select>
	<br />
	<input required accept="image/jpeg" type="file" name="imagen"/>
	<br />
	<input type="submit" value="Subir Imagen" />
</form>