<?php echo $error;?>
<?php echo form_open_multipart('autobuses/guardar_imagen');?>
	<label for="autobus">Autobuses</label>
	<select required name="autobus">
		<option value="">Elige un autobus </option>
			<?
				foreach ($autobuses as $key => $value) {
			?>
		<option value=<? echo $value["_id"];?>> <? echo $value["Linea"]."-".$value["Descripcion"];  ?> </option>
			<?
				}
			?>
	</select>
	<br />
	<input required accept="image/jpeg" type="file" name="imagen"/>
	<br />
	<input type="submit" value="Subir Imagen" />
</form>