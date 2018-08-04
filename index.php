<?php
// date
foreach (getallheaders() as $name => $value) {  
    echo "$name: $value <br>\n";  
}

foreach ($_SERVER as $name => $value) {  
    echo "$name: $value <br>\n";  
}

echo __FILE__;
?>