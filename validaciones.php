
      <?php

                error_reporting(0);


                function validarindices()
                {

                        // funcion para validar que las propiedades del json enviado sean las correctas que requiere el API para procesar la informacion
                      
                        $datos = new StdClass;
                        
                        $data =  (array) json_decode(file_get_contents('php://input')) ;

                        //indices obligatorios que se deben recibir
                        $indices =  array("event_value","url_value","action_value","navegador_value","email_value","phone_value","aliat_key");
                     
                        for($f = 0; $f < count($indices); $f ++)
                        {

                                if($data{$indices[$f]} == false)
                                {
                                        http_response_code(400); 
                                        echo json_encode("Hubo un error al procesar el objeto json - Favor de validar propiedad: valor que son requeridos ");
                                        exit();
                                }
                         
                           
                        }     

                       
                }

      
      
      
        function validamoscampos($input,$palabra)
        {
                            $vacio = null; 

                            if($input == $vacio)
                            {
                                    echo json_encode("El campo $palabra es requerido. - Favor de completar campo");
                                    exit();
                            }
        }


        function validarletras($palabra,$input)
        {
                            $pattern = "/^[a-zA-ZzÑñáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]{3,35}+$/"; 

                            if(!preg_match($pattern, $palabra))
                            {
                                    echo json_encode("El campo $input no contiene un formato válido- Máximo 35 carácteres");
                                    exit();
                            }
        }


        function validarcorreo($correo) {
            if(filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                
            }
            else {
                echo json_encode("El campo correo no contiene un formato válido- favor de volver a intentarlo");
                exit();
            }
        }

        function validartel($input)
        {
                            $pattern = "/^[0-9]{10}$/"; 

                            if(!preg_match($pattern,$input))
                            {
                                    echo json_encode("El campo Teléfono no contiene un formato válido - Máximo 10 carácteres");
                                    exit();
                            }
        }

        function validaralfa($input,$palabra)
        {                                        
            $pattern = "/^[a-zA-ZzÑñáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ0-9. ]{3,50}+$/"; 

            if(!preg_match($pattern,$input))
            {
                    echo json_encode("El campo $palabra no contiene un formato válido - Máximo 45 carácteres");
                    exit();
            }
        }


       ?> 