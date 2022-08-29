jQuery.validator.addMethod('nome_apelido', function (value, element) {
			var regex = /(^([ A-Za-zÃ¡-ÃºÃ-Ãš.\s]){2,200})+$/;
			var names = rtrim(value).split(' ');
			var test = true;
			if( names.length <= 2 ){
				test = false;
			}else{
				for( var k=0; k< names.length; ++k ){
					if( !regex.test( names[k] ) ){
						test = false;
					}
				}
			}
			return this.optional(element) || test && !formValidation_isInvalidName(value)
		}, 'Debes completar tu nombre y 2 apellidos');
		function formValidation_isInvalidName( param_name ){
					var invalidName = ['aaa','bbb','ccc','ddd','eee','fff','ggg','hhh','iii','jjj','kkk','lll','mmm','nnn','ooo','ppp','qqq','rrr','sss','ttt','uuu','vvv','www','xxx','yyy','zzz','AAA','BBB','CCC','DDD','EEE','FFF','GGG','HHH','III','JJJ','KKK','LLL','MMM','NNN','OOO','PPP','QQQ','RRR','SSS','TTT','UUU','VVV','WWW','XXX','YYY','ZZZ'];
					for( var i=0; i < invalidName.length; ++i ){
						if( param_name.indexOf(invalidName[i]) > -1 ) return true;
					}
					return false;
				}
		function rtrim ( s ){return s.replace( /\s*$/, '' );
}
jQuery.validator.addMethod('integer', function(value, element) {
			return this.optional(element) || /^-?\d+$/.test(value);
}, 'Un nÃºmero no decimal positivo o negativo por favor');
jQuery.validator.addMethod('mobileMX10', function(value, element) {
			var regex = new RegExp('^[0-9]{10}$');
			var isValid = true;
			if(value.charAt(0) == 0 && value.charAt(1) == 4) {isValid = false};
			if(!formValidation_isValidLada(value)) {isValid = false};
			return ((regex.test(value) && isValid)||(jQuery(element).val() == ''));
		}, 'Escriba su celular correctamente, sin incluir la clave 044/045');
		function formValidation_isValidLada( phone ){
			var validaLada2 = ['55','33','81'];
			var validaLada3 = ['222','223','224','225','226','227','228','229','231','232','233','235','236','237','238','241','243','244','245','246','247','248','249','271','272','273','274','275','276','278','279','281','282','283','284','285','287','288','294','296','297','311','312','313','314','315','316','317','318','319','321','322','323','324','325','326','327','328','329','341','342','343','344','345','346','347','348','349','351','352','353','354','355','356','357','358','359','371','372','373','374','375','376','377','378','379','381','382','383','384','385','386','387','388','389','391','392','393','394','395','411','412','413','414','415','416','417','418','419','421','422','423','424','425','426','427','428','429','431','432','433','434','435','436','437','438','441','442','443','444','445','447','448','449','451','452','453','454','455','456','457','458','459','461','462','463','464','465','466','467','468','469','471','472','473','474','475','476','477','478','481','482','483','485','486','487','488','489','492','493','494','495','496','498','499','588','591','592','593','594','595','596','597','599','612','613','614','615','616','618','621','622','623','624','625','626','627','628','629','631','632','633','634','635','636','637','638','639','641','642','643','644','645','646','647','648','649','651','652','653','656','658','659','661','662','664','665','667','668','669','671','672','673','674','675','676','677','678','686','687','694','695','696','697','698','711','712','713','714','715','716','717','718','719','721','722','723','724','725','726','727','728','729','731','732','733','734','735','736','737','738','739','741','742','743','744','745','746','747','748','749','751','753','754','755','756','757','758','759','761','762','763','764','765','766','767','768','769','771','772','773','774','775','776','777','778','779','782','783','784','785','786','789','791','797','821','823','824','825','826','827','828','829','831','832','833','834','835','836','841','842','844','846','861','862','864','866','867','868','869','871','872','873','877','878','891','892','894','897','899','913','914','917','918','919','921','922','923','924','932','933','934','937','938','951','953','954','958','961','962','963','964','965','966','967','968','969','971','972','981','982','983','984','985','986','987','988','991','992','993','994','995','996','997','998','999'];
			var phone2 = phone.substr(0,2);
			var phone2_rest = phone.substr(2);
			var phone3 = phone.substr(0,3);
			var phone3_rest = phone.substr(3);

			for( var i=0; i <= validaLada2.length; ++i ){
				if( phone2 == validaLada2[i] ) {
					if(formValidation_isInvalidPhoneNumbers(phone2_rest) == true){
						return true;
					}
				}
			}
			for( var i=0; i <= validaLada3.length; ++i ){
				if( phone3 == validaLada3[i] ) {
					if(formValidation_isInvalidPhoneNumbers(phone3_rest) == true){
						return true;
					}
				}
			}
			return false;
		}
		function formValidation_isInvalidPhoneNumbers( phone ){
			var invalidPhones1 = ['1111111','2222222','3333333','4444444','5555555','6666666','7777777','8888888','9999999','0000000','0000001','1234567'];
			var invalidPhones2 = ['11111111','22222222','33333333','44444444','55555555','66666666','77777777','88888888','99999999','00000000','00000001','12345678'];
			var invalidPhones3 = ['1111111111','2222222222','3333333333','4444444444','5555555555','6666666666','7777777777','8888888888','9999999999','0000000000','0000000001','1234567890'];

			if(phone.length == 7){
				for( var i=0; i < invalidPhones1.length; ++i ){
					if( phone == invalidPhones1[i] ) return false;
				}
			} else if(phone.length == 8){
				for( var i=0; i < invalidPhones2.length; ++i ){
					if( phone == invalidPhones2[i] ) return false;
				}
			} else if(phone.length == 10){
				for( var i=0; i < invalidPhones3.length; ++i ){
					if( phone == invalidPhones3[i] ) return false;
				}
			}
			return true;
}
jQuery.validator.addMethod('dateCampus', function(value, element) {
			alert(value);
}, 'Por Favor elige una fecha en un horario de operacion');


var availableTags = ["@hotmail.com","@gmail.com","@live.com.mx","@icloud.com","@yahoo.com","@yahoo.com.mx","@hotmail.es","@live.com","@prodigy.net.mx"];
				$("#email").autocomplete({
				  source: availableTags
				});
				$("#email").keyup(function(event) {
				  if (availableTags != undefined) {
				    if (event.target.value.indexOf("@") == -1) {
				      var new_options = [];
				      for (var i = 0; i < availableTags.length; i++)
				        new_options[i] = $(this).val() + availableTags[i];
				      $(this).autocomplete("option", "source", new_options);
				    }
				  }
				});