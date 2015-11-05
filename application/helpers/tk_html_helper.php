<?php if (!defined('BASEPATH'))    exit('Sem permissao de acesso direto ao Script.');
if ( ! function_exists('lnbreak'))
{
	function lnbreak($num = 1)
	{
            for($i=0; $i<$num; $i++) {
                echo "\n";
            }

	}
}

if ( ! function_exists('script_tag'))
{
        function script_tag($src, $type = 'text/javascript', $index_page = FALSE) {

            $CI =& get_instance();
            
            if( $index_page === FALSE)
                $script = '<script src="' . $CI->config->slash_item('base_url') . $src . '" type="' . $type . '"></script>';
            else 
                $script = '<script src=" '.  $src . '"></script>';
            return $script;
            
        }   
}

?>
