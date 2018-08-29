<?php

// Define APP_NAME & LIBRARY_NAME
if (!defined('WIKIBOX_APP_NAME')) {
    define('WIKIBOX_APP_NAME', 'my-wikibox-name');
    define('WIKIBOX_LIBRARY_NAME', 'wikibox-library');
}

// BASE_URI & URL_REWRITE
$URL_REWRITE = false;
$BASE_URI = dirname( explode('?',$_SERVER['REQUEST_URI'],2)[0] . '#') .'/';
if( $t = strpos($BASE_URI, WIKIBOX_LIBRARY_NAME) ){
    $URL_REWRITE = true;
    $BASE_URI = substr($BASE_URI, 0, $t);
}
//define('URL_REWRITE', $URL_REWRITE);
define('URL_REWRITE', false);
define('BASE_URI', $BASE_URI);
define('BASE_DIR', __DIR__ . DIRECTORY_SEPARATOR);
define('DSEP', DIRECTORY_SEPARATOR);

// WikiBox Util Class
class WB
{
    static public function info($str){
        if(is_string($str)){
            echo $str .'<br>';
        }else{
            var_dump($str);
        }
    }

    static public function load($moduleName)
    {
        return require_once(BASE_DIR . 'modules' .DSEP. $moduleName .DSEP. 'module.php');
    }

}

// load WikiBox
WB::load('frame');

?>