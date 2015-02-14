<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
  <title>Photos Famille Le Du</title>


</head>


<body style="color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);" alink="#000099" link="#000000" vlink="#000000">

<div style="text-align: center;">
<div style="text-align: center; font-family: Batang;">
<table style="width: 100%; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2">

  <tbody>

    <tr>

      <td style="text-align: center; vertical-align: middle;">
      <h1 style="text-align: center;" class="titre"><span style="color: rgb(51, 51, 255);">F</span><span style="color: rgb(255, 0, 0);">a</span><span style="color: rgb(255, 204, 51);">m</span><span style="color: rgb(51, 51, 255);">i</span><span style="color: rgb(51, 204, 0);">l</span><span style="color: rgb(255, 0, 0);">l</span><span style="color: rgb(51, 51, 255);">e</span> <span style="color: rgb(255, 0, 0);">L</span><span style="color: rgb(255, 204, 51);">e</span> <span style="color: rgb(51, 51, 255);">D</span><span style="color: rgb(51, 204, 0);">&ucirc; - </span><span style="color: rgb(51, 51, 255);">L</span><span style="color: rgb(255, 0, 0);">e</span><span style="color: rgb(51, 204, 0);">s</span><span style="color: rgb(255, 204, 51);"> P</span><span style="color: rgb(51, 51, 255);">h</span><span style="color: rgb(255, 0, 0);">o</span><span style="color: rgb(51, 204, 0);">t</span><span style="color: rgb(255, 204, 51);">o</span><span style="color: rgb(51, 51, 255);">s</span><span style="color: rgb(51, 204, 0);"></span><span style="color: rgb(255, 0, 0);"></span><span style="color: rgb(51, 51, 255);"></span><span style="color: rgb(255, 0, 0);"></span><span style="color: rgb(255, 204, 51);"></span></h1>

      </td>

    </tr>

  </tbody>
</table>

</div>

<table cellspacing="10%">

  <tbody>

    <tr align="left" valign="top">

      <td>
      <table style="width: 100%; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2">

        <tbody>

          <tr>

            <td style="text-align: center;">
            <div style="margin-left: 10px;"> <a href="acceuil.html"><big><span style="color: rgb(51, 51, 255);">Accueil</span></big></a>
            </div>

            </td>

            <td style="text-align: center;">
            <p><a href="../LEDUHTML/index.htm"><big><span style="color: rgb(255, 0, 0);">G&eacute;n&eacute;alogie</span></big></a></p>

            </td>

            <td style="text-align: center;">
            <p><a href="agenda.html"><big><span style="color: rgb(255, 203, 0);">Agenda</span></big></a></p>

            </td>

            <td style="text-align: center;">
            <p><a href="photos.php"><big><span style="color: rgb(51, 51, 255);">Photos</span></big></a></p>

            </td>

            <td style="text-align: center;">
            <p><a href="webcam.html"><big><span style="color: rgb(51, 201, 0);">Webcam</span></big></a></p>

            </td>

            <td style="text-align: center;">
            <p><a href="carte.html"><big><span style="color: rgb(255, 0, 0);">Plan</span></big></a></p>

            </td>

            <td style="text-align: center;">
            <p><a href="meteo.php"><big><span style="color: rgb(51, 51, 255);">M&eacute;t&eacute;o</span></big></a></p>

            </td>

            <td style="text-align: center;"> <a href="mailto:famille-le-du@wanadoo.fr"><big><span style="color: rgb(51, 201, 0);">E-mail</span></big></a>
            </td>

            </td>
            <td style="text-align: center;">
            <p><a href="appartement.html"><big><span style="color: rgb(255, 203, 0);">Plessis</span></big></a></p>
            </td>
          </tr>

        </tbody>
      </table>

      </td>

    </tr>

    <tr>

      <td><br>

Voici un album photo de la famille &agrave; consulter sans
mod&eacute;ration. Cet album sera compl&eacute;t&eacute;
au fur et &agrave; mesure des &eacute;v&egrave;nements.</br> Cliquer sur les photos pour les agrandir ou utiliser le diaporama<br><br>

   <table>

     <tbody>

      <tr align="left" valign="center">

      <td>
      <a target="_blank" href="diapos.php"><span style="font-weight: bold;">Lancer le diaporama en cliquant ici </span>
               </a>

       </td>
     

      <td>
      <a target="_blank" href="diapos.php"><img style="width: 122px" src="../photos/v_diaporama.gif">
               </a>

       </td>
     </tr>

      <tr align="left" valign="center">

      <td>
      <a href="adminphotos.php"><span style="font-weight: bold;">Ajouter des photos à la galerie en cliquant ici </span>
               </a>

       </td>
      
      </tr>    
    </tbody>
   </table>
      <br>

