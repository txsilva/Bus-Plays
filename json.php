<?php

$codigo = '001';
$nome = 'Wiliam';
$telefone = '012 9999-6352';

$cliente1 = array(
	'codigo'=>$codigo,
	'nome'=>$nome,
	'telefone'=>$telefone
);

$dados = array ($cliente1);

//print_r($dados);

$dados_json = json_encode($dados);

$fp = fopen ("cadastro.json", "a");

$escreve = fwrite ($fp, $dados_json);

fclose($fp);

?>