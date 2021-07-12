<?php
function ParsingXMLDE($url_korr, $count, $site)
{
    require_once '../simple_html_dom.php';
	$count_korr = 1;
	$rss_korr = simplexml_load_file($url_korr, null, LIBXML_NOCDATA);
	if ($rss_korr != NULL){

		//site feed title an desc
		$feed_title = $rss_korr->channel->title;
		$feed_desc = $rss_korr->channel->description;

		echo '<div class="channel">' . $feed_title . '</div>';
		foreach ($rss_korr->channel->item as $item)
		{
			echo '<form action="../novosti.php" method="post">';
			$dt2 = date_parse_from_format("j.n.Y H:iP", $item->pubDate);
			$dt = $item->pubDate;

	        // data
			$day = $dt['day'];
	     	$month = $dt['month'];
	    	$year = $dt['year'];

	        // time
			$hour = $dt2['hour'];
			$minute = $dt2['minute'];
			if ($minute<10){
				$minute = '0' . $minute;
			}

	        // channel
	     	$channel = $rss_korr->channel->title;

		    $link = $item->link;
		    $title = $item->title;

			$description = $item->description;
			$description = str_replace('a>', "", $description);
			$description = str_replace('">', "", $description);
			$firsttitle = $title;
			$count_korr2 = $count_korr + $count;

	        echo '<div class="news-con'. $count_korr .'"><span class="date">' . $hour . '-' . $minute . ' </span>';
			echo '<a href="' . $link . '" target="_blank"><span class="title">' . $item->title . '</span></a>';

			echo '<input type="hidden" name="link-channel" value="' . $channel . $count_korr2 .'" />';
			echo '<input type="hidden" name="link-hour" value="' . $hour . $count_korr2 .'" />';
			echo '<input type="hidden" name="link-min" value="' . $minute . $count_korr2 .'" />';
			echo '<input type="hidden" name="link-ahref" value="' . $link . $count_korr2 .'" />';
			echo '<input type="hidden" name="link-title" value="' . $title . $count_korr2 .'" />';
			echo '<div class="read"><a href="' . $link . '" target="_blank">More..</a></div>';
			echo '</div>';

			if ($count_korr == 13) break;
			$count_korr++;
			echo '</form>';
		}
		echo '<div class="text" style="margin-top: 20px;">' . $feed_desc . ' | ' . $feed_title . '</div>';
	}
}

function ParsingT($url_korr, $count, $site)
{
	$count_korr = 1;
	$rss_korr = simplexml_load_file($url_korr, null, LIBXML_NOCDATA);
	if ($rss_korr != NULL){

		//site feed title an desc
		$feed_title = $rss_korr->channel->title;
		$feed_desc = $rss_korr->channel->description;
		return $feed_title;
		
	}
}

function ParsingD($url_korr, $count, $site)
{
	$count_korr = 1;
	$rss_korr = simplexml_load_file($url_korr, null, LIBXML_NOCDATA);
	if ($rss_korr != NULL){

		//site feed title an desc
		$feed_title = $rss_korr->channel->title;
		$feed_desc = $rss_korr->channel->description;
		return $feed_desc;
		
	}
}

function Page($link_feed)
{
	$case = 1;
	$connect_to_site = mysqli_query($link,'SELECT * FROM `site` where (`file_name` = "'. $file . '")');
	$row_site = mysqli_fetch_assoc($connect_to_site);
	$site = $row_site['site_name'];
	
    header('Content-Type: text/html; charset=utf-8');
	include '../header.php';

	

	echo '<div class="slides">';
	echo '<div class="slide3">';
	echo'<span class="news-block" id="censor">';
	ParsingXMLDE($link_feed, $case, $site);
	echo'</span></div></div>';
	include '../footer.php';


}


function Country($country_id)
{

include '../header.php';

echo " intro function = " . $country_id;
$country_id = "au";


    $connect_to_site = mysqli_query($link,'SELECT * FROM `site` where (`country` = "'. $country_id . '")');
    $c = mysqli_query($link,'SELECT COUNT(1) FROM `site`where (`country` = "'. $country_id . '")');
	$d = mysqli_fetch_array( $c );



    echo '<ul class="">';
    for ($s=0; $s < $d[0]; $s++) {

    	$row_site = mysqli_fetch_assoc($connect_to_site);
    	$country = $row_site['country'];
    	$file_name = $row_site['file_name'];
    	$site_name = $row_site['site_name'];

    	echo '<li><a href="../' . $country . '/' . $file_name . '.php">' . $site_name . '</a></li>';
    }
    echo '</ul>';

include '../footer.php';
}

?>
