<?php 
class ScrappingVediosUrls{
    static function getUrlsFromBresteeg($url)
    {
        $updatedUrl = str_replace('watch.php', 'play.php', $url);
    
        $ch = curl_init($updatedUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => 'Mozilla/5.0',
            CURLOPT_FOLLOWLOCATION => true
        ]);
        $html = curl_exec($ch);
        curl_close($ch);
    
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        $xpath = new DOMXPath($dom);
    
        $buttons = $xpath->query('//div[@id="WatchServers"]//button[@data-embed-url]');
        $servers = [];
    
        foreach ($buttons as $button) {
            $name = trim($button->textContent);
            $url = $button->getAttribute('data-embed-url');
            $servers[] = [
                'name' => $name,
                'url' => $url
            ];
        }
    
        return $servers;
    }

    static function getUrlsFromCimaobas($url)
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERAGENT => 'Mozilla/5.0',
        CURLOPT_FOLLOWLOCATION => true
    ]);
    $html = curl_exec($ch);
    curl_close($ch);

    libxml_use_internal_errors(true);
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);

    // Query the list of servers from the <ul> container with class "list_servers list_embedded col-sec"
    $items = $xpath->query('//ul[@class="list_servers list_embedded col-sec"]/li');
    $servers = [];

    foreach ($items as $item) {
        $name = trim($item->getElementsByTagName('strong')[0]->textContent);
        $embedUrl = $item->getAttribute('data-embed');
        $servers[] = [
            'name' => $name,
            'url' => $embedUrl
        ];
    }

    return $servers;
}

public static function getUrlsFromCimaClub($url)
{
    // Initialize cURL
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // Follow redirects if needed

    // Execute cURL and store the result
    $htmlContent = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
        return [];
    }

    // Create a new DOMDocument instance
    $doc = new DOMDocument();

    // Suppress warnings for invalid HTML (e.g., missing closing tags)
    libxml_use_internal_errors(true);

    // Load the HTML content into DOMDocument
    $doc->loadHTML($htmlContent);

    // Clear any libxml errors after loading HTML
    libxml_clear_errors();

    // Create a new XPath object to query the DOM
    $xpath = new DOMXPath($doc);

    // XPath query to find the <li> elements inside the container
    $nodes = $xpath->query('//div[@class="ServersList" and @id="WatchList"]//li');

    // Array to hold all the scraped URLs
    $serverLinks = [];

    // Loop through the nodes and extract the data-watch attribute and text content
    foreach ($nodes as $node) {
        $dataWatch = $node->getAttribute('data-watch');
        $name = trim($node->textContent); // Get the text inside the <li> (name)

        // Store name and URL in the array
        if ($dataWatch) {
            $serverLinks[] = [
                'name' => $name,
                'url' => $dataWatch
            ];
        }
    }

    // Close cURL
    curl_close($ch);

    // Return the scraped URLs
    return $serverLinks;
}

}

?>