<?php
$tab_dir = array(); 
/* Lecture du repertoire pour reperer les sous-répertoires et tris des sous-répertoires suivant leur noms */
$rep = "../photos/";

/* Si il y a un parametre alors on affiche à partir du répertoire indiqué */

if($_GET["rep"] <> "")
  {
   echo "<a href=\"photos.php\">";
   echo "<span style=\"font-weight: bold;\">";
   echo "  Cliquer ici pour le retour </span>\n";
   echo "</a>\n";
   $rep=$_GET["rep"];
  }

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

/* Pour chaque sous répertoire affichage des fichier JPG */
foreach($tab_dir as $f) 
  {
    $repPhoto = $rep.$f."/";

    /* récupération du titre des photos dans le fichier titre.txt de chaque sous répertoire */
    $fichTitre = $repPhoto."titre.txt";

    if(is_file($fichTitre)) 
     {
      $fp = @fopen($fichTitre,"r"); 
      $titre = @fgets($fp, 4096); 
      @fclose($fp);
      echo "<span style=\"font-weight: bold;\"><big><br>";
      echo $titre."<br></big></span>\n";
     }


    echo "<table style=\"text-align: left; width: 100%;\" cellpadding=\"2\">\n";

    echo " <tbody>\n";

    echo " <tr>\n";

    /* Lecture des noms de fichiers JPG et tri de ceux-ci */
    $nb_fich = 0;
    $tab_fich = array(); 
    $tab_sousdir = array(); 

    $dirPhoto = opendir($repPhoto); 
    while ($P = readdir($dirPhoto)) 
     {
  
      if(is_file($repPhoto.$P) && (strtolower(substr($P,0,2)) != "v_") && 
           ((strtolower(substr($P, strrpos($P, '.'))) == ".jpg") || (strtolower(substr($P, strrpos($P, '.'))) == ".jpeg") 
            )) 
       {
        $tab_fich[] = $P; 
       }

      if(is_dir($repPhoto.$P) && ($P != ".") && ($P != "..")) 
       {
        $tab_sousdir[] = $P; 
       }

     }

    closedir($dirPhoto); 

   /* tri dans l'ordre alphabetique des noms des fichiers JPG et des sous répertoires */ 
   sort($tab_fich); 
   sort($tab_sousdir); 

   /* Pour chaque fichier JPG */
   foreach($tab_fich as $P) 
     {
        $nb_fich = $nb_fich + 1;
        if ($nb_fich > 5)
          {
           $nb_fich = 1;
           echo "</tr>\n";
           echo "<tr>\n";
          }
         echo "<td><a target=\"_blank\" href=\"diapos.php?fichier=".$repPhoto.$P."\"><img style=\"border: 0px solid ; width: 130px \"";
         echo " src=\"".$repPhoto."v_".$P."\"></a>";

         /* Recherche si il y a un titre à la photo */

         $fichTitre = substr($P,0,strrpos($P, '.')).".txt";
         $fichTitre = $repPhoto.$fichTitre;
        
         if(is_file($fichTitre)) 
           {
            $fp = @fopen($fichTitre,"r"); 
            $titre = @fgets($fp, 4096); 
            @fclose($fp);
            echo "<br>".$titre;
           }

         echo "</td>\n";
      }

   /* Pour chaque sous répertoire */
   $nbsousrep = 0;
   $finliste=" ";
   foreach($tab_sousdir as $P) 
     {
        

        if ($nbsousrep == 0)
         {
         echo "</tr>\n";
         echo "<tr>\n";

         echo "<td><a href=\"photos.php?rep=".$repPhoto."/\">";

         echo "<span style=\"font-weight: bold;\">";
         echo "Cliquer ici pour voir les photos de : </span>\n";

         echo "</a>";
         echo "<lu>\n";
         $finliste="</lu>";
         
         }

         $nbsousrep = $nbsousrep + 1;

       /* Recherche si il y a un titre dans le répertoire */

        $titre = $P;

        $fichTitre = $repPhoto.$P."/titre.txt";

        if(is_file($fichTitre)) 
         {
          $fp = @fopen($fichTitre,"r"); 
          $titre = @fgets($fp, 4096); 
          @fclose($fp);
         }

         echo "<li>";
         echo $titre;

         echo "</li>\n";
      }

    echo $finliste;
    echo "  </tr>\n";
    echo " </tbody>\n";
    echo "</table>\n";
    echo "<br>\n";

 }

?>


      </td>

    </tr>

  </tbody>
</table>

<br>

</div>

</body>
</html>
