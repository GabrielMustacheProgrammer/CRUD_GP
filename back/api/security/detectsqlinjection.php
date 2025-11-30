<?php
function detectSqlInjection($input)
{
    
    $patterns = [
        '/\bSELECT\b/i',
        '/\bINSERT\b/i',
        '/\bUPDATE\b/i',
        '/\bDELETE\b/i',
        '/\bDROP\b/i',
        '/\bALTER\b/i',
        '/\bUNION\b/i',
        '/\bCREATE\b/i',
        '/\bREPLACE\b/i',
        '/--/',
        '/#/',
        '/\/\*/',
        '/\*\//',
        '/;/'
    ];

    
    if (is_array($input)) {
        foreach ($input as $value) {
            if (detectSqlInjection($value)) {
                return true;
            }
        }
        return false;
    }

    
    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $input)) {
            return true; 
        }
    }

    return false;
}
