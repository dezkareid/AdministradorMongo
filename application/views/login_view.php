
	<h1>Directorio geográfico UV</h1>
	<form action="<?=base_url()?>index.php/login/process" method="post" name="process">
        <div>
            <label for="username">Username:</label>
            <input autofocus alt="Usuario del sistema" id="username" name="username" size="20" type="text" />
        </div>

        <div>
            <label for="password">Password:</label>
            <input alt="El password de tu usuario"  id="password" name="password"  size="20" type="password" />
        </div>
        <input type="submit" value="Login"/>
   </form>
