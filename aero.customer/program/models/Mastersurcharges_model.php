<?php


class Mastersurcharges_model extends CI_Model
{
    private $db;
    private $table = "mastersurcharges";

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('transaksi', true);
    }

    public function getAll()
    {
        return $this->db
            ->where('surchargesActive <>', 0, true)
            ->get($this->table)
            ->result();
    }

    public function find($param)
    {
        $query = $this->db
            ->where($param)
            ->get($this->table);
        return $query->row();
    }

    public function getForDropDown()
    {
        $surcharge = $this->getAll();
        $data = [];

        foreach ($surcharge as $key => $value) {
            $data[$value->surchargesCode] = $value->surchargesCommodity;
        }

        return $data;
    }
}