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

$arquivo = fopen ("unbPlanaltina.json", "w+");
fwrite($arquivo, "{\"features\":[");
for($i=0;$i<1246;$i++){

	if(($json_str['features'][$i]["properties"]["codigo_linha"] == 0.600) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.602) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.603) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.615) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.620) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.624) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.640) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.641) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 067.1) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.605) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 605.1) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 600.2) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 602.1) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 605.1) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 606.2) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 616.2) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 616.4) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 624.1) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 630.1)){
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