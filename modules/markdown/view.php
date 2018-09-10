<div>
<link rel="stylesheet" href="<?php echo BASE_URI ?>modules/markdown/editor.md/css/editormd.css" />
<script src="<?php echo BASE_URI ?>modules/markdown/editor.md/editormd.min.js"></script>
<button onclick='save()'>保存</button>
<br>
<div id="my-editormd" >
<textarea id="my-editormd-markdown-doc" name="my-editormd-markdown-doc" style="display:none;">
<?php include($path) ?>
</textarea>
</div>
<div id="div1"></div>
<script type="text/javascript">
var editor;
  $(function() {
    var h = document.documentElement.clientHeight || document.body.clientHeight;
    editor=editormd("my-editormd", {//注意1：这里的就是上面的DIV的id属性值
          width   : "99%",
          height  : h-150,
          syncScrolling : "single",
          path    : "<?php echo BASE_URI ?>modules/markdown/editor.md/lib/",//注意2：你的路径
      });
  });
function save(){
    var mark = { mark : editor.getMarkdown(), path: "<?php echo getRequestPath() ?>"};
    $.ajax({
        url:"<?php echo BASE_URI ?>?a=api&m=markdown",
        success:function(result){
            console.log(result);
        },
        data:mark,
        dataType:"text"
    });
}
</script>
</div>