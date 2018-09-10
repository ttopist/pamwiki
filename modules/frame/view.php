<?php

// function list

function getRequestPath()
{
    //获取file path, extension
    if (URL_REWRITE) {
        $uriPath = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
        $pathStartIdx = strpos($uriPath, WIKIBOX_LIBRARY_NAME);
        $path = urldecode(substr($uriPath, $pathStartIdx));
    } else {
        $path = isset($_REQUEST['p']) ? $_REQUEST['p'] : '/index.md';
    }
    return $path;
}

function renderContent()
{
    //获取file path, extension
    $path = getRequestPath();
    WB::info((BASE_DIR . WIKIBOX_LIBRARY_NAME . $path));
    $path = realpath(BASE_DIR . WIKIBOX_LIBRARY_NAME . $path);
    WB::info(($path));
    WB::info(pathinfo($path));
    $extension = pathinfo($path)['extension'];

    // render table
    $extensionRenderTable = array(
        "md" => "markdown",
    );
    if (array_key_exists($extension, $extensionRenderTable)) {
        $renderModule = WB::load($extensionRenderTable[$extension]);
    } else {
        $renderModule = require('TypeRender.class.php');
    }

    // render action
    $content = $renderModule->render($path);
    return $content;
}

function _getTree($dir = BASE_DIR . WIKIBOX_LIBRARY_NAME)
{
    $_ignore = "/^\..*|^CVS$/"; // Match dotfiles and CVS
    $_force_unignore = false; // always show these files (false to disable)
    $return = array('directories' => array(), 'files' => array());
    $items = scandir($dir);
    foreach ($items as $item) {
        if (preg_match($_ignore, $item)) {
            if ($_force_unignore === false || !preg_match($this->_force_unignore, $item)) {
                continue;
            }
        }
        $path = $dir . DIRECTORY_SEPARATOR . $item;
        if (is_dir($path)) {
            $return['directories'][$item] = _getTree($path);
            continue;
        }
        $return['files'][$item] = $item;
    }
    uksort($return['directories'], "strnatcasecmp");
    uksort($return['files'], "strnatcasecmp");
    return $return['directories'] + $return['files'];
}

function tree($array, $parent, $parts = array(), $step = 0)
{
    if (!count($array)) {
        return '';
    }
    $tid = ($step == 0) ? 'id="tree"' : '';
    $t = '<ul class="unstyled" ' . $tid . '>';
    foreach ($array as $key => $item) {
        if (is_array($item)) {
            $open = $step !== false && (isset($parts[$step]) && $key == $parts[$step]);
            $t .= '<li class="directory' . ($open ? ' open' : '') . '">';
            $t .= '<a href="#" data-role="directory"><i class="glyphicon glyphicon-folder-' . ($open ? 'open' : 'close') . '"></i>&nbsp; ' . $key . '</a>';
            $t .= tree($item, "$parent/$key", $parts, $open ? $step + 1 : false);
            $t .= '</li>';
        } else {
            $selected = (isset($parts[$step]) && $item == $parts[$step]);
            $filepath = substr($parent, strlen(WIKIBOX_LIBRARY_NAME));
            if (URL_REWRITE) {
                $t .= '<li class="file' . ($selected ? ' active' : '') . '"><a href="' . BASE_URI . 'view' . $filepath . '/' . $item . '">' . $item . '</a></li>';
            } else {
                $t .= '<li class="file' . ($selected ? ' active' : '') . '"><a href="' . BASE_URI . '?p=' . $filepath . '/' . $item . '">' . $item . '</a></li>';
            }
        }
    }
    $t .= '</ul>';
    return $t;
}

?>
<html>
    <head>
        <meta charset="utf-8">
        <base href="<?php echo BASE_URI . WIKIBOX_LIBRARY_NAME . getRequestPath() ?>" />
        <title>title</title>

        <link rel="shortcut icon" href="static/img/favicon.ico">

        <link rel="stylesheet" href="<?php echo BASE_URI ?>modules/frame/static/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo BASE_URI ?>modules/frame/static/css/prettify.css">
        <link rel="stylesheet" href="<?php echo BASE_URI ?>modules/frame/static/css/codemirror.css">
        <link rel="stylesheet" href="<?php echo BASE_URI ?>modules/frame/static/css/main.css">
		<link rel="stylesheet" href="<?php echo BASE_URI ?>modules/frame/ic/css/custom.css">

        <meta name="description" content="<?php echo ($page['description']) ?>">
        <meta name="keywords" content="<?php echo (join(',', $page['tags'])) ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="<?php echo BASE_URI ?>modules/frame/static/js/jquery.min.js"></script>
        <script src="<?php echo BASE_URI ?>modules/frame/static/js/prettify.js"></script>
        <script src="<?php echo BASE_URI ?>modules/frame/static/js/codemirror.min.js"></script>
    </head>
