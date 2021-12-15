<?php
//inici as variaveis de sessão
session_start();


//As variaveis são recebidas
$titulo = str_replace('-','#',  $_POST['titulo']);
$categoria = str_replace( '-','#',$_POST['categoria']);
$descricao = str_replace( '-','#',$_POST['descricao']);

//O fopen é uma função nativa do php que incorpora arquivos de texto
//ele recebe dois parametros, o nome do arquivo a ser recebido com extensão,
//e se vai abrir pra leitura, dowload e etc
$arquivo = fopen('arquivo.txt', 'a');

//e são colocada em uma unica variavel
$texto = $_SESSION['id'].'-'. $titulo. '-'. $categoria . '-'. $descricao. PHP_EOL; //PHP_EOL faz a quebra de linha de acordo com a configuração do sistema

//esta função nativa recebe o arquivo que foi aberto
fwrite($arquivo, $texto);

//esta função nativa fecha o arquivo aberto de texto
fclose($arquivo);

header('Location: abrir_chamado.php');
?> 