<?php

$arquivo = file_get_contents('cadastro1.json');

$json = json_decode($arquivo);

//print_r($json);

foreach ($json as $registro):
	echo 'Linha : ' .$registro->linha. ' Sentido: ' .$registro->sentido. ' Operadora: ' .$registro->operadora. ' Dias: ' .$registro->dias. ' Horário: ' .$registro->horario. '<br>';
endforeach;

?>