<?php
ob_start();
?>
<?php
session_start();
if(isset($_SESSION['logueado']) && $_SESSION['logueado'] == TRUE) {
  header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Mercurio</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>

  <div id="wrapper">

    <div class="w-left"><img src="images/logotipo.png"></div>

    <div class="w-right">

      <?php
      if(isset($_GET['error'])) {
        echo "<center>Error el usuario o contraseña no coinciden</center>";
      }
      ?>

      <?php
      if(isset($_POST['entrar'])) {

        require("conexion.php");

        $username = $mysqli->real_escape_string($_POST['usuario']);
        $password = md5($_POST['password']);

        $consulta = "SELECT username,password,id FROM users WHERE username = '$username' AND password = '$password'";

        if($resultado = $mysqli->query($consulta)) {
          while($row = $resultado->fetch_array()) {

            $userok = $row['username'];
            $passok = $row['password'];
            $id = $row['id'];
          }
          $resultado->close();
        }
        $mysqli->close();


        if(isset($username) && isset($password)) {

          if($username == $userok && $password == $passok) {

            session_start();
            $_SESSION['logueado'] = TRUE;
            $_SESSION['username'] = $userok;
            $_SESSION['id'] = $id;
            header("Location: home.php");

          }

          else {

            Header("Location: index.php?error=login");

          }

        }


      }
      ?>

      <div class="main-content">
        <div class="header">
          <img src="images/logo.png">
        </div>
        <div class="l-part">
          <form action="" method="post">
            <input type="text" placeholder="Usuario" class="input" name="usuario" autocomplete="off" />
            <div class="overlap-text">
              <input type="password" placeholder="Contraseña" class="input" name="password" />
              <a href="olvidocontrasena.php">Olvidaste?</a>
            </div>
            <input type="submit" value="Entrar" class="btn" name="entrar" />




          </form>
        </div>
      </div>

      <div class="sub-content">
        <div class="s-part">
          ¿No tienes una cuenta? <a href="registro.php">Regístrate</a>

          
        </div>
      </div>



      <div class="sub-content">
        <div class="s-part">
    <a href="https://coreas1703.wixsite.com/my-site">Ayuda</a>
        </div>
      </div>


    


    <center><img src="     "></center>



    </div>

  </div>

</body>
</html>
<?php
ob_end_flush();
?>
