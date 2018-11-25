<?php  
/*
Template Name:Plugin Test
*/
/**
 *  Oxygen WordPress Theme
 *  
 *  Laborator.co
 *  www.laborator.co 
 */
defined( 'ABSPATH' ) || exit;
if (!is_user_logged_in()) {
  ?>
  <script type="text/javascript">
      document.location.href="http://arosaa.com/my-account/";
    </script>
  <?php
}
// Header
get_header();

if (isset( $_POST['send'])) {

      global $wpdb;
      global $current_user;
      wp_get_current_user();
      $user_name = $current_user->user_login;
      $mail = $current_user->user_email;
      $top = $_POST['top_id'];
      $bottom = $_POST['bot_id'];
      $data=array(
          'user_name' => $user_name,
          'mail' => $mail, 
          'top_id' => $top,
          'bottom_id' => $bottom
          );
      $wpdb->insert( 'orders', $data); ?>
       <script type="text/javascript">
      document.location.href="http://arosaa.com/own-design/";
    </script>
<?php
 }
?>
 <style>

.card {
    width: 300px;
    height: 70vh;
    margin: 20px;
    background-color: white;
    box-shadow: 0px 5px 20px #555;
}
.card-title {
    font-size: 21px;
    background-color: white;
    font-family: "DroidArabicKufiRegular", Helvetica, Arial, sans-serif;
    text-align: center;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
}
.dresscard{
    margin: auto;
    overflow: auto;
    width: auto;
    height: 70vh;
    margin-top: 20px;
    padding-left: 50px;
    box-shadow: 0px 0px 0px;

}
.tog{
    display: none;
}
.topimg , .bottomimg{
    width: 100px;
    height:90px;
    margin-top: 10px;
    object-fit: cover;
}
button{
    font-size: 16px;
    margin: auto;
    border: none;
    width: 150px;
    color: #222222;;
    background-color: white;
    font-family: "DroidArabicKufiRegular", Helvetica, Arial, sans-serif;

}
button:hover{
   background-color: #B0976E; 
}
.caret{
    float: left;
    margin-top: 8px;
}

/*controls dressing , undressing*/
.intop{
    position: absolute;
    left: 70px;
    top :130px;
}
.inbot{
    position: absolute;
    top: 221px;
    left: 70px;
}
.remove{
    display: none;
}
red{
    color: red;
}
#selected{
    height: 50vh;
}


 </style>
  <div class="container-fluid">
    <div class="row" id="cont">
      <div class="col-sm-4">

        <button class="btn" id="btn-top" onclick="togBtn(this)">جزء علوي&nbsp;<b class="caret"></b></button>

        <div class="row card dresscard tog" id="top">
           
            <?php
                    $results = $wpdb->get_results( "SELECT template_path FROM add_top");
                    if(!empty($results)) {
                        foreach($results as $row){
                            $upload_dir = wp_upload_dir();?>
                            <img class="topimg" onclick="moveButton(this)" src="<?php echo $upload_dir['baseurl'] . '/' . $row->template_path; ?>" />
                            <?php
                        }
                    }

            ?>
        </div>
      </div>
      <div class="col-sm-4 card">
        <h1 class="card-title">المودل</h1>
        <div class="form-group" id="selected">

        </div>
                  <form action="#" method="POST">
            <input type="hidden" id="forTop" name="top_id">
            <input type="hidden" id="forBottom" name="bot_id">
                <input class="btn btn-success" style="background-color: #B0976E;" id="send" type="submit" name="send" value="أرسل الطلب" />
          </form>
      </div>
      <div class="col-sm-4">
      <button class="btn" id="btn-bot" onclick="togBtn(this)"><b class="caret"></b>&nbsp;جزء سفلي</button>
       <div class="row card dresscard tog" id="bottom">
           
            <?php
                    $results = $wpdb->get_results( "SELECT template_path FROM add_bottom");
                    if(!empty($results)) {
                        foreach($results as $row){
                            $upload_dir = wp_upload_dir();?>
                            <img class="bottomimg" onclick="moveButton(this)" src="<?php echo $upload_dir['baseurl'] . '/' . $row->template_path; ?>" />
                            <?php
                        }
                    }

            ?>
        </div>
      </div>
      </div>
    </div>

   <!-- Footer -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
  function togBtn(e){
    if($(e).attr("id") == "btn-top"){
        $("#top").toggle().removeClass("tog");
      }
    else if($(e).attr("id") == "btn-cr"){
        $("#crafts").toggle().removeClass("tog");
      }
    else {
        $("#bottom").toggle().removeClass("tog");
    }
    };

function moveButton(elem){
    if( $(elem).parent().attr("id") == "top" ){
        $( ".topimg.intop" ).appendTo('#top').removeClass("intop");
        $(elem).detach().appendTo('#selected').addClass("intop");
        var src_array = $(elem).attr('src').split("/");
        var img_name_array = src_array[src_array.length-1].split(".");
        var img_id = img_name_array[0];
        $("#forTop").prop("value",img_id);
    }
    else if( $(elem).parent().attr("id") == "bottom" ){
        $( ".bottomimg.inbot" ).appendTo('#bottom').removeClass("inbot");
        $(elem).detach().appendTo('#selected').addClass("inbot");
        var src_array = $(elem).attr('src').split("/");
        var img_name_array = src_array[src_array.length-1].split(".");
        var img_id = img_name_array[0];
        $("#forBottom").prop("value",img_id);
    }
    else{ 
        if( $(elem).hasClass("topimg")){
          $(elem).detach().appendTo('#top').removeClass("intop");
    }
        else {
          $(elem).detach().appendTo('#bottom').removeClass("inbot");
        }
    }
}
</script>
<?php get_footer(); ?>