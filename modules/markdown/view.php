<div>
<link rel="stylesheet" href="<?php echo BASE_URI ?>modules/markdown/editor.md/css/editormd.css" />
<script src="<?php echo BASE_URI ?>modules/markdown/editor.md/editormd.min.js"></script>
<div id="my-editormd" >
<textarea id="my-editormd-markdown-doc" name="my-editormd-markdown-doc" style="display:none;">
<?php include($path) ?>
</textarea>
</div>
<script type="text/javascript">
  $(function() {
      editormd("my-editormd", {//注意1：这里的就是上面的DIV的id属性值
          width   : "99%",
          height  : 640,
          syncScrolling : "single",
          path    : "<?php echo BASE_URI ?>modules/markdown/editor.md/lib/",//注意2：你的路径
      });
  });
</script>
</div>