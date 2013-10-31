<?php
header('Content-type: application/json');

$serverName = "CIDEZ\CIDEZ"; //serverName\instanceName
$connectionInfo = array("Database"=>"CIDEZ", "UID"=>"cidez", "PWD"=>"6600690j");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
$sq=$_GET["q"];
$result = sqlsrv_query($conn,
"SELECT A.civ AS CIV
      ,A.cedula AS CEDULA
      ,apel_nom AS NOMBRE
      ,fec_insc AS FECHA_INCRIPCION
      ,fec_gra AS FECHA_GRADUACION
      ,isnull(Especializacion,0) AS ESPECIALIZACION
      ,CONVERT(VARCHAR(10), fec_canc, 120) AS FECHA_CANCELACION
      ,CONVERT(VARCHAR(10), (CASE WHEN fec_upag > GETDATE() THEN CAST(GETDATE() AS DATE) ELSE fec_upag END), 120) AS FECHA_DESDE
      ,isnull(CONVERT(VARCHAR(10), FECHA_HASTA, 120), CONVERT(VARCHAR(10), (CASE WHEN fec_upag > GETDATE() THEN CAST(GETDATE() AS DATE) ELSE fec_upag END), 120)) AS FECHA_HASTA
	,CONVERT(VARCHAR(10), fec_upag, 120) AS FECHA_ULT_PAGO
	,isnull(TOTAL_PAGAR, 0.00) AS TOTAL_PAGAR 
	,1 AS BANDERA   
  FROM agremiados A
  LEFT JOIN Agremiados_Deudores B
  ON CAST(A.cedula AS VARCHAR(255)) = CAST(B.CEDULA AS VARCHAR(255))
  LEFT JOIN Especialidades
  ON cast(cod_esp as int) = Cod
  WHERE A.cedula = '".$sq."'"
  ,array(5));

	$row = sqlsrv_fetch_array($result);
	if ($row === NULL)
	{
		$records2[] = Array("CIV"=>'', "CEDULA"=> '', "NOMBRE"=> '', "FECHA_INCRIPCION"=> '', 
		"FECHA_GRADUACION"=> '', "ESPECIALIZACION"=> '', "FECHA_CANCELACION"=> '', 
		"FECHA_DESDE"=> '', "FECHA_HASTA"=> '', "FECHA_ULT_PAGO"=> '', "TOTAL_PAGAR"=> '', "BANDERA"=> '0');
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