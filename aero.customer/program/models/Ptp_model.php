<?php


class Ptp_model extends CI_Model
{
    private $db;
    private $ci;

    public function __construct()
    {
        $this->db = $this->load->database('transaksi', true);
    }

    public function saveGroup($data)
    {
        $error = new stdClass();
        $error_message = [];
        $this->db->trans_begin();
        $this->db->insert_batch('bookingheader', [$data['header']]);
        if (count($this->db->error()) > 0) {
            array_push($error_message, $this->db->error()['message']);
        }
        $this->db->insert_batch('bookingdetail', $data['detail']);
        if (count($this->db->error()) > 0) {
            array_push($error_message, $this->db->error()['message']);
        }
        $this->db->insert_batch('reservationheader', [$data['header']]);
        if (count($this->db->error()) > 0) {
            array_push($error_message, $this->db->error()['message']);
        }
        $this->db->insert_batch('reservationdetail', $data['detail']);
        if (count($this->db->error()) > 0) {
            array_push($error_message, $this->db->error()['message']);
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $error->database = $error_message;
            return ['status' => 0, 'message' => [$error]];
        }

        $this->db->trans_commit();
    }
}