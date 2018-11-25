<?php
  
    if (isset( $_POST['add'] ) && empty($_POST['category'])) {
      echo "<div class='alert alert-danger' id='alert'><strong>Hey! </strong> Please Select Category</div>";
    }
    elseif (isset( $_POST['add'] ) && empty($_FILES['fileToUpload']['tmp_name'])) {
      echo "<div class='alert alert-danger' id='alert'><strong>Hey! </strong> Please Select Image</div>";
    }
   else if (isset( $_POST['add'] ) && ! empty($_POST['category']) ){

      global $wpdb;

      global $current_user;
      wp_get_current_user();
      $admin_name = $current_user->user_login;
      $date = date('l jS F Y');
      $category=$_POST['category'];
      //inserting multiple tables
      if ($category=='top') {
      $last = $wpdb->get_row("SHOW TABLE STATUS LIKE 'add_top'");
      $id = $last->Auto_increment;
      $img_name=$_FILES['fileToUpload']['name'];
      $ext = pathinfo($img_name, PATHINFO_EXTENSION);
      $img_new_name=$_POST['category'] . $id . "." . $ext;
      $img_tmp_name = $_FILES['fileToUpload']['tmp_name'];
      $img_id=$_POST['category'] . $id ;
      //works for server
      // $upload_dir = wp_upload_dir();
      // $img_folder=$upload_dir['baseurl'] . '/owndesign/';
      $img_folder='/var/www/html/wordpress/wp-content/uploads/owndesign/';
      $img_path= $img_folder.$img_new_name;
      move_uploaded_file($img_tmp_name, $img_folder . $img_new_name);
      $data=array(
          'img_id' => $img_id, 
          'template_path' => $img_new_name,
          'admin_name' => $admin_name, 
          'date' => $date
          );
      
        $wpdb->insert( 'add_top', $data);
      }
      //edit table name
      elseif ($category=='bottom') {
      $last = $wpdb->get_row("SHOW TABLE STATUS LIKE 'add_bottom'");
      $id = $last->Auto_increment;
      $img_name=$_FILES['fileToUpload']['name'];
      $ext = pathinfo($img_name, PATHINFO_EXTENSION);
      $img_new_name=$_POST['category'] . $id . "." . $ext;
      $img_tmp_name = $_FILES['fileToUpload']['tmp_name'];
      $img_id=$_POST['category'] . $id ;
      //works for server
      // $upload_dir = wp_upload_dir();
      // $img_folder=$upload_dir['baseurl'] . '/owndesign/';
      $img_folder='/var/www/html/wordpress/wp-content/uploads/owndesign/';
      $img_path= $img_folder.$img_new_name;
      move_uploaded_file($img_tmp_name, $img_folder . $img_new_name);
      $data=array(
          'img_id' => $img_id, 
          'template_path' => $img_new_name,
          'admin_name' => $admin_name, 
          'date' => $date,
          );
        $wpdb->insert( 'add_bottom', $data);
      }
      elseif($category=='craft') {
      $last = $wpdb->get_row("SHOW TABLE STATUS LIKE 'add_craft'");
      $id = $last->Auto_increment;
      $img_name=$_FILES['fileToUpload']['name'];
      $ext = pathinfo($img_name, PATHINFO_EXTENSION);
      $img_new_name=$_POST['category'] . $id . "." . $ext;
      $img_tmp_name = $_FILES['fileToUpload']['tmp_name'];
      $img_id=$_POST['category'] . $id ;
      //works for server
      // $upload_dir = wp_upload_dir();
      // $img_folder=$upload_dir['baseurl'] . '/owndesign/';
      $img_folder='/var/www/html/wordpress/wp-content/uploads/owndesign/';
      $img_path= $img_folder.$img_new_name;
      move_uploaded_file($img_tmp_name, $img_folder . $img_new_name);
      $data=array(
          'img_id' => $img_id, 
          'template_path' => $img_new_name,
          'admin_name' => $admin_name, 
          'date' => $date,
          );
        $wpdb->insert( 'add_craft', $data);
      }
    

 }

?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>Add Template</title>
  <link rel="stylesheet" href="sample.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="sample.js"></script>
