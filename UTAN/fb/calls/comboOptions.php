<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
define("DBHOSTMUZZMX", "localhost");
define("DBUSERMUZZ", "servnet_aliatabc");
define("DBPASSMUZZ", "s3rv3rn3T#Al4");
$db="servnet_aliat";
$table="oferta2021c3";
$pdo = new PDO(
		'mysql:host=' . DBHOSTMUZZMX . ';dbname=' . $db,
		DBUSERMUZZ,
		DBPASSMUZZ,
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
		);

$retorno = array();
$retorno["msg"] = "erro";
switch($_POST["action"]){
	case 'categoria':
		$sql = "SELECT DISTINCT(linea) as linea FROM {$table} WHERE marca='UTAN' ORDER BY linea ASC";
		try {
			$stmt = $pdo->prepare($sql);
			#$stmt->bindParam(":marca", $_POST["marca"], PDO::PARAM_STR);
			$stmt->execute();
			$registos = $stmt->fetchAll();
			$pdoerror = $stmt->errorInfo();
			$stmt->closeCursor();
			$retorno["msg"] = "ok";
		} catch (PDOException $pdoException) {
			die('Database error.');
		}
		#print_r($registos);
		$i = 0;
		foreach($registos as $registo){
			$retorno["linea"][$i] = $registo["linea"];
			/*$retorno["campus"][$i] = $registo["campus"];
			$retorno["marca"][$i] = $registo["marca"];*/
			$i++;
			//echo $retorno["modalidad"][$i];
		}
	break;
	case 'carrera':
		$sql = "SELECT DISTINCT(carrera) as carrera FROM {$table} WHERE marca='UTAN' AND linea=:linea ORDER BY carrera ASC";
		try {
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(":linea", $_POST["categoria"], PDO::PARAM_STR);
			$stmt->execute();
			$registos = $stmt->fetchAll();
			$pdoerror = $stmt->errorInfo();
			$stmt->closeCursor();
			$retorno["msg"] = "ok";
		} catch (PDOException $pdoException) {
			die('Database error.');
		}
		#print_r($registos);
		$i = 0;
		foreach($registos as $registo){
			$retorno["carrera"][$i] = $registo["carrera"];
			/*$retorno["campus"][$i] = $registo["campus"];
			$retorno["marca"][$i] = $registo["marca"];*/
			$i++;
			//echo $retorno["modalidad"][$i];
		}
	break;
	case 'campus':
		$sql = "SELECT DISTINCT(campus_texto),campus_valor FROM {$table} WHERE marca='UTAN' AND carrera=:carrera AND linea=:linea ORDER BY campus_texto ASC";
		try {
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(":carrera", $_POST["carrera"], PDO::PARAM_STR);
			$stmt->bindParam(":linea", $_POST["categoria"], PDO::PARAM_STR);
			$stmt->execute();
			$registos = $stmt->fetchAll();
			$pdoerror = $stmt->errorInfo();
			$stmt->closeCursor();
			$retorno["msg"] = "ok";
		} catch (PDOException $pdoException) {
			die('Database error.');
		}
		#print_r($registos);
		$i = 0;
		foreach($registos as $registo){
			$retorno["campus_texto"][$i] = $registo["campus_texto"];
			$retorno["campus_valor"][$i] = $registo["campus_valor"];
			/*$retorno["marca"][$i] = $registo["marca"];*/
			$i++;
			//echo $retorno["modalidad"][$i];
		}
	break;
	case 'modalidad':
		$sql = "SELECT DISTINCT(modalidad) FROM {$table} WHERE marca='UTAN'  AND carrera=:carrera AND campus_valor=:campus AND linea=:linea ORDER BY modalidad ASC";
		try {
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(":carrera", $_POST["carrera"], PDO::PARAM_STR);
			$stmt->bindParam(":campus", $_POST["campus"], PDO::PARAM_STR);
			$stmt->bindParam(":linea", $_POST["categoria"], PDO::PARAM_STR);
			$stmt->execute();
			$registos = $stmt->fetchAll();
			$pdoerror = $stmt->errorInfo();
			$stmt->closeCursor();
			$retorno["msg"] = "ok";
		} catch (PDOException $pdoException) {
			die('Database error.');
		}
		#print_r($registos);
		$i = 0;
		foreach($registos as $registo){
			$retorno["modalidad"][$i] = $registo["modalidad"];
			/*$retorno["marca"][$i] = $registo["marca"];*/
			$i++;
			//echo $retorno["modalidad"][$i];
		}
	break;
	case 'ciclos':
		$sql = "SELECT DISTINCT(linea) as linea, campus_valor FROM {$table} WHERE marca='ALIAT' ORDER BY linea ASC";
		try {
			$stmt = $pdo->prepare($sql);
			#$stmt->bindParam(":marca", $_POST["marca"], PDO::PARAM_STR);
			$stmt->execute();
			$registos = $stmt->fetchAll();
			$pdoerror = $stmt->errorInfo();
			$stmt->closeCursor();
			$retorno["msg"] = "ok";
		} catch (PDOException $pdoException) {
			die('Database error.');
		}
		#print_r($registos);
		$i = 0;
		foreach($registos as $registo){
			$retorno["linea"][$i] = $registo["campus_valor"] . "|" . $registo["linea"];
			/*$retorno["campus"][$i] = $registo["campus"];
			$retorno["marca"][$i] = $registo["marca"];*/
			$i++;
			//echo $retorno["modalidad"][$i];
		}
	break;	
}
echo json_encode($retorno);
?>