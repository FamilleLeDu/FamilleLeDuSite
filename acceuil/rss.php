<?php

function echo_UTF8($msg)
{
  echo utf8_encode($msg);
}


echo_UTF8 ("<?xml version=\"1.0\" encoding= \"UTF-8\" ?>\n");
echo_UTF8 ("<rss version=\"2.0\">\n");
echo_UTF8 ("  <channel>\n");
echo_UTF8 ("    <title>Famille Le Du</title>\n");
echo_UTF8 ("    <link>http://familleledu.free.fr</link>\n");
echo_UTF8 ("    <description>Le site Web de la Famille Le Du</description>\n");

echo_UTF8 ("    <image>\n");
echo_UTF8 ("        <url>http://familleledu.free.fr/maison.JPG</url>\n");
echo_UTF8 ("        <link>http://familleledu.free.fr/acceuil/acceuil.html</link>\n");
echo_UTF8 ("    </image>\n");
    

/* Insertion des news */

$commentaires="news.html";

if(is_file($commentaires))
{
 // Si le fichier existe, on ouvre en lecture le fichier
 $verif=fopen($commentaires,"r");
 // On lit les données et on les stocks
 $stock=fread($verif,filesize($commentaires));
 fclose($verif);

 eregi("<li>(.*)</li>", $stock, $rawli );
 $lis = explode("<li>", $rawli[0]);
 for($i=1;$i<=5;$i++)
  {
   //recherche du titre du message
   echo_UTF8 ("    <item>\n");
   $titre = explode("</b>",$lis[$i]);
   $pos = strpos($titre[0],"<b>");
   if (is_int($pos) == false) { $pos = 0;}

   // suppression des accents
   $title=substr($titre[0],$pos+3,strlen($titre[0])-$pos-3);
//   $title = strtr($title, 'ÁÀÂÄÃÅÇÉÈÊËÍÏÎÌÑÓÒÔÖÕÚÙÛÜİ', 'AAAAAACEEEEEIIIINOOOOOUUUUY');
//   $title = strtr($title, 'áàâäãåçéèêëíìîïñóòôöõúùûüıÿ\'', 'aaaaaaceeeeiiiinooooouuuuyy ');   



   echo_UTF8 ("       <title>".$title."</title>\n");

   echo_UTF8 ("       <link>http://familleledu.free.fr/acceuil/acceuil.html</link>\n");

   // recherche du corp du message
   $msg = explode("</div>",$lis[$i]);
   $pos = strpos($msg[0],"<div>");
   if (is_int($pos) == false) 
     $pos = 0;
   else
     $pos=$pos+5;

   // si il y a une image alors il faut prendre après la balise a
   $pos_balise = strpos($msg[0],"</a>");
   if (is_int($pos_balise) == true) 
     $pos=$pos_balise+5;

   $message=substr($msg[0],$pos,strlen($msg[0])-$pos);
//   $message = strtr($message, 'ÁÀÂÄÃÅÇÉÈÊËÍÏÎÌÑÓÒÔÖÕÚÙÛÜİ', 'AAAAAACEEEEEIIIINOOOOOUUUUY');
//   $message = strtr($message, 'áàâäãåçéèêëíìîïñóòôöõúùûüıÿ\'', 'aaaaaaceeeeiiiinooooouuuuyy ');   
   
   echo_UTF8 ("       <description><![CDATA[".$message."]]></description>\n");

   
   $pos = strpos($lis[$i],"href=\"photonews/");
   if (is_int($pos) == false) 
     {
      echo_UTF8 ("    <enclosure url=\"http://familleledu.free.fr/maison.JPG\" type=\"image/jpeg\" />\n");
     }
   else
     {
      $pos=$pos+16;
      $fic = substr($lis[$i],$pos,strpos($lis[$i],"\"><img style")-$pos);
      echo_UTF8 ("    <enclosure url=\"http://plessisrobinson:frcathchnano@familleledu.free.fr/acceuil/photonews/".$fic."\" type=\"image/jpeg\" />\n");
     }

   echo_UTF8 ("    </item>\n");   

  }// fin for sur item

}// fin si le fichier news existe


echo_UTF8 ("  </channel>\n"); 
echo_UTF8 ("</rss>");
?>