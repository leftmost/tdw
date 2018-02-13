<?php
Class shop extends TagLibrary {
    function dummy(){
    }
    // FUNZIONE CSS
    function css($name, $data, $pars){
        switch ($data) {
            case 'cssindex': return $result = "<link rel=\"stylesheet\" type=\"text/css\" href=\"dtml/shop/styles/main_styles.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"dtml/shop/styles/responsive.css\">";
            break;
            case 'cssprodotto': return $result = "<link rel=\"stylesheet\" href=\"dtml/shop/plugins/themify-icons/themify-icons.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"dtml/shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"dtml/shop/styles/single_styles.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"dtml/shop/styles/single_responsive.css\">";
            break;
            case 'cssprofilo': return $result = "<link rel=\"stylesheet\" type=\"text/css\" href=\"dtml/shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"dtml/shop/styles/categories_styles.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"dtml/shop/styles/categories_responsive.css\">
			<link rel=\"stylesheet\" href=\"dtml/shop/plugins/themify-icons/themify-icons.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"dtml/shop/styles/contact_styles.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"dtml/shop/styles/contact_responsive.css\">";
            break;
            case 'csscategorie': return $result = "<link rel=\"stylesheet\" type=\"text/css\" href=\"dtml/shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"dtml/shop/styles/categories_styles.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"dtml/shop/styles/categories_responsive.css\">";
            break;
        }
    }
    //FUNZIONE JS
    function js($name, $data, $pars){
        switch ($data) {
            case 'jsindex': return $result = "<script src=\"dtml/shop/js/custom.js\"></script>";
            break;
            case 'jsprodotto': return $result = "<script src=\"dtml/shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.js\"></script>
			<script src=\"dtml/shop/js/single_custom.js\"></script>";
            break;
            case 'jsprofilo': return $result ="<script src=\"dtml/shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.js\"></script>
			<script src=\"dtml/shop/js/categories_custom.js\"></script>";
            break;
            case 'jscategorie': return $result ="<script src=\"dtml/shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.js\"></script>
			<script src=\"dtml/shop/js/categories_custom.js\"></script>";
            break;
        }
    }
    /***************************** BEST SELLERS E ULTIMI ARRIVI home.html ***********/
    function prodotto($name, $data, $pars){
        if(!is_array($data)){return $result="";}
        if(empty($data)){
            $result ="<div class=\"product_info\"> PRODOTTO NON DISPONIBILE </div>";
            return $result;
        }
        $result="";
        foreach($data as $key => $value) {
            $result .= "
		 <div class=\"product-item {$pars['type']}\">
				<div class=\"product discount product_filter\">
                    <a href=\"prodotto.php?id={$value['id']}\">
					   <div class=\"product_image text-center\">
					   	<img src=\"image.php?id={$value['idImage']}\"  style=\"width:auto;max-height:221px;max-width:221px;\"  alt=\"\">
					   </div>
					   <div class=\"product_info\">
						  <h6 class=\"product_name\"><a href=\"prodotto.php?id={$value['id']}\">{$value['Name']}</a></h6>
						  <div class=\"product_price\">{$value['Price']} €</div>
					   </div>
				    </a>
                </div>
                <div>
			     <div class=\"red_button add_to_cart_button\"><a href=\"prodotto.php?id={$value['id']}\">VISUALIZZA</a></div>
		        </div>
		  </div>";
        }
        return $result;
    }
    function bestsellers($name, $data, $pars){
        $result = "";
        foreach ($data as $key => $value) {
            $result .= "
            <div class=\"owl-item product_slider_item product-item \">
				<div class=\"product-item\">
					<div class=\"product discount\">
						<div class=\"product_image text-center\">
							<img src=\"image.php?id={$value['idImage']}\"  style=\"margin: 0 auto; width:auto;max-height:221px;max-width:221px;\"  alt=\"\">
						</div>
						<div class=\"product_info\">
							<h6 class=\"product_name\"><a href=\"prodotto.php?id={$value['id']}\">{$value['Name']}</a></h6>
							<div class=\"product_price\">{$value['Price']}</div>
						</div>
					</div>
                    <div>
					   <div class=\"red_button add_to_cart_button\"><a href=\"prodotto.php?id={$value['id']}\">VISUALIZZA</a></div>
				    </div>
                </div>
			</div>";
        }
        return $result;
    }
    /*************************************************************************************/
    /************************************PROFILO******************************************/
    function info($name, $data, $pars){
        if(empty("$data")){
            return $result = "";
        }
        return $result = "  <table style=\"width: 100%\">
			    							 				<tr style=\"border: 1px solid #ddd; padding: 8px;\">
			      											<td style=\"border: 1px solid #ddd; padding: 8px; font-weight: bold;\">Username</td>
			      											<td style=\"border: 1px solid #ddd; padding: 8px;\">{$data[0]['Username']}</td>
			    											</tr>
			    											<tr style=\"border: 1px solid #ddd; padding: 8px;\">
			      											<td style=\"border: 1px solid #ddd; padding: 8px; font-weight: bold;\">Email</td>
			      											<td style=\"border: 1px solid #ddd; padding: 8px;\">{$data[0]['Email']}</td>
			    											</tr>
																<tr style=\"border: 1px solid #ddd; padding: 8px;\">
			      											<td style=\"border: 1px solid #ddd; padding: 8px; font-weight: bold;\">Nome</td>
			      											<td style=\"border: 1px solid #ddd; padding: 8px;\">{$data[0]['Name']}</td>
			    											</tr>
																<tr style=\"border: 1px solid #ddd; padding: 8px;\">
			      											<td style=\"border: 1px solid #ddd; padding: 8px; font-weight: bold;\">Cognome</td>
			      											<td style=\"border: 1px solid #ddd; padding: 8px;\">{$data[0]['Surname']}</td>
			    											</tr>
																<tr style=\"border: 1px solid #ddd; padding: 8px;\">
			      											<td style=\"border: 1px solid #ddd; padding: 8px; font-weight: bold;\">Indirizzo</td>
			      											<td style=\"border: 1px solid #ddd; padding: 8px;\">{$data[0]['Address']}</td>
			    											</tr>
																<tr style=\"border: 1px solid #ddd; padding: 8px;\">
			      											<td style=\"border: 1px solid #ddd; padding: 8px; font-weight: bold;\">Città</td>
			      											<td style=\"border: 1px solid #ddd; padding: 8px;\">{$data[0]['City']}</td>
			    											</tr>
			  									</table>";
    }
    //semplice tabella
    function tabella($name, $data, $pars) {
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
            $result .= "<th>Remove</th>\n";
            $result .= "</thead>\n";
            echo "<!-- end_intestazione -->";
            foreach($data as $row) {
                $result .= "<tr>\n";
                foreach($row as $key => $value) {
                    if (!is_numeric($key)) {
                        $result .= "<td>$value</td>\n";
                    }
                }
                $result .= "<td><a href=\"profilo.php?page=delete&id=$row[0]\" style=\"color: black;\"> Delete</a></td>\n";
                $result .= "</tr>\n";
            }
            $result .= "</table>\n";
        }else{
            $result = "<p>Carrello vuoto</p><br />";
        }
        return $result;
    }
    // tabella carrello
    function carrello($name, $data, $pars) {
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
            $result .= "<th>Remove</th>\n";
            $result .= "</thead>\n";
            echo "<!-- end_intestazione -->";
            foreach($data as $row) {
                $result .= "<tr>\n";
                foreach($row as $key => $value) {
                    if (!is_numeric($key)) {
                        $result .= "<td>$value</td>\n";
                    }
                }
                $result .= "<td><a href=\"profilo.php?page=delete&id=$row[0]&size=$row[5]&amount=$row[4]\" style=\"color: black;\"> Delete</a></td>\n";
                $result .= "</tr>\n";
            }
            $result .= "</table>\n";
        }else{
            $result = "<p>Carrello vuoto</p><br />";
        }
        return $result;
    }
    // tabella acquisti
    function tabacquisti($name, $data, $pars) {
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
            $result = "<p>Non ci sono acquisti effettuati!</p><br />";
        }
        return $result;
    }
    function buy($name,$data,$pars){
        if(empty($data)){return $result="";}
        return $result = "<div class=\"red_button shop_now_button\"><a href=\"pagamento.php?order={$data}\">acquista ora</a></div>";
    }
    function edit($name, $data, $pars){
        if(empty("$data")){
            return $result = "";
        }
        return $result = "<div class=\"col-lg-6 get_in_touch_col\" style=\"margin-left: 200px;\">
			<div class=\"get_in_touch_contents text-center\">
				<h3 style=\"margin-bottom: 30px;\">Modifica Informazioni</h3>
				<form method=\"post\" action=\"profilo.php?page=modifica\">
					<div>
						<input class=\"form_input input_name input_ph\" type=\"hidden\" name=\"username\" placeholder=\"Username\" required=\"required\" data-error=\"Username is required.\" value=\"{$data[0]['Username']}\">
						<input class=\"form_input input_email input_ph\" type=\"email\" name=\"email\" placeholder=\"Email\" required=\"required\" data-error=\"Valid email is required.\" value=\"{$data[0]['Email']}\">
						<input class=\"form_input input_name input_ph\" type=\"password\" name=\"password\" placeholder=\"Password\" required=\"required\" data-error=\"Password is required.\" value=\"{$data[0]['Password']}\">
						<input class=\"form_input input_name input_ph\" type=\"text\" name=\"name\" placeholder=\"Nome\" value=\"{$data[0]['Name']}\">
						<input class=\"form_input input_name input_ph\" type=\"text\" name=\"surname\" placeholder=\"Cognome\" value=\"{$data[0]['Surname']}\">
						<input class=\"form_input input_name input_ph\" type=\"text\" name=\"address\" placeholder=\"Indirizzo\" value=\"{$data[0]['Address']}\">
						<input class=\"form_input input_name input_ph\" type=\"text\" name=\"city\" placeholder=\"Città\" value=\"{$data[0]['City']}\">
					</div>
					<div>
						<button id=\"review_submit\" type=\"submit\" class=\"red_button message_submit_btn trans_300\" value=\"Submit\">salva modifiche</button>
					</div>
				</form>
			</div>
		</div>";
    }
    /*************************************************************************************/
    function categorie($name, $total, $pars){
        $data=$total[0];
        $type=$total[1];
        $result = "";
        foreach ($data as $key => $value){
            $result .= "<li><a href=\"categorie.php?type=$type&page={$value['id']}\">{$value['Name']}</a></li>";
        }
        return $result;
    }
    function pagamento($name, $data, $pars){
        if(empty("$data")){
            return $result = "";
        }
        return $result="";
    }
}
?>