<?php


class Mastertypeservice_model extends CI_Model
{
    private $db;
    protected $table = "mastertypeservice";

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('transaksi',  true);
    }

    public function getAll()
    {
        return $this->db
            ->where('serviceActive', 1)
            ->where('serviceFlag <>', 9, true)
            ->where('serviceCustomer', 0)
            ->get($this->table)
            ->result();
    }

    public function getParam($param)
    {
        $sql = $this->db;
        $sql->where('serviceActive', 1);
        $sql->where('serviceFlag <>', 9, true);
        $sql->where('serviceCustomer', 0);

        if (is_array($param)) {
            foreach ($param as $key => $val) {
                if (gettype($key) == 'integer') {
                    $sql->where($val, null, true);
                } else {
                    $sql->where($key, $val);
                }
            }
        }

        $query = $sql->get($this->table);

        return $query->result();
    }
}