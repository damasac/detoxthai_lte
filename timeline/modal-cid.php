<?php
    session_start();
    require_once '../_theme/util.inc.php';
    $MasterPage = 'page_main.php';
    include "../_connection/db_base.php";
    // $sql = "SELECT * FROM `puser` WHERE id='".$_SESSION["dtt_puser_id"]."' ";
    // echo $sql;
    // $query = $mysqli->query($sql);
    // $data = $query->fetch_assoc();
    // echo $_GET["pid"];
?>

<?php ?>
<div class="container">
<div class="row">
  <div class="col-lg-6">
  <label>
    กรุณากรอกเลขบัตรประจำตัวประชาชน 13 หลัก
  </label>
  <input type="text" class="form-control"   id="personid" name="personid"
  style="width:550px;"
  data-inputmask="'mask': ['9-9999-99999-99-9']" data-mask

  >
  </div>

</div>
<br>
<div class="row">
<div class="col-lg-1">
  <button class="btn btn-success" onclick='checkForm();'>ยืนยัน</button>
</div>
</div>
</div>
<script>
$("[data-mask]").inputmask();
function checkID(id)
{
  if(id.length != 13) return false;
  for(i=0, sum=0; i < 12; i++)
  sum += parseFloat(id.charAt(i))*(13-i); if((11-sum%11)%10!=parseFloat(id.charAt(12)))
  return false; return true;
}

function checkForm()
{
  var id = $("#personid").val();
  var pid = "<?Php echo $_GET["pid"]?>";
  var cid = id.split("-");
  var personid = cid[0]+cid[1]+cid[2]+cid[3]+cid[4];
  if(!checkID(personid)){
    alert('รหัสประชาชนไม่ถูกต้อง');
  }
  else{
    $.ajax({
        url: "sql.php?task=cid",
        type: "post",
        data: {
          cid:id,
          pid:pid
          },
        success: function(data){
              // location.reload();
        },
        error:function(){
            alert("failure");
        }
      });
  }
}
</script>
