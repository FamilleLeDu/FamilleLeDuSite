<?php

function fctremplacecar($msg)
{
$msg=html_entity_decode($msg,ENT_NOQUOTES);
$msg = nl2br($msg);
$msg = str_replace("\\'","'",$msg);
$msg = str_replace("\\\"","\"",$msg);
}

// assignons les variables du formulaire
$rep=htmlentities($_POST['rep']);
$titrerep=htmlentities($_POST['titrerep']);
$titreimage= array();
$titreimage[0]=htmlentities($_POST['titreimage1']);
$titreimage[1]=htmlentities($_POST['titreimage2']);
$titreimage[2]=htmlentities($_POST['titreimage3']);
$titreimage[3]=htmlentities($_POST['titreimage4']);
$titreimage[4]=htmlentities($_POST['titreimage5']);
$files = array();
$files[0]=$_FILES['fichier_source1'];
$files[1]=$_FILES['fichier_source2'];
$files[2]=$_FILES['fichier_source3'];
$files[3]=$_FILES['fichier_source4'];
$files[4]=$_FILES['fichier_source5'];


if (trim($rep)=="" && trim($_FILES['fichier_source1']['name'])=="" 
    && trim($_FILES['fichier_source2']['name'])==""
    && trim($_FILES['fichier_source3']['name'])==""
    && trim($_FILES['fichier_source4']['name'])==""
    && trim($_FILES['fichier_source5']['name'])=="")
{
 // on affiche la page de d�part si on a appel� la page sans passer par le formulaire et pour revenir en automatique
 header("Location: http://familleledu.free.fr/acceuil/adminphotos.php");     
 // On sort du script !
 exit;
}

if (trim($rep)=="")
{
  echo "Vous devez indiquer un r�pertoire de destination ! <a href=\"adminphotos.php\"> Retour </a>";
 // On sort du script !
 exit;
}


// On v�rifie qu'il y a au moins une image
if (trim($_FILES['fichier_source1']['name'])=="" 
    && trim($_FILES['fichier_source2']['name'])==""
    && trim($_FILES['fichier_source3']['name'])==""
    && trim($_FILES['fichier_source4']['name'])==""
    && trim($_FILES['fichier_source5']['name'])==""
   )
{
        echo "Vous devez mettre au moins une image ! <a href=\"adminphotos.php\"> Retour </a>";
       
        // On sort du script !
        exit;
}

echo "<br> Chargement des Photos en cours .... <br>";


for ($i=0;$i<5;$i++)
{

// Si il y a un fichier Image � charger
if(!empty($files[$i]['tmp_name']))
{
 // On verifie si l'upload dans le repertoire temp est OK
 if(!is_uploaded_file($files[$i]['tmp_name']))
 {
        echo "Upload du fichier image incorrect ! <a href=\"admiphotos.php\"> Retour </a>";       
        // On sort du script !
        exit;
 }


 //On va v�rifier la taille du fichier en ne passant pas par $_FILES['fichier_source']['size'] pour �viter les failles de s�curit�
 if(filesize($files[$i]['tmp_name'])>10240000)
 {
        echo "Le fichier image est trop grand (MAX 10Mo)! <a href=\"admiphotos.php\"> Retour </a>";       
        // On sort du script !
        exit;
 }

 //On v�rifie maintenant le type de l'image � l'aide de la fonction getimagesize()
 list($largeur, $hauteur, $type, $attr)=getimagesize($files[$i]['tmp_name']);


 //Le Type est JPEG (correspond au chiffre 2)
 if($type!==2)
 {
        echo "Le fichier image doit �tre au format JPEG ! <a href=\"admiphotos.php\"> Retour </a>";       
        // On sort du script !
        exit;
 }

} // fin if fichier image � charger

}// fin for


//V�rification du r�pertoire 
$tab_dir = array(); 
/* Lecture du repertoire pour reperer les sous-r�pertoires et tris des sous-r�pertoires suivant leur noms */
$chemin = "../photos/";


if ($rep == "NEW") // Cas d'un nouveau r�pertoire
  {
   // Verification qu'il y a un titre au r�pertoire
   if (trim(titrerep)=="")
     {
        echo "Vous devez donner un titre au r�pertoire ! <a href=\"adminphotos.php\"> Retour </a>";  
        // On sort du script !
        exit;
     }

   //recherche du n� du nouveau r�pertoire
   $dir = opendir($chemin); 

   while ($f = readdir($dir)) 
    {
     if(is_dir($chemin.$f) && ($f != ".") && ($f != "..")) 
      {
       $tab_dir[] = $f; 
      }
    }
   closedir($dir); 
   /* tri dans l'ordre alphabetique inverse*/ 
   arsort($tab_dir);
   foreach($tab_dir as $f)
     {
      $n = sscanf(substr($f,0,2),"%d",$nbrep);
      break;
     }


   $except = array('\\', '/', ':', '*', '?', '"', '<', '>', '|','!','(',')','.','%',' ',';','�','�','�','�','�','�','-','&','�','�'); 
   $newrep = $titrerep;
   fctremplacecar(&$newrep);
   $newrep=sprintf("%02d%s",$nbrep+1,str_replace($except, '',strtoupper($newrep)));
   if (strlen($newrep)> 20)
     $newrep=substr($newrep,0,20);

   // Cr�ation du r�pertoire
   mkdir($chemin.$newrep, 0700);
   $rep = $newrep; 
  }

// Cr�ation du fichier titre du r�pertoir


