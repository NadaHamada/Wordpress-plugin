<?php

$status = '0';

if(isset($_POST['submit']))
{
  $status = $_POST['gee'];
  global $wpdb;
  $result = $wpdb->get_results ( "UPDATE orders SET approave=1 WHERE id= $status" );
  $mail=$wpdb->get_results ("SELECT `mail` FROM `orders` WHERE id= $status");
  wp_mail($mail[0]->mail, "Order Approaval" , "Yor order is approaved");
}
else if (isset($_POST['cancel'])) {
  $status = $_POST['gee'];
  global $wpdb;
  $mail=$wpdb->get_results ("SELECT `mail` FROM `orders` WHERE id= $status");
  wp_mail($mail[0]->mail, "Order Cancelation" , "Yor order is canceled");
  $result = $wpdb->get_results ( "DELETE FROM `orders` WHERE id= $status" );
}
else if(isset($_POST['send'])){
  $to = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];
  wp_mail($to, $subject ,$message);
}
else if(isset($_POST['show_btn'])){ 
  $order_id = $_POST['show_pop'];
  global $wpdb;
  $top_id=$wpdb->get_results ("SELECT `top_id` FROM `orders` WHERE id= $order_id")[0]->top_id;
  $top_name=$wpdb->get_results ("SELECT `template_path` FROM `add_top` WHERE img_id= '$top_id'")[0]->template_path;
  $bot_id=$wpdb->get_results ("SELECT `bottom_id` FROM `orders` WHERE id= $order_id")[0]->bottom_id;
  $bot_name=$wpdb->get_results ("SELECT `template_path` FROM `add_bottom` WHERE img_id= '$bot_id'")[0]->template_path;
  $upload_dir = wp_upload_dir();
  $img_top_url = $upload_dir["baseurl"]."/owndesign/".$top_name;
  $img_bot_url = $upload_dir["baseurl"]."/owndesign/".$bot_name;
  echo "<div class='overlay'>
          <div class='con'>
            <span class='modalClose'>&times;</span>
            <img class='tempModel' src='$img_top_url'/>
            <img class='tempModel' src='$img_bot_url'/>
          </div>
        </div>" ;
    }
?>



<!DOCTYPE html>
<html lang="fa" dir="rtl">
  <head>
    <meta charset="utf-8">
    <title> Orders </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="sample.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="sample.js"></script>
  </head>

  <body>

    <div class="container">

<div id="all">
        <table class="data-table">
        <caption class="title">الطلبات</caption>
        <thead>
          <tr>
            <th>التسلسل</th>
            <th>اسم المستخدم</th>
            <th>رقم التليفون</th>
            <th>البريد الالكتروني</th>
            <th>الطلبات</th>
            <th>الحالة</th>
          </tr>
        </thead>
        <tbody>
           <?php
              global $wpdb;
              $result = $wpdb->get_results ( "SELECT * FROM orders WHERE approave=0" );
              foreach ( $result as $print )   {
              ?>
              <tr>
                <td><?php echo $print->id;?></td>
                <td><?php echo $print->user_name;?></td>
                <td><?php echo $print->num;?></td>
                <td><a class="myBtn clickable"><?php echo $print->mail;?></a></td>
                <td>
                  <form action="#" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="show_pop" value="<?php echo $print->id;?>">
                    <input type="submit" name="show_btn" value="عرض الطلب">
                  </form>
                </td>
                <td>
                <form action="#" enctype="multipart/form-data" method="POST">
                <input class="btn btn-default" type="submit" name="submit" value="تأكيد الطلب" />
                <input type="hidden" name="gee" value="<?php echo $print->id;?>">
                <input class="btn btn-default" type="submit" name="cancel" value="إلغاء الطلب" />
                <input type="hidden" name="gee" value="<?php echo $print->id;?>">
                </form>
                </td>
              </tr>
                  <?php } ?>
                  <!-- The Modal -->
              <div id="myModal1" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                  <span class="close">&times;</span>
                     <form method="POST" action="#">
                       <div class="form-group">
                          <label for="email">إلي<red>*</red></label>
                          <input type="email" class="form-control" name="email" id="email" placeholder="Email" required="yes">
                        </div>
                        <div class="form-group">
                          <label for="subject">العنوان<red>*</red></label>
                          <input type="text" class="form-control" name="subject" id="subject" placeholder="عنوان الرسالة" required="yes">
                        </div>
                        <div class="form-group">
                          <label for="message">الرسالة<red>*</red></label>
                          <textarea class="form-control" name="message" id="message" placeholder="نص الرسالة" required="yes"></textarea>
                        </div>
                        <input class="btn btn-success" id="send" type="submit" name="send" value="إرسال" />
                      </form>
                </div>
              </div>
              
          
                    </div>
        </tbody>
      </table>
      </div>
  </body>
</html>