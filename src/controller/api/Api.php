<?php

namespace Src\Controller\Api;

class Api
{
    protected function jsonResponse(array $response, $statusCode = 200): void
    {
        // Set the HTTP status code
        http_response_code($statusCode);

        // Set the content type to JSON
        header('Content-Type: application/json');

        // Output the JSON-encoded response
        echo json_encode($response);
        exit;
    }
}