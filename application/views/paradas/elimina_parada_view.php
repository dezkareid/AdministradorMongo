<div class="container">
    <div class="container-fluid">
    	<div class="row-fluid">
      		<div class="span5">
				<div>
					<label for="autobuses">Autobuses</label>
					<select id="AutobusesPEliminar" name="autobuses">
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
					<select id="indicePEliminar" name="indice"></select>
				</div>
				<button id="parada-eliminar">Eliminar</button>
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

	<footer>

	</footer>
		<script src="<?=base_url()?>js/jquery.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
		<script src="<?=base_url()?>bootstrap/js/bootstrap.js"></script>
		<script src="<?=base_url()?>js/fEliminarParada.js"></script>
		
</body>
</html>