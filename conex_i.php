<?php
header('Content-type: application/json');

$serverName = "CIDEZ\CIDEZ"; //serverName\instanceName
$connectionInfo = array("Database"=>"CIDEZ", "UID"=>"cidez", "PWD"=>"6600690j");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
$sq=$_GET["q"];
$result = sqlsrv_query($conn,
"SELECT edo_reg
      ,cod_esp
      ,fec_reg
      ,cedula
      ,apellido
      ,nombre
      ,apel_nom
      ,cod_uni
      ,fec_gra
      ,fec_insc
      ,mon_insc
      ,mon_ecar
      ,cod_ban
      ,num_depo
      ,fec_depo
      ,num_reci
      ,tipo_ins
      ,observa
      ,edo_ins
      ,fec_anu
      ,hor_anu
      ,mot_anu
      ,usu_anu
      ,edo_entt
      ,fec_entt
      ,usu_entt
      ,hor_reg
  FROM CIDEZ.dbo.inscrip
  WHERE cedula = '".$sq."'"
  ,array(5));

	$row = sqlsrv_fetch_array($result);
	if ($row === NULL)
	{
		$records2[] = Array("cedula"=>'', "apel_nom"=> '', "apel_nom"=> '', "cod_esp"=> '', 
		"fec_gra"=> '', "fec_depo"=> '', "fec_insc"=> '',  "BANDERA"=> '0');
		$val2 = json_encode($records2);
		echo $_GET['jsoncallback']."(".$val2.")";
	}
	else 
	{
		$records[] = $row;
		$val = json_encode($records);
		echo $_GET['jsoncallback']."(".$val.")";
	}
	
	sqlsrv_close($conn);

?>