</head>
<body>
  <div class="container-default">
  	<h1 id="header"> أضف قالب</h1>
  	<div class="row">
  		
  		<div class="col-sm-6">
    			<a href="#" class="btn btn-default" id="list">عرض القوالب</a>
		</div>
		<div class="col-sm-6">
			<div>
				<button class="btn btn-success" id="add_new">إضافة قالب جديد</button>
			</div>
		</div>
  	</div>
  	<div class="row element">
  		<!-- tables code -->
  		<div id="all">
  			<table class="data-table">
				<caption class="title">جزء علوي</caption>
				<thead>
          <tr>
            <th>كود الصورة</th>
            <th>القالب</th>
            <th>اﻷدمن</th>
            <th>تاريخ الرفع</th>
          </tr>
				</thead>
				<tbody>
				   <?php
              global $wpdb;
              $result = $wpdb->get_results ( "SELECT * FROM add_top" );
              if (empty($result)){
                echo "<div class='alert alert-danger' id='alert'><strong>Add New Templates! </strong> No Tops to display</div>";
              }
              else{
              foreach ( $result as $print )   {
              ?>
              <tr>
              <td><?php echo $print->img_id;?></td>
                  <?php $upload_dir = wp_upload_dir();?>
              <td><img class="temp" src="<?php echo $upload_dir['baseurl'] . '/owndesign/' . $print->template_path; ?>" /></td>
              <td><?php echo $print->admin_name;?></td>
              <td><?php echo $print->date;?></td>
              </tr>
                  <?php }} ?>
				</tbody>
			</table>
  		</div>
  	</div>
    <div class="row element">
      <!-- tables code -->
      <div id="all">
        <table class="data-table">
        <caption class="title">جزء سفلي</caption>
        <thead>
          <tr>
            <th>كود الصورة</th>
            <th>القالب</th>
            <th>اﻷدمن</th>
            <th>تاريخ الرفع</th>
          </tr>
        </thead>
        <tbody>
           <?php
              global $wpdb;
              $result = $wpdb->get_results ( "SELECT * FROM add_bottom" );
              if (empty($result)){
                echo "<div class='alert alert-danger' id='alert'><strong>Add New Templates! </strong> No bottoms to display</div>";
              }
              else{
              foreach ( $result as $print )   {
              ?>
              <tr>
              <td><?php echo $print->img_id;?></td>
                  <?php $upload_dir = wp_upload_dir();?>
              <td><img class="temp" src="<?php echo $upload_dir['baseurl'] . '/owndesign/' . $print->template_path; ?>" /></td>
              <td><?php echo $print->admin_name;?></td>
              <td><?php echo $print->date;?></td>
              </tr>
                  <?php }} ?>
        </tbody>
      </table>
      </div>
    </div>
    <div class="row element">
      <!-- tables code -->
      <div id="all">
        <table class="data-table">
        <caption class="title">أخري</caption>
        <thead>
          <tr>
            <th>كود الصورة</th>
            <th>القالب</th>
            <th>اﻷدمن</th>
            <th>تاريخ الرفع</th>
          </tr>
        </thead>
        <tbody>
           <?php
              global $wpdb;
              $result = $wpdb->get_results ( "SELECT * FROM add_craft" );
              if (empty($result)){
                echo "<div class='alert alert-danger' id='alert'><strong>Add New Templates! </strong> No crafts to display</div>";
              }
              else{
              foreach ( $result as $print )   {
              ?>
              <tr>
              <td><?php echo $print->img_id;?></td>
                  <?php $upload_dir = wp_upload_dir();?>
              <td><img class="temp" src="<?php echo $upload_dir['baseurl'] . '/owndesign/' . $print->template_path; ?>" /></td>
              <td><?php echo $print->admin_name;?></td>
              <td><?php echo $print->date;?></td>
              </tr>
                  <?php }} ?>
        </tbody>
      </table>
      </div>
    </div>
  	<div class="row" id="form">
  		<!-- adding category -->
  		 <form method="POST" action="#" enctype="multipart/form-data">
  		 <div class="form-group">
        <label for="category" class="control-label" >اختر التصنيف</label>
        <br><br>
  		 	  <div class="radio-inline">
                  <label class="radio-inline"><input name = "category" type="radio" value="top"/>جزء علوي</label>
                  <label class="radio-inline"><input  name = "category" type="radio" value="bottom"/>جزء سفلي</label>
                  <label class="radio-inline"><input  name = "category" type="radio" value="craft"/>أخري</label>
                  <br><br>
          </div>
  		 </div>
  		 <div class="form-group">
  		 	<label for="fileToUpload" name="upload" class="control-label" >رفع قالب</label>
        <br>
  		 	<input type="file" accept="image/png, image/jpg, image/jpeg, image/gif" name="fileToUpload" id="fileToUpload">
  		 </div>
  		 <input type="submit" name="add" value="رفع" id="add" class="btn btn-info">

  	</div>
  </div>
</body>
</html>