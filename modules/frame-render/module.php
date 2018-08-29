<?php

class Renders{
    public function render($path){
        if(empty($path))
            return '404';
        $source = file_get_contents($path);
        require 'Markdown.php';
        $html = \Michelf\MarkdownExtra::defaultTransform($source);
        return $html;
    }
}

return new Renders();

?>