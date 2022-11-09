
window.onload = function(){



            document.querySelector('form').onsubmit=function()
            {

              
        
                            /* 1 - obtenemos valores globales de los campos */
                        
                            function email() {
                                return document.querySelector('input[name="email"]').value
                                }
                    
                            function phone() {
                                return document.querySelector('input[name="phone"]').value
                                }
                    
                                const correo = email();
                    
                                const cel = phone();
                
                            
                                /*2- validamos que los  valores esten correctos */
                
                                let excorreo = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                                let numeros = /^([0-9 ])+$/;
                
                                if(correo.length > 55 || excorreo.test(correo) === false ||  correo.length == 0 ) 
                                {
                                
                                    console.log("Por favor ingresa tu correo electrónico - Debe contener un formato correcto.");
                                
                                }
                                else if (cel.length != 10 || numeros.test(cel) === false ||  cel.length == 0 ) 
                                {
                                
                                    console.log("Por favor ingresa un número de teléfono - Debe contener un formato valido a 10 digítos.");
                                }
                                else
                                {
                
                                    
                
                                /*3- Enviamos datos a api */    
                                    
                                        const datos =  {
                                            event_value : 'CompleteRegistration',
                                            url_value : document.domain,
                                            navegador_value : navigator.userAgent,
                                            action_value : 'website',
                                            email_value : correo,
                                            phone_value : cel, 
                                            aliat_key: 'ALIAT-162098695936825',
                                            }
                                            
                                        const url = 'https://midominio/api/fb/index.php';
                                        
                                        fetch(url,{
                                            method : 'POST',
                                            //mode: 'no-cors',
                                            body : JSON.stringify(datos),
                                            headers: {
                                                    'content-type': 'application/json'
                                            }

                                        }).then((respuesta) => {

                                            console.log(respuesta.ok);
                                            console.log(respuesta.status);
                                            console.log(respuesta.json());

                                          })
                                          .catch((error) => {

                                            console.log(error);

                                          });
                                
                                         

                                }
                


            }
  }
       
        

