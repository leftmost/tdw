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

		foreach ($data as $key => $value) {


		 $result .= "<div class=\"product-item men\">
			<div class=\"product discount product_filter\">
				<div class=\"product_image\">
					<img src=\"image.php?id={$value['idImage']}\" alt=\"\">
				</div>
				<div class=\"product_info\">
					<h6 class=\"product_name\"><a href=\"\">{$value['Name']}</a></h6>
					<div class=\"product_price\">{$value['Price']}</div>
				</div>
			</div>
			<div class=\"red_button add_to_cart_button\"><a href=\"carrello.php?add={$value['id']}\">add to cart</a></div>
		  </div>";
	  }
	  return $result;
	}



	function bestsellers($name, $data, $pars){

		foreach ($data as $key => $value) {

			$result .= "<div class=\"owl-item product_slider_item\">
				<div class=\"product-item\">
					<div class=\"product discount\">
						<div class=\"product_image\">
							<img src=\"image.php?id={$value['idImage']}\" alt=\"\">
						</div>
						<div class=\"favorite favorite_left\"></div>
						<div class=\"product_info\">
							<h6 class=\"product_name\"><a href=\"\">{$value['Name']}</a></h6>
							<div class=\"product_price\">{$value['Price']}</div>
						</div>
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

			return $result = "<div class=\"col text-center\">
			  <div class=\"new_arrivals_title\">
			      <h3>Il mio account</h3>
			      <h4 style=\"color: #51545f;\">Username: {$data[0]['Username']}</h4>
			      <h4 style=\"color: #51545f;\">Email: {$data[0]['Email']}</h4>
			      <h4 style=\"color: #51545f;\">Nome: {$data[0]['Name']}</h4>
			      <h4 style=\"color: #51545f;\">Cognome: {$data[0]['Surname']}</h4>
			      <h4 style=\"color: #51545f;\">Indirizzo: {$data[0]['Address']}</h4>
			      <h4 style=\"color: #51545f;\">Città: {$data[0]['City']}</h4>
				</div>
			</div>";
	}

	function edit($name, $data, $pars){

		if(empty("$data")){

			return $result = "";
		}

		return $result = "<div class=\"col-lg-6 get_in_touch_col\">
			<div class=\"get_in_touch_contents text-center\">
				<h3>Modifica Informazioni</h3>
				<form action=\"post\">
					<div>
						<input class=\"form_input input_name input_ph\" type=\"text\" name=\"username\" placeholder=\"Username\" required=\"required\" data-error=\"Username is required.\" value=\"{$data[0]['Username']}\">
						<input class=\"form_input input_email input_ph\" type=\"email\" name=\"email\" placeholder=\"Email\" required=\"required\" data-error=\"Valid email is required.\" value=\"{$data[0]['Email']}\">
						<input class=\"form_input input_name input_ph\" type=\"password\" name=\"password\" placeholder=\"Password\" required=\"required\" data-error=\"Password is required.\" value=\"{$data[0]['Password']}\">
						<input class=\"form_input input_name input_ph\" type=\"text\" name=\"name\" placeholder=\"Nome\" required=\"required\" data-error=\"Nome is required.\" value=\"{$data[0]['Name']}\">
						<input class=\"form_input input_name input_ph\" type=\"text\" name=\"surname\" placeholder=\"Cognome\" required=\"required\" data-error=\"Cognome is required.\" value=\"{$data[0]['Surname']}\">
						<input class=\"form_input input_name input_ph\" type=\"text\" name=\"address\" placeholder=\"Indirizzo\" required=\"required\" data-error=\"Indirizzo is required.\" value=\"{$data[0]['Address']}\">
						<input class=\"form_input input_name input_ph\" type=\"text\" name=\"city\" placeholder=\"Città\" required=\"required\" data-error=\"Città is required.\" value=\"{$data[0]['City']}\">
					</div>
					<div>
						<button id=\"review_submit\" type=\"submit\" class=\"red_button message_submit_btn trans_300\" value=\"Submit\">salva modifiche</button>
					</div>
				</form>
			</div>
		</div>";
	}







}


?>
