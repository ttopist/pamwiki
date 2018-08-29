<?php
class TypeRender{

    public function render($path){
        $finfo = finfo_open(FILEINFO_MIME);
        $mime_type = finfo_file($finfo, $path);
        return 'TypeRender 404<br><pre>'.json_encode($mime_type).'</pre>';
    }
}

return new TypeRender();
?>