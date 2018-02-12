<?php

    

	Class nevia extends TagLibrary {
		
		
		function dummy(){
			
		}
		
		function setmessage($name, $data, $pars) {
		    
		    
		    if ($data == "undefined") {
		      
		        echo "QUI";
		        
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
		
		function report($name, $data, $pars) {
		    
		    if (count($data) > 0) {
		    
		        $result = "<table class=\"standard-table\">\n";
		        $result .= "<tr>\n";
		        
		        foreach($data[0] as $key => $value) {
		            
		            if (!is_numeric($key)) {
		              $result .= "<th>{$key}</th>\n";
		            }
		        }
		    
		        $result .= "</tr>\n";
		    
		        foreach($data as $row) {
		            $result .= "<tr>\n";
		            
		            foreach($row as $key => $value) {
		                if (!is_numeric($key)) {
		                  $result .= "<td><a href=\"?key={$row[0]}&step=1\">{$value}</a></td>\n";
		                }
		            }
		            $result .= "</tr>\n";
		        }
		    
		        $result .= "</table>\n";
		        
		    
		    } else {
		        $result = "There are no items.";
		    }
		    
		    
		    return $result;
		    
		    
		}
		
	}

?>