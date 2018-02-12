<?php

Class lumino extends TagLibrary {


	function dummy(){

	}

	function setmessage($name, $data, $pars) {


			if ($data==1) {
               return $result = "<div class=\"alert bg-success\" role=\"alert\"><em class=\"fa fa-lg fa-check\">&nbsp;</em>{$pars['ok']}<a href=\"#\" class=\"pull-right\"><em class=\"fa fa-lg fa-close\"></em></a></div>";
			}
			if(is_string($data)){
                return $result = "<div class=\"alert bg-warning\" role=\"alert\"><em class=\"fa fa-lg fa-warning\">&nbsp;</em>$data<a href=\"#\" class=\"pull-right\"><em class=\"fa fa-lg fa-close\"></em></a></div>";
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

    //semplice tabella
	function report($name, $data, $pars) {
		//controllo se ha almeno un elemento
		if(count($data)>0){

			$result = "<table class=\"table table-bordered table-striped\">\n";
      echo "<!-- intestazione -->";
			$result .= "<thead>\n";
			foreach($data[0] as $key => $value) {
				if (!is_numeric($key)) {
					$result .= "<th>{$key}</th>\n";
				}

			}
			$result .= "</thead>\n";
			echo "<!-- end_intestazione -->";

			foreach($data as $row) {
				$result .= "<tr>\n";

				foreach($row as $key => $value) {
					if (!is_numeric($key)) {
						$result .= "<td>$value</td>\n";
					}
				}
				$result .= "</tr>\n";
			}

			$result .= "</table>\n";

		}else{
			$result = "<p>There are no items</p><br />";
		}

		return $result;

	}

    //semplice tabella
    function report_update($name, $data, $pars) {
        //controllo se ha almeno un elemento
        if(count($data)>0){

            $result = "<table class=\"table table-bordered table-striped\">\n";
            echo "<!-- intestazione -->";
            $result .= "<thead>\n";
            foreach($data[0] as $key => $value) {
                if (!is_numeric($key)) {
                    $result .= "<th>{$key}</th>\n";
                }

            }

            $result .= "</thead>\n";
            echo "<!-- end_intestazione -->";

            foreach($data as $row) {
                $result .= "<tr>\n";

                foreach($row as $key => $value) {
                    if (!is_numeric($key)) {
                        $result .= "<td>$value</td>\n";
                    }
                }
                $result .= "<td><a href=\"products.php?page=edit&id=$row[0]\" ><em class=\"fa fa-lg fa-pencil\"></em> Edit</a></td>\n";
                $result .= "<td><a href=\"products.php?page=delete&id=$row[0]\" ><em class=\"fa fa-lg fa-trash-o\"></em> Delete</a></td>\n";
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
