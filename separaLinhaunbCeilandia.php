<?php

//$json_file = file_get_contents("http://webservice.dftrans.df.gov.br:8080/geoserver/DFTrans/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=DFTrans:Itiner%C3%A1rio%20das%20Linhas&maxFeatures=50000&outputFormat=application%2Fjson");
$json_file = file_get_contents("geoarquivoMarco.json");
$json_str = json_decode($json_file, true);

// Abre o Arquvio se existir ou cria no Modo w+ (para leitura e escrita)
//$arquivo = fopen ("unbDarcy.json", "w+");
//Escreve no arquivo aberto.
//fwrite($arquivo, "{");
//Fecha o arquivo.
//fclose($arquivo);

$i = 0;
$cade=0;
$countID=0;

$tamFeatures = count($json_str['features']);
echo $tamFeatures ."<br><br>";
$feature[]="";

for($i=0;$i<1246;$i++){

	if(($json_str['features'][$i]["properties"]["codigo_linha"] == 0.043) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.300) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.301) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.333) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.334) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.336) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.339) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.345) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.347) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.383) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.361) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.369) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.385) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.378) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.552) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.812) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.910) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.914) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.954) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 310.1) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 334.1) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 383.1) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 383.2)){
		echo "Existe a linha selecionada<br><br>";

		//$type = $json_str['features'][$i]["type"];
		//$id = $json_str['features'][$i]["id"];
		//$typeString = $json_str['features'][$i]['geometry']['type'];
		//$geometry_name = $json_str['features'][$i]["geometry_name"];
		$properties = $json_str['features'][$i]["properties"]["id"];
		$linha = $json_str['features'][$i]["properties"]["codigo_linha"];
		$nome = $json_str['features'][$i]["properties"]["localidade_origem"];
		$sentido = $json_str['features'][$i]["properties"]["sentido"];
		$bacia = $json_str['features'][$i]["properties"]["bacia"];
		$faixa_tarifaria = $json_str['features'][$i]["properties"]["nm_faixa_tarifaria"];
		$tarifa = $json_str['features'][$i]["properties"]["vl_tarifa"];
		$servico = $json_str['features'][$i]["properties"]["tx_servico"];
		$operadora = $json_str['features'][$i]["properties"]["nm_operadora"];
		$extensao_km = $json_str['features'][$i]["properties"]["extensao_km"];
		$codigo_linha = $json_str['features'][$i]["properties"]["codigo_linha"];
		$itinerario = $json_str['features'][$i]["properties"]["itinerario"];
		$domingo = $json_str['features'][$i]["properties"]["domingo"];
		$segunda = $json_str['features'][$i]["properties"]["segunda"];
		$sabado = $json_str['features'][$i]["properties"]["sabado"];
		$tamCodigoLinha = count($json_str['features'][$i]['geometry']['coordinates']);

		$j=0;
		$coordinates = "[";
		for ($j=0;$j<$tamCodigoLinha;$j++){
			$json1 = $json_str['features'][$i]['geometry']['coordinates'][$j];
			if ($j < $tamCodigoLinha-1){
				$coordinates = $coordinates ."[".$json1[0] .",". $json1[1] ."],";
			}else{
				$coordinates = $coordinates ."[".$json1[0] .",". $json1[1] ."]]";
			}
		}

		$arquivo = fopen ("unbceilandia/".$json_str['features'][$i]["properties"]["codigo_linha"].".json", "w+");
		$feature = array(array(
			"properties" => $properties, 
			"linha" => $linha,
			"nome" => $nome, 
			"sentido" => $sentido,
			"bacia" => $bacia,
			"faixa_tarifaria" => $faixa_tarifaria,
			"tarifa" => $tarifa,			
			"servico" => $servico,
			"operadora" => $operadora,
			"extensao_km" => $extensao_km,
			"codigo_linha" => $codigo_linha,
			"itinerario" => $itinerario,
			"domingo" => $domingo,
			"segunda" => $segunda,
			"sabado" => $sabado,
			"coordinates" => $coordinates));
		$featureEncode = json_encode($feature);
		fwrite($arquivo, $featureEncode);
		if($i <= 1246){
			fwrite($arquivo, "");
		}

		//echo "Type da Features: ". $type ."<br>";
		//echo "Id da Features: ". $id ."<br>";
		//echo "Tipo da string: ". $typeString ."<br>";
		//echo "Geometry_name da Features: ". $geometry_name ."<br>";
		echo "Id da Properties da Features: ". $properties ."<br>";
		echo "Linha: ". $linha ."<br>";
		echo "Nome da linha: ". $nome ."<br>";
		echo "Sentido da linha: ". $sentido ."<br";
		echo "Bacia da linha: ". $bacia ."<br>";
		echo "Faixa da tarifa: ". $faixa_tarifaria ."<br>";
		echo "Tarifa cobrada: ". $tarifa ."<br>";
		echo "Serviço: ". $servico ."<br>";
		echo "Operadora: ". $operadora ."<br>";
		echo "Extensão percorrida: ". $extensao_km ."<br>";
		echo "Código da linha: ". $codigo_linha ."<br>";
		echo "Itinerario: ". $itinerario ."<br>";
		echo "Domingo: ". $domingo ."<br>";
		echo "Segunda: ". $segunda ."<br>";
		echo "Sabado: ". $sabado ."<br>";
		echo "Tamanho linestring: ". $tamCodigoLinha ."<br>";

		$j=0;
		echo "Coordenadas: [";
		for ($j=0;$j<$tamCodigoLinha;$j++){
			$json1 = $json_str['features'][$i]['geometry']['coordinates'][$j];
			if ($j < $tamCodigoLinha-1){
				echo "[".$json1[0] .",". $json1[1] ."],";
			}else{
				echo "[".$json1[0] .",". $json1[1] ."]";
			}
		}
		echo "]<br><hr>";
	}else{
		$cade++;
	}

}

//fwrite($arquivo, "}");
fclose($arquivo);

echo "Cadê: ". $cade ."<br><br><hr><h>";
print_r($feature);







//foreach ($json1 as $value) {
//    echo "[".$value[0] .",". $value[1] ."]";
//    $i++;
//}

//var_dump($json_str);

?>