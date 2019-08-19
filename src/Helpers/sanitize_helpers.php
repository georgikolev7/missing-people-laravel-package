<?php

if (!function_exists('snippet')) {
    function snippet($text, $length = 600)
    {
        // strip HTML and BB codes
        $pattern = '#(\[\w+[^\]]*?\]|\[\/\w+\]|<\w+[^>]*?>|<\/\w+>)#i';
        $text = preg_replace($pattern, '', $text);
        // remove repeated spaces and new lines
        $text = preg_replace('#\s{2,}#', PHP_EOL, $text);
        $text = trim($text, PHP_EOL);
        if (mb_strlen($text, 'UTF-8') > $length) {
            $text = utf8_substr($text, 0, $length);
            $_tmp = utf8_decode($text);
            if (preg_match('#.*([\.\s]).*#s', $_tmp, $matches, PREG_OFFSET_CAPTURE)) {
                $end_pos = $matches[1][1];
                $text = utf8_substr($text, 0, $end_pos + 1);
                $text.= ' ...';
            }
        }
        return $text;
    }
}

if (!function_exists('utf8_strlen')) {
    function utf8_strlen($string) {
    	return mb_strlen($string);
    }
}

if (!function_exists('utf8_substr')) {
    function utf8_substr($string, $offset, $length = NULL) {
        if($length == NULL)
            return mb_substr($string, $offset, utf8_strlen($string));
        else
            return mb_substr($string, $offset, $length);
    }
}
