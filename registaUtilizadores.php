<?php
include "ligaBD.php";

require_once "mail.php";

$nome = $_POST['nome'];
$email = $_POST['email'];
$cargo = $_POST['cargo'];
$pass = sha1($_POST['password']);


$consulta = $liga->query("SELECT email FROM utilizador WHERE email='$email'");
$exibe = $consulta->fetch_assoc();

if(mysqli_num_rows($consulta) ){
    echo "<div class='alert alert-danger'>Email já cadastrado!</div>";
} else{
    $query = "INSERT INTO utilizador (nome, email, cargo, password) VALUES('$nome','$email', '$cargo', '$pass')";
        if(mysqli_query($liga,$query)){
            $destinario = $_POST['email'];
            if(isset($_POST['nome']) && !empty(['nome']) && isset($_POST['email']) && !empty(['email']) && isset($_POST['cargo']) && !empty(['cargo'])  && isset($_POST['password']) && !empty(['password'])){

                $assunto = "Bem-vindo(a) a #";
                $mensagem = "<html><head>
                            <div style='background-color: #ebebeb; border-radius: 9px; height: 300px; padding: 10px;'>
                            <h2 style='margin-left: 10%;'> O seu registo foi efetuado com sucesso no site #.</h2>
                            <hr>
                            <p style='margin-left: 10%;'> Obrigado pelo seu registo.</p> 
                            </div>
                            </head></html>";
            if(send($assunto, $mensagem, $email)){
                    echo "Enviado";
                 } else{
                    echo "<div class='alert alert-danger'>Erro ao enviar email</div>";
                }
            } else{
                echo "<div class='alert alert-danger'>Preencha todos os campos</div>";
            }  
        }
            header("Location: index.html"); 
}
mysqli_close($liga);
?>