<?php


class Mastertypepayment_model extends CI_Model
{
    private $db;
    protected $table = "mastertypepayment";
    protected $defaultParam = ['paymentActive <>' => 0, 'paymentFlag <>' => 9];

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