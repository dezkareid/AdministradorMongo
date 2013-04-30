	<div>
		<label for="nombre">Nombre:</label> 
		<input alt="Aqui va tu nombre" autofocus id="nombre" name="nombre" placeholder="Nombre completo" type="text"   />
	</div>
	<div>
		<label for="correo">Correo:</label>
		<input alt="Aqui va tu correo electronico" id="correo"  name="correo" placeholder="ejemplo@gmail" type="email" />
	</div>
	<div>
		<label for="usuario">Usuario:</label>
		<input alt="Aqui va tu nombre de usuario" id="usuario" name="usuario" placeholder="Tu nombre de usuario" type="text"  />
	</div>
	<div>
		<label for="password">Contraseña:</label>
		<input alt="Aqui va tu contraseña" id="password" name="password" placeholder="Contraseña" type="password"/>
	</div>
	<div>
		<label for="acceso">Nivel de acceso:</label>
		<select id="acceso" name="acceso">
			<option value="admin">Administrador</option>
			<option value="normal">Normal</option>
		</select>
	</div>
	<button id="agregar">Agregar</button>
	<br/>
	<br/>
	<div class="alert alert-info">
  		<label id="msg"></label>	
  	</div>
	<script src="<?=base_url()?>js/jquery.js"></script>
	<script src="<?=base_url()?>js/fAgregarUsuarios.js"></script>

