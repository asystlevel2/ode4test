<?php


class Masterpacking_model extends CI_Model
{
    private $db;
    protected $table = "masterpacking";
    protected $defaultParam = ['packingActive <>' => 0];

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('transaksi', true);
    }

    public function getAll()
    {
        return $this->db
            ->where($this->defaultParam)
            ->get($this->table)
            ->result();
    }

    public function getForDropDown()
    {
        $packing = $this->getAll();
        $data = [];

        foreach ($packing as $key => $value) {
            $data[$value->packingField] = $value->packingName;
        }

        return $data;
    }
}