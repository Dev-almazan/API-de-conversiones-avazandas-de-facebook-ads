<?php
$arr = array();
$txEmail = isset($_POST['email']) ? $_POST['email'] : null;
if(!is_null($txEmail)){
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    require_once('functions.php');
    /*foreach ($_POST as $key => $value) {
        echo $key . '======= ' . $value."<br>";
    }
    echo "hubcookie ".$_COOKIE['hubspotutk'];
    exit();*/
    $post = $_POST;
    $hubspotutk=isset($_COOKIE['hubspotutk']) ? $_COOKIE['hubspotutk'] : '';
    if(isset($post['full_name'])){
        $fullName=explode(' ', $post['full_name']);
        $stringCount=count($fullName);
        if ($stringCount==3) {
            $name=explode(' ', $post['full_name'],3);
            $post['first_name']=$name[0];
            $post['last_name']=$name[1];
            $post['00Nd0000005EcRm']=$name[2];
        }else{
            $name=explode(' ', $post['full_name'],4);
            $post['first_name']=$name[0].' '.$name[1];
            $post['last_name']=$name[2];
            $post['00Nd0000005EcRm']=$name[3];
        }
    }
    $hs_context=array("hutk" => $hubspotutk,
                      "ipAddress" => $_SERVER['REMOTE_ADDR'],
                      "pageUrl" => $_SERVER['HTTP_REFERER'],
                      "pageName" => "Contact Us",
                      "redirectUrl" => "");
    $hs_contextFinal=json_encode($hs_context);
    $post['hs_contextFinal']=$hs_contextFinal;
    //var_dump($hs_contextFinal);
    $post['fn']=$post['first_name'];
    $post['ln']=$post['last_name'];
    $post['email']=$post['email'];
    $post['cel']=$post['phone'];
    $post['nivel_de_interes']=$post['categoria'];
    $post['carrera']=$post['carrera'];//prod: fldCarrera y modalidad
    $post['campus']=$post['campus'];
    $post['localNumber']=$post['phone'];
    $post['politica']=$post['aviso'];
    $post['modalidad']=$post['modalidad'];
	//$post['ciclo_de_tu_interes']=$post['ciclo_de_tu_interes'];
    #$post['medio']=$post['00Nd0000009STAS'];


    $validation=leadValidation($post);
    // echo $validation;
    // exit();
    if ($validation=="valid") {
		wsDB($post);
        ws_hubspotInterciclo($post);
        $arr['message'] = "success";
    }else{
        $arr['message'] = "error";
    }
    echo json_encode($arr);
    unset($post);
}else{
   $arr['message'] = "error";
}
?>