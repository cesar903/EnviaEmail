<?php
//Para a pagina abrir é necessario passar pela autenticação e receber o valor sim
  session_start();
  if(!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM'){
    header('Location: index.php?login=erro2');
  }
  
?>