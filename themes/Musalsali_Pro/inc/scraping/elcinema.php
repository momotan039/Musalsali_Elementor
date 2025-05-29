<?php
function getFromElcinema($show_id)
{
    // Example usage:
    $html = @file_get_contents("https://elcinema.com/work/" . $show_id . "/cast");
    if(!$html)
    return;
    // Load HTML into DOMDocument
    $dom = new DOMDocument();
    libxml_use_internal_errors(true); // Suppress warnings for invalid HTML
    
    $dom->loadHTML($html);
    libxml_clear_errors();

    // Initialize XPath
    $xpath = new DOMXPath($dom);

    //get rate
    $rateNode = $xpath->query("//span[contains(@class, 'legend')]");
    $rateVal = trim($rateNode[0]->nodeValue);
    // Find all <li> elements in the container to get actors
    $container = $xpath->query("(//ul[contains(@class, 'small-block-grid-2')])[1]/li");

    // define show info array
    $show_info = ['rating' => $rateVal];
    foreach ($container as $item) {
        // Get the <img> src
        $imgs = $xpath->query(".//img", $item);
        $imgSrc = $imgs[0]->getAttribute('data-src');
        // Get the second <li> in the description
        $description = $xpath->query(".//ul[contains(@class, 'description')]/li[1]", $item);
        $name_actor = trim($description[0]->nodeValue);

        $show_info['actors'][] = ['name' => $name_actor, 'img' => $imgSrc];
    }
    return $show_info;
}