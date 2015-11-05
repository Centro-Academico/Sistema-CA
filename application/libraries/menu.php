<?php

class Menu {
    
    
    function __construct() {
        
    }
    
    
    function retira_iguais($array){
        
        $new_array = array();
        $p = 0;
            
        for($i = 0; $i < sizeof($array); $i++){
         
            if(in_array($array[$i], $new_array)){

            }else{
                 $new_array[$p] = $array[$i];
                $p++;
            }
        }
        return $new_array;
    }
}
