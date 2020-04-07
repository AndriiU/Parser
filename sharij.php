<?php
include 'simple_html_dom.php'; // подключаем библиотеку (заранее скаченную про нее почитать можно в нете)

$url = 'https://sharij.net/feed'; //собственно что парсим
$rss = simplexml_load_file($url); // загоняя ссылку в функцию (функция из библиотеки), получаем обьект

foreach ($rss->channel->item as $item) { //циклоп проходим по данным обьекта
        echo '<h1>'.$item->title.'</h1>'; 
        echo 'Description<br>';
        echo $item->description;
        echo '<br>Link<br>';
        //echo $item->guid;  // ссылка на страницу с полным текстом
        echo $item->link;  // ссылка на страницу с полным текстом

        // $first = $item->guid; // просто переколбас файлов не обращать внимание
        $first = $item->link; // просто переколбас файлов не обращать внимание
		$int_link = $first;

		$curl = curl_init();                                //  прогоняем ссылку через Курл
		curl_setopt($curl, CURLOPT_URL, $int_link);         //  чтоб не забанили парсер
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);      //
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);     //
		$str = curl_exec($curl);                            //
		curl_close($curl);  
		                                //
		$html= str_get_html($str);                          //  получаем всю страницу в HTML 

		///$item['contont'] = $html->find('table[class="ttxt2"]', 0)->plaintext;  // находим в каком теге находиться текст страницы
		
		$item['contont'] = $html->find('div[class="single"]', 0)->plaintext;  // находим в каком теге находиться текст страницы
		echo '<br>Content<br>';
		
		echo $item['contont']; // выводим контент

}
?>


