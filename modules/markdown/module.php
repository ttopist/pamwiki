<?php

class MarkDownRender{
    public function render($path){
        ob_start();
        include('view.php');
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}

return new MarkDownRender();

?>