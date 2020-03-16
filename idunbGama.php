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

$arquivo = fopen ("unbGama.json", "w+");
fwrite($arquivo, "{\"features\":[");
for($i=0;$i<1246;$i++){

	if(($json_str['features'][$i]["properties"]["codigo_linha"] == 2201) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 2202) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 2203) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 3201) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 3204) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 3207) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 3208) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.205) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.215) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.218) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.225) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 0.234) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 203.6) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 205.1) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 217.2) || ($json_str['features'][$i]["properties"]["codigo_linha"] == 815.1)){
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