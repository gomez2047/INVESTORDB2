
<?php
$ldap_base="dc=afdb,dc=local";
//Base utilisateurs de l'arbre LDAP
$ldap_base_users="ou=people,".$ldap_base;
//Adresse du serveur LDAP
$ldap_server="192.168.140.42";
 //Port d'ecoute du serveur LDAP
$ldap_port="389";
 $user=
//Login
$login=htmlentities($_POST['username']);//le fromat doit etre domain/user
//Password
$password=htmlentities($_POST['password']);
//---------Fonction de connexion au serveur LDAP
function ldap_logon($user, $passwd, $base, $serveur, $port) {
     $connexion_serveur = ldap_connect($serveur,$port) or die("Serveur ".$serveur." introuvable");
    $connexion_user = ldap_bind($connexion_serveur ,$user,$passwd);
 
    if ($connexion_user) {
        $resultat = $connexion_serveur;
		
    } else {
        $resultat = 0;
    }
     return $resultat;
}
 
//---------Authentification
$authentification = ldap_logon($login, $password, $ldap_base, $ldap_server, $ldap_port);
 
//---------Test de l'authentification
if($authentification==0) {
	     echo'no';

} else {
     echo'yes';

}
?>