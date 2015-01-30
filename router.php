<?php

function match_route($request, $route) {
    //get URL argument names with preg_match_all
    $var_matches = [];
    $num_vars = preg_match_all("/\{([^\}]+)\}/", $route, $var_matches);
    $var_names = $var_matches[1];
    //replace URL arguments with regex ([^\/]+)
    $route_pattern_quote = preg_quote($route);
    $route_pattern = "|^" . preg_replace("/\\\\{[^\\\]+\\\\}/", "([^\/]+)", $route_pattern_quote) . "$|";
    //attempt a match
    $matches = [];
    $num_matches = preg_match_all($route_pattern, $request, $matches);
    if($num_matches === 0){
        return FALSE;
    }
    array_shift($matches);
    //assign matches to array with var_names as keys
    $ret = [];
    foreach ($matches as $i => $match) {
        $ret[$var_names[$i]] = $match[0];
    }
    return $ret;
}