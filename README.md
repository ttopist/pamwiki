# wikibox
a modularization wiki base filesystem, no database, writed by php

# 统一入口
index.php是统一的入口。
请对apache或nginx进行相对于的配置。
以下是配置示例：

apache

httpd.conf配置

<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^/wikibox/wikibox-library/(.*)$ /wikibox/index.php [L]
</IfModule>

.htaccess配置

<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^wikibox-library/(.*)$ index.php [L]
</IfModule>


nginx

