<?php

session_start();
//há dois jeitos de apagar os dados quando sair do programa

//remover os indices do array de sessão
//unset()
unset($_SESSION);

//Faz o redirecionamento do site
header('location: index.php');
//Destruir a variavel de sessão
//session_destroy($_SESSION)

?>