<?php
session_start();
if(!isset($_SESSION["auth_uname"])){
?>
<script>location.href="../"</script>
<?php
}else{

include("creds.php");
include("stats.php");

error_reporting(E_ALL & ~E_NOTICE);

$ansToken=$_GET["ansToken"];
$qToken=$_GET["qToken"];
if(!isset($_GET["ansToken"])||!isset($_GET["qToken"])){
?>
<script>window.history.back();</script>
<?php
}else if(strpos($ansToken,"sha128")){
$aid="A".substr($ansToken,0,strpos($ansToken,"sha128"));
$qid="Q".substr($qToken,0,strpos($qToken,"sha256"));
$attachment=$_GET["attach"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta content="IE=Edge,chrome=1" http-equiv="X-UA-Compatible">
<meta charset="utf-8">
<title>QnA- Update Editor</title>
	<meta name="robot" content="no index, no follow"/>
	    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="author" content="abhi@tech">
    
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/skins.css">
	<link rel="stylesheet" href="css/responsive.css">
	<link rel="shortcut icon" href="images/favicon.png">
	<link rel="stylesheet" href="custom_style.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.js" ></script>

    <script src="wysihtml5/parser_rules/advanced.js" ></script>
    <script src="wysihtml5/dist/wysihtml5-0.3.0.js" ></script>
    <!--[if lt IE 9]>
      <script src='http://html5shiv.googlecode.com/svn/trunk/html5.js'></script>
    <![endif]-->
    
    <link rel="stylesheet" href="wysihtml5/css/reset-min.css">
    <link rel="stylesheet" href="wysihtml5/css/stylesheet.css">
	
  
	<style id="style-1-cropbar-clipper">
	/* Copyright 2014 Evernote Corporation. All rights reserved. */
    .en-markup-crop-options {
    top: 18px !important;
    left: 50% !important;
    margin-left: -100px !important;
    width: 200px !important;
    border: 2px rgba(255,255,255,.38) solid !important;
    border-radius: 4px !important;
    }

    .en-markup-crop-options div div:first-of-type {
    margin-left: 0px !important;
    }
	a {
    text-decoration: none;
}

a:hover {
    text-decoration: none;
}

a:focus {
    text-decoration: none;
}
</style>
    </head>
<body>
<script type="text/javascript">
$(document).ready(function(){
<?php 
	$con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
	$res=mysqli_query($con,"select answer,format from answer_table where aid='".$aid."';");
	$data=mysqli_fetch_array($res,MYSQLI_ASSOC);
	$temp=str_replace("'","&apos;",$data["answer"]);
	$temp=str_replace("\\","&#92;",$temp);
	//$temp=str_replace("/","&#47;",$temp);
	if($data["format"]=="t"){
	$temp=str_replace("<","&lt;",$temp);
    $temp=str_replace(">","&gt;",$temp);
    $temp=str_replace("\r\n","<br/>",$temp);
	//$temp=str_replace("\n","<br/>",$temp);
	}
echo 'document.getElementById("qnaEditor").value=\''.$temp.'\'';	
mysqli_close($con);
?>
});
</script>
<header id="header" style="background:#34dddd" class=""  >
<section class="container clearfix" align="center" >
<span class="qna-logo-big">Q</span>
<span class="qna-logo">n</span>
<span class="qna-logo-big">A</span>
<span class="qna-logo"> &lt;editor</span>
<span class="qna-logo">/&gt;</span>

</section> 
</header> 

<!-- qnaEditor -->
   <div class="row">
<div class="col-md-1"></div>
<div class="col-md-10">
     <div id="qnaEditor-toolbar" >
		<header class="wysihtml5-header">
        <ul class="commands">
          <li data-wysihtml5-command="bold" title="Make text bold (CTRL + B)" class="command"></li>
          <li data-wysihtml5-command="italic" title="Make text italic (CTRL + I)" class="command"></li>
          <li data-wysihtml5-command="insertUnorderedList" title="Insert an unordered list" class="command"></li>
          <li data-wysihtml5-command="insertOrderedList" title="Insert an ordered list" class="command"></li>
          <li data-wysihtml5-command="createLink" title="Insert a link" class="command"></li>
          <li data-wysihtml5-command="insertImage" title="Insert an image" class="command"></li>
          <li data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1" title="Insert headline 1" class="command"></li>
          <li data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2" title="Insert headline 2" class="command"></li>
          <li data-wysihtml5-command-group="foreColor" class="fore-color" title="Color the selected text" class="command">
            <ul>
              <li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="silver"></li>
              <li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="gray"></li>
              <li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="maroon"></li>
              <li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="red"></li>
              <li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="purple"></li>
              <li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="green"></li>
              <li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="olive"></li>
              <li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="navy"></li>
              <li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="blue"></li>
            </ul>
          </li>
		  <li data-wysihtml5-action="change_view" title="Show HTML" class="action"></li>
        </ul>
      </header>
	  <div class="row">
	  <div class="col-md-6" align="center">
      <div data-wysihtml5-dialog="createLink" style="display:none;">
        <label>
          Link:
          <input data-wysihtml5-dialog-field="href" value="http://">
        </label>
        <span data-wysihtml5-dialog-action="save">OK</span>&nbsp;<span data-wysihtml5-dialog-action="cancel">Cancel</span>
      </div>
		</div>
		<div class="col-md-6" style="float:right">
      <div data-wysihtml5-dialog="insertImage" style="display: none;">
        <label>
          Image:
          <input data-wysihtml5-dialog-field="src" value="http://">
        </label>
        <span data-wysihtml5-dialog-action="save">OK</span>&nbsp;<span data-wysihtml5-dialog-action="cancel">Cancel</span>
      </div>
	  </div></div>
	  
    </div></div><div class="col-md-1"></div></div>
    <div class="row">
	<div class="col-md-1"></div>
<div class="col-md-10">
    <section class="wysihtml5-section">
      <textarea class="wysihtml5-textarea" id="qnaEditor" spellcheck="false" wrap="on"  style="max-height:500px">
      </textarea>
    </section></div>
		<div class="col-md-1"></div>
	</div>

<!-- Form -->   
   <div class="row" style="margin-bottom:30px;margin-top:30px">
   <div class="col-md-1"></div>
   <div class="col-md-10">
   <div id="respond" class="comment-respond page-content clearfix" style="height:initial">
<form action="update_answer.php" method="post" enctype="multipart/form-data" id="pri_form1" class="comment-form">
<div id="respond-textarea" style="visibility:hidden;height:0px;width:0px;padding:0px;margin:0px" >
<textarea id="comment" name="comment" style="visibility:hidden;height:0px;width:0px;padding:0px;margin:0px"></textarea>
</div>
<div id="respond-textarea" class="clearfix">
<p>
<label>Attachment</label>
<?php if($attachment=='n'){
echo '<div class="fileinputs" style="width:100%">
<input type="file" class="file" accept="*" id="file_input1" name="attach_file">
<div class="fakefile">
<button type="button" id="attach_file1" class="button small margin_0">No file selected</button>
<span><i class="icon-arrow-up"></i>Browse</span>
</div>
<div style="margin-top:5px;float:left;color:#848991;font-size:12px">Select .pdf, .jpg, .png or .jpeg file of upto 3MB size.</div>
</div><div id="showAttachment"></div>';	
}else if(substr($attachment,0,12)=="ans_attach-a"){
echo '<div id="attachDiv"><span class="question-comment" title="1 Attachment"  style="padding:20px"><a href="attachments/'.$attachment.'" target="_blank" style="cursor:pointer"><i class="icon-paper-clip" ></i> Attachment</a> <a onclick="removeAttachment()"><i class="icon-remove" title="Remove" style="margin-left:20px;cursor:pointer"></i></a></span></div>';	
}
?>
<script type="text/javascript">
function removeAttachment(){
$("#attachDiv").replaceWith('<div class="fileinputs" style="width:100%"><input type="file" class="file" accept="*" id="file_input1" name="attach_file"><div class="fakefile"><button type="button" id="attach_file1" class="button small margin_0">No file selected</button><span><i class="icon-arrow-up"></i>Browse</span></div><div style="margin-top:5px;float:left;color:#848991;font-size:12px">Select .pdf, .jpg, .png or .jpeg file of upto 3MB size.</div></div><div id="attachDiv"></div><div id="showAttachment"></div>');
document.getElementById("postAttach").value="n";
$("#file_input1").change(function(){
    readURL(this);
});
}

function remove(){
	document.getElementById("file_input1").value="";
			  document.getElementById("attach_file1").innerHTML="No file selected";
			  document.getElementById("postAttach").value="n";
			 $("#showAttachment").html("");
}

function readURL(input){
    if (input.files && input.files[0]) {
		if(!hasExtension('file_input1', ['.jpg','.png','.jpeg','.JPEG','.JPG','.pdf'])){
				remove();
				$("#modal_title").html("FILE EXTENSION UNKNOWN");
			   $("#modal_content").html("<strong> Important! </strong>Please upload file of .pdf, .png, .jpg or .jpeg extensions.");
			   $("#show_alert").modal();
		}else{
		     if(input.files[0].size>3072000){
		     remove();
			 $("#modal_title").html("FILE SIZE EXCEEDED");
			 $("#modal_content").html("<strong> Important! </strong>File size is greater than 3MB.");
			 $("#show_alert").modal();
		}else{
        document.getElementById("attach_file1").innerHTML=input.files[0].name;
		document.getElementById("postAttach").value=input.files[0].name;
		$("#showAttachment").html('<span class="question-comment" title="1 Attachment"  style="padding:20px;padding-top:5px"><a><i class="icon-paper-clip" ></i> '+input.files[0].name+'</a><a onclick="remove()"><i class="icon-remove" title="Remove" style="margin-left:20px;cursor:pointer"></i></a></span>');
		}
	}
	}
}
function hasExtension(inputID, exts) {
    var fileName = document.getElementById(inputID).value;
    return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
}
$("#file_input1").change(function(){
    readURL(this);
});


</script>

</p>
</div>
<!--<input type="text" name="aid">-->

<p class="form-submit" style="height:36px">
<input name="" type="button" id="" value="Update your Answer" class="button small color" onclick="submitAns()">
</p>
<input type="hidden" name="single_ques_pri_id" value="<?php echo $qid;?>">
<input type="hidden" name="single_ques_pri_format" value="h">
<input type="hidden" name="aid" value="<?php echo $aid;?>">
<input type="hidden" name="oldAttachment" value="<?php echo $attachment;?>">
<input type="hidden" name="newAttachment" id="postAttach" value="<?php echo $attachment;?>">
</form>
<script>
function submitAns(){
		   var contents = document.getElementById("qnaEditor").value;
           //var iframe_contents = iframe1.contentWindow.document.body.innerHTML;
		    

	       document.getElementById("comment").value=contents;
	       //var para=document.getElementById("para");
		   //para.contentWindow.document.body.innerHTML=iframe_contents;

		   var answer = document.getElementById("comment").value;
			if(answer==""){
			$("#empty_alert").modal();
			}else{
			//console.log("Submit");
						document.getElementById("pri_form1").submit();
			}
		   }
		   </script>
<div>
</div>

</div>
</div>
<div class="col-md-1"></div>
</div>

<div id="show_alert" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal_title"></h4>
      </div>
      <div class="modal-body">
	 <div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-top:0px">
<span class="glyphicon glyphicon-remove-sign" aria-hidden="true" id="modal_content"></span> 
</div>
<div id="modal_extra" style="margin-left:15px;font-family:'Glyphicons Halflings'"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="empty_alert" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EMPTY FIELDS</h4>
      </div>
      <div class="modal-body">
	 <div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-top:0px">
<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span><strong> Important! </strong>Required fields are empty. 
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
		   <script>
		   		
     var editor = new wysihtml5.Editor("qnaEditor", {
		style:false,
        toolbar:     "qnaEditor-toolbar",
        stylesheets: ["wysihtml5/css/reset-min.css", "wysihtml5/css/editor.css"],
        parserRules: wysihtml5ParserRules
      });
      
      editor.on("load", function() {
        var composer = editor.composer,
            h1 = editor.composer.element.querySelector("h1");
        if (h1) {
          composer.selection.selectNode(h1);
        }
      });
	</script>
</body>
</html>
<?php
}
?>
