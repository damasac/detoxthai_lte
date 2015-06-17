<!DOCTYPE html>
<html>
<head>
  <title>Codeerror</title>
  <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="../ckfinder/ckfinder.js"></script>
</head>
<body>
  <script type="text/javascript">

    var editor = CKEDITOR;
    CKFinder.setupCKEditor( editor, '../ckfinder/' ) ;

  </script>

  <form name="frmNews" method="POST" action="news_edit.php">
    <textarea rows="50" class="ckeditor" id=ta1 name="news_detail[]" cols="100"></textarea>
  </form>
</body>
</html>
