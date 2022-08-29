<?php

                    header('Access-Control-Allow-Origin: *');
                    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
                    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
                    header('content-type: application/json; charset=utf-8');


                    switch ($_SERVER['REQUEST_METHOD']) 
                    {
                        case 'POST':

                                    require  'validaciones.php';

                                    validarindices();
                                    
                                    $datos = json_decode(file_get_contents('php://input'));

                                    if($datos -> aliat_key  == "ALIAT-162098695936825")
                                    {
                                        
                                        /* 1- Validamos valores que esten correctos*/


                                        validamoscampos($datos -> event_value,"event_value");
                                        validamoscampos($datos -> url_value,"url_value");
                                        validamoscampos($datos -> navegador_value,"navegador_value");
                                        validamoscampos($datos -> action_value,"action_value");
                                        validamoscampos($datos -> email_value,"email_value");
                                        validamoscampos($datos -> phone_value,"phone_value");
                                       
                                        validarletras($datos -> event_value,"event_value");
                                        validarletras($datos -> action_value,"action_value");

                                        validarcorreo($datos -> email_value);
                                        validartel($datos -> phone_value);

                                        
                                        /* 2- Asignamos valores recibidos */


                                        date_default_timezone_set('America/Mexico_City');

                                        $data = array();

                                        $data["evento"] = $datos -> event_value ;

                                        $data["momento"]  = mktime(date('H')); // HORA EN FORMATO UNIX

                                        $data["url"]=  $datos -> url_value ;

                                        $data["origen"] = $datos -> action_value ;

                                        $data["ip"] = $_SERVER["REMOTE_ADDR"];

                                        $data["navegador"] = $datos -> navegador_value ;


                                        $data["email"] = hash('sha256',$datos -> email_value) ; //VALOR ENCRYPTADO

                                        $data["telefono"] = hash('sha256',"52".$datos -> phone_value); //VALOR ENCRYPTADO


                                        /* 3 - CONECTAMOS CON API DE FACEBOOK */
       
                                        $api = 'https://graph.facebook.com/v14.0/162098695936825/events/';



                                        $array["event_name"]=$data["evento"];
                                        $array["event_time"]=$data["momento"];
                                        $array["action_source"]=$data["origen"];
                                        $array["event_source_url"]=$data["url"];
                                        $array["client_ip_address"]=$data["ip"];
                                        $array["client_user_agent"]=$data["navegador"];
                                        $array["user_data"]["em"]=$data["email"];
                                        $array["user_data"]["ph"]=$data["telefono"];
    

                                        $array_data = array($array);

                                        $fields = array();

                                        
                                        $fields['access_token'] = '';
                                        $fields['test_event_code'] = 'TEST4000';
                                        $fields['data'] = $array_data;
                                       
                                        json_encode($fields);
                                        
                                                    
                                        $ch = @curl_init();
                                            @curl_setopt($ch, CURLOPT_POST, true);
                                            @curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
                                            @curl_setopt($ch, CURLOPT_URL, $api);
                                            @curl_setopt($ch, CURLOPT_HTTPHEADER, array( "cache-control: no-cache","Accept: application/json"));
                                            @curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
                                            $response   = @curl_exec($ch); 
                                            $status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); 
                                        @curl_close($ch);

                                    
                                        if($status_code == 400)
                                        {
                                            http_response_code(400); 
                                            echo json_encode($response);

                                        }
                                        else
                                        {
                                            http_response_code(204); 
                                            echo json_encode($response);
                                        }

                                    }   
                                    else
                                    {
                                        http_response_code(400); 
                                        $mensaje  = "No posee los permisos necesarios para manipular el contenido.";
                                        echo json_encode($mensaje);
                                    }
                
                                    
                        break;
                    }

?>