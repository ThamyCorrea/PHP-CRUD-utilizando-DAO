//CODIGO COM O USO DO DAO

<?php

require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if($name && $email){

    if($usuarioDao->findByEmail($email) === false){
        $novoUsuario = new Usuario();
        $novoUsuario->setNome($name);
        $novoUsuario->setEmail($email);   

        $usuarioDao->add($novoUsuario);

        header("Location: index.php");
        exit;
    }else{
        header("Location: adicionar.php");
    exit;
    }
}

    
       // CODIGO SEM O USO DO DAO
    
    // $sql = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");

    // $sql->bindValue(':email', $email);
    // $sql->execute();

    // if($sql->rowCount() === 0){

    //     $sql = $pdo->prepare("INSERT INTO usuario (nome, email) VALUES(:name, :email)");

    //     $sql->bindValue(':name', $name);
    //     $sql->bindValue(':email', $email);
    //     $sql->execute();
        
    //     header("Location: index.php");
    //     exit;
    //     }else{
    //         header("Location: adicionar.php");
    //         exit;
    //     }
    // }else{
    // header("Location: adicionar.php");
    // exit;
    // }

