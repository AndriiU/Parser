<ul class="accordion-menu">
<?php
// get country count
$a = mysqli_query($link,'SELECT COUNT(1) FROM `country`');
		 	$b = mysqli_fetch_array( $a );
		 	//echo 'find country - ' . $b[0];
$connect_to_country = mysqli_query($link,'SELECT * FROM `country`'); 
//if(!$connect_to_country) die ("Сбой при доступе к базе данных");
//$connect_to_site = mysqli_query($link,'SELECT * FROM `site`');

for ($i=0; $i < $b[0]; $i++) { 

	$row_country = mysqli_fetch_assoc($connect_to_country);
	$country_name = $row_country['country_name'];
	$country_img_link = $row_country['country_img_link'];
	$country_id = $row_country['country_id'];

	echo '<li>';
	echo '<div class="dropdownlink"><img src="../img/' . $country_img_link . '.png" class="country-logo"/> ' . $country_name . '
            <i class="fa fa-chevron-down" aria-hidden="true"></i>
          </div>';
    $connect_to_site = mysqli_query($link,'SELECT * FROM `site` where (`country` = "'. $country_id . '")');
    $c = mysqli_query($link,'SELECT COUNT(1) FROM `site`where (`country` = "'. $country_id . '")');
		 	$d = mysqli_fetch_array( $c );
		 	//echo $d[0];


    echo '<ul class="submenuItems">';
    for ($s=0; $s < $d[0]; $s++) { 

    	$row_site = mysqli_fetch_assoc($connect_to_site);
    	$country = $row_site['country'];
    	$file_name = $row_site['file_name'];
    	$site_name = $row_site['site_name'];

    	echo '<li><a href="../' . $country . '/' . $file_name . '.php">' . $site_name . '</a></li>';
    }
    echo '</ul>';
	echo '</li>';
}

?>
