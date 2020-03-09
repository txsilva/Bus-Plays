<?php

$json_file = file_get_contents("http://geomobi.semob.df.gov.br:8080/geoserver/semob/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=semob:linhas_stpc&maxFeatures=25000&outputFormat=application%2Fjson");
//$json_file = file_get_contents("file:///C:/xampp/htdocs/json/geoarquivo.json");
//$json_str = json_decode($json_file, true);

// Abre o Arquvio se existir ou cria no Modo w+ (para leitura e escrita)
$arquivo = fopen ("geoarquivoMarco.json", "w+");
//Escreve no arquivo aberto.
fwrite($arquivo, $json_file);
//Fecha o arquivo.
fclose($arquivo);

//var_dump($json_str);

?>
