<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <title>M&eacute;t&eacute;o</title>


<!--meta http-equiv="Refresh" content="5"-->
  <meta http-equiv="Pragma" content="no-cache">

  <script language="JavaScript">
<!--
function ends()
{ document.imgToLoad.src = "http://ptq2.mcom.fr/rouennaises/f2.jpg?" + new Date().getTime();
}
// -->
  </script>
</head>


<body style="color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);" alink="#000099" link="#000000" vlink="#000000">

<br>

<div style="text-align: center;">
<table style="width: 100%; text-align: left; margin-left: auto; margin-right: auto;" border="1" cellpadding="2">

  <tbody>

    <tr>

      <td style="text-align: center; vertical-align: middle; background-color: rgb(51, 51, 153);">
      <h1 style="text-align: center; color: rgb(255, 255, 255);" class="titre">Famille
Le D&ucirc;</h1>

      </td>

    </tr>

  </tbody>
</table>

</div>

<br>

<table cellspacing="20%">

  <tbody>

    <tr align="left" valign="top">

      <td>
      <table border="1" cellpadding="2">

        <tbody>

          <tr>

            <td style="background-color: rgb(51, 51, 153);">
            <h2> <span style="color: rgb(255, 255, 255);">Sommaire</span>
            </h2>

            </td>

          </tr>

          <tr>

            <td>
            <div style="margin-left: 10px;">
            <a href="acceuil.html"><big>Accueil</big></a>
            <p><a href="../LEDUHTML/index.htm"><big>G&eacute;n&eacute;alogie</big></a></p>

            <p><a href="agenda.html"><big>Agenda</big></a></p>

            <p><a href="photos.html"><big>Photos</big></a></p>

            <p><a href="webcam.html"><big>Webcam</big></a></p>

            <p><a href="carte.html"><big>Plan</big></a></p>

            <p><a href="meteo.php"><big>M&eacute;t&eacute;o</big></a></p>

            <a href="mailto:famille-le-du@wanadoo.fr"><big>E-mail</big></a></div>

            </td>

          </tr>

        </tbody>
      </table>

      </td>

      <td style="text-align: center;"> <big><big><big>M&eacute;t&eacute;o
&agrave; Rouen<br>

      </big></big></big>
      <div style="text-align: left;">Cette page va vous
permettre de constater le climat dont nous jouissons &agrave;
Rouen.
Vous avez une image d'une webcam sur Rouen qui vous donnera un
aper&ccedil;u de la m&eacute;t&eacute;o actuelle. Vous avez
en plus un bulletin m&eacute;t&eacute;o.<br>

      </div>

      <br>

      <table>

        <tbody>

          <tr>

            <td>
<?php 
$site = "http://meteo.msn.com/rss.aspx?wealocations=wc:FRXX0085&weadegreetype=C&culture=fr-FR";
$fp = @fopen($site,"r"); while(!feof($fp)) $raw .= @fgets($fp, 4096); 
fclose($fp); 

eregi("<item>(.*)</item>", $raw, $rawitems ); 
$items = explode("<item>", $rawitems[0]); 

eregi("<title>(.*)</title>",$items[1], $title ); 
eregi("<description>(.*)</description>",$items[1], $cat); 
$cat[1] = str_replace("<![CDATA["," ",$cat[1]); 
$pos = strpos($cat[1],"<br />Toute"); 

if (is_int($pos) == false) { 
  $pos = strlen($cat[1]); } 

echo $title[1]." <br/> ".substr($cat[1],0,$pos); 
?>
            </td>

            <td> <a target="_blank" href="http://ptq2.mcom.fr/rouennaises/f2.jpg">
<img style="width: 272px; height: 224px;" name="imgToLoad" src="http://ptq2.mcom.fr/rouennaises/f2.jpg" onload="setTimeout('ends()', 50000)" onerror="setTimeout('ends()', 10000)" onclick="ends()" border="5"> 
           </a> 
           </td>

          </tr>

        </tbody>
      </table>

<?php 
eregi("<title>(.*)</title>",$items[2], $title ); 
eregi("<description>(.*)</description>",$items[2], $cat); 
$cat[1] = str_replace("<![CDATA["," ",$cat[1]); 
$pos = strpos($cat[1],"<br /></p>"); 
if (is_int($pos) == false) { 
  $pos = strlen($cat[1]); } 
echo $title[1]." <br/> ".substr($cat[1],0,$pos); 
?>
      </td>

    </tr>

  </tbody>
</table>

</body>
</html>
