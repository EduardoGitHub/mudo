<?php
$rss = new DOMDocument();
	$rss->load('http://www.mudominhacasa.com.br/blog/feed/');
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue
			);
		array_push($feed, $item);
	}
	
	$limit = 4;
	echo '<ol>';
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
		$link = $feed[$x]['link'];
		$description = $feed[$x]['desc'];
		$posIni =  strpos($description,'<div>');
		$posFim =  strpos($description,'</div>');
		$image = substr($description, $posIni+5,$posFim);
		//$date = date('l F d, Y', strtotime($feed[$x]['date']));
		
		echo '<li style="margin-left: 20px"><a href="'.$link.'" title="'.utf8_decode($title).'">'.$image.'</br></br>'.utf8_decode($title).'</a></li>';
	}
	echo '</ol>';


/*xm
 
$rss = 'http://blog.devintegration.locaweb.com.br/feed/';
 
 
$xml = simplexml_load_file( $rss, 'SimpleXMLElement', LIBXML_NOCDATA );
$desc = $xml->children()->channel->item[0]; //->description;
 
 
$content = $desc->children('http://purl.org/rss/1.0/modules/content/');
var_dump( $content->encoded );
 
 
exit();

*/
?>
