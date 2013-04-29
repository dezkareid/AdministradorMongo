<div class="container"> 
	<div class="container-fluid">
	    <div class="row-fluid">
	    	<div class="span5">
				<div>
					<label for="dependencias">Dependencias</label>
					<select id="listaDependencias" name="dependencias">
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
				<div>
					<label for="nombre">Nombre:</label> 
					<input alt="Nombre de la dependencia" autofocus id="nombre" name="nombre" placeholder="Nombre de la dependencia" type="text"   />
				</div>
				<div>
					<label for="unidad">Unidad:</label> 
					<input alt="Nombre de la unidad donde se encuentra la dependencia" id="unidad" name="unidad" placeholder="Ciencias de la salud" type="text"   />
				</div>
				<div>
					<label for="colonia">Colonia:</label>
					<input alt="Colonia en la que se encuentra la dependencia" id="colonia" name="colonia" placeholder="Obrero-Campesino" type="text"  />
				</div>
				<div>
					<label for="calle">Calle:</label>
					<input alt="Calle en la que se encuentra la dependencia" id="calle"  name="calle" placeholder="Avila Camacho" type="text"/>
				</div>
				<div>
					<label for="numero">Numero:</label>
					<input alt="Numero de la dependencia" id="numero"  name="numero" placeholder="#12" type="number" />
				</div>
				<div>
					<label for="cp">Código postal:</label>
					<input alt="Código postal de la dependencia" id="cp" name="cp" placeholder="Código postal" type="number"/>
				</div>
				<div>
					<label for="telefono">Telefóno:</label>
					<input alt="Telefóno de la dependencia" id="telefono" name="telefono" type="text" />
				</div>
				<div>
					<label for="pagina">Página web:</label>
					<input alt="Página de la dependencia" id="pagina" name="pagina" placeholder="www.uv.mx/dependencia" type="url"/>
				</div>
				<div>
					<label for="lat">Latitud:</label>
					<input alt="Latitud del lugar" id="lat" name="lat" placeholder="19.01010101" type="text"/>
				</div>
				<div>
					<label for="long">Longitud:</label>
					<input alt="Longitud del lugar" id="long" name="long" placeholder="96.00020200" type="text"/>
				</div>
				<button id="dependencia-actualizar">Actualizar</button>
				</div>
			<div class="span7">
	       		<div id="map_canvas">
	       		</div>
	      	</div>
	    </div>
	</div>
</div>