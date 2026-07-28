<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorLogModel extends Model
{
    protected $table = 'visitor_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['page_url', 'ip_address', 'user_agent', 'visited_at'];
    protected $useTimestamps = false;

    /**
     * Get total visitors
     */
    public function getTotalVisitors(): int
    {
        return $this->countAllResults();
    }

    /**
     * Get visitors today
     */
    public function getVisitorsToday(): int
    {
        return $this->where('DATE(visited_at)', date('Y-m-d'))
                    ->countAllResults();
    }

    /**
     * Get visitors this week
     */
    public function getVisitorsThisWeek(): int
    {
        $startOfWeek = date('Y-m-d', strtotime('monday this week'));
        $endOfWeek = date('Y-m-d', strtotime('sunday this week'));
        
        return $this->where('DATE(visited_at) >=', $startOfWeek)
                    ->where('DATE(visited_at) <=', $endOfWeek)
                    ->countAllResults();
    }

    /**
     * Get visitors this month
     */
    public function getVisitorsThisMonth(): int
    {
        $startOfMonth = date('Y-m-01');
        $endOfMonth = date('Y-m-t');
        
        return $this->where('DATE(visited_at) >=', $startOfMonth)
                    ->where('DATE(visited_at) <=', $endOfMonth)
                    ->countAllResults();
    }

    /**
     * Get visitors by day of week (last 7 days)
     */
    public function getVisitorsByDayOfWeek(): array
    {
        $db = \Config\Database::connect();
        
        $query = $db->query("
            SELECT 
                DAYNAME(visited_at) as day_name,
                DATE(visited_at) as visit_date,
                COUNT(*) as total
            FROM visitor_logs
            WHERE visited_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
            GROUP BY DATE(visited_at), DAYNAME(visited_at)
            ORDER BY visit_date ASC
        ");
        
        return $query->getResultArray();
    }

    /**
     * Get visitors statistics for last 7 days
     */
    public function getLast7DaysStats(): array
    {
        $db = \Config\Database::connect();
        
        // Initialize array with all 7 days
        $stats = [];
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $dayName = date('D', strtotime($date)); // Mon, Tue, etc
            
            $stats[$dayName] = [
                'date' => $date,
                'day' => $dayName,
                'count' => 0
            ];
        }
        
        // Get actual data from database
        $query = $db->query("
            SELECT 
                DATE(visited_at) as visit_date,
                COUNT(*) as total
            FROM visitor_logs
            WHERE visited_at >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
            GROUP BY DATE(visited_at)
            ORDER BY visit_date ASC
        ");
        
        $results = $query->getResultArray();
        
        // Merge with actual data
        foreach ($results as $row) {
            $dayName = date('D', strtotime($row['visit_date']));
            if (isset($stats[$dayName])) {
                $stats[$dayName]['count'] = (int)$row['total'];
            }
        }
        
        return array_values($stats);
    }

    /**
     * Get unique visitors (by IP)
     */
    public function getUniqueVisitorsToday(): int
    {
        return $this->select('DISTINCT ip_address')
                    ->where('DATE(visited_at)', date('Y-m-d'))
                    ->countAllResults();
    }

    /**
     * Get most visited pages
     */
    public function getMostVisitedPages(int $limit = 5): array
    {
        return $this->select('page_url, COUNT(*) as visits')
                    ->groupBy('page_url')
                    ->orderBy('visits', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    /**
     * Log visitor
     */
    public function logVisitor(string $pageUrl, string $ipAddress, string $userAgent): bool
    {
        return $this->insert([
            'page_url' => $pageUrl,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'visited_at' => date('Y-m-d H:i:s')
        ]);
    }
}
