<?php
function sanitizeInput($input) {
    if (is_array($input)) {
        foreach ($input as &$value) {
            $value = sanitizeInput($value);
        }
        return $input;
    }
    return htmlspecialchars(strip_tags($input), ENT_QUOTES, 'UTF-8');
}
