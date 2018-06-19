
<?php
    // Defining the basic cURL function
    function curl($url) {
        $ch = curl_init();  // Initialising cURL
        curl_setopt($ch, CURLOPT_URL, $url);    // Setting cURL's URL option with the $url variable passed into the function
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Setting cURL's option to return the webpage data
        $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
        curl_close($ch);    // Closing cURL
        return $data;   // Returning the data from the function
    }
	function scrape_between($data, $start, $end){
        $data = stristr($data, $start); // Stripping all data from before $start
        $data = substr($data, strlen($start));  // Stripping $start
        $stop = stripos($data, $end);   // Getting the position of the $end of the data to scrape
        $data = substr($data, 0, $stop);    // Stripping all data from after and including the $end of the data to scrape
        return $data;   // Returning the scraped data from the function
    }
	$scraped_page = curl("https://www.lemonde.fr/");  // Executing our curl function to scrape the webpage and return the results into the $scraped_website variable
	$scraped_data = strip_tags(scrape_between($scraped_page, "<h1 class=\"tt3  \">", "<ul class=\"liste_carre liste_une\">"));  
    $scraped_data = str_replace('&eacute;', 'é', $scraped_data);
    $scraped_data = str_replace('&rsquo;', '\'', $scraped_data);
    $scraped_data = str_replace('&nbsp;', ' ', $scraped_data);
    $scraped_data = str_replace('&laquo;', '<<', $scraped_data);
    $scraped_data = str_replace('&raquo;', '>>', $scraped_data);
	//$scraped_data = mb_convert_encoding($scraped_data, "UTF8", "auto");
	echo $scraped_data;
//	echo "\n";
	$msg = "Le Monde: " . $scraped_data;
    $url = "https://smsapi.free-mobile.fr/sendmsg?user=*****&pass=*****&msg=" . urlencode($msg);
    $a = curl($url);
	$figaro = curl("http://www.lefigaro.fr/");
	$mostShared = "Le Figaro: " . scrape_between($figaro, "<span class=\"fig-toparticles__item-title-inner\">", "</span>");
	echo mb_detect_encoding($mostShared, "auto");
	$a = curl("https://smsapi.free-mobile.fr/sendmsg?user=*****&pass=******&msg=" . $mostShared);
	
	$meteo = curl("http://france.lachainemeteo.com/meteo-france/ville/previsions-meteo-orleans-3846-0.php");
    $meteoToSend = strip_tags(scrape_between($meteo, "<div id=\"texte_description\">", "<div class=\"lien_transversaux\">"));

	$meteoToSend2 = strip_tags(scrape_between($meteo, "<div id=\"contenu_hparh\">", "<div class=\"survol_echeance locHHQJ\" num_survol_qj=\"2\">"));
	$meteoToSend = mb_convert_encoding($meteoToSend, "UTF-8", "ASCII");
    $meteoToSend2 = mb_convert_encoding($meteoToSend2, "UTF-8", "ASCII");
//	echo mb_detect_encoding($meteoToSend, "auto" );
	echo $meteoToSend;
    echo $meteoToSend2;
    $url = urlencode($meteoToSend2);
    $url = str_replace("%0A", "", $url);
    $url = str_replace("%0D", "", $url);
    $url = str_replace("%09", "", $url);
    $url = str_replace("%26deg", "°", $url);
    $url = str_replace("h", "h ", $url);
    $url = str_replace("km/h", "km/h\n", $url);
    echo $url;
    $a = curl("https://smsapi.free-mobile.fr/sendmsg?user=****&pass=*******&msg=" . urlencode($meteoToSend));
    $a = curl("https://smsapi.free-mobile.fr/sendmsg?user=****&pass=****&msg=" . $url);
?>
