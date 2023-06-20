<?php
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,"http://projets-tomcat.isep.fr:8080/appService?ACTION=GETLOG&TEAM=G02A");
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$data = curl_exec($ch);
curl_close($ch);


define('DB_USERNAME', 'u565232470_healthyvibe');
define('DB_PASSWORD', 'HealthyVibe2023');
define('DB_HOST', 'localhost');
define('DB_NAME', 'u565232470_HealthyVibe');

$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

$data_tab = str_split($data,33);
for($i=0;$i<count($data_tab)-1; $i++){
    $trame = $data_tab[$i];
    $t = substr($trame,0,1); 
    $o = substr($trame,1,4);
    echo "<br/>";
    echo "<br/>";
    list($t, $o, $r, $c, $n, $v, $a, $x, $year, $month, $day, $hour, $min, $sec) = sscanf($trame,"%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
    echo("<br />$t,$o,$r,$c,$n,$v,$a,$x,$year,$month,$day,$hour,$min,$sec<br />");
    $dateAVerifier = $year."-".$month."-".$day." ".$hour.":".$min.":".$sec;
    echo $dateAVerifier."<br/>";

    $timestampAVerifier = mktime($hour, $min, $sec, $month, $day, $year);

    // Obtenir le timestamp actuel
    $timestampActuel = time() + 2*3600;

    // Soustraire une minute en secondes du timestamp actuel
    $timestampUneMinuteAvant = $timestampActuel - 60;

    echo $timestampAVerifier."<br/>";
    echo $timestampActuel."<br/>";
    echo $timestampUneMinuteAvant."<br/>";

    // Comparer la date à vérifier avec la date une minute avant
    $n = intval($n);
    if ($timestampAVerifier >= $timestampActuel - 60 && $n != 0) {
        echo "Trame Valide";
        if ($n == 3 || $n == 7) {
            $v = hexdec($v);
        } else {
            $v /= 10;
        } 
        $req = "INSERT INTO `donnee`(`valeur`, `date`, `idCapteur`) VALUES ('$v', '$dateAVerifier', $n)";
        $result = $co->query($req);
    } else {
        echo "Trame trop vieille ou de test";
    }
}

?>