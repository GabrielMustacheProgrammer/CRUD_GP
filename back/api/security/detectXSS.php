<?php

function detectXSS($input)
{
    // Se for array, verifica recursivamente
    if (is_array($input)) {
        foreach ($input as $value) {
            if (detectXSS($value)) {
                return true;
            }
        }
        return false;
    }

    // Converte para string
    $input = strtolower(trim($input));

    // Lista de patterns perigosos
    $patterns = [
        '/<script\b/i',
        '/<\/script>/i',
        '/javascript:/i',
        '/onerror=/i',
        '/onload=/i',
        '/<img/i',
        '/<iframe/i',
        '/<svg/i',
        '/<link/i',
        '/<object/i',
        '/<embed/i',
        '/<meta/i',
        '/<style/i',
        '/<base/i',
        '/<body/i',
        '/<video/i',
        '/<audio/i'
    ];

    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $input)) {
            return true; // XSS detectado
        }
    }

    return false;
}
