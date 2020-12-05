<div class="login-box">
      <img src="img/logoAAA.svg" class="avatar" alt="Avatar Image">
      <form method="POST" action="php/usr/USRagrega.php" id="registrar_frm" name="registrar_frm" enctype="application/x-www-form-urlencoded">
        <!-- e-mail -->
        <label for="usr">e-mail</label>
        <input type="email" name="usr" id="usr" class="caja-texto" placeholder="Tu e-mail" required>
        
        <!-- Nombre -->
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" class="caja-texto" placeholder="Nombre" required >

        <!-- PASSWORD  -->
        <label for="psw">Password</label>
        <input type="password" name="psw" id="psw" class="caja-texto" placeholder="Password" required>
        
        <!-- Confirma PSW  -->
        <label for="conpsw">Confirma Password</label>
        <input type="password" name="conpsw" id="conpsw" class="caja-texto" placeholder="Confirma Contraseña" required />

        <input type="submit" id="enviar" name="enviar" value="REGISTRATE">
        <a href="?op=1"> Ingresa</a>
      </form>
</div>