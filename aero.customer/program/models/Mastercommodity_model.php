<?php


class Mastercommodity_model extends CI_Model
{
    private $db;
    private $table = "mastercommodity";

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('transaksi', true);
    }

    public function getAll()
    {
        return $this->db
            ->where('is_active', 1)
            ->get($this->table)
            ->result();
    }
}