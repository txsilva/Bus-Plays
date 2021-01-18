<!DOCTYPE html>
<html>
  <head>
	<title>UnB Darcy Ribeiro - Ponto de Interesse</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>
   <style>
      body {
        padding: 2;
        margin: 2;
      }
      html, body, #map {
        height: 90%;
      }
    </style>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
</head>
<body>
	<h3><img src="http://www.busplays.com.br/wp-content/uploads/2020/01/368019-200.png" width="50px">UnB Darcy - Asa Norte</h3>
	[+] <a href="http://www.busplays.com.br/unb-darcy-ponto-de-interesse">Todas as linhas</a>
<?php

$json_file = file_get_contents("http://www.busplays.com.br/pontosdeinteresse/unbDarcy.json");
$json_str = json_decode($json_file, true);

$tamFeatures = count($json_str['features']);
//echo $tamFeatures ."<br><br>";
//$feature[]="";

//echo $_GET['linha'];

// Array com os dias da semana
$diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');

// Aqui podemos usar a data atual ou qualquer outra data no formato Ano-mês-dia (2014-02-28)
$data = date('Y-m-d');

// Varivel que recebe o dia da semana (0 = Domingo, 1 = Segunda ...)
$diasemana_numero = date('w', strtotime($data));

// Variavel que guarda a hora atual
date_default_timezone_set('America/Sao_Paulo');
$hora_numero = strtotime(date('H:i'));
//echo $hora_numero;

$i = 0;
$cade=0;
$countID=0;
$linha = [];
$dia = 0;
$countHora = 0;
$maxtres = 0;

for($i=0;$i<$tamFeatures;$i++){
	if($_GET['linha'] == $json_str['features'][$i][0]["linha"]){
		$linha_file = file_get_contents("http://www.busplays.com.br/pontosdeinteresse/linhas/".$_GET['linha'].".json");
		$linha_str = json_decode($linha_file, true);
		//print_r($linha_str);
		if ($linha_str[0]['properties'] == $json_str['features'][$i][0]["id"]){
			
			//echo "Nome: ". $linha_str[0]['nome'] ."<br>";
			//echo "Bacia: ". $linha_str[0]['bacia'] ."<br>";
			//echo "Operadora: ". $linha_str[0]['operadora'] ." ";
			$linha = explode(".",$linha_str[0]['linha']);
			echo $linha[1];
			echo "<br><br><h3>". $linha_str[0]['linha'] ." ". $linha_str[0]['sentido'] ." ";
			// Exibe o dia da semana com o Array
			echo " ". $diasemana[$diasemana_numero] ."</h3>";
			echo "<b>R$</b> ". $linha_str[0]['tarifa'] ."0 ";
			echo "<span class=\"glyphicon glyphicon-road\" aria-hidden=\"true\"></span> ". $linha_str[0]['extensao_km'] ." Metros ";
			echo "<span class=\"glyphicon glyphicon-hourglass\" aria-hidden=\"true\"></span> ". round((($linha_str[0]['extensao_km']/(90/3.6))*60)/60) .":".round((($linha_str[0]['extensao_km']/(90/3.6))*60),0) ." ";
			echo "<span class=\"glyphicon glyphicon-credit-card\" aria-hidden=\"true\"></span> Recarga Bilhete";
			echo "<div style=\"background: #dd5459; min-height: 50px;\">";
			if($diasemana_numero == 0){
				$novo = explode(",",$linha_str[0]['domingo']);
				echo "<h3>Domingo</h3> <br>";
				$dia++;
			}
			if(($diasemana_numero == 1) || ($diasemana_numero == 2) || ($diasemana_numero == 3) || ($diasemana_numero == 4) || ($diasemana_numero == 5)){
				$novo = explode(",",$linha_str[0]['segunda']);
				echo "<h3>Segunda a Sexta</h3><br>";
				$dia++;
			}
			if($diasemana_numero == 6){
				$novo = explode(",",$linha_str[0]['sabado']);
				echo "<h3>Sabado</h3>";
				if(strlen($linha_str[0]['sabado']) == 0){
					echo "<span class=\"glyphicon glyphicon-alert\" aria-hidden=\"true\"></span> Não há viagem programada para hoje!<br>";
				}
				$dia++;
			}
			if($dia == 0){
				echo "<br><span class=\"glyphicon glyphicon-alert\" aria-hidden=\"true\"></span> Essa linha de ônibus não faz viagem nesse dia.<br><br>";
			}
			$ultimo = count($novo);
			foreach($novo as $key => $value){
				if($hora_numero <= strtotime($value)){
					echo " <span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> ".$novo[$countHora];
					$maxtres++;
				}
				$countHora++;
				if($maxtres == 3){
					echo " | <span class=\"glyphicon glyphicon-alert\" aria-hidden=\"true\"></span> Última partida ". $novo[$ultimo-1];
					break;
				}
				//echo $hora_numero ."<BR>";
			}
			if($maxtres == 0){
					echo "<span class=\"glyphicon glyphicon-alert\" aria-hidden=\"true\"></span> Nenhuma horário de partida para essa linha de ônibus hoje!";
				}
			//print_r($novoarray);
			echo "<br><br>";
			echo "</div>";
			echo "<script>function itinerario(){ document.getElementById('itinerario').style.visibility='visible';
			document.getElementById('itinerario').innerHTML='<button onclick=\'fechar()\'>X</button><br>". $linha_str[0]['itinerario']."'}</script>";
			echo "<script>function fechar(){ document.getElementById('itinerario').style.visibility='hidden'; }</script>";
			//$linha = $linha_str[0]['coordinates'];
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
echo $linha[0]."_".$linha[2].$linha[3].$linha[4];
?>
<div class="row">
	<div class="col-xs-12 col-md-4" style="background: #000;">
	Partida<br><br>
	Origem<br><br>
	Destino<br><br>
	<button style="padding: 10px; background: #ccc;" onclick="itinerario()">Itinerário</button><br>
<div id="itinerario" style="visibility: hidden;"><button onclick="fechar()">X</button><br></div>
	</div>
	<div class="col-xs-12 col-md-8" style="background: #00c;">
	<div id="map" style="height:400px; margin-left: 15px; margin-right: 20px;"></div>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
   integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>
    <script src="https://busplays.com.br/sistema/mapa/<?php echo $linha[0]."_".$linha[2].$linha[3].$linha[4];?>/linha<?php echo $linha[0]."_".$linha[2].$linha[3].$linha[4];?>.js"></script>
	</div>
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>