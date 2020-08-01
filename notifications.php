<?php
session_start();
include_once("site-settings.php");

//reading blocked ips
$isblocked=mysql_num_rows(mysql_query("SELECT * FROM `blockedips` WHERE ip='$ip'"));
if($isblocked>0){header("location:error.php");}

//checking whether loggedin or not
$isloggedin=false;
$stuid="";
if(isloggedin())
{
$stuid=trim($_SESSION['stuid']);
$isloggedin=true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $title;?></title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="Cygnus_files/style.css" rel="stylesheet">
    <link href="Cygnus_files/soon.min.css" rel="stylesheet"> 
    <link href="Cygnus_files/vscroller.css" rel="stylesheet"> 

</head>
  <body cz-shortcut-listen="true">
    <div class="wrapper-line">
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
    </div>
    <div class="object-left">
      <ul class="list-inline" style="text-transform: lowercase;font-size: 13px;">
        <li>Phone : <?php echo $contact_dis;?></li>
        <li>Email : <a href="mailto:<?php echo $email_dis;?>"><?php echo $email_dis;?></a></li>
        <li>Website : <a href="https://<?php echo $web_dis;?>"><?php echo $web_dis;?></a></li>
      </ul>
    </div>
    <div class="object-right">
      <ul class="list-inline">
        <li><a href="index.php">SmartQuint</a></li>
      </ul>
    </div>
    <?php
    $today=date('m-d-Y');
    $w=mysql_query("SELECT * FROM notifications where added_date='$today' and visibility=1");
    $count=mysql_num_rows($w);
    ?>
    <nav class="wrapper-nav wow slideInDown" style="visibility: visible; animation-name: slideInDown;">
      <div class="container">
        <div class="nav-primary"><a class="logo" href="index.php" title="<?php echo $title;?>"><img src="Cygnus_files/logo.png" alt="<?php echo $title;?>"></a>
          <ul class="list-inline nav-desktop">
            <li><a href="index.php" title="Homepage">Home</a></li>
            <li><a href="about.php" title="About">About</a></li>
            <li><a href="index.php#events" title="Events">Events</a></li>
            <li><a href="gallery.php" title="Gallery">Gallery</a></li>
            <li class="active"><a href="notifications.php" title="Notifications">Notifications <?php if($count>0){?><span class="badge badge-warning"><?php echo $count; }else{ ?><?php }?></span></a></li>
            <li><a href="team.php" title="Team">Team</a></li>
            <li><a href="contact.php" title="Contact">Contact</a></li>
          </ul>
         <?php if(!isloggedin()){
          ?>
          <a class="btn btn-primary btn-contact" href="reglogin.php" title="Register / Login" style="margin-left:10px;">Register / Login</a>
          <?php } else { ?>
          <a class="btn btn-primary btn-contact" href="profile.php" title="Profile/Logout" style="margin-left:10px;">Profile/Logout</a>
          <?php } ?>
          <span class="btn btn-primary menu">Menu</span>
          <ul class="nav-responsive">
            <li class="nav-close"><i class="fa fa-times"></i>Close Menu</li>
            <li><a href="index.php" title="Homepage">Home</a></li>
            <li><a href="about.php" title="About">About</a></li>
            <li><a href="index.php#events" title="Events">Events</a></li>
            <li><a href="gallery.php" title="Gallery">Gallery</a></li>
            <li class="active"><a href="notifications.php" title="Notifications">Notifications <span class="badge badge-warning"><?php echo $count ?></span></a></li>
            <li><a href="team.php" title="Team">Team</a></li>
            <li><a href="contact.php" title="Contact">Contact</a></li>
           <?php if(!isloggedin()){
          ?> <li><a href="reglogin.php" title="Register / Login">Register / Login</a></li>
           <?php } else { ?>
          <li><a href="profile.php" title="Profile/Logout">Profile/Logout</a></li>
          <?php } ?>
          </ul>
        </div>
      </div>
    </nav>
    <section class="wrapper-hero" id="hero">

      <div class="container">
        <div class="row">
        <span class="text-box wow slideInDown" style="z-index:-1;font-size:18px;margin-top:8%;margin-left:35%;color: khaki;font-family:'hk_grotesk';visibility: visible; animation-name: slideInDown;">Cygnus2K18 Notifications</span>
</div>


          <div class="col-md-12">
            <div class="text-box wow slideInLeft" style="margin-top:13%;visibility: visible; animation-name: slideInLeft;">
              <table class="table table-bordered" style="color:#000;background-color: #fff;">
    <thead>
      <tr>
        <th style="width:10%;">Sno</th>
        <th style="width:70%;">Title</th>
        <th style="width:15%;">Posted</th>
        <th style="width:5%;">Visits</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $qu=mysql_query("SELECT * FROM notifications WHERE visibility='1' ORDER BY nid DESC");
    while ($quf=mysql_fetch_array($qu)) {
      ?>
      <tr>
        <td><?php echo $quf['nid'];?></td>
        <td><div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" href="#collapse<?php echo $quf['nid'];?>" onclick=updatecount("<?php echo $quf['nid'];?>")><?php echo $quf['title'];?>
          <?php
          $today=date('m-d-Y');
          $not=$quf['added_date'];
          if($not==$today){
            echo'<img src="Cygnus_files/new1.gif" style="width:50px;height:30px;">' ;
          }
          ?>
           
        </a>
      </h4>
    </div>
    <div id="collapse<?php echo $quf['nid'];?>" class="panel-collapse collapse">
      <div class="panel-body"><?php echo $quf['description'];?><br>
      <?php echo $quf['attachments'];?>
      </div>
      <div class="panel-footer">sd/-<br><?php echo $quf['sd'];?></div>
    </div>
  </div>
</div></td>
        <td><?php echo $quf['time'];?></td>
        <td><?php echo $quf['views'];?></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
          </div>

        </div>
      </div>


    </section>
   
   
    <footer class="wrapper-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-5">
            <ul class="social list-inline">
                <li><a href="https://www.facebook.com/CygnusRGUKTN/" target="_blank" title="facebook"><img src="img/fb.png" width="20px"><span>/CygnusRGUKTN</span></a></li><li><a href="https://www.twitter.com/CygnusRGUKTN/" target="_blank" title="twitter"><img src="img/twitter.png" width="20px"><span>/CygnusRGUKTN</span></a></li>
            </ul>
          </div>
          <div class="col-md-2">
            <p class="copyright">© Copyright 2018</p>
          </div>
          <div class="col-md-5">
            <ul class="contact list-inline">
              <li>Phone <?php echo $contact_dis;?></li>
              <li><a href="mailto:<?php echo $email_dis;?>"><?php echo $email_dis;?></a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    <div class="cd-cover-layer"></div>
    <div class="cd-loading-bar"></div>
    
    <script src="Cygnus_files/jquery.min.js"></script>
    <script src="Cygnus_files/bootstrap.min.js"></script>
    <script src="Cygnus_files/jquery.matchHeight-min.js"></script>
    <script src="Cygnus_files/owl.carousel.min.js"></script>
    <script src="Cygnus_files/wow.min.js"></script>
    <script src="Cygnus_files/sketch.min.js"></script>
    <script src="Cygnus_files/jquery.easing.1.3.js"></script>
    <script src="Cygnus_files/jquery.parallax-scroll.js"></script>
    <script src="Cygnus_files/jquery.gradient.text.js"></script>
    <script src="Cygnus_files/soon.min.js"></script>
    <script src="Cygnus_files/vscroller.js"></script>
    <script src="Cygnus_files/custom.js"></script>
    <script src="Cygnus_files/script.js"></script>
</body></html>