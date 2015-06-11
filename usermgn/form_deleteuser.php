<?php
  require_once '../_theme/util.inc.php'; chk_login(); chk_login(); $MasterPage = 'page_main.php';
  include "../_connection/db.php";
  $id=$_GET["id"];
    
?>
<h3><center>ยืนยันการลบผู้ใช้งานนี้ ?</center></h3>
<br>
<div class="row">
    <div class="col-lg-6">
        <button class="btn btn-danger btn-block" onclick="doDelete('<?php echo $id;?>')">ลบ</button>
    </div>
    <div class="col-lg-6">
        <button class="btn btn-warning btn-block">ยกเลิก</button>
    </div>
</div>
<script>
    function doDelete(id) {
        //
        //alert(id);
                     $.ajax({
		    url: "ajax-sql-query.php?task=doDelete",
		    type: "post",
		    data: {id:id},
		    success: function(data){
                        location.href="index.php";
		    },
		    error:function(){
			alert("failure");
		    }
		});

    }
</script>