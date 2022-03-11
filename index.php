<?php
$altert= '';
session_start();

if(!empty($_SESSION['active'])){
    header('location: sistema/indeex.php');
}
else{

    if(!empty($_POST)){
        if(empty($_POST['usuario']) || empty($_POST['clave'])){
            $altert= 'Ingrese su usuario y su clave';
        }
        else{

            require_once "conexion.php";

            $user = $_POST['usuario'];
            $pass = $_POST['clave'];

            $query= mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' AND clave = '$pass'");
            $result= mysqli_num_rows($query);

            if($result > 0){
                $data = mysqli_fetch_array($query);

                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $data['idusuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['user'] = $data['usuario'];
                $_SESSION['rol'] = $data['rol'];

                header('location: sistema/indeex.php');
            }
            else{
                $altert = 'El usuario o la clave son incorrectos';
                session_destroy();
            }
        }
    }

}    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Login | Sisteme Ventas</title>
</head>
<body>
    <section id="container">
        <form action="" method="post">

            <h3>Iniciar Sesión</h3>
            <img src="img/logoL.png" alt="Login">

            <input type="text" name="usuario" placeholder="User">
            <input type="password" name="clave" placeholder="Password">
            <div class="alter"><?php echo(isset($altert) ? $altert: '' ); ?></div>
            <input type="submit" value="INGRESAR">

        </form>
    </section>
</body>
</html>