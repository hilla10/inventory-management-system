<?php
function determineCurrentPage($request_uri) {
    $url_parts = parse_url($request_uri);
    $path = isset($url_parts['path']) ? $url_parts['path'] : '';
    $path_parts = explode('/', $path);
    
    // Get the last two parts of the path
    $last_two_parts = array_slice($path_parts, -2);
    
    // Combine the last two parts with a slash
    return implode('/', $last_two_parts);
}
?>
