<?php


class Masterdirectory_model extends CI_Model
{
    protected $table = "masterdirectory";
    private $db;

    public function __construct()
    {
        $this->db = $this->load->database('transaksi', true);
    }

    public function get()
    {
        return $this->db->get($this->table)
            ->result();
    }

    public function getPtp()
    {
        return $this->db
            ->where('direcGroup', 'PTP')
            ->where('direcActive <>', 0, true)
            ->get($this->table)
            ->result();
    }

    public function getHubPtp($param)
    {
        return $this->db
            ->where($param)
            ->get($this->table)
            ->row();
    }

    public function valid_directory_rules($value)
    {
        $val = explode('@', $value);
        return $this->db->where('direcCityName', $val[0])
            ->get($this->table)
            ->num_rows();
    }
}