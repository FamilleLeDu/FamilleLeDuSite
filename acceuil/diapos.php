<html>
<head>

  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
  <title>Photos Famille Le Du</title>


</head>


<?php
$tab_dir = array(); 
/* Lecture du repertoire pour reperer les sous-répertoires et tris des sous-répertoires suivant leur noms */
$rep = "../photos/";
$dir = opendir($rep); 

while ($f = readdir($dir)) 
 {
   if(is_dir($rep.$f) && ($f != ".") && ($f != "..")) 
   {
    $tab_dir[] = $f; 
   }
 }
closedir($dir); 

/* tri dans l'ordre alphabetique inverse*/ 
arsort($tab_dir); 

$tab_fic_nom = array();
$tab_fic_titre = array();
$tab_fic_libel = array();


/* Pour chaque sous répertoire récuperation des fichier JPG */
foreach($tab_dir as $f) 
  {
    $repPhoto = $rep.$f."/";

    /* récupération du titre des photos dans le fichier titre.txt de chaque sous répertoire */
    $fichTitre = $repPhoto."titre.txt";

    $titre = "";
    if(is_file($fichTitre)) 
     {
      $fp = @fopen($fichTitre,"r"); 
      $titre = @fgets($fp, 4096); 
      @fclose($fp);
     }
    $titre = str_replace("\"","\\\"",$titre);


    /* Lecture des noms de fichiers JPG et tri de ceux-ci */
    $tab_fich = array(); 

    $dirPhoto = opendir($repPhoto); 
    while ($P = readdir($dirPhoto)) 
     {
  
      if(is_file($repPhoto.$P) && (strtolower(substr($P,0,2)) != "v_") && 
          ((strtolower(substr($P, strrpos($P, '.'))) == ".jpg") || (strtolower(substr($P, strrpos($P, '.'))) == ".jpeg")
          )) 
       {
        $tab_fich[] = $P; 
       }
     }

    closedir($dirPhoto); 

   /* tri dans l'ordre alphabetique des noms des fichiers JPG */ 
   sort($tab_fich); 

   /* Pour chaque fichier JPG */
   foreach($tab_fich as $P) 
     {

       /* Recherche si il y a un titre à la photo */

       $fichTitre = substr($P,0,strrpos($P, '.')).".txt";
       $fichTitre = $repPhoto.$fichTitre;
        
       $fic_libel = ""; 
       if(is_file($fichTitre)) 
           {
            $fp = @fopen($fichTitre,"r"); 
            $fic_libel = @fgets($fp, 4096); 
            @fclose($fp);
           }

      $tab_fic_nom[] = $repPhoto.$P;

      $tab_fic_titre[] = $titre;

      $fic_libel = str_replace("\"","\\\"",$fic_libel);
      $tab_fic_libel[] = $fic_libel;

     }


 }

?>

  <script language="JavaScript">
<!--
var idx = 0;
var tab_nom_fich = [
<?php
   $lnb_fichier = 0;
   foreach($tab_fic_nom as $P) 
     {
      if ($lnb_fichier != 0)
        {
         echo ",";
        }
      echo "\"".$tab_fic_nom[$lnb_fichier]."\"\n";
      $lnb_fichier = $lnb_fichier+1;
     }
?>
];

var tab_texte = [
<?php
   $lnb_fichier = 0;
   foreach($tab_fic_titre as $P) 
     {
      if ($lnb_fichier != 0)
        {
         echo ",";
        }

      echo "\"".$tab_fic_titre[$lnb_fichier]." : ";
      echo $tab_fic_libel[$lnb_fichier]."\"\n";
      $lnb_fichier = $lnb_fichier+1;
     }
?>
];

var lecture = 1;
var params = " ";

<?php
  if ($_GET["fichier"] <> "")
    echo "params=\"".$_GET["fichier"]."\";"; 

?>

if (params != " ")
  {
   lecture = 0;
   for (i=0; i<tab_nom_fich.length; i++)
      {
	if (params == tab_nom_fich[i])
         idx = i;		
      }
  }


if (params == " ")
  LeTimer = setTimeout('ends()', 8000);


function LecturePause()
{
 if (lecture == 0)
   {
    lecture = 1;
    BoutonLecture.value="Pause";
   }
 else
   {
    clearTimeout(LeTimer);
    lecture = 0;
    BoutonLecture.value="Lecture";
   }

 if (lecture == 1)
   ends();
}

