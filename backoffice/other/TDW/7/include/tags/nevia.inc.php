<?php

	Class nevia extends TagLibrary {
		
		
		function dummy(){
			
		}
		
		function setmessage($name, $data, $pars) {
		    
		    
		    if ($data == "undefined") {
		        return "";
		    } else {
		    
        		    if ($data) {
        		        
        		        $result = "<div class=\"notification success closeable\">
        		        <p><span>Success!</span> {$pars['ok']} !</p>
        		        </div>";
        		        
        		    } else {
        		        $result = "<div class=\"notification error closeable\">
        		        <p><span>Error!</span> {$pars['ko']} !</p>
        		            </div>";
        		    }
        		    
        		    return $result;

		    }
		}
		
	}

?>