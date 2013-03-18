	<div>
		<label for="usuarios">Usuarios</label>
		<select id="listaUsuarios" name="usuarios">
		</select>
	</div>

	<div>
		<label for="nombre">Nombre:</label> 
		<input alt="Aqui va tu nombre" autofocus id="nombre" name="nombre" type="text"  placeholder="Nombre completo" />
	</div>
	<div>
		<label for="correo">Correo:</label>
		<input alt="Aqui va tu correo electronico" id="correo" placeholder="ejemplo@gmail" name="correo" type="email" />
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

	<button>Guardar cambios</button>