<?php
// TMDb API Key
$apiKey = get_option('tmdb_key');

// Step 1: Get rating and media type using /find/{external_id}
function getRateAndMediaType($externalId) {
    global $apiKey;
    $url = "https://api.themoviedb.org/3/find/$externalId?api_key=$apiKey&external_source=imdb_id";
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    // Extract movie or TV show details
    if (!empty($data['movie_results'])) {
        $media = $data['movie_results'][0];
        return [
            'id' => $media['id'],
            'type' => 'movie',
            'rating' => $media['vote_average']
        ];
    } elseif (!empty($data['tv_results'])) {
        $media = $data['tv_results'][0];
        return [
            'id' => $media['id'],
            'type' => 'tv',
            'rating' => $media['vote_average']
        ];
    }

    return null; // No results found
}

// Step 2: Get actors using the media type and ID
function getActors($id, $type) {
    global $apiKey;
    $url = "https://api.themoviedb.org/3/$type/$id/credits?api_key=$apiKey";
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    $actors = [];
    if (!empty($data['cast'])) {
        foreach ($data['cast'] as $actor) {
            $actors[] = [
                'name' => $actor['name'],
                'img' => !empty($actor['profile_path']) ? "https://image.tmdb.org/t/p/w500" . $actor['profile_path'] : null
            ];
        }
    }
    return $actors;
}

// Step 3: Combine rate and actors
function getRateAndActors($externalId) {
    global $apiKey;
    $mediaData = getRateAndMediaType($externalId);
    if ($mediaData) {
        $actors = getActors($mediaData['id'], $mediaData['type'], $apiKey);
        return [
            'rating' =>  number_format($mediaData['rating'],1),
            'actors' => $actors
        ];
    }

    return null; // No data found
}

