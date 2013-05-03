<div class="container">
    <div class="container-fluid">
	    <div class="row-fluid">
	    	<div class="span5">
				<div>
					<label for="autobuses">Autobuses</label>
					<select id="AutobusesP" name="autobuses">
						<option value="">Elige una autobus </option>
						<?
							foreach ($autobuses as $key => $value) {
							?>
							<option value=<? echo $value["_id"];?>> <? echo $value["Linea"]."-".$value["Descripcion"]; ?> </option>
							<?
							}

						?>
					</select>
				</div>
				<div>
					<label for="indice">Indice :</label> 
					<input alt="Indice de visita del autobus a esa paradda" autofocus id="indice" name="indice" placeholder="1" type="number"/>
				</div>
				<div>
					<label for="tiempo">Tiempo :</label> 
					<input alt="Tiempo que tarda en llegar un camion a esa parada desde el punto anterior" id="tiempo" name="tiempo" placeholder="1" type="text"/>
				</div>
				<div>
					<label for="latitud">Latitud :</label> 
					<input alt="Latitud de la parada" id="latitud" name="latitud" placeholder="19.xxxxxx" type="text"/>
				</div>
				<div>
					<label for="longitud">Longitud :</label> 
					<input alt="Longitud de la parada" id="longitud" name="longitud" placeholder="-96.xxxxxx" type="text"/>
				</div>
				<button id="ver-Coordenadas"> Visualizar Coordenas</button>
				<button id="parada-agregar">Agregar</button>
				<br/>
				<br/>
				<div class="alert alert-info">
  					<label id="msg"></label>	
  				</div>
			</div>
			<div class="span7">
	       		<div id="map_canvas">
	       		</div>
	      	</div>

	    </div>
    </div>
</div>
<script src="<?=base_url()?>js/jquery.js"></script>
<script src="<?=base_url()?>js/fAgregarParada.js"></script>
