<div class="info-box">
  <span class="info-box-icon bg-blue"><i class="fa fa-file-o"></i></span>
  <div class="info-box-content">
    <span ><h4>Ez Form</h4></span>
    
    <?php if($MenuType=="MenuMain"){?>
    <span class="info-box-text">
        <?php if($MenuSetting=="listeform"){ $menuKey="success";}else{$menuKey="default";}?>
        <button class='btn btn-<?php echo $menuKey;?>' id="user" onclick="location.href='index.php'"><i class="fa fa-list-ul"></i> รายการฟอร์ม</button>
        <?php if($MenuSetting=="shareform"){ $menuKey="success";}else{$menuKey="default";}?>
        <button class='btn btn-<?php echo $menuKey;?>' id="department" onclick="location.href='formshare.php'"><i class="fa fa-child"></i> ฟอร์มส่วนรวม</button>
    </span>
    <?php }else if($MenuType=="MenuEform"){?>
    <span class="info-box-text">
        <?php if($MenuSetting=="listeform"){ $menuKey="success";}else{$menuKey="default";}?>
        <button class='btn btn-<?php echo $menuKey;?>' id="user" onclick="location.href='index.php'"><i class="fa fa-list-ul"></i> รายการฟอร์ม</button>
        <?php if($MenuSetting=="manageform"){ $menuKey="success";}else{$menuKey="default";}?>
        <button class='btn btn-<?php echo $menuKey;?>' id="user" onclick="location.href='eform.php?idFormMain=<?php echo $idForm; ?>'"><i class="fa fa-edit"></i> จัดการฟอร์ม</button>
        <?php if($MenuSetting=="viewform"){ $menuKey="success";}else{$menuKey="default";}?>
        <button class='btn btn-<?php echo $menuKey;?>' id="department" onclick="location.href='form.php?idFormMain=<?php echo $idForm; ?>'"><i class="fa fa-globe"></i> ตัวอย่างฟอร์มออนไลน์</button>
        <?php if($MenuSetting=="dataform"){ $menuKey="success";}else{$menuKey="default";}?>
        <button class='btn btn-<?php echo $menuKey;?>' id="department" onclick="location.href='table2.php?idFormMain=<?php echo $idForm; ?>'"><i class="fa fa-database"></i> ตารางข้อมูล</button>
    </span>
    <?php }?>
  </div><!-- /.info-box-content -->
</div><!-- /.info-box -->