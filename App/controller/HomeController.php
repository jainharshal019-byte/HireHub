<?php

namespace App\Controllers;

use Framework\Database;

class HomeController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        try {
            $this->db = new Database($config);
        } catch (\Throwable $e) {
            $this->db = null;
        }
    }

    private function fetchListings()
    {
        if (!$this->db) {
            return [];
        }

        try {
            return $this->db->query('SELECT * FROM listings ORDER BY created_at DESC LIMIT 6')->fetchAll();
        } catch (\Throwable $e) {
            return [];
        }
    }

    /*
   * Show the latest listings
   * 
   * @return void
   */
    public function index()
    {
        loadView('home', [
            'listings' => $this->fetchListings()
        ]);
    }
}
?>
