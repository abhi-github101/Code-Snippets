<?php
session_start();
if(isset($_SESSION["auth_uname"])){
?>
<script>location.href="template/home.php"</script>
<?php
}else{
	
$rel_url="template/";
include($rel_url."creds.php");
error_reporting(E_ALL & ~E_NOTICE);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 
<meta charset="utf-8"/>
<title><?php echo $site_title;?></title>
<meta name="description" content="<?php echo $site_desc;?>">

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<meta name="author" content="abhi@tech">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" href="<?php echo $rel_url; ?>css/style.css">
<link rel="stylesheet" href="<?php echo $rel_url; ?>style.css">
<link rel="stylesheet" href="<?php echo $rel_url; ?>css/skins.css">
<link rel="stylesheet" href="<?php echo $rel_url; ?>css/responsive.css">
<link rel="stylesheet" href="<?php echo $rel_url; ?>custom_style.css">
<link rel="shortcut icon" href="<?php echo $rel_url; ?>images/favicon.png">
<script src="<?php echo $rel_url; ?>js/jquery.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.min.js"></script>
<script src="<?php echo $rel_url; ?>bootstrap/js/bootstrap.js"></script> 

<!--Pre Color:#ff7361-->
<style>
a {
    text-decoration: none;
}

a:hover {
    text-decoration: none;
}

a:focus {
    text-decoration: none;
}
.none{

}

#singleQuesTitle{
background:transparent;
color:black;
padding:0px;
font-size:20px;}

#singleQuesTitle:hover{
color:#34dddd;
}

#singleQuesTitle:focus{
color:#34dddd;
}


</style>
<script>
</script>
</head>

<body>
<div class="loader"><div class="loader_html"></div></div>
<div id="wrap" class="grid_1200">
<!-------------------------------   Header       -------------------------------------->
<header id="header" style="background:#34dddd" class=""  >
<section class="container clearfix" >
<a  href="">
<span class="qna-logo-big" style="">Q</span>
<span class="qna-logo">n</span>
<span class="qna-logo-big">A</span>
</a>
<div class="logo">
</div>
</section> 
</header> 

<!------------------------------------- Login Panel     ------------------------------------->
<div  style="background-color:#f3f3f3;margin-top:80px;margin-bottom:165px">
<section class="container">
<div class="row" >
<div class="col-md-3"></div>
<div class="col-md-6">
<div class="page-content">
<h2 >Login</h2>
<div class="form-style form-style-3">
<form id="login_form" action="<?php echo $rel_url; ?>validate.php" method="POST">
<div class="form-inputs clearfix">
<p class="login-text">
<input name="uname" id="uname" type="text" value="abhi" onfocus="if (this.value == 'Username') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Username';}">
<i class="icon-user"></i>
</p>
<p class="login-password">
<input name="pswd" id="uname" type="password" value="Password" onfocus="if (this.value == 'Password') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Password';}">
<i class="icon-lock"></i>
</p>
</div>
<p class="form-submit login-submit">
<input type="submit" value="Log in" class="button color small login-submit submit" >
</p>
</form>
</div>
</div> 
</div>
  <div class="col-md-3"></div>
</div>
</section>
</div> 
</div>
 
<footer id="footer-bottom" style="background-color:#ff7361">
<section class="container" >
<div class="copyrights f_left" style="color:#fff">Developed By Abhijeet Singh</div> 
<div class="copyrights f_right" style="color:#fff">Copyright &#169 2018 QnA</div>
</section> 
</footer>  

<script src="<?php echo $rel_url; ?>js/tabs.js"></script>
<script src="<?php echo $rel_url; ?>js/custom.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.easing.1.3.min.js"></script>
<script src="<?php echo $rel_url; ?>js/html5.js"></script>
<script src="<?php echo $rel_url; ?>js/twitter/jquery.tweet.js"></script>
<script src="<?php echo $rel_url; ?>js/jflickrfeed.min.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.inview.min.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.tipsy.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.flexslider.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.prettyPhoto.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.carouFredSel-6.2.1-packed.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.scrollTo.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.nav.js"></script>
<script src="<?php echo $rel_url; ?>js/tags.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.bxslider.min.js"></script>
<script>
$(function(){$('[data-toggle="popover"]').popover()})
</script>

</body>
</html>