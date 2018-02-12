<?php

	Class tdw201718 extends TagLibrary {
		
		
		function dummy(){
			
		}
		
		function table($name, $data, $pars) {
		    
		    $mario = "<!-- {$name} -->\n";
		    $mario .= "<table>\n";
		    	    
		    foreach($data as $row) {
		        
		        $mario .= "<tr>\n";
		        
		        foreach($row as $column) {
		            $mario .= "<td>{$column}</td>\n";
		        } 
		        
		        $mario .= "</tr>\n";
		        
		    }
		    
		    $mario .= "</table>\n";
		    $mario .= "<!-- {$name} end -->\n";
		    return $mario;
		    
		}
		
		function radiobox($name, $data, $pars) {
		    $mario = "<!-- {$name} -->\n";
		   	$fields = explode(" ",$pars['name']);
		   	
		   	
		   
		    foreach($data as $row) {
		        
		      /* $label = "";
		      foreach($fields as $field) {
		          $label .= " ".$row[$field];
		      } */
		      
		      $mario .= "<input type=\"radio\" name=\"{$name}\"> {$label}<br>\n";      
		      
		  
		    }
		    
		    $mario .= "<!-- {$name} end -->\n";
		    
		    
		    
		    return $mario;
		}
		
		
	}

?>