function ImgSuiv()
{
 if (lecture == 0)
   {
    idx = idx+1;
    ends();
   }
}

function ImgPrec()
{
 if (lecture == 0)
   {
    idx = idx-1;
    ends();
   }
}

function ImgSuivFast()
{
 if (lecture == 0)
   {
    idx = idx+5;
    ends();
   }
}

function ImgPrecFast()
{
 if (lecture == 0)
   {
    idx = idx-5;
    ends();
   }
}


function ends()
{ 

 if (lecture == 1)
   {
    idx = idx+1;
    if (RadioAleatoire[1].checked)
      idx = Math.floor(Math.random() * tab_nom_fich.length) ;
   }

 if (idx >= tab_nom_fich.length)
   idx = 0;

 if (idx < 0)
   idx = tab_nom_fich.length - 1;

 document.imgToLoad.src = tab_nom_fich[idx];
 document.getElementById("IDTexte").innerHTML = tab_texte[idx];

 if (lecture == 1)
   LeTimer = setTimeout('ends()', 8000);   
}

// -->
  </script>




<body style="color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);" alink="#000099" link="#000000" vlink="#000000">

<div style="text-align: center;">
<div style="text-align: center; font-family: Batang;">
<table style="width: 100%; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2">

  <tbody>

    <tr>

      <td style="text-align: center; vertical-align: middle;">
      <h1 style="text-align: center;" class="titre">
             <span style="color: rgb(51, 51, 255);">F</span><span style="color: rgb(255, 0, 0);">a</span><span style="color: rgb(255, 204, 51);">m</span><span style="color: rgb(51, 51, 255);">i</span><span style="color: rgb(51, 204, 0);">l</span><span style="color: rgb(255, 0, 0);">l</span><span style="color: rgb(51, 51, 255);">e </span><span style="color: rgb(255, 0, 0);">L</span><span style="color: rgb(255, 204, 51);">e </span><span style="color: rgb(51, 51, 255);">D</span><span style="color: rgb(51, 204, 0);">&ucirc; - </span><span style="color: rgb(51, 51, 255);">D</span><span style="color: rgb(255, 0, 0);">i</span><span style="color: rgb(51, 204, 0);">a</span><span style="color: rgb(255, 204, 51);">p</span><span style="color: rgb(51, 51, 255);">o</span><span style="color: rgb(255, 0, 0);">r</span><span style="color: rgb(51, 204, 0);">a</span><span style="color: rgb(255, 204, 51);">m</span><span style="color: rgb(51, 51, 255);">a</span></h1>

      </td>

    </tr>

  </tbody>
</table>

</div>

<table cellspacing="10%">

  <tbody>


    <tr>
      <td>
       <center>
            <input value="&lt;&lt;" name="BoutonPrecFast" onclick="javascript:ImgPrecFast()" type="button"> <input value="&lt;" name="BoutonPrec" onclick="javascript:ImgPrec()" type="button">
<input name="BoutonLecture" onclick="javascript:LecturePause()" type="button" value=
<?php

           if ($_GET["fichier"] <> "")
             echo "\"Lecture\"> "; 
           else
             echo "\"Pause\"> "; 
?>
<input value="&gt;" name="BoutonSuiv" onclick="javascript:ImgSuiv()" type="button"> <input value="&gt;&gt;" name="BoutonSuivFast" onclick="javascript:ImgSuivFast()" type="button">

       </center>

      </td>

    </tr>

    <tr>
      <td>
       <center>
            <input value="Normale" name="RadioAleatoire" type="radio" checked="checked">Lecture normale    <input value="Aleatoire" name="RadioAleatoire" type="radio">Lecture aléatoire 
       </center>

      </td>

    </tr>
    <tr>

      <td><h4><div id = "IDTexte" >
<?php

      echo $tab_fic_titre[0]." : ".$tab_fic_libel[0];

?>
      </div></h4>

      </td>

    </tr>

    <tr>
      <td>
       <center>
          <img name="imgToLoad" 
<?php

           if ($_GET["fichier"] <> "")
             echo "src=\"".$_GET["fichier"]."\""; 
           else
             echo "src=\"".$tab_fic_nom[0]."\""; 
?>
           border="5"> 
       </center>


      </td>

    </tr>

  </tbody>
</table>

<br>

</div>

</body>
</html>
