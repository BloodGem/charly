<?php



class ControladorGlobal{
	static public function ctrObtenerDia($day){

		switch ($day) {
			case "Sunday":
			$dia_texto = "Domingo";
			break;
			case "Monday":
			$dia_texto = "Lunes";
			break;
			case "Tuesday":
			$dia_texto = "Martes";
			break;
			case "Wednesday":
			$dia_texto = "Miércoles";
			break;
			case "Thursday":
			$dia_texto = "Jueves";
			break;
			case "Friday":
			$dia_texto = "Viernes";
			break;
			case "Saturday":
			$dia_texto = "Sábado";
			break;
		}

		return $dia_texto;

	}


	static public function ctrObtenerRangoFechas($no_rango){

		switch ($no_rango) {

			case 1:

			$dia = date("Y-m-d", strtotime("today"));
			$fecha1 = $dia . ' 00:00:00';
			$fecha2 = $dia . ' 23:59:59' ;


			break;

			case 2:

			$dia = date("Y-m-d", strtotime("yesterday"));
			$fecha1 = $dia . ' 00:00:00';
			$fecha2 = $dia . ' 23:59:59' ;


			break;
			case 3:

			if(date("D")=="Mon"){
				$lunes = date("Y-m-d");
			}else{
				$lunes = date("Y-m-d", strtotime('last Monday', time()));
			}


			$dia1 = $lunes;
			$dia2 = date('Y-m-d', strtotime('this Sunday', time()));
			$fecha1 = $dia1 . ' 00:00:00';
			$fecha2 = $dia2 . ' 23:59:59' ;



			break;

			case 4:

			if(date("D")=="Mon"){
				$lunes = date("Y-m-d", strtotime('last Monday', time()));
			}else{
				$lunes = date("Y-m-d", strtotime('last Monday - 7 days', time()));
			}


			$dia1 = $lunes;
			$dia2 = date('Y-m-d', strtotime('last Sunday', time()));
			$fecha1 = $dia1 . ' 00:00:00';
			$fecha2 = $dia2 . ' 23:59:59' ;


			break;

			case 5:
			$dia1 = date("Y-m-d", strtotime("today - 6 days"));
			$dia2 = date("Y-m-d", strtotime("today"));
			$fecha1 = $dia1 . ' 00:00:00';
			$fecha2 = $dia2 . ' 23:59:59' ;


			break;

			case 6:
			$dia1 = date("Y-m-d", strtotime("today - 29 days"));
			$dia2 = date("Y-m-d", strtotime("today"));
			$fecha1 = $dia1 . ' 00:00:00';
			$fecha2 = $dia2 . ' 23:59:59' ;


			break;

			case 7:

			$dia1 = date("Y-m-d", strtotime("first day of this month"));
			$dia2 = date("Y-m-d", strtotime("last day of this month"));
			$fecha1 = $dia1 . ' 00:00:00';
			$fecha2 = $dia2 . ' 23:59:59' ;



			break;

			case 8:

			$dia1 = date("Y-m-d", strtotime("first day of last month"));
			$dia2 = date("Y-m-d", strtotime("last day of last month"));
			$fecha1 = $dia1 . ' 00:00:00';
			$fecha2 = $dia2 . ' 23:59:59' ;


			break;
			
		}

		return array($fecha1, $fecha2);

	}










	static public function ctrEnviarMensaje($mensaje, $celular){

		$params=array(
			'token' => '5t6eu06n1yooxtu4',
			'to' => '+52'.$celular,
			'body' => $mensaje
		);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.ultramsg.com/instance68310/messages/chat",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => http_build_query($params),
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
	}


}


?>