if(!is_file($chemin.$rep."/titre.txt"))
  {
   // si le fichier n'existe pas on le cr�e 
   $verif=fopen($chemin.$rep."/titre.txt","w+");
   // enregistrement du titre du r�pertoire
   fputs($verif,$titrerep);
   // On clos le fichier
   fclose($verif);
  }

// enregistrement des photos
$except_fic = array('*', '?', '"', '<', '>', '|','!','(',')','%',' ',';','�','�','�','�','�','�','-','&','�','�'); 
$ratio = 486;// taille en pixel des photos 648x486
$ratio_v = 122;// taille en pixel des vignettes 162x122

for ($i=0;$i<5;$i++)
 if (strlen($files[$i]['name']) > 0)   
  {
   // Cr�ation du nom du fichier
   $name_fic = str_replace($except_fic, '',strtoupper($files[$i]['name']));
   if (strlen($name_fic)> 20)
     $name_fic=substr($name_fic,-20,20);

   if (!is_file($chemin.$rep."/".$name_fic))
     {
      list($largeur, $hauteur, $type, $attr)=getimagesize($files[$i]['tmp_name']);
 
      // on cr�e une image � partir de notre grande image � l'aide de la librairie GD 
      $src = imagecreatefromjpeg($files[$i]['tmp_name']); 
      if (!$src)
        echo "Erreur imagecreatefromjpeg";

      // on teste si notre image est de type paysage ou portrait 
      if ($largeur > $hauteur) 
        { 
         $im = imagecreatetruecolor(round(($ratio/$hauteur)*$largeur), $ratio); 
         if (!$im)
            echo "erreur imagecreatetruecolor";
         if (!imagecopyresampled($im, $src, 0, 0, 0, 0, round(($ratio/$hauteur)*$largeur), $ratio, $largeur, $hauteur))
            echo "erreur imagecopyresampled"; 
        } 
      else 
        { 
         $im = imagecreatetruecolor($ratio, round(($ratio/$largeur)*$hauteur)); 
         if (!$im)
            echo "erreur imagecreatetruecolor";
         if (!imagecopyresampled($im, $src, 0, 0, 0, 0, $ratio, round($hauteur*($ratio/$largeur)), $largeur, $hauteur)) 
            echo "erreur imagecopyresampled"; 
        }
      // on copie notre fichier g�n�r� dans le r�pertoire 

      if (!imagejpeg ($im, $chemin.$rep."/".$name_fic))
        echo "Erreur imagejpeg"; 

      imagedestroy($im);
      imagedestroy($src);
   
    }// fin cr�ation du fichier photo

  // cr�ation de la vignette
   $name_fic = str_replace($except_fic, '',strtoupper($files[$i]['name']));
   if (strlen($name_fic)> 20)
   $name_fic=substr($name_fic,-20,20);

   if (!is_file($chemin.$rep."/v_".$name_fic))
     {
      list($largeur, $hauteur, $type, $attr)=getimagesize($files[$i]['tmp_name']);
 
      // on cr�e une image � partir de notre grande image � l'aide de la librairie GD 
      $src = imagecreatefromjpeg($files[$i]['tmp_name']); 
      if (!$src)
        echo "Erreur imagecreatefromjpeg";

      // on teste si notre image est de type paysage ou portrait 
      if ($largeur > $hauteur) 
        { 
         $im = imagecreatetruecolor(round(($ratio_v/$hauteur)*$largeur), $ratio_v); 
         if (!$im)
            echo "erreur imagecreatetruecolor";
         if (!imagecopyresampled($im, $src, 0, 0, 0, 0, round(($ratio_v/$hauteur)*$largeur), $ratio_v, $largeur, $hauteur))
            echo "erreur imagecopyresampled"; 
        } 
      else 
        { 
         $im = imagecreatetruecolor($ratio_v, round(($ratio_v/$largeur)*$hauteur)); 
         if (!$im)
            echo "erreur imagecreatetruecolor";
         if (!imagecopyresampled($im, $src, 0, 0, 0, 0, $ratio_v, round($hauteur*($ratio_v/$largeur)), $largeur, $hauteur)) 
            echo "erreur imagecopyresampled"; 
        }
      // on copie notre fichier g�n�r� dans le r�pertoire 
      if (!imagejpeg ($im, $chemin.$rep."/v_".$name_fic))
        echo "Erreur imagejpeg"; 

      imagedestroy($im);
      imagedestroy($src);
   
    }// fin cr�ation du fichier vignette

  // cr�ation du fichier titre image
  if (strlen($titreimage[$i]) > 0)
     {
      $name_fic = str_replace($except_fic, '',strtoupper($files[$i]['name']));
      if (strlen($name_fic)> 20)
        $name_fic=substr($name_fic,-20,20);

      $path_parts = pathinfo($name_fic);
      $name_fic = str_replace(".".$path_parts['extension'],".txt",$path_parts['basename']);

      if(!is_file($chemin.$rep."/".$name_fic))
       {
        // si le fichier n'existe pas on le cr�e 
        $verif=fopen($chemin.$rep."/".$name_fic,"w+");
        // enregistrement du titre du r�pertoire
        fputs($verif,$titreimage[$i]);
        // On clos le fichier
        fclose($verif);
       }
     } // fin cr�ation fichier titre image
  } // fin for sur photos


// on affiche un message OK

 echo "<html><head><META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=\"adminphotos.php\"></head>";
 echo "<body><b><h2>Vos photos ont �t� enriegistr�es</h2> </b>";
 echo "<h3>Si le retour n'est pas automatique apr�s quelque secondes <a href=\"adminphotos.php\">cliquez sur ici</a></h3></body>";


?>
