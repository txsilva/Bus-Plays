<!DOCTYPE html>
<html>
  <head>
	<title>UnB Ceilândia - Ponto de Interesse</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
</head>
<body bgcolor="#E0ECF8">
	<center><h3><img src="http://www.busplays.com.br/wp-content/uploads/2020/01/368019-200.png" width="50px">UnB Darcy - Asa Norte</h3></center>
	[+] <a href="http://www.busplays.com.br/unb-darcy-ponto-de-interesse">Ver mais linhas disponíveis</a>
<?php

$json_file = file_get_contents("http://www.busplays.com.br/pontosdeinteresse/unbDarcy.json");
$json_str = json_decode($json_file, true);

$tamFeatures = count($json_str['features']);
//echo $tamFeatures ."<br><br>";
//$feature[]="";

//echo $_GET['linha'];

$i = 0;
$cade=0;
$countID=0;

for($i=0;$i<$tamFeatures;$i++){
	if($_GET['linha'] == $json_str['features'][$i][0]["linha"]){
		$linha_file = file_get_contents("http://www.busplays.com.br/pontosdeinteresse/unbceilandia/".$_GET['linha'].".json");
		$linha_str = json_decode($linha_file, true);
		//print_r($linha_str);
		if ($linha_str[0]['properties'] == $json_str['features'][$i][0]["id"]){
		
			echo "<br><hr><br>Número: ". $linha_str[0]['linha'] ." ";
			//echo "Nome: ". $linha_str[0]['nome'] ."<br>";
			echo $linha_str[0]['sentido'] ."<br>";
			//echo "Bacia: ". $linha_str[0]['bacia'] ."<br>";
			echo "Tarifa: R$ ". $linha_str[0]['tarifa'] ."0<br>";
			echo "Operadora: ". $linha_str[0]['operadora'] ."<br>";
			echo "Extensão: ". $linha_str[0]['extensao_km'] ." Metros <br>";
			echo "<fieldset><h3>Domingo</h3> ". $linha_str[0]['domingo'] ."<br>";
			echo "<h3>Segunda a Sexta</h3> ". $linha_str[0]['segunda'] ."<br>";
			echo "<h3>Sabado</h3> ". $linha_str[0]['sabado'] ."<br></fieldset>";
			echo "<fieldset><h3>Itinerário</h3> ". $linha_str[0]['itinerario'] ."<br><br></fieldset>";
			$linha = $linha_str[0]['coordinates'];
			//echo "Linestring: ". $linha_str[0]['coordinates'] ."<br>";

			$id = $json_str['features'][$i][0]["id"];
			$linha = $json_str['features'][$i][0]["linha"];
			$sentido = $json_str['features'][$i][0]["sentido"];
		}

		$cade++;
	}
}


//echo "Cadê: ". $cade ."<br><br><hr><h>";
//print_r($feature);

?>

</body>
</html>