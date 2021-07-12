<?
include 'function.php';
include 'header.php';

echo '<div style="margin-top:42px;"></div>';
function _auth(){
    
    $pass = 'pass';
    if ( isset($_POST['pass_value'], $_POST['pass_btn']) ) {
        if ($pass == $_POST['pass_value']) {
            $_SESSION['unique_sdfcdrgbtrhbgfnb'] = true;
        } else {
            $_SESSION['sdfcdrgbtrhbgfnb'] = false;
            echo '<div>Failed password</div>';
        }
    }
    if ($_SESSION['unique_sdfcdrgbtrhbgfnb'] !== true) {
        echo '<form method="POST">'.
        '<div>Enter password:<br /><input type="text" name="pass_value" size="30" /></div>'.
        '<div><input type="submit" value="Enter" name="pass_btn" /></div>'.
        '</form>';
        die();
    }
}

_auth();

// insert country
    	echo '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';
		echo '<div class="form-group">';
		echo '<label for="exampleFormControlInput1">Country ID</label>';
		echo '<input class="form-control" id="exampleFormControlInput1" type="text" name="country_id">';
		echo '<label for="exampleFormControlInput1">Country Name</label>';
		echo '<input class="form-control" id="exampleFormControlInput1 "type="text" name="country_name">';
		echo '<label for="exampleFormControlInput1">Img Link</label>';
		echo '<input class="form-control" id="exampleFormControlInput1" type="text" name="country_img_link">';
		echo '<br>';
		echo '<input type="submit" class="btn btn-primary" name="add">';
		echo '</div></form>';

if (isset($_POST['add'])){

		$country_id = $_POST['country_id'];
		$country_name = $_POST['country_name'];
		$country_img_link = $_POST['country_img_link'];

		mysqli_query($link,"INSERT INTO country (country_id,country_name,country_img_link) VALUES ('$country_id','$country_name','$country_img_link')");
		mkdir($country_id, 0755);
}

// insert site
		echo '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';
		echo '<div class="form-group">';
		echo '<label for="exampleFormControlInput1">Site name</label>';
		echo '<input class="form-control" id="exampleFormControlInput1" type="text" name="site_name">';
		echo '<label for="exampleFormControlInput1">File Name</label>';
		echo '<input class="form-control" id="exampleFormControlInput1" type="text" name="file_name">';
		echo '<label for="exampleFormControlInput1">Link feed</label>';
		echo '<input class="form-control" id="exampleFormControlInput1" type="text" name="link_feed">';
		echo '<label for="exampleFormControlInput1">Country</label>';
		echo '<input class="form-control" id="exampleFormControlInput1" type="text" name="country_select">';
		echo '<br>';
		echo '<input type="submit" class="btn btn-primary" name="add-site">';
		echo '</div></form>';

if (isset($_POST['add-site'])){

		$site_name = $_POST['site_name'];
		$file_name = $_POST['file_name'];
		$link_feed = $_POST['link_feed'];
		$country_select = $_POST['country_select'];

		mysqli_query($link,"INSERT INTO site (site_name,file_name,link_feed,country) VALUES ('$site_name','$file_name','$link_feed','$country_select')");

		//$work_dir = $HTTP_SERVER_VARS['DOCUMENT_ROOT'];


		chdir($country_select);
		$file = $file_name . '.php';
		if( !file_exists($file)) {
		$fp = fopen($file, "w");
		fwrite($fp, '<?php
		include "../function.php";
		Page("' . $link_feed . '");
		?>');
		fclose ($fp);
		}

}




mysqli_close($link);
$site_name = "";
$file_name = "";
$link_feed = "";
$country_select = "";
include 'footer.php';
?>
