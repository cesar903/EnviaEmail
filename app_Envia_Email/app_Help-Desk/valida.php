<?php
    //esta função permite bloquear as paginas caso queira entrar pela url
    session_start();

    //Recebe o formulario atraves da action pelo metodo post
    $_POST['email'];
    $_POST['senha'];

    $perfis = [1=> 'adm', 2 => 'user'];
    $id_perfil= null;
    
    $usuarios = [
        ['id'=> 1, 'email' => 'adm@teste.com.br', 'senha' => '1234', 'perfil' => 1],
        ['id'=> 2,'email' => 'usuario@teste.com.br', 'senha' => 'abcd', 'perfil' => 1],
        ['id'=> 3,'email' => 'jose@teste.com.br', 'senha' => '1234', 'perfil' => 2],
        ['id'=> 4,'email' => 'maria@teste.com.br', 'senha' => '1234' ,'perfil' => 2],

    ];
    $usuario_autenticado = false;
    $id_usuario= null;

    //Faz a comparação pra ver se ha um email e senha iguais para autenticação
    foreach($usuarios as $user){


        if($user['email'] == $_POST['email'] && $user['senha'] == $_POST['senha']){
            $usuario_autenticado = true;
            $id_usuario = $user['id'];
            $id_perfil = $user['perfil'];
        }
    }
    if($usuario_autenticado){
        //se houver senha e email iguais ele te manda pro home pelo header
        header('Location: home.php');
        //Uma variavel na section é criada, e recebe sim caso seja true
        $_SESSION['autenticado'] = 'SIM';
        $_SESSION['id'] = $id_usuario;
        $_SESSION['perfil'] = $id_perfil;
    }else{
        //Uma variavel na section é criada, e recebe nao caso seja false
        $_SESSION['autenticado'] = 'NAO';
        //O header é uma função do php que força o retorno para a pagina index
        header('Location: index.php?login=erro');
    }
    
?>