<div class="login-box">
      <img src="img/logoAAA.svg" class="avatar" alt="Avatar Image">
      <h1>BIENVENIDO</h1>
      <form method="POST" action="php/usr/USRvalida.php" id="acceder_frm" name="acceder_frm" enctype="application/x-www-form-urlencoded">
        <!-- USERNAME INPUT -->
        <label for="usr">e-mail</label>
        <input type="email" name="usr" id="usr" class="caja-texto" placeholder="Tu e-mail" required>

        <!-- PASSWORD INPUT -->
        <label for="psw">Password</label>
        <input type="password" name="psw" id="psw" class="caja-texto" placeholder="Password" required>

        <input type="submit" id="enviar" name="enviar" value="Accesar">

        <a href="?op=2"> Suscribete</a>
      </form>
</div>