<?php
error_reporting(0);
session_start();

include("admin/connection.php");
?>
<?php
$catgid = 0;
$scatgid = 0;
$bid = 0;

if(isset($_REQUEST["bid"]))
{
    $bid = (int) $_REQUEST["bid"];
}

if(isset($_POST['getbanner']))
{
    $_SESSION['Cid'] = 0;
    $_SESSION['Sid'] = 0;
    $catgid = (int) $_POST['catgid'] ;
    $scatgid = (int) $_POST['scatgid'] ;

    $banner_top = '';
    $msg['status'] = false;
    $msg['banner_top'] = '';
    $sql1 = "select * from dubaiexpo_banner_category_link ";
    $sql1 .= " where catgid=$catgid and scatgid=$scatgid";
    //echo $sql1;
    $msg['banner_top_link'] = '#';
    $msg['sppt_link'] = '#';
    $msg['rppt_link'] = '#';
    $msg['mppt_link'] = '#';
    $result1=mysql_query($sql1);

    while($row1 = mysql_fetch_array($result1))
    {
        $msg['banner_top_link'] = $row1['tppt'];
        $msg['sppt_link'] = $row1['sppt'];
        $msg['rppt_link'] = $row1['rppt'];
        $msg['mppt_link'] = $row1['mppt'];
    }

    $sql1 = "select * from dubaiexpo_banner_category ";
    $sql1 .= " where catgid=$catgid and scatgid=$scatgid";
    //echo $sql1;

    $result1=mysql_query($sql1);

    while($row1 = mysql_fetch_array($result1))
    {
        $msg['banner_top'] = $row1['tppt'];
        $msg['sppt'] = $row1['sppt'];
        $msg['rppt'] = $row1['rppt'];
        $msg['mppt'] = $row1['mppt'];
        $msg['status'] = true;
        $_SESSION['Cid'] = $catgid;
        $_SESSION['Sid'] = $scatgid;
    }
    echo json_encode($msg);
    return;
}

if(isset($_POST['enqdt']))
{
    $enqdtl=$_POST['enqu'];


    $sql2="INSERT INTO `dubaiexpo_enquiry` (`enquiryid`,`enquirycom`) VALUES (NULL,'".$enqdtl."')";
    $res2=mysql_query($sql2);



    ?>
    <script type="text/javascript">
        alert("Submitted Successfully");
        window.location.href = 'enquiry.php';
    </script>
    <?php

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"    content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author"      content="">

    <title>Enquire | The Dubai Expo 2020</title>
    <link rel="stylesheet" href="css/style1.css">
    <link rel="shortcut icon" href="assets/images/gt_favicon.png">

    <link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- Custom styles for our template -->
    <link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
    <link rel="stylesheet" href="assets/css/main.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>
<script>
    var bCid = 0;
    var bSid = 0;
    <?php
    if (isset($_SESSION['Cid']))
    {
        echo 'bCid = ' . $_SESSION['Cid'] . ';';
        echo 'bSid = ' . $_SESSION['Sid'] . ';';
    }
    ?>
</script>

<style>


    .my_pagination{
        border: 1px solid #000099;
        padding: 0px 5px 0px 5px;
        text-decoration: none;
        margin-right:5px;
        margin-left:5px;
        color:red;


    }

    .my_pagination a {
        text-decoration: none;
        color: blue;

    }

    .my_pagination a:hover {
        text-decoration: none;
        color: green;

    }


</style>
<style>

    a {
        color: #333;
        text-decoration: none;
    }


    a:hover {
        color: #333;
        text-decoration: none;
    }


</style>

<script>
    function load(str)
    {

        var xmlhttp;
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {

            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("subcatid1").innerHTML =xmlhttp.responseText;
                var catgid = $("#catgid").val();
                var scatgid = $("#subcatid").val();
                updateBanner(catgid, scatgid);

                $("#subcatid").change(function () {
                    var scatgid = this.value;
                    var catgid = $("#catgid").val();
                    updateBanner(catgid, scatgid);
                });


            }
        };
        xmlhttp.open("GET","subcat_info.php?str="+str,true);
        xmlhttp.send();
    }
</script>

<script language="Javascript">
    function validate()
    {
        if(document.form2.catgid.selectedIndex=="")
        {
            alert ( "Please select a  category");
            return false;
        }
        var sel = document.getElementById(catgid);
//get the selected option
        var selectedText = sel.options[sel.selectedIndex].text;

        return true;
    }

</script>
<style>

    div#collapse{
        display:none;
    }
