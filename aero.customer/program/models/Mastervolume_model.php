<?php


class Mastervolume_model extends CI_Model
{
    private $table = "mastervolume";
    protected $db;
    protected $defaultParam = ['volumeActive <>' => 0, 'volumeFlag <>' => 9];

    public function __construct()
    {
        $this->db = $this->load->database('transaksi', true);
    }

    public function getAll()
    {
        return $this->db
            ->where('volumeActive', 1)
            ->where('volumeFlag <>', 9, true)
            ->get($this->table)
            ->result();
    }

    public function getRowUdara()
    {
        return $this->db
            ->where(['volumeField' => 'Udara'])
            ->where($this->defaultParam)
            ->get($this->table)
            ->row_array();
    }
}