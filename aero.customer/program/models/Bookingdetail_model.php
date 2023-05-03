<?php


class Bookingdetail_model extends CI_Model
{
    protected $table = "bookingdetail";
    private $db;

    public function __construct()
    {
        $this->db = $this->load->database('transaksi', true);
    }

    public function batchSaveDetail($data)
    {
        $this->db->insert_batch($this->table, $data);
    }

    public function ajaxGetDetailByCodeId()
    {
        return $this->db->where('bkCodeId', $this->input->post('bkCodeId'))
            ->get($this->table)
            ->result();
    }
}