</style>
<!--[if !IE]><!-->
<style>

    /*
    Max width before this PARTICULAR table gets nasty
    This query will take effect for any screen smaller than 760px
    and also iPads specifically.
    */
    @media
    only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px)  {

        /* Force table to not be like tables anymore */
        table, thead, tbody, th, td, tr {
            display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr { border: 1px solid #ccc; }

        td {
            /* Behave  like a "row" */

            border-bottom: 1px solid #eee;
            position: relative;
            padding-left:30%;

        }

        td:before {
            /* Now like a table header */
            position: absolute;
            /* Top/left values mimic padding */
            top: 6px;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
        }

        /*
        Label the data
        */
        td:nth-of-type(1):before { content: "Logo"; }
        td:nth-of-type(2):before { content: "Company"; }
        td:nth-of-type(3):before { content: "Website"; }
        td:nth-of-type(4):before { content: "Contact"; }
        td:nth-of-type(5):before { content: "Email"; }
        td:nth-of-type(6):before { content: "Description"; }

    }

    /* Smartphones (portrait and landscape) ----------- */
    @media only screen
    and (min-device-width : 320px)
    and (max-device-width : 480px) {
        body {
            padding: 0;
            margin: 0;
            width: 320px; }
    }

    /* iPads (portrait and landscape) ----------- */
    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
        body {
            width: 495px;
        }
    }
    .sidebar{
        position: absolute;
        top: 315px;
        right: -15px;
        width: 320px;
    }
</style>
<!--<![endif]-->
<script>
    function showDiv(elem)
    {
        //alert(elem);
        if(elem.value == 2)
        {
            document.getElementById('collapse').style.display = "block";
            document.getElementById('expand').style.display = "none";
        }
        else
        {
            document.getElementById('collapse').style.display = "none";
            //document.getElementById('expand').style.display = "block";
        }

    }
</script>
<style type="text/css" style="display: none !important;">
    * {
    margin: 0;
    padding: 0;
    }
    body {
    overflow-x: hidden;
    }



</style>


<body>
<?php
    include 'header.php';
?>


<!-- container -->
<div class="container">

<ol class="breadcrumb">
<li><a href="index.php">Home</a></li>
                                  <li class="active">Enquire</li>
                                                              </ol>

                                                                <div class="row">

<!-- Article main content -->
<article class="col-sm-9 maincontent">
<header class="page-header" style="margin: 0px;margin-top: -15px;width:800px;">
<h1 class="page-title">Enquire</h1>
                                </header>
                                  <?php
                                      if(!isset($_GET['catgid'])){
                                  ?>
                                  <form method="get" name="form2"  action="enquiry.php" enctype="multipart/form-data" id="login-form">




<div class="row">
<div class="col-md-3">
<?php

            $sql1="select * from dubaiexpo_catg order by catgy  asc";
             $result1=mysql_query($sql1);?>
<select class="form-control" name="catgid" id="catgid" onchange="load(this.value)">
<option value="">Category</option>
                           <?php


                               while($row1 = mysql_fetch_array($result1)){


                               $catgyid=$row1['cyid'];
                               $ctgy=$row1['catgy'];
                              ?>
                           <option value="<?php echo $catgyid;?>"> <?php echo $ctgy; ?> </option>
                                                                                          <?php } ?>
                                                                                          </select>
                                                                                            </div>
                                                                                              <div class="col-md-3">
<div id="subcatid1">

</div>
  </div>


    <input type="submit" class="btn btn-custom-blue" value="Find" onclick="return validate();">
</div>

  </form>
    <?php
    }

    foreach (range('A', 'Z') as $char) {
    echo "<a href='?alpha=$char";
    if(isset($_GET["catgid"])){echo"&catgid=$_GET[catgid]";}
    if(isset($_GET["subcatid"])){echo"&subcatid=$_GET[subcatid]";}
    echo"'>".$char . "</a> &nbsp;&nbsp;";
}
    ?>



<!------------------------------- my second form starts-------------------------------------->

                                  <?php

if($_GET['alpha']!=""){

                           $catgsh=$_GET['catgid'];
                          $subcatgsh=$_GET['subcatid'];
                          $sql_h4="SELECT * FROM dubaiexpo_catg where cyid='$catgsh' " ;
                          $res4 = mysql_query($sql_h4);
                          $row4 = mysql_fetch_array($res4);
                          $catsh1=$row4['catgy'];
                          $sql_h5="SELECT * FROM dubaiexpo_subcatg where scid='$subcatgsh' " ;
                          $res5 = mysql_query($sql_h5);
                          $row5 = mysql_fetch_array($res5);
                           $subcatsh1=$row5['subcatgy'];




                           if(($_GET["catgid"] != "") && ($_GET["subcatid"] != "")) {

                          $sql8 = "SELECT dubaiexpo_reg.*,dubaiexpo_catg.cyid,dubaiexpo_catg.catgy,dubaiexpo_subcatg.scid,dubaiexpo_subcatg.subcatgy,dubaiexpo_subcatg.catid FROM dubaiexpo_reg,dubaiexpo_catg,dubaiexpo_subcatg WHERE dubaiexpo_reg.catgid = dubaiexpo_catg.cyid and dubaiexpo_reg.subcatid = dubaiexpo_subcatg.scid and dubaiexpo_reg.cstatus=1 AND (dubaiexpo_catg.catgy LIKE '%".$catsh1."%' and dubaiexpo_subcatg.subcatgy LIKE '%".$subcatsh1."%') and dubaiexpo_reg.cname LIKE '".$_GET[alpha]."%' order by dubaiexpo_reg.cname desc";
                           }else if(($_GET["catgid"] != "") && ($_GET["subcatid"] == "")){
                          $sql8 = "SELECT dubaiexpo_reg.*,dubaiexpo_catg.cyid,dubaiexpo_catg.catgy,dubaiexpo_subcatg.scid,dubaiexpo_subcatg.subcatgy,dubaiexpo_subcatg.catid FROM dubaiexpo_reg,dubaiexpo_catg,dubaiexpo_subcatg WHERE dubaiexpo_reg.catgid = dubaiexpo_catg.cyid and dubaiexpo_reg.subcatid = dubaiexpo_subcatg.scid and dubaiexpo_reg.cstatus=1 AND (dubaiexpo_catg.catgy LIKE '%".$catsh1."%') and dubaiexpo_reg.cname LIKE '".$_GET[alpha]."%' order by dubaiexpo_reg.cname desc";
                           }else if(($_GET["catgid"] == "") && ($_GET["subcatid"] != "")){
                          $sql8 = "SELECT dubaiexpo_reg.*,dubaiexpo_catg.cyid,dubaiexpo_catg.catgy,dubaiexpo_subcatg.scid,dubaiexpo_subcatg.subcatgy,dubaiexpo_subcatg.catid FROM dubaiexpo_reg,dubaiexpo_catg,dubaiexpo_subcatg WHERE dubaiexpo_reg.catgid = dubaiexpo_catg.cyid and dubaiexpo_reg.subcatid = dubaiexpo_subcatg.scid and dubaiexpo_reg.cstatus=1 AND (dubaiexpo_subcatg.subcatgy LIKE '%".$subcatsh1."%') and dubaiexpo_reg.cname LIKE '".$_GET[alpha]."%' order by dubaiexpo_reg.cname desc";
                           }else if(($_GET["catgid"] == "") && ($_GET["subcatid"] == "")){
                          $sql8 = "SELECT dubaiexpo_reg.*,dubaiexpo_catg.cyid,dubaiexpo_catg.catgy,dubaiexpo_subcatg.scid,dubaiexpo_subcatg.subcatgy,dubaiexpo_subcatg.catid FROM dubaiexpo_reg,dubaiexpo_catg,dubaiexpo_subcatg WHERE dubaiexpo_reg.catgid = dubaiexpo_catg.cyid and dubaiexpo_reg.subcatid = dubaiexpo_subcatg.scid and dubaiexpo_reg.cstatus=1 and dubaiexpo_reg.cname LIKE '".$_GET[alpha]."%' order by dubaiexpo_reg.cname desc";
                           }








                          $query8 = mysql_query($sql8);
                          $Num_Rows = mysql_num_rows($query8);

                          $Per_Page = 20;   // Per Page

                          $Page = $_GET["Page"];
                          if(!$_GET["Page"])
                          {
                          $Page=1;
                          }

                          $Prev_Page = $Page-1;
                          $Next_Page = $Page+1;

                          $Page_Start = (($Per_Page*$Page)-$Per_Page);
                          if($Num_Rows<=$Per_Page)
                          {
                          $Num_Pages =1;
                          }
                          else if(($Num_Rows % $Per_Page)==0)
                          {
                          $Num_Pages =($Num_Rows/$Per_Page) ;
                          }
                          else
                          {
                          $Num_Pages =($Num_Rows/$Per_Page)+1;
                          $Num_Pages = (int)$Num_Pages;
                          }
                           if(($_GET["catgid"] != "") && ($_GET["subcatid"] != "")) {
                           $sql8="SELECT dubaiexpo_reg.*,dubaiexpo_catg.cyid,dubaiexpo_catg.catgy,dubaiexpo_subcatg.scid,dubaiexpo_subcatg.subcatgy,dubaiexpo_subcatg.catid FROM dubaiexpo_reg,dubaiexpo_catg,dubaiexpo_subcatg WHERE dubaiexpo_reg.catgid = dubaiexpo_catg.cyid and dubaiexpo_reg.subcatid = dubaiexpo_subcatg.scid and dubaiexpo_reg.cstatus=1 AND (dubaiexpo_catg.catgy LIKE '%".$catsh1."%' and dubaiexpo_subcatg.subcatgy LIKE '%".$subcatsh1."%')order by dubaiexpo_reg.cname desc LIMIT $Page_Start , $Per_Page";
                           }


                           $query8  = mysql_query($sql8);
                          $rowcount=mysql_num_rows($query8);
                          if($rowcount==0){
                          ?>

                                  <script type="text/javascript">
alert("Sorry the details are not available.Please report us below");

<?php if ($catgid > 0)
{
 echo "window.location.href = 'enquiry.php?bid=" . $catgid . "';";
}
else
{
 echo "window.location.href = 'enquiry.php?a=1';";
}
?>
</script>
  <?php } ?>
  <?php

      if($rowcount!=0){
  ?>
















  <div id="expand">


<div class="row">

<table>
 <thead>
 <tr>
 <th>Logo</th>
           <th>Company</th>
                        <th>Website </th>
                                      <th>Contact </th>
                                                    <th>Email</th>
                                                               <th>Description</th>
                                                                                </tr>
                                                                                  </thead>





                                                                                    <?php

                                                       $i=1; $no=$Page-1; $no=$no*$Per_Page;



                                                           ?>

                                                                                    <?php
                                                                                 while($row8 = mysql_fetch_array($query8))
                                                                                 {

                                                                                     $comid=$row8['regid'];
                                                                                     $cotermsc=$row8['termsc'];
                                                                                     $cocatgid = $row8['catgy'];

                                                                                     $cosubcatid= $row8['subcatgy'];
                                                                                     $coclogo= $row8['clogo'];
                                                                                     $cocname =$row8['cname'];
                                                                                     $cocweb= $row8['cweb'];
                                                                                     $cocperson=$row8['cperson'];
                                                                                     $cocno=$row8['cno'];
                                                                                     $cocemail= $row8['cemail'];
                                                                                     $cocdesp1=$row8['cdesp'];
                                                                                         $cocdesp= substr($cocdesp1, 0, 40). '...';
                                                                                         $cocemail= substr($cocemail, 0, 20). '...';
                                                                                         $cocweb= substr($cocweb, 0, 20). '...';
                                                                                                                          ?>




                                                                                    <tbody>

                                                                                    <?php echo ($i % 2)?'<tr class="odd">':'<tr class="even">';?>
                                                                                    <td><a href="eqdetail.php?sr=<?php echo $comid;?>"><img src="<?php echo $coclogo;?>" style="  height: 100%;width: 100%;max-height: 150px;width: 150px;"  /></a> </td>
                                                                                                                                                                                                                                                      <td><a href="eqdetail.php?sr=<?php echo $comid;?>"> <?php echo $cocname;?></a></td>
                                                                                                                                                                                                                                                                                                                                      <td><a href="eqdetail.php?sr=<?php echo $comid;?>"><?php echo $cocweb;?></a> </td>
                                                                                                                                                                                                                                                                                                                                                                                                                     <td><a href="eqdetail.php?sr=<?php echo $comid;?>"><?php echo $cocperson;?><br/><?php echo $cocno;?></a> </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td><a href="eqdetail.php?sr=<?php echo $comid;?>"><?php echo $cocemail;?></a> </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <td><a href="eqdetail.php?sr=<?php echo $comid;?>"><?php echo $cocdesp;?></a> </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 </tr>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   </tbody>


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $i++;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     </table>















                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <div style="padding-top:20px;float:right;margin-right:20px;">Page :


<?php
if($Prev_Page)
{
echo "<span class=my_pagination ><a href='enquiry.php?Page=$Prev_Page&catgid=$_GET[catgid]&subcatid=$_GET[subcatid]'>Prev</a></span> ";
}

for($i=1; $i<=$Num_Pages; $i++){
if($i != $Page)
{
echo "<span class=my_pagination ><a href='enquiry.php?Page=$i&catgid=$_GET[catgid]&subcatid=$_GET[subcatid]'>$i</a></span>";
}
else
{
echo "<span class=my_pagination ><b> $i </b></span>";
}
}
if($Page!=$Num_Pages)
{
echo "<span class=my_pagination ><a href ='enquiry.php?Page=$Next_Page&catgid=$_GET[catgid]&subcatid=$_GET[subcatid]'>Next</a></span> ";
}
?>
</div>
  </div>
    <?php
    }
    }
else if(($_GET["catgid"] != "") && ($_GET["subcatid"] != ""))
                          {

                           $catgsh=$_GET['catgid'];
                          $subcatgsh=$_GET['subcatid'];
                          $sql_h4="SELECT * FROM dubaiexpo_catg where cyid='$catgsh' " ;
                          $res4 = mysql_query($sql_h4);
                          $row4 = mysql_fetch_array($res4);
                          $catsh1=$row4['catgy'];
                          $sql_h5="SELECT * FROM dubaiexpo_subcatg where scid='$subcatgsh' " ;
                          $res5 = mysql_query($sql_h5);
                          $row5 = mysql_fetch_array($res5);
                           $subcatsh1=$row5['subcatgy'];




                           if(($_GET["catgid"] != "") && ($_GET["subcatid"] != "")) {

                          $sql8 = "SELECT dubaiexpo_reg.*,dubaiexpo_catg.cyid,dubaiexpo_catg.catgy,dubaiexpo_subcatg.scid,dubaiexpo_subcatg.subcatgy,dubaiexpo_subcatg.catid FROM dubaiexpo_reg,dubaiexpo_catg,dubaiexpo_subcatg WHERE dubaiexpo_reg.catgid = dubaiexpo_catg.cyid and dubaiexpo_reg.subcatid = dubaiexpo_subcatg.scid and dubaiexpo_reg.cstatus=1 AND (dubaiexpo_catg.catgy LIKE '%".$catsh1."%' and dubaiexpo_subcatg.subcatgy LIKE '%".$subcatsh1."%')order by dubaiexpo_reg.cname desc";
                           }








                          $query8 = mysql_query($sql8);
                          $Num_Rows = mysql_num_rows($query8);

                          $Per_Page = 20;   // Per Page

                          $Page = $_GET["Page"];
                          if(!$_GET["Page"])
                          {
                          $Page=1;
                          }

                          $Prev_Page = $Page-1;
                          $Next_Page = $Page+1;

                          $Page_Start = (($Per_Page*$Page)-$Per_Page);
                          if($Num_Rows<=$Per_Page)
                          {
                          $Num_Pages =1;
                          }
                          else if(($Num_Rows % $Per_Page)==0)
                          {
                          $Num_Pages =($Num_Rows/$Per_Page) ;
                          }
                          else
                          {
                          $Num_Pages =($Num_Rows/$Per_Page)+1;
                          $Num_Pages = (int)$Num_Pages;
                          }
                           if(($_GET["catgid"] != "") && ($_GET["subcatid"] != "")) {
                           $sql8="SELECT dubaiexpo_reg.*,dubaiexpo_catg.cyid,dubaiexpo_catg.catgy,dubaiexpo_subcatg.scid,dubaiexpo_subcatg.subcatgy,dubaiexpo_subcatg.catid FROM dubaiexpo_reg,dubaiexpo_catg,dubaiexpo_subcatg WHERE dubaiexpo_reg.catgid = dubaiexpo_catg.cyid and dubaiexpo_reg.subcatid = dubaiexpo_subcatg.scid and dubaiexpo_reg.cstatus=1 AND (dubaiexpo_catg.catgy LIKE '%".$catsh1."%' and dubaiexpo_subcatg.subcatgy LIKE '%".$subcatsh1."%')order by dubaiexpo_reg.cname desc LIMIT $Page_Start , $Per_Page";
                           }


                           $query8  = mysql_query($sql8);
                          $rowcount=mysql_num_rows($query8);
                          if($rowcount==0){
                          ?>

    <script type="text/javascript">
alert("Sorry the details are not available.Please report us below");

<?php if ($catgid > 0)
{
 echo "window.location.href = 'enquiry.php?bid=" . $catgid . "';";
}
else
{
 echo "window.location.href = 'enquiry.php?a=1';";
}
?>
</script>
  <?php } ?>
  <?php

      if($rowcount!=0){
  ?>
















  <div id="expand">


<div class="row">

<table>
 <thead>
 <tr>
 <th>Logo</th>
           <th>Company</th>
                        <th>Website </th>
                                      <th>Contact </th>
                                                    <th>Email</th>
                                                               <th>Description</th>
                                                                                </tr>
                                                                                  </thead>





                                                                                    <?php

                                                       $i=1; $no=$Page-1; $no=$no*$Per_Page;



                                                           ?>

                                                                                    <?php
                                                                                 while($row8 = mysql_fetch_array($query8))
                                                                                 {

                                                                                     $comid=$row8['regid'];
                                                                                     $cotermsc=$row8['termsc'];
                                                                                     $cocatgid = $row8['catgy'];

                                                                                     $cosubcatid= $row8['subcatgy'];
                                                                                     $coclogo= $row8['clogo'];
                                                                                     $cocname =$row8['cname'];
                                                                                     $cocweb= $row8['cweb'];
                                                                                     $cocperson=$row8['cperson'];
                                                                                     $cocno=$row8['cno'];
                                                                                     $cocemail= $row8['cemail'];
                                                                                     $cocdesp1=$row8['cdesp'];
                                                                                         $cocdesp= substr($cocdesp1, 0, 40). '...';
                                                                                         $cocemail= substr($cocemail, 0, 20). '...';
                                                                                         $cocweb= substr($cocweb, 0, 20). '...';
                                                                                                                          ?>




                                                                                    <tbody>

                                                                                    <?php echo ($i % 2)?'<tr class="odd">':'<tr class="even">';?>
                                                                                    <td><a href="eqdetail.php?sr=<?php echo $comid;?>"><img src="<?php echo $coclogo;?>" style="  height: 100%;width: 100%;max-height: 150px;width: 150px;"  /></a> </td>
                                                                                                                                                                                                                                                      <td><a href="eqdetail.php?sr=<?php echo $comid;?>"> <?php echo $cocname;?></a></td>
                                                                                                                                                                                                                                                                                                                                      <td><a href="eqdetail.php?sr=<?php echo $comid;?>"><?php echo $cocweb;?></a> </td>
                                                                                                                                                                                                                                                                                                                                                                                                                     <td><a href="eqdetail.php?sr=<?php echo $comid;?>"><?php echo $cocperson;?><br/><?php echo $cocno;?></a> </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td><a href="eqdetail.php?sr=<?php echo $comid;?>"><?php echo $cocemail;?></a> </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <td><a href="eqdetail.php?sr=<?php echo $comid;?>"><?php echo $cocdesp;?></a> </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 </tr>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   </tbody>


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $i++;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     </table>















                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <div style="padding-top:20px;float:right;margin-right:20px;">Page :


<?php
if($Prev_Page)
{
echo "<span class=my_pagination ><a href='enquiry.php?Page=$Prev_Page&catgid=$_GET[catgid]&subcatid=$_GET[subcatid]'>Prev</a></span> ";
}

for($i=1; $i<=$Num_Pages; $i++){
if($i != $Page)
{
echo "<span class=my_pagination ><a href='enquiry.php?Page=$i&catgid=$_GET[catgid]&subcatid=$_GET[subcatid]'>$i</a></span>";
}
else
{
echo "<span class=my_pagination ><b> $i </b></span>";
}
}
if($Page!=$Num_Pages)
{
echo "<span class=my_pagination ><a href ='enquiry.php?Page=$Next_Page&catgid=$_GET[catgid]&subcatid=$_GET[subcatid]'>Next</a></span> ";
}
?>
</div>
  </div>
    <?php
    }
    }

    //mysql_close($objConnect);

    ?>

<!--------------------------------- my second form ends ------------------------------------------------------------>

<form method="post" name="form3"  action="enquiry.php" enctype="multipart/form-data" id="login-form3">
<div class="row jumbotron top-space" style="width:800px;">
<div class="col-sm-5">
Did you find what you are looking for?<br/><br/>
<input type="radio" name="gfind" id="bt1" value="1"  checked  onclick="showDiv(this)"/> Yes
                <span class="radio-btn-space"></span>
                                                                                                                                        <input type="radio" name="gfind" id="bt1" value="2"   onclick="showDiv(this)"/> No
            </div>
                                                                                                                                                                                                                                      </div>
                                                                                                                                                                                                                                        </form>
                                                                                                                                                                                                                                          <br/>
<form method="post" name="form4"  action="enquiry.php" enctype="multipart/form-data" id="login-form4">
<div id="collapse">
<div class="row">
<div class="col-sm-2">
<h4>Enquire</h4>
             </div>
               <div class="col-sm-12">
<textarea  name="enqu"  id="enqu"   class="form-control"  rows="9" placeholder="Please write a small description of what you are looking for with your contact details and we will get back to you in a couple of days."></textarea>
                                                                                                                                                                                                                           </div>
                                                                                                                                                                                                                             <div class="col-sm-4">
<input class="btn btn-custom-blue" type="submit" value="Submit" name="enqdt">
</div>
  </div>
    </div>
      </form>

<!------------------------------------- my CATEGORY FIELD starts------------------------------------------>

                                        <?php

                                if(($_GET["catgid"] != "") && ($_GET["subcatid"] == ""))
                                {

                                 $catgsh=$_GET['catgid'];
                                $sql_h4="SELECT * FROM dubaiexpo_catg where cyid='$catgsh' " ;
                                $res4 = mysql_query($sql_h4);
                                $row4 = mysql_fetch_array($res4);
                                $catsh1=$row4['catgy'];





                                if(($_GET["catgid"] != "") && ($_GET["subcatid"] == ""))  {

                                $sql8 = "SELECT dubaiexpo_reg.*,dubaiexpo_catg.cyid,dubaiexpo_catg.catgy FROM dubaiexpo_reg,dubaiexpo_catg WHERE dubaiexpo_reg.catgid = dubaiexpo_catg.cyid  and dubaiexpo_reg.cstatus=1 AND (dubaiexpo_catg.catgy LIKE '%".$catsh1."%' )order by dubaiexpo_reg.cname desc";
                                 }








                                $query8 = mysql_query($sql8);
                                $Num_Rows = mysql_num_rows($query8);

                                $Per_Page = 20;   // Per Page

                                $Page = $_GET["Page"];
                                if(!$_GET["Page"])
                                {
                                $Page=1;
                                }

                                $Prev_Page = $Page-1;
                                $Next_Page = $Page+1;

                                $Page_Start = (($Per_Page*$Page)-$Per_Page);
                                if($Num_Rows<=$Per_Page)
                                {
                                $Num_Pages =1;
                                }
                                else if(($Num_Rows % $Per_Page)==0)
                                {
                                $Num_Pages =($Num_Rows/$Per_Page) ;
                                }
                                else
                                {
                                $Num_Pages =($Num_Rows/$Per_Page)+1;
                                $Num_Pages = (int)$Num_Pages;
                                }
                                if(($_GET["catgid"] != "") && ($_GET["subcatid"] == ""))   {
                                 $sql8="SELECT dubaiexpo_reg.*,dubaiexpo_catg.cyid,dubaiexpo_catg.catgy FROM dubaiexpo_reg,dubaiexpo_catg WHERE dubaiexpo_reg.catgid = dubaiexpo_catg.cyid and dubaiexpo_reg.cstatus=1 AND (dubaiexpo_catg.catgy LIKE '%".$catsh1."%' )order by dubaiexpo_reg.cname desc LIMIT $Page_Start , $Per_Page";
                                 }


                                 $query8  = mysql_query($sql8);
                                $rowcount=mysql_num_rows($query8);
                                if($rowcount==0){
                                ?>

                                        <script type="text/javascript">
alert("Sorry the details are not available.Please report us below");
//window.location.href = 'enquiry.php';

<?php if ($catgid > 0)
{
 echo "window.location.href = 'enquiry.php?bid=" . $catgid . "';";
}
else
{
 echo "window.location.href = 'enquiry.php?a=1';";
}
?>

</script>
  <?php } ?>
  <?php

      if($rowcount!=0){
  ?>



  <?php /*to hide the login form 3 */ ?>
  <script type="text/javascript">
document.getElementById('login-form3').style.display = "none";
</script>











  <div id="expand">


<div class="row" style="">



<table>
 <thead>
 <tr>
 <th>Logo</th>
           <th>Company</th>
                        <th>Website </th>
                                      <th>Contact </th>
                                                    <th>Email</th>
                                                               <th>Description</th>
                                                                                </tr>
                                                                                  </thead>





                                                                                    <?php

                                                       $i=1; $no=$Page-1; $no=$no*$Per_Page;



                                                           ?>

                                                                                    <?php
                                                                                 while($row8 = mysql_fetch_array($query8))
                                                                                 {

                                                                                     $comid=$row8['regid'];
                                                                                     $cotermsc=$row8['termsc'];
                                                                                     $cocatgid = $row8['catgy'];

                                                                                     $cosubcatid= $row8['subcatgy'];
                                                                                     $coclogo= $row8['clogo'];
                                                                                     $cocname =$row8['cname'];
                                                                                     $cocweb= $row8['cweb'];
                                                                                     $cocperson=$row8['cperson'];
                                                                                     $cocno=$row8['cno'];
                                                                                     $cocemail= $row8['cemail'];
                                                                                     $cocdesp1=$row8['cdesp'];
                                                                                         $cocdesp= substr($cocdesp1, 0, 40). '...';
                                                                                         $cocemail= substr($cocemail, 0, 20). '...';
                                                                                         $cocweb= substr($cocweb, 0, 20). '...';
                                                                                                                          ?>





                                                                                    <tbody>
                                                                                    <?php echo ($i % 2)?'<tr class="odd">':'<tr class="even">';?>
                                                                                    <td><a href="eqdetail.php?sr=<?php echo $comid;?>"><img src="<?php echo $coclogo;?>" style="  height: 100%;width: 100%;max-height: 150px;width: 150px;"  /></a> </td>
                                                                                                                                                                                                                                                      <td><a href="eqdetail.php?sr=<?php echo $comid;?>"> <?php echo $cocname;?></a></td>
                                                                                                                                                                                                                                                                                                                                      <td><a href="eqdetail.php?sr=<?php echo $comid;?>"><?php echo $cocweb;?></a> </td>
                                                                                                                                                                                                                                                                                                                                                                                                                     <td><a href="eqdetail.php?sr=<?php echo $comid;?>"><?php echo $cocperson;?><br/><?php echo $cocno;?></a> </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td><a href="eqdetail.php?sr=<?php echo $comid;?>"><?php echo $cocemail;?></a> </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <td><a href="eqdetail.php?sr=<?php echo $comid;?>"><?php echo $cocdesp;?></a> </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 </tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   </tbody>



                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $i++;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     </table>






                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       </div>










                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <div style="padding-top:20px;float:right;margin-right:20px;">Page :


<?php
if($Prev_Page)
{
echo "<span class=my_pagination ><a href='enquiry.php?Page=$Prev_Page&catgid=$_GET[catgid]'>Prev</a></span> ";
}

for($i=1; $i<=$Num_Pages; $i++){
if($i != $Page)
{
echo "<span class=my_pagination ><a href='enquiry.php?Page=$i&catgid=$_GET[catgid]'>$i</a></span>";
}
else
{
echo "<span class=my_pagination ><b> $i </b></span>";
}
}
if($Page!=$Num_Pages)
{
echo "<span class=my_pagination ><a href ='enquiry.php?Page=$Next_Page&catgid=$_GET[catgid]'>Next</a></span> ";
}
?>
</div>
  </div>
    <?php
    }
    }
    //mysql_close($objConnect);

    ?>

<!---------------------------------------------------------------- my CATEGORY FIELD form ends ------------------------------------------------------------>









<div class="empty-space"></div>



                           </article>
<!-- /Article -->

<?php
    $enquiry_banner = true;
    include 'sidebar.php';
?>

</div>
  </div>	<!-- /container -->


<?php
    include 'footer.php';
?>





<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
                                                                                 <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
                                                                                                                                                                    <script src="assets/js/headroom.min.js"></script>
                                                                                                                                                                                                              <script src="assets/js/jQuery.headroom.min.js"></script>
                                                                                                                                                                                                                                                               <script src="assets/js/template.js"></script>
                                                                                                                                                                                                                                                                                                     </body>

                                                                                                                                                                                                                                                                                                       <script>

                                                                                                                                                                                                                                                                                                       $(document).ready(function() {
$("#catgid").change(function () {
    var catgid = this.value;
    var scatgid = $("#subcatid").val();
updateBanner(catgid, scatgid);
});

$("#subcatid").change(function () {
    var scatgid = this.value;
    var catgid = $("#catgid").val();
updateBanner(catgid, scatgid);
});
if (bCid > 0)
{
updateBanner(bCid, bSid);
}
});

var topban=$('.banner-top').attr('src');
var topbanlink=$('.banner-top-link').attr('href');
var sban=$('.sppt').attr('src');
var sbanlink=$('.sppt-link').attr('href');
var rban=$('.rppt').attr('src');
var rbanlink=$('.rppt-link').attr('href');
var mban=$('.mppt').attr('src');
var mbanlink=$('.mppt-link').attr('href');
function updateBanner(catgid, scatgid)
{
    var url = 'enquiry.php';
var data = {};
data.getbanner = 1;
data.catgid = catgid;
data.scatgid = scatgid;

$.ajax({
    type: "POST",
    url: url,
    data: data,
    dataType: 'json',
})
.done(function(msg) {
if (msg.status)
{
if (msg.banner_top.length > 0)
{
    url = 'admin/' + msg.banner_top;
    $('.banner-top').attr('src', url);
    $('.banner-top-link').attr('href', msg.banner_top_link);
}else{
     $('.banner-top').attr('src', topban);
     $('.banner-top-link').attr('href', topbanlink);
     /*$(".banner-top").css("visibility", "hidden");
     $("#slider1").css("visibility", "visible");*/
 }


if (msg.sppt != '')
{
    url = 'admin/' + msg.sppt;
    $('.sppt').attr('src', url);
    $('.sppt-link').attr('href', msg.sppt_link);
}else{
     $('.sppt').attr('src', sban);
     $('.sppt-link').attr('href', sbanlink);
 }
if (msg.rppt != '')
{
    url = 'admin/' + msg.rppt;
    $('.rppt').attr('src', url);
    $('.rppt-link').attr('href', msg.rppt_link);
}else{
     $('.rppt').attr('src', rban);
     $('.rppt-link').attr('href', rbanlink);
 }
if (msg.mppt != '')
{
    url = 'admin/' + msg.mppt;
    $('.mppt').attr('src', url);
    $('.mppt-link').attr('href', msg.mppt_link);
}else{
     $('.mppt').attr('src', mban);
     $('.mppt-link').attr('href', mbanlink);
 }
}else{
     $('.banner-top').attr('src', topban);
     $('.sppt').attr('src', sban);
     $('.rppt').attr('src', rban);
     $('.mppt').attr('src', mban);
     $("#slider1").css("visibility", "visible");
 }
});
}


</script>

  </html>