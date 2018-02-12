<?php

Class lumino extends TagLibrary {


	function dummy(){

	}
function setimage($name, $data, $pars) {

	return $result="<img height=100% class=\"img-responsive\"  src=\"image.php?id=$data\">";
}
	function point($name, $data, $pars) {
		$result="";
		$name=$pars['value'];
		if(count($data)>0){
			foreach ($data as $row) {
				$result.="<li>$row[$name]</li>";
			}
		}else{$result.="<li>No groups</li>";}
		return $result;
	}

	function setmessage($name, $data, $pars) {

		if ($data==1) {
			return $result = "<div id=\"close\" class=\"alert bg-success\" role=\"alert\"><em class=\"fa fa-lg fa-check\">&nbsp;</em>{$pars['ok']}<a href=\"javascript:close()\" class=\"pull-right\"><em class=\"fa fa-lg fa-close\"></em></a></div>";
		}
		if(is_string($data)){
			return $result = "<div id=\"close\" class=\"alert bg-warning\" role=\"alert\"><em class=\"fa fa-lg fa-warning\">&nbsp;</em>&emsp;$data<a href=\"javascript:close()\" class=\"pull-right\"><em class=\"fa fa-lg fa-close\"></em></a></div>";
		}
	}

function address_bar($name, $data, $pars) {

	$result="<div class=\"row\">
    <ol class=\"breadcrumb\">
      <li>
        <a href=\"dashboard.php\"><em class=\"fa fa-home\"></em></a>
      </li>";
			foreach($data as $key => $value){
				$result.="<li class=\"active\">$value</li>";
			}

  $result.="</ol>
  </div>";
	return $result;
}

function title($name, $data, $pars) {
	$result="<div class=\"row\">
						<div class=\"col-lg-12\">
							<h1 class=\"page-header\">$data</h1>
						</div>
					</div>";
	return $result;
}


	function form_option($name, $total, $pars) {

		if(count($total)>0){
			$data=$total[0];
			$id=$total[1];

			$name=$pars['name'];     // Nome form
			$option=$pars['option']; // colonna da scegliere nel box
			$value=$pars['value'];   // colonna da assegnare


			$result="<select  id=$name name=$name class=\"form-control\" required>\n";
			$result .="<option value=\"\" disabled selected hidden ></option>\n";
			foreach($data as $row) {

				if($row[$value]==$id){
					$result .="<option value=\"$row[$value]\" selected >$row[$option]</option>\n";
				}else{
				$result .="<option value=\"$row[$value]\" >$row[$option]</option>\n";
				}
			}
			$result.="</select>\n";

		}else{
			$result ="<br /><p>There are no items</p>";
		}
		return $result;
	}

	function checkbox($name, $data, $pars) {
		$result="";
		$id=$pars['id'];
		$option=$pars['option'];
		$name=$pars['name']."[]";

		if(isset($pars['check'])){
			if(count($data)>0){
				foreach ($data as $key => $value) {
					$result.="<div class=\"checkbox\">\n";
					$result.="<label>\n";
				  $result.="<input value=\"$value[$id]\" checked name=\"$name\" required type=\"checkbox\" required>$value[$option]\n";
					$result.="</label>\n";
					$result.="</div>\n";
				}
			}
		}else {
			if(count($data)>0){
				foreach ($data as $key => $value) {
					$result.="<div class=\"checkbox\">\n";
					$result.="<label>\n";
				  $result.="<input value=\"$value[$id]\" name=\"$name\" type=\"checkbox\" required>$value[$option]\n";
					$result.="</label>\n";
					$result.="</div>\n";
				}
			}
		}
		return $result;
	}

	function checked($name, $data, $pars) {
		$result="";
		if(count($data)>0){
			foreach ($data as $key => $value) {
				$result.="<div class=\"checkbox\">\n";
				$result.="<label>\n";
				$result.="<input value=\"$value[id]\" name=\"services[]\" checked type=\"checkbox\">$value[Description]\n";
				$result.="</label>\n";
				$result.="</div>\n";
			}
		}
		return $result;
	}

	function unchecked($name, $data, $pars) {

		$result="";
		if(count($data)>0){
			foreach ($data as $key => $value) {
				$result.="<div class=\"checkbox\">\n";
				$result.="<label>\n";
				$result.="<input value=\"$value[id]\" name=\"services[]\" type=\"checkbox\">$value[Description]\n";
				$result.="</label>\n";
				$result.="</div>\n";
			}
		}
		return $result;
	}

	function blocked($name, $data, $pars) {

		$result="";
		if(count($data)>0){
			foreach ($data as $key => $value) {
				$result.="<div class=\"checkbox\">\n";
				$result.="<label>\n";
				$result.="<input disabled='true' value=\"$value[id]\" name=\"services[]\" type=\"checkbox\">$value[Description]\n";
				$result.="</label>\n";
				$result.="</div>\n";
			}
		}
		return $result;
	}
	//semplice tabella
	function report($name, $data, $pars) {
		if(!is_array($data)){return $result="";}

		//controllo se ha almeno un elemento
		if(!empty($data)){

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
	function report_view($name, $data, $pars) {
		if(!is_array($data)){return $result="";}
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
			$result .= "<th>Other</th>\n";
			$result .= "</thead>\n";
			echo "<!-- end_intestazione -->";

			foreach($data as $row) {
				$result .= "<tr>\n";

				foreach($row as $key => $value) {
					if (!is_numeric($key)) {
						$result .= "<td>$value</td>\n";
					}
				}
				$result .= "<td><a href=\"{$pars['page']}?page={$pars['reference']}&{$pars['id']}=$row[0]\" ><em class=\"fa fa-arrow-circle-right\"></em> {$pars['reference']}</a></td>\n";
				$result .= "</tr>\n";
			}

			$result .= "</table>\n";

		}else{
			$result = "<p>There are no items</p><br />";
		}

		return $result;

	}

	// table update settings with 2 parameters
	function report_update2($name, $data, $pars) {

		if(!is_array($data)){return $result="";}//caricamento iniziale placeholder

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
			$result .= "<th colspan=\"2\">Settings</th>\n";
			$result .= "</thead>\n";
			echo "<!-- end_intestazione -->";

			foreach($data as $row) {
				$result .= "<tr>\n";

				foreach($row as $key => $value) {
					if (!is_numeric($key)) {
						$result .= "<td>$value</td>\n";
					}
				}
				$result .= "<td><a href=\"{$pars['page']}?page=edit&{$pars['id0']}=$row[0]&{$pars['id1']}=$row[1]\" ><em class=\"fa fa-lg fa-pencil\"></em> Edit</a></td>\n";
				$result .= "<td><a href=\"{$pars['page']}?page=delete&{$pars['id0']}=$row[0]&{$pars['id1']}=$row[1]\" ><em class=\"fa fa-lg fa-trash-o\"></em> Delete</a></td>\n";
				$result .= "</tr>\n";
			}

			$result .= "</table>\n";

		}else{
			$result = "<p>There are no items</p><br />";
		}

		return $result;

	}

	// table update with settings
	function report_update($name, $data, $pars) {
		if(!is_array($data)){return $result="";}
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
			$result .= "<th colspan=\"2\">Settings</th>\n";
			$result .= "</thead>\n";
			echo "<!-- end_intestazione -->";

			foreach($data as $row) {
				$result .= "<tr>\n";

				foreach($row as $key => $value) {
					if (!is_numeric($key)) {
						$result .= "<td>$value</td>\n";
					}
				}
				$result .= "<td><a href=\"{$pars['page']}?page=edit&{$pars['id']}=$row[0]\" ><em class=\"fa fa-lg fa-pencil\"></em> Edit</a></td>\n";
				$result .= "<td><a href=\"{$pars['page']}?page=delete&{$pars['id']}=$row[0]\" ><em class=\"fa fa-lg fa-trash-o\"></em> Delete</a></td>\n";
				$result .= "</tr>\n";
			}

			$result .= "</table>\n";

		}else{
			$result = "<p>There are no items</p><br />";
		}

		return $result;

	}

	// table update with settings
	function report_orders($name, $data, $pars) {
		if(!is_array($data)){return $result="";}
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
			$result .= "<th colspan=\"2\">Settings</th>\n";
			$result .= "</thead>\n";
			echo "<!-- end_intestazione -->";

			foreach($data as $row) {
				$result .= "<tr>\n";
				foreach($row as $key => $value) {
					if (!is_numeric($key)) {
						$result .= "<td>$value</td>\n";
					}
				}
				$result .= "<td><a href=\"{$pars['page']}?page=view&{$pars['id']}=$row[0]\" ><em class=\"fa fa-lg fa-arrow-circle-right\"></em> View</a></td>\n";
				$result .= "<td><a href=\"{$pars['page']}?page=deleteOrder&{$pars['id']}=$row[0]\" ><em class=\"fa fa-lg fa-trash-o\"></em> Delete</a></td>\n";
				$result .= "</tr>\n";
			}

			$result .= "</table>\n";

		}else{
			$result = "<p>There are no items</p><br />";
		}

		return $result;

	}

	// table update with 2 settings
	function report_producs_order($name, $data, $pars) {
		if(!is_array($data)){return $result="";}
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
			$result .= "<th colspan=\"2\">Settings</th>\n";
			$result .= "</thead>\n";
			echo "<!-- end_intestazione -->";

			foreach($data as $row) {
				$result .= "<tr>\n";

				foreach($row as $key => $value) {
					if (!is_numeric($key)) {
						$result .= "<td>$value</td>\n";
					}
				}
				$result .= "<td><a href=\"{$pars['page']}?page=edit&id_Order=$row[0]&id_Product=$row[1]\" ><em class=\"fa fa-lg fa-pencil\"></em> Edit</a></td>\n";
				$result .= "<td><a href=\"{$pars['page']}?page=delete&id_Order=$row[0]&id_Product=$row[1]\" ><em class=\"fa fa-lg fa-trash-o\"></em> Delete</a></td>\n";
				$result .= "</tr>\n";
			}

			$result .= "</table>\n";

		}else{
			$result = "<p>There are no items</p><br />";
		}

		return $result;

	}

	function setplace($name, $data, $pars) {
		if(empty($data)){return $place="";}

		$place="
		<div class=\"row\">
    <div class=\"col-md-12\">
			<div class=\"panel panel-default\">
        <div class=\"panel panel-body text-center\">
          <form class=\"\" method=\"post\">
            <input type=\"number\" class=\"btn btn-md btn-default\" name=\"place\" placeholder=\"Insert place\">
            <input type=\"submit\" class=\"btn btn-md btn-primary\" value=\"Save\">
          </form>
        </div>
      </div>
    </div>
		</div>";

		return $place;
	}

	// table list product with warehouse and gallery
	function report_products($name, $data, $pars) {
		if(!is_array($data)){return $result="";}
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
			$result .= "<th colspan=\"2\">Other</th>\n";
			$result .= "</thead>\n";
			echo "<!-- end_intestazione -->";

			foreach($data as $row) {
				$result .= "<tr>\n";

				foreach($row as $key => $value) {
					if (!is_numeric($key)) {
						$result .= "<td>$value</td>\n";
					}
				}
				$result .= "<td><a href=\"{$pars['page']}?page=warehouse&{$pars['id']}=$row[0]\" ><em class=\"fa fa-lg fa-university\"></em></a></td>\n";
				$result .= "<td><a href=\"gallery.php?page=list&{$pars['id']}=$row[0]\" ><em class=\"fa fa-lg fa-camera\"></em></a></td>\n";
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
