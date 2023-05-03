<?php


class Masterhubrelasidestdetail_model extends CI_Model
{
    private $table = 'masterhubrelasidestdetail';
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('transaksi', true);
    }

    public function getRowData($param)
    {
        return $this->db->where($param)
            ->get($this->table)
            ->row_array();
    }
}