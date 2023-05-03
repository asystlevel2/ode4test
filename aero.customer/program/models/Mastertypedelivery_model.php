<?php


class Mastertypedelivery_model extends CI_Model
{
    private $db;
    protected $table = "mastertypedelivery";
    protected $defaultParam = ['deliveryFlag <>' => 9, 'deliveryActive <>' => 0, 'deliveryCustomer' => 0];

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
}