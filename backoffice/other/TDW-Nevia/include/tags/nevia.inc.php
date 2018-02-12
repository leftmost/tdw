<?php

Class nevia extends TagLibrary {


	function dummy(){

	}

	function setmessage($name, $data, $pars) {

		if ($data != 'undefined') {
			if ($data) {
				$result = "<div class=\"notification success closeable ten\">
				<p><span>Success!</span> {$pars['ok']}</p>
				</div>";
				return $result;
			}
		}

	}

	function seterror($name, $data, $pars) {

		if ($data != 'undefined') {
			switch ($data) {
			  case 'error':
				$result = "<div class=\"notification error closeable ten\">
				<p><span>Error!</span> {$pars['mexError']}</p>
				</div>";
				break;

				case 'success':
				$result = "<div class=\"notification success closeable ten\">
				<p><span>Success!</span> {$pars['mexSuccess']}</p>
				</div>";
				break;

				case 'warning':
				$result = "<div class=\"notification warning closeable ten\">
				<p><span>Warning!</span> {$pars['mexWarning']}</p>
				</div>";
				break;

				case 'notice':
				$result = "<div class=\"notification notice closeable ten\">
				<p>{$pars['mexNotice']}</p>
				</div>";
				break;
				
				default: $result ="";
			}
			return $result;
		}
	}

	function report($name, $data, $pars) {
		//controllo se ha almeno un elemento
		if(count($data)>0){


			$result = "<table class=\"standard-table\">\n";
			$result .= "<tr>\n";

			// nomi tabelle

			foreach($data[0] as $key => $value) {
				if (!is_numeric($key)) {
					$result .= "<th>{$key}</th>\n";
				}

			}
			$result .= "<th>Impostazioni</th>\n";
			$result .= "</tr>\n";
			//fine nomi tabelle

			foreach($data as $row) {
				$result .= "<tr>\n";

				foreach($row as $key => $value) {
					if (!is_numeric($key)) {
						$result .= "<td>{$value}</td>\n";
					}
				}
				$result .= "<td> <a href=\"?key={$row[0]}&step=1\" class=\"button gray small\"><i class=\"icon-edit\"></i> </a> <a href=\"users-update.php?key={$row[0]}&step=2\" class=\"button gray small\"><i class=\"icon-remove\"></i></a> </td>\n";
				$result .= "</tr>\n";
			}

			$result .= "</table>\n";

		}else{
			$result = "<p>There are no items</p><br />";
		}

		return $result;

	}
}


?>