<body>
    <div id="main">
        <div class="inner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <div id="sidebar">
                            <div class="inner">
                                <h2><span>My WikiBox</span></h2>
<div id="tree-filter" class="input-group">
    <input type="text" id="tree-filter-query" placeholder="Search file &amp; directory names." class="form-control input-sm">
    <a id="tree-filter-clear-query" title="Clear current search..." class="input-group-addon input-sm">
        <i class="glyphicon glyphicon-remove"></i>
    </a>
</div>
<ul class="unstyled" id="tree-filter-results"></ul>

<?php echo tree(_getTree(), WIKIBOX_LIBRARY_NAME, explode("/", substr(getRequestPath(),1)) ); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-9">
                        <div id="content">
                            <div class="inner">
                                <?php echo renderContent() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- tree -->
<script>
    // Case-insensitive alternative to :contains():
    // All credit to Mina Gabriel:
    // http://stackoverflow.com/a/15033857/443373
    $.expr[':'].containsIgnoreCase = function (n, i, m) {
        return jQuery(n).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
    };

    $(document).ready(function() {
        var iconFolderOpenClass  = 'glyphicon glyphicon-folder-open',
            iconFolderCloseClass = 'glyphicon glyphicon-folder-close',

            // Handle live search/filtering:
            tree             = $('#tree'),
            resultsTree      = $('#tree-filter-results')
            filterInput      = $('#tree-filter-query'),
            clearFilterInput = $('#tree-filter-clear-query')
        ;

        // Auto-focus the search field:
        filterInput.focus();

        // Cancels a filtering action and puts everything back
        // in its place:
        function cancelFilterAction()
        {
            filterInput.val('').removeClass('active');
            resultsTree.empty();
            tree.show();
        }

        // Clear the filter input when the X to its right is clicked:
        clearFilterInput.click(cancelFilterAction);

        // Same thing if the user presses ESC and the filter is active:
        $(document).keyup(function(e) {
            e.keyCode == 27 && filterInput.hasClass('active') && cancelFilterAction();
        });

        // Perform live searches as the user types:
        // @todo: check support for 'input' event across more browsers?
        filterInput.bind('input', function() {
            var value         = filterInput.val(),
                query         = $.trim(value),
                isActive      = value != ''
            ;

            // Add a visual cue to show that the filter function is active:
            filterInput.toggleClass('active', isActive);

            // If we have no query, cleanup and bail out:
            if(!isActive) {
                cancelFilterAction();
                return;
            }

            // Hide the actual tree before displaying the fake results tree:
            if(tree.is(':visible')) {
                tree.hide();
            }

            // Sanitize the search query so it won't so easily break
            // the :contains operator:
            query = query
                        .replace(/\(/g, '\\(')
                        .replace(/\)/g, '\\)')
                    ;

            // Get all nodes containing the search query (searches for all a, and returns
            // their parent nodes <li>).
            resultsTree.html(tree.find('a:containsIgnoreCase(' + query + ')').parent().clone());
        });

        // Handle directory-tree expansion:
        $(document).on('click', '#sidebar a[data-role="directory"]', function (event) {
            event.preventDefault();

            var icon = $(this).children('.glyphicon');
            var open = icon.hasClass(iconFolderOpenClass);
            var subtree = $(this).siblings('ul')[0];

            icon.removeClass(iconFolderOpenClass).removeClass(iconFolderCloseClass);

            if (open) {
                if (typeof subtree != 'undefined') {
                    $(subtree).slideUp({ duration: 100 });
                }
                icon.addClass(iconFolderCloseClass);
            } else {
                if (typeof subtree != 'undefined') {
                    $(subtree).slideDown({ duration: 100 });
                }
                icon.addClass(iconFolderOpenClass);
            }
        });
    });
</script>

</html>