	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
		<script type="text/javascript">

// This is a check for the CKEditor class. If not defined, the paths must be checked.
if ( typeof CKEDITOR == 'undefined' )
{
	document.write(
		'<strong><span style="color: #ff0000">Error</span>: CKEditor not found</strong>.' +
		'This sample assumes that CKEditor (not included with CKFinder) is installed in' +
		'the "/ckeditor/" path. If you have it installed in a different place, just edit' +
		'this file, changing the wrong paths in the &lt;head&gt; (line 5) and the "BasePath"' +
		'value (line 32).' ) ;
}
var editor = CKEDITOR;
CKFinder.setupCKEditor( editor, 'ckfinder/' ) ;

		</script>

<form name="frmNews" method="POST" action="news_edit.php">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#64C2CA" width="100%" id="AutoNumber7" align = center>
  <tr>
    <td class=color2 width="100%" valign="top"><p align="right"><textarea rows="50" class="ckeditor" id=ta1 name="news_detail[]" cols="100"></textarea></p></td>
  </tr>
</table>
</form>