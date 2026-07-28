<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\VisitorLogModel;

class VisitorTrackingFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do nothing before the request
        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        try {
            // Only track successful responses (200)
            if ($response->getStatusCode() !== 200) {
                return $response;
            }

            // Get current URI
            $uri = (string) $request->getUri();
            
            // Exclude admin routes and assets
            if (
                strpos($uri, '/admin') !== false ||
                strpos($uri, '/assets') !== false ||
                strpos($uri, '/uploads') !== false ||
                strpos($uri, '.css') !== false ||
                strpos($uri, '.js') !== false ||
                strpos($uri, '.jpg') !== false ||
                strpos($uri, '.png') !== false ||
                strpos($uri, '.gif') !== false ||
                strpos($uri, '.svg') !== false ||
                strpos($uri, '/logout') !== false ||
                strpos($uri, '/login') !== false
            ) {
                return $response;
            }

            // Get visitor data
            $ipAddress = $request->getIPAddress();
            $userAgent = $request->getUserAgent()->getAgentString();
            $pageUrl = $uri;

            // Log visitor
            $visitorModel = new VisitorLogModel();
            $visitorModel->logVisitor($pageUrl, $ipAddress, $userAgent);

        } catch (\Throwable $e) {
            // Log error but don't stop the response
            log_message('error', 'Failed to track visitor: ' . $e->getMessage());
        }

        return $response;
    }
}
