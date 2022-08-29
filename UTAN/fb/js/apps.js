
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
                                    
                                        const data =  {
                                            event_value : 'CompleteRegistration',
                                            url_value : window.location,
                                            action_value : 'website',
                                            email_value : correo,
                                            phone_value : cel, 
                                            aliat_key: 'ALIAT-162098695936825',
                                            }
                
                                            console.log(data)
                
                                }
                


            }
  }
       
        

