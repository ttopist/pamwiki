<?php

class MarkDownRender{
    public function render($path){
        ob_start();
        include('view.php');
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function api(){
        echo 'api';
        echo '<pre>';
        var_dump($_REQUEST);
        echo '</pre>';
        $filepath = realpath(BASE_DIR . WIKIBOX_LIBRARY_NAME . $_REQUEST['path']);
        file_put_contents($filepath,$_REQUEST['mark']);
    }
}

return new MarkDownRender();

?>