<html>
    <head>
        <meta charset="utf-8">
        <title>title</title>

        <base href="modules/frame/">

        <link rel="shortcut icon" href="static/img/favicon.ico">

        <link rel="stylesheet" href="static/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/prettify.css">
        <link rel="stylesheet" href="static/css/codemirror.css">
        <link rel="stylesheet" href="static/css/main.css">
		<link rel="stylesheet" href="static/css/custom.css">

        <meta name="description" content="<?php echo ($page['description']) ?>">
        <meta name="keywords" content="<?php echo (join(',', $page['tags'])) ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="static/js/jquery.min.js"></script>
        <script src="static/js/prettify.js"></script>
        <script src="static/js/codemirror.min.js"></script>
    </head>
<body>
    <div id="main">
        <div class="inner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <div id="sidebar">
                            <div class="inner">
                                <h2><span><?php 'APP_NAME' ?></span></h2>
                                there is tree
                                <?php include 'tree.php' ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-9">
                        <div id="content">
                            <div class="inner">
                                there is content
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>