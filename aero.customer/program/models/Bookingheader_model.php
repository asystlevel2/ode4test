<?php


class Bookingheader_model extends CI_Model
{
    private $table = "bookingheader";
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
        $search = $this->input->post('search')['value'];
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        $data = $this->db
            ->select('a.*, a.bkActualWeight as chargeableWeight, c.serviceName, (SELECT SUM(bkVolumeWeight) FROM bookingdetail WHERE a.bkCodeId = bkCodeId) as volumeWeight, (SELECT SUM(bkWeight) FROM bookingdetail WHERE a.bkCodeId = bkCodeId) as actualWeight, (SELECT bkSubCharge FROM bookingdetail WHERE a.bkCodeId = bkCodeId LIMIT 1) as subCharge', false)
            ->from($this->table." a")
            ->join('mastercust b', 'a.bkCustAcc = b.custAcc')
            ->join('mastertypeservice c', 'a.bkService = c.serviceField')
            ->where("bkBookingDate BETWEEN '$start_date' AND '$end_date'")
            ->where('bkCustAcc', $this->session->userdata('account_information')['custAcc'])
            ->group_start()
            ->like('custName', $search)
            ->or_like('bkCustAcc', $search)
            ->or_like('bkShipperName', $search)
            ->or_like('bkShipperContact', $search)
            ->or_like('bkConsigneeName', $search)
            ->group_end()
            ->get()
            ->result();

        $totalRecord = $this->db->count_all($this->table);

        return ['draw' => $this->input->post('draw'), 'recordsTotal' => $totalRecord, 'recordsFiltered' => $totalRecord, 'data' => $data];
    }

}