<meta charset="utf-8">
<?php

$json_file = file_get_contents("geoarquivoMarco.json");
$json_str = json_decode($json_file, true);


$i = 0;
$cade=0;
$countID=0;

$tamFeatures = count($json_str['features']);
echo $tamFeatures ."<br><br>";
$feature[]="";

$arquivo = fopen ("unbCeilandia.json", "w+");
fwrite($arquivo, "{\"features\":[");
for($i=0;$i<1246;$i++){

	if(($json_str['features'][$i]["properties"]["codigo_linha"] == 0.043) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.300) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.301) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.333) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.334) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.336) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.339) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.345) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.347) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.383) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.361) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.369) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.385) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.378) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.552) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.812) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.910) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.914) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.954) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 310.1) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 334.1) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 383.1) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 383.2)){
		echo "Existe a linha selecionada<br><br>";

		$id = $json_str['features'][$i]["properties"]["id"];
		$linha = $json_str['features'][$i]["properties"]["codigo_linha"];
		$sentido = $json_str['features'][$i]["properties"]["sentido"];


		$feature = array(array(
			"id" => $id, 
			"linha" => $linha,
			"sentido" => $sentido));
		$featureEncode = json_encode($feature);
		fwrite($arquivo, $featureEncode);
		fwrite($arquivo, ",");

		echo "Id da Linha: ". $id ."<br>";
		echo "Linha: ". $linha ."<br>";
		echo "Sentido: ". $sentido ."<br>";

	}else{
		$cade++;
	}

}


fwrite($arquivo, "[{\"id\":9999,\"linha\":\"000.0\", \"sentido\":\"sem\"}]]}");
fclose($arquivo);
echo "Cadê: ". $cade ."<br><br><hr><h>";
//print_r($feature);

?>