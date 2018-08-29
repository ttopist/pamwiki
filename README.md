# wikibox
a modularization wiki base filesystem, no database, writed by php
基于wikitten

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



/*
在index支持两套路径方式， index.php/file  index.php?p=file

内容页 md渲染直接使用写好的路径加载图片
                       div
index.php/file         直接显示
index.php?p=file       basepath改掉，其他内容的css用全路径(/开头或者http开头)，或者../../形式,render内容直接显示


*/

