<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Reverse Routing
 *
 * @author        AJ Heller <aj@drfloob.com>
 * @link        http://drfloob.com/
 *
 * Edited by LimpidCMS
 */
if (!function_exists('route')) {
    function route($uri = '')
    {
        $Router =& load_class('Router');

        $uri = trim($uri, '/');

        $routes = $Router->routes;

        foreach ($routes as $key => $val) {
            if (preg_match('/[^\(][.+?{\:]/', $key))
                continue;

            if (strpos($val, '$') !== FALSE AND strpos($key, '(') !== FALSE) {
                preg_match_all('/\(.+?\)/', $key, $keyRefs);
                preg_match_all('/\$.+?/', $val, $valRefs);

                $keyRefs = $keyRefs[0];
                $uriRegex = $val;

                $goodValRefs = array();
                foreach ($valRefs[0] as $ref) {
                    $tempKey = substr($ref, 1);
                    if (is_numeric($tempKey)) {
                        --$tempKey;
                        $goodValRefs[$tempKey] = $ref;
                    }
                }

                foreach ($goodValRefs as $tempKey => $ref) {
                    if (isset($keyRefs[$tempKey])) {
                        $uriRegex = str_replace($ref, $keyRefs[$tempKey], $uriRegex);
                    }
                }
                $uriRegex = str_replace(':any', '.+', str_replace(':num', '[0-9]+', $uriRegex));

                if (preg_match('#^' . $uriRegex . '$#', $uri)) {
                    $key = str_replace(':any', '.+', str_replace(':num', '[0-9]+', $key));
                    $routeString = preg_split('/\(.+?\)/', $key);

                    $replacement = '';
                    $rsEnd = count($routeString) - 1;

                    for ($i = 0; $i < $rsEnd; $i++) {
                        $replacement .= $routeString[$i] . $valRefs[0][$i];
                    }
                    $replacement .= $routeString[$rsEnd];

                    $customURI = preg_replace('#^' . $uriRegex . '$#', $replacement, $uri);

                    return site_url($customURI);
                }
            } elseif ($val == $uri)
                return site_url($key);
        }

        return site_url($uri);
    }
}
