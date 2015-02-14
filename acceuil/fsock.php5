<?php 
  
    // Exemple de récupération d'un document via HTTP 
    // en utilisant directement les sockets. 
  
    $serveur  = "familleledu.free.fr"; 
    $document = "/"; 
  
    echo "<b>Lecture de $serveur$document</b><br />"; 
  
    $idSocket = fSockOpen($serveur, 80, $codeErreur, $msgErreur); 
    if (!$idSocket) { 
        echo "La connexion via la socket a échouée.<br />"; 
        echo "Code d'erreur: $codeErreur<br />"; 
        echo "Message d'erreur: $msgErreur<br />"; 
        die(); 
    } 
  
    // Configuration de la connexion 
    // en mode bloquant 
    // et avec un timeout de 5 minutes 
    socket_set_blocking($idSocket, TRUE); 
    socket_set_timeout($idSocket, 5, 0); 
  
  
    // Envoi de données au serveur 
    fputs($idSocket, "GET $document HTTP/1.1\r\n"); 
    fputs($idSocket, "Host: familleledu.free.fr\r\n"); 
    fputs($idSocket, "\r\n");                  // Marque la fin de l'en-tête 
  
    // Lecture de la réponse 
    while (!feof($idSocket)) { 
        $donnees = fgets($idSocket, 512); 
        echo "<xmp>$donnees</xmp>";            // Affichage du code source 
    } 
?> 
