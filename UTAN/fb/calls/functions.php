<?php
date_default_timezone_set('America/Mexico_City');
ini_set('date.timezone', 'America/Mexico_City');												
function leadValidation($post){
        $onlyNumberTenDigits="/^[0-9]{10}+$/";
        $onlyLettersSpace="/^[a-zA-Z.áéíóúÁÉÍÓÚñÑ\s]+$/";
        $ladaCel2 = substr($post['cel'], 0, 2);
        $ladaCel3 = substr($post['cel'], 0, 3);
        $ladaTel2 = substr($post['localNumber'], 0, 2);
        $ladaTel3 = substr($post['localNumber'], 0, 3);
        $ladaArray2 = array('55','33','81','56');
        $ladaArray3 = array('936','222','223','224','225','226','227','228','229','231','232','233','235','236','237','238','241','243','244','245','246','247','248','249','271','272','273','274','275','276','278','279','281','282','283','284','285','287','288','294','296','297','311','312','313','314','315','316','317','318','319','321','322','323','324','325','326','327','328','329','341','342','343','344','345','346','347','348','349','351','352','353','354','355','356','357','358','359','371','372','373','374','375','376','377','378','379','381','382','383','384','385','386','387','388','389','391','392','393','394','395','411','412','413','414','415','416','417','418','419','421','422','423','424','425','426','427','428','429','431','432','433','434','435','436','437','438','441','442','443','444','445','447','448','449','451','452','453','454','455','456','457','458','459','461','462','463','464','465','466','467','468','469','471','472','473','474','475','476','477','478','481','482','483','485','486','487','488','489','492','493','494','495','496','498','499','588','591','592','593','594','595','596','597','599','612','613','614','615','616','618','621','622','623','624','625','626','627','628','629','631','632','633','634','635','636','637','638','639','641','642','643','644','645','646','647','648','649','651','652','653','656','658','659','661','662','664','665','667','668','669','671','672','673','674','675','676','677','678','686','687','694','695','696','697','698','711','712','713','714','715','716','717','718','719','721','722','723','724','725','726','727','728','729','731','732','733','734','735','736','737','738','739','741','742','743','744','745','746','747','748','749','751','753','754','755','756','757','758','759','761','762','763','764','765','766','767','768','769','771','772','773','774','775','776','777','778','779','782','783','784','785','786','789','791','797','821','823','824','825','826','827','828','829','831','832','833','834','835','836','841','842','844','846','861','862','864','866','867','868','869','871','872','873','877','878','891','892','894','897','899','913','914','917','918','919','921','922','923','924','932','933','934','937','938','951','953','954','958','961','962','963','964','965','966','967','968','969','971','972','981','982','983','984','985','986','987','988','991','992','993','994','995','996','997','998','999');
        if (in_array($ladaCel2, $ladaArray2)) {
            $statusCel="valid";
        }elseif(in_array($ladaCel3, $ladaArray3)){
            $statusCel="valid";
        }else{
            $statusCel="invalid";
        }
        if (in_array($ladaTel2, $ladaArray2)) {
            $statusTel="valid";
        }elseif(in_array($ladaTel3, $ladaArray3)){
            $statusTel="valid";
        }else{
            $statusTel="invalid";
        }
        if ($statusCel=="valid" || $statusTel=="valid") {
            if (trim($post['localNumber'])!="" & trim($post['email'])!="" & trim($post['cel'])!="" & trim($post['fn'])!="" & trim($post['ln'])!="") {
                if (preg_match($onlyNumberTenDigits,$post['localNumber']) & preg_match($onlyNumberTenDigits,$post['cel'])) {
                    if (preg_match($onlyLettersSpace,$post['fn']) & preg_match($onlyLettersSpace,$post['ln']) & preg_match($onlyLettersSpace,$post['carrera']) & preg_match($onlyLettersSpace,$post['campus'])) {
                        $status="valid";
                    }else{
                        $status="invalid onlyLettersSpace";
                    }
                }else{
                    $status="invalid lenght";
                }
            }else{
                $status="invalid empty";
            }
        }else{
            $status="invalid telephone or cel";
        }

        return $status;
}
function ws_hubspotInterciclo($post){
  
	$ciclo = "2022-3";											 

    $post['ln']=$post['last_name']." ".$post['00Nd0000005EcRm'];

    $hs_context= $post['hs_contextFinal'];
    $str_post = "nivel_de_interes=" . urlencode($post['nivel_de_interes'])
        ."&modalidad_c=" . urlencode($post['modalidad'])
        ."&ciclo_de_tu_interes=" . urlencode($ciclo)
        ."&campus__c=" . urlencode($post['campus'])
        ."&recuperaci_n_de_contactos=" . urlencode('Si')
        ."&carrer=" . urlencode($post['carrera'])
        ."&firstname=" . urlencode($post['fn'])
        ."&lastname=" . urlencode($post['ln'])
        ."&email=" . urlencode($post['email'])
        ."&mobilephone=" . urlencode($post['cel'])
        ."&phonetype=" . urlencode('Móvil')
        ."&company=" . urlencode('UTAN')
        ."&creador_lead=" . urlencode('HubSpot Integration')
        ."&leadsource=" . urlencode('Medios Dígitales')
        ."&medio__c=" . urlencode('Facebook')
        ."&canal__c=" . urlencode('Sitios Web')
        ."&hs_context=" . urlencode($hs_context); //Leave this one be
    /*echo $str_post;
    exit();*/
    #$formId=formByCampus($post['campus']);
    //replace the values in this URL with your portal ID and your form GUID
    $endpoint = 'https://forms.hubspot.com/uploads/form/v2/3354370/73abec7a-cc4f-42e7-9ee8-b07f6105ae59';

    $ch = @curl_init();
    @curl_setopt($ch, CURLOPT_POST, true);
    @curl_setopt($ch, CURLOPT_POSTFIELDS, $str_post);
    @curl_setopt($ch, CURLOPT_URL, $endpoint);
    @curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/x-www-form-urlencoded'
    ));

    @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response    = @curl_exec($ch); //Log the response from HubSpot as needed.
    // var_dump($response);
    // exit();
    $status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); //Log the response status code
    @curl_close($ch);
    #echo $status_code . " " . $response;
}
function wsDB($post){
    define("DBHOSTMUZZMX", "localhost");
    define("DBUSERMUZZ", "servnet_aliatabc");
    define("DBPASSMUZZ", "s3rv3rn3T#Al4");
    $db="servnet_aliat";
    $table="wp_fb_ads";
    $fecha=date("Y-m-d H:i:s");
    $post['ln']=$post['last_name']." ".$post['00Nd0000005EcRm'];
	$post['startDate']="2022-2";
    $pdo = new PDO(
            'mysql:host=' . DBHOSTMUZZMX . ';dbname=' . $db,
            DBUSERMUZZ,
            DBPASSMUZZ,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
    $sqlInsert = "INSERT INTO {$table} (id,marca,nombre,apellidos,campus,carrera,telefono,email,categoria,modalidad,fecha_creacion,medio, ciclo_de_interes) VALUES ('0','UTAN','{$post['fn']}','{$post['ln']}','{$post['campus']}','{$post['carrera']}','{$post['cel']}','{$post['email']}','{$post['nivel_de_interes']}','{$post['modalidad']}','{$fecha}','Facebook', '{$post['startDate']}')";
    /////////////////////////////////////////////// ver como se imprime la query
    #echo $sqlInsert."<br>";
    /////////////////////////////////////////////// ver como se imprime la query
    ///////////////////////////////////////////////////////comentar antes de insertarlo a la bd try catch
    try {
        $stmt = $pdo->prepare($sqlInsert);
        $stmt->execute();
        $insertid = $pdo->lastInsertId();
        $pdoerror = $stmt->errorInfo();
        $stmt->closeCursor();
        $stmt = null;
    } catch (PDOException $pdoException) {
        die('Database error.');
    }
    ///////////////////////////////////////////////////////comentar antes de insertarlo a la bd try catch
    /*if ($insertid){
       echo "record inserted successfully<br>";
    }else{
       echo "record insertion failed<br>";
    }*/
}
?>
