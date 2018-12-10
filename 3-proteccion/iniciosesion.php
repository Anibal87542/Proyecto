<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_name']) && $_POST['form_name'] == 'loginform')
{
   $success_page = './../5-panel-de-socios/inde-panel-de-socio.php';
   $error_page = './contrase-invalida.php';
   $mysql_server = 'localhost';
   $mysql_username = 'id8148428_socios';
   $mysql_password = '7475858382';
   $mysql_database = 'id8148428_socios';
   $mysql_table = 'cms';
   $crypt_pass = md5($_POST['password']);
   $found = false;
   $fullname = '';
   $session_timeout = 600;
   $db = mysqli_connect($mysql_server, $mysql_username, $mysql_password);
   if (!$db)
   {
      die('Failed to connect to database server!<br>'.mysqli_error($db));
   }
   mysqli_select_db($db, $mysql_database) or die('Failed to select database<br>'.mysqli_error($db));
   mysqli_set_charset($db, 'utf8');
   $sql = "SELECT * FROM ".$mysql_table." WHERE username = '".mysqli_real_escape_string($db, $_POST['username'])."'";
   $result = mysqli_query($db, $sql);
   if ($data = mysqli_fetch_array($result))
   {
      if ($crypt_pass == $data['password'] && $data['active'] != 0)
      {
         $found = true;
         $fullname = $data['fullname'];
      }
   }
   mysqli_close($db);
   if($found == false)
   {
      header('Location: '.$error_page);
      exit;
   }
   else
   {
      if (session_id() == "")
      {
         session_start();
      }
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['fullname'] = $fullname;
      $_SESSION['expires_by'] = time() + $session_timeout;
      $_SESSION['expires_timeout'] = $session_timeout;
      header('Location: '.$success_page);
      exit;
   }
}
$username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
$password = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Inicio de Sesion </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body
{
   background-color: #FFFFFF;
   color: #000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   line-height: 1.1875;
   margin: 0;
   padding: 0;
}
a
{
   color: #0000FF;
   text-decoration: underline;
}
a:visited
{
   color: #800080;
}
a:active
{
   color: #FF0000;
}
a:hover
{
   color: #0000FF;
   text-decoration: underline;
}
input:focus, textarea:focus, select:focus
{
   outline: none;
}
#FlexGrid1
{
   display: grid;
   background-color: transparent;
   background-image: none;
   border: 0px solid #CCCCCC;
   box-sizing: border-box;
   margin: 0;
   padding: 0;
   font-size: 0px;
   grid-template-columns: 1fr 2fr 1fr;
   grid-template-rows: auto auto;
   grid-template-areas:
      "sidebar1 main sidebar2"
      ". . .";
}
#FlexGrid1 .sidebar1
{
   display: flex;
   grid-area: sidebar1;
   background-color: transparent;
   background-image: none;
   border: 0px solid #FFFFFF;
   -webkit-flex-direction: column;
   flex-direction: column;
   -webkit-flex-wrap: nowrap;
   flex-wrap: nowrap;
   -webkit-justify-content: flex-start;
   justify-content: flex-start;
   -webkit-align-items: stretch;
   align-items: stretch;
   -webkit-align-content: stretch;
   align-content: stretch;
}
#FlexGrid1 .main
{
   display: flex;
   grid-area: main;
   background-color: transparent;
   background-image: none;
   border: 0px solid #FFFFFF;
   padding: 20px 20px 20px 20px;
   -webkit-flex-direction: column;
   flex-direction: column;
   -webkit-flex-wrap: nowrap;
   flex-wrap: nowrap;
   -webkit-justify-content: flex-start;
   justify-content: flex-start;
   -webkit-align-items: stretch;
   align-items: stretch;
   -webkit-align-content: stretch;
   align-content: stretch;
}
#FlexGrid1 .sidebar2
{
   display: flex;
   grid-area: sidebar2;
   background-color: transparent;
   background-image: none;
   border: 0px solid #FFFFFF;
   -webkit-flex-direction: column;
   flex-direction: column;
   -webkit-flex-wrap: nowrap;
   flex-wrap: nowrap;
   -webkit-justify-content: flex-start;
   justify-content: flex-start;
   -webkit-align-items: stretch;
   align-items: stretch;
   -webkit-align-content: stretch;
   align-content: stretch;
}
#Accordion2 *, #Accordion2 *::before, #Accordion2 *::after
{
   box-sizing: border-box;
}
#Accordion2 .panel
{
   background-color: #FFFFFF;
   background-image: none;
   border: 1px solid transparent;
   border-radius: 4px;
   box-shadow: 0px 1px 1px rgba(0,0,0,0.05);
   margin-bottom: 1px;
   overflow: hidden;
   text-align: left;
}
#Accordion2 .panel-default
{
   border-color: #C5C5C5;
}
#Accordion2 .panel-group .panel
{
   margin-bottom: 0px;
   overflow: hidden;
   border-radius: 4px;
}
#Accordion2 .panel-group .panel + .panel
{
   margin-top: 5px;
}
#Accordion2 .panel-heading
{
   padding: 9px 10px 9px 10px;
   border-bottom: 1px solid transparent;
   border-top-right-radius: 4px;
   border-top-left-radius: 4px;
}
#Accordion2 .panel-group .panel-heading
{
   border-bottom: 0;
}
#Accordion2 .panel-default > .panel-heading
{
   background-color: #F6F6F6;
   background-image: none;
}
#Accordion2 .panel-default.active
{
   border-color: #DDDDDD;
}
#Accordion2 .panel-default.active > .panel-heading
{
   background-color: #F5F5F5;
   background-image: none;
}
#Accordion2 .panel-body
{
   padding: 4px 4px 4px 4px;
   position: relative;
}
#Accordion2 .panel-body::before, #Accordion2 .panel-body::after
{
   display: table;
   content: " ";
}
#Accordion2 .panel-body::after
{
   clear: both;
}
#Accordion2 .panel-group .panel-heading + .panel-collapse .panel-body
{
   border-top: 1px solid #C5C5C5;
}
#Accordion2 .panel-default > .panel-heading + .panel-collapse .panel-body
{
   border-top-color: #C5C5C5;
}
#Accordion2 .panel-title
{
   margin-top: 0px;
   margin-bottom: 0px;
   color: #454545;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px !important;
   font-style: normal;
}
#Accordion2 .panel-title > a
{
   color: inherit;
   text-decoration: none;
}
#Accordion2 .active .panel-title > a
{
   color: #000000;
}
#Accordion2 .collapse 
{
   display: none;
}
#Accordion2 .collapse.in
{
   display: block;
}
#Accordion2 .collapsing
{
   position: relative;
   height: 0;
   overflow: hidden;
   -webkit-transition: height 0.35s linear;
   transition: height 0.35s linear;
}
#Accordion2 .panel-default .panel-heading .panel-icon
{
   width: 16px;
   height: 16px;
   box-sizing: content-box;
   padding-right: 4px;
   display: inline-block;
   vertical-align: middle;
   margin-top: -0.25em;
   position: relative;
   text-indent: -99999px;
   overflow: hidden;
   background-image: url(images/iniciosesion-Accordion2-default.png);
   background-repeat: no-repeat;
}
#Accordion2 .panel-default.active .panel-heading .panel-icon
{
   background-image: url(images/iniciosesion-Accordion2-active.png);
}
#wb_Accordion2
{
   margin: 20px 20px 0px 20px;
   -webkit-flex-grow: 0;
   flex-grow: 0;
   -webkit-flex-shrink: 0;
   flex-shrink: 0;
   -webkit-align-self: auto;
   align-self: auto;
}
#Login1
{
   background-color: #FFFFFF;
   border-color:#CCCCCC;
   border-width:0px;
   border-style: solid;
   border-radius: 4px;
   color: #000000;
   border-spacing: 6px;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: left;
   width: 100%;
   height: 147px;
}
#Login1 td
{
   padding: 0;
}
#Login1 .header
{
   background-color: #878787;
   color: #FFFFFF;
   height: 0px;
   padding: 4px 4px 4px 4px;
   text-align: center;
}
#Login1 .row
{
   height: 36px;
   text-align: left;
}
#Login1 .input
{
   background-color: #FFFFFF;
   border-color: #CCCCCC;
   border-width: 1px;
   border-style: solid;
   border-radius: 2px;
   color: #000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   width: 100%;
   height: 30px;
   box-sizing: border-box;
   margin-top: 6px;
   padding: 6px 4px 6px 4px;
}
#Login1 .input:focus
{
   border-color: #66AFE9;
   outline: 0;
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
}
#Login1 .button
{
   background-color: #3370B7;
   border-color: #2E6DA4;
   border-width: 1px;
   border-style: solid;
   border-radius: 3px;
   color: #FFFFFF;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   padding: 4px 14px 4px 14px;
}
#wb_Heading1
{
   background-color: #006400;
   background-image: none;
   border: 0px solid #000000;
   border-radius: 4px;
   margin: 0px 0px 20px 0px;
   padding: 16px 16px 16px 16px;
   text-align: center;
   -webkit-flex-grow: 0;
   flex-grow: 0;
   -webkit-flex-shrink: 0;
   flex-shrink: 0;
   -webkit-align-self: auto;
   align-self: auto;
}
#Heading1
{
   color: #000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 21px;
   margin: 0;
   text-align: center;
}
#footer
{
   display: -webkit-flex;
   display: flex;
   padding: 10px 10px 10px 10px;
   -webkit-flex-direction: row;
   flex-direction: row;
   -webkit-flex-wrap: wrap;
   flex-wrap: wrap;
   -webkit-justify-content: space-between;
   justify-content: space-between;
   -webkit-align-items: center;
   align-items: center;
   -webkit-align-content: flex-start;
   align-content: flex-start;
   margin: 0;
   background-color: transparent;
   background-image: none;
   border: 0px solid #CCCCCC;
   box-sizing: border-box;
   font-size: 0px;
}
#wb_Text1 
{
   background-color: transparent;
   background-image: none;
   border: 0px solid #000000;
   -webkit-flex-grow: 1;
   flex-grow: 1;
   -webkit-flex-shrink: 1;
   flex-shrink: 1;
   -webkit-align-self: auto;
   align-self: auto;
   padding: 0;
   margin: 11px 0px 0px 6px;
   text-align: right;
}
#wb_Text1
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   line-height: 16px;
}
#wb_Text1 div
{
   text-align: right;
   white-space: nowrap;
}
#wb_Login1
{
   display: inline-block;
   width: 100%;
   z-index: 0;
}
#wb_Accordion2
{
   display: inline-block;
   z-index: 2;
}
#wb_Heading1
{
   display: inline-block;
   z-index: 1;
}
@media only screen and (max-width: 1065px)
{
body
{
   background-color: #FFFFFF;
   background-image: none;
}
#FlexGrid1
{
   visibility: visible;
   display: grid;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#FlexGrid1
{
   margin: 0;
   grid-column-gap: 0px;
   grid-row-gap: 0px;
   grid-template-columns: 1fr;
   grid-template-rows: auto auto auto;
   grid-template-areas:
      "sidebar1"
      "main"
      "sidebar2";
}
#FlexGrid1 .sidebar1
{
   display: flex;
   background-color: transparent;
   background-image: none;
   border: 0px solid #FFFFFF;
   -webkit-flex-direction: column;
   flex-direction: column;
   -webkit-flex-wrap: nowrap;
   flex-wrap: nowrap;
   -webkit-justify-content: space-around;
   justify-content: space-around;
   -webkit-align-items: stretch;
   align-items: stretch;
   -webkit-align-content: flex-start;
   align-content: flex-start;
}
#FlexGrid1 .main
{
   display: flex;
   background-color: transparent;
   background-image: none;
   border: 0px solid #FFFFFF;
   padding: 20px 20px 20px 20px;
   -webkit-flex-direction: column;
   flex-direction: column;
   -webkit-flex-wrap: nowrap;
   flex-wrap: nowrap;
   -webkit-justify-content: flex-start;
   justify-content: flex-start;
   -webkit-align-items: stretch;
   align-items: stretch;
   -webkit-align-content: flex-start;
   align-content: flex-start;
}
#FlexGrid1 .sidebar2
{
   display: flex;
   background-color: transparent;
   background-image: none;
   border: 0px solid #FFFFFF;
   -webkit-flex-direction: column;
   flex-direction: column;
   -webkit-flex-wrap: nowrap;
   flex-wrap: nowrap;
   -webkit-justify-content: space-around;
   justify-content: space-around;
   -webkit-align-items: stretch;
   align-items: stretch;
   -webkit-align-content: flex-start;
   align-content: flex-start;
}
#wb_Accordion2
{
   width: auto;
   height: auto;
   visibility: visible;
   display: inline;
   margin: 20px 20px 0px 20px;
   -webkit-flex-grow: 0;
   flex-grow: 0;
   -webkit-flex-shrink: 0;
   flex-shrink: 0;
   -webkit-align-self: auto;
   align-self: auto;
}
#wb_Login1
{
   width: calc(100% - 0px);
   visibility: visible;
   display: block;
   margin: 0;
}
#Login1
{
}
#wb_Heading1
{
   width: auto;
   height: auto;
   visibility: visible;
   display: inline;
   color: #000000;
   font-size: 21px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: #006400;
   background-image: none;
   border-radius: 4px;
   margin: 0px 0px 20px 0px;
   padding: 16px 16px 16px 16px;
   -webkit-flex-grow: 0;
   flex-grow: 0;
   -webkit-flex-shrink: 0;
   flex-shrink: 0;
   -webkit-align-self: auto;
   align-self: auto;
}
#wb_Heading1
{
   background-color: #006400;
   background-image: none;
   border: 0px solid #000000;
   border-radius: 4px;
   text-align: center;
   -webkit-flex-grow: 0;
   flex-grow: 0;
   -webkit-flex-shrink: 0;
   flex-shrink: 0;
   -webkit-align-self: auto;
   align-self: auto;
}
#Heading1
{
   color: #000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 21px;
}
#footer
{
   visibility: visible;
   display: flex;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#footer
{
   margin: 0;
   padding: 10px 10px 10px 10px;
   -webkit-flex-direction: column;
   flex-direction: column;
   -webkit-flex-wrap: nowrap;
   flex-wrap: nowrap;
   -webkit-justify-content: space-between;
   justify-content: space-between;
   -webkit-align-items: stretch;
   align-items: stretch;
   -webkit-align-content: flex-start;
   align-content: flex-start;
}
#wb_Text1
{
   width: auto;
   height: auto;
   visibility: visible;
   display: inline;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
   -webkit-flex-grow: 1;
   flex-grow: 1;
   -webkit-flex-shrink: 1;
   flex-shrink: 1;
   -webkit-align-self: auto;
   align-self: auto;
}
#wb_Text1
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   margin: 4px 0px 0px 0px;
   padding: 0;
   text-align: right;
   line-height: 16px;
}
}
</style>
<script src="java scrit/jquery-1.12.4.min.js"></script>
<script src="java scrit/transition.min.js"></script>
<script src="java scrit/collapse.min.js"></script>
<script>
$(document).ready(function()
{
   $("#Accordion2 .panel").on('show.bs.collapse', function()
   {
      $(this).addClass('active');
   });
   $("#Accordion2 .panel").on('hide.bs.collapse', function()
   {
      $(this).removeClass('active');
   });
});
</script>
</head>
<body>
<div id="FlexGrid1">
<div class="sidebar1">
</div>
<div class="main">
<div id="wb_Heading1">
<h1 id="Heading1">INICIO DE SESION PARA SOCIOS</h1>
</div>
<div id="wb_Accordion2">
<div id="Accordion2" class="panel-group" role="tablist">
<div class="panel panel-default active">
   <div class="panel-heading" role="tab">
      <h4 class="panel-title">
         <a role="button" data-toggle="collapse" data-parent="#Accordion2" href="#Accordion2-collapse1" aria-controls="Accordion2-collapse1" aria-expanded="true"><span class="panel-icon"></span>Inicie Sesion</a>
      </h4>
   </div>
   <div id="Accordion2-collapse1" class="panel-collapse collapsein in" role="tabpanel">
      <div class="panel-body">
<div id="wb_Login1">
<form name="loginform" method="post" accept-charset="UTF-8" action="<?php echo basename(__FILE__); ?>" id="loginform">
<input type="hidden" name="form_name" value="loginform">
<table id="Login1">
<tr>
   <td class="row"><input class="input" name="username" type="text" id="username" value="<?php echo $username; ?>" placeholder="Nombre de Usuario"></td>
</tr>
<tr>
   <td class="row"><input class="input" name="password" type="password" id="password" value="<?php echo $password; ?>" placeholder="Contrase&#241;a"></td>
</tr>
<tr>
   <td style="text-align:left;vertical-align:bottom"><input class="button" type="submit" name="login" value="Iniciar" id="login"></td>
</tr>
</table>
</form>

</div>
      </div>
   </div>
</div>
</div>

</div>
<div id="wb_Text1">
<span style="color:#000000;"><strong><em><a href="./registrnuevsocios.php">Registro para Nuevos Socios</a></em></strong></span>
</div>
</div>
<div class="sidebar2">
</div>
</div>
<div id="footer">
</div>
</body>
</html>