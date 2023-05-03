<?php


class Reservationheader_model extends CI_Model
{
    private $table = "reservationheader";
    protected $db;

    public function __construct()
    {
        $this->db = $this->load->database('transaksi', true);
    }

    public function batchSaveHeader($data)
    {
        $this->db->insert_batch($this->table, $data);
    }

    public function ajaxDataTables()
    {
        $page = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search')['value'];
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $data = $this->db
            ->select('a.bkWeightRcs, a.bkCodeId, b.*, c.*')
            ->from($this->table." a")
            ->join('mastercust b', 'a.bkCustAcc = b.custAcc')
            ->join('traceheaderhawb c', 'a.bkCodeId = c.trnReffInstruction')
            ->where("bkBookingDate BETWEEN '$start_date' AND '$end_date'")
            ->where('a.bkCustAcc', $this->session->userdata('account_information')['custAcc'])
            ->group_start()
            ->like('custName', $search)
            ->or_like('bkCustAcc', $search)
            ->or_like('bkShipperName', $search)
            ->or_like('bkShipperContact', $search)
            ->or_like('bkConsigneeName', $search)
            ->group_end()
//            ->limit($length, $page)
            ->get()
            ->result();
        $totalRecord = $this->db->count_all($this->table);
        return ['draw' => $this->input->post('draw'), 'recordsTotal' => $totalRecord, 'recordsFiltered' => $totalRecord, 'data' => $data];
    }

}