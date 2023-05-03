<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ptpservices
{
    private $ci;
    protected $errorMessage = [];
    protected $validated = 0;

    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->helper(['calculate_helper', 'hash_helper']);
        $this->ci->load->model(['Masterhubrelasidestdetail_model', 'Mastervolume_model', 'Mastersurcharges_model']);
    }

    public function initializeData()
    {
        $header = [];
        $detail = [];
        $customer_account = $this->ci->session->userdata('account_information');

        $header['bkCodeId'] = uniqidReal(10);
        $header['bkCustAcc'] = $this->ci->input->post('bk_shipper_account');
        $header['bkBookingDate'] = date('Y-m-d', strtotime($this->ci->input->post('bk_date')));
        $header['bkShipperName'] = $this->ci->input->post('bk_shipper_name');
        $header['bkShipperAlamat1'] = $this->ci->input->post('bk_shipper_alamat1');
        $header['bkShipperAlamat2'] = $this->ci->input->post('bk_shipper_alamat2');
        $header['bkShipperAlamat3'] = $this->ci->input->post('bk_shipper_alamat3');
        $header['bkShipperCity'] = $this->ci->input->post('bk_shipper_city');
        $header['bkShipperOrg'] = $this->ci->input->post('bk_shipper_kd_city');
        $header['bkShipperPos'] = $this->ci->input->post('bk_shipper_kd_pos');
        $header['bkShipperContact'] = $this->ci->input->post('bk_shipper_contact');
        $header['bkShipperPhone'] = $this->ci->input->post('bk_shipper_phone');
        $header['bkShipperFax'] = $this->ci->input->post('bk_shipper_fax');
        $header['bkConsigneeName'] = $this->ci->input->post('bk_consignee_name');
        $header['bkConsigneeAlamat1'] = $this->ci->input->post('bk_consignee_alamat1');
        $header['bkConsigneeAlamat2'] = $this->ci->input->post('bk_consignee_alamat2');
        $header['bkConsigneeAlamat3'] = $this->ci->input->post('bk_consignee_alamat3');
        $header['bkConsigneeCity'] = $this->ci->input->post('bk_consignee_city');
        $header['bkConsigneeDest'] = $this->ci->input->post('bk_consignee_kd_city');
        $header['bkConsigneePos'] = $this->ci->input->post('bk_consignee_kd_pos');
        $header['bkBranch'] = $this->ci->input->post('bk_shipper_origin');
        $header['bkDestination'] = $this->ci->input->post('bk_consignee_destination');
        $header['bkConsigneeContact'] = $this->ci->input->post('bk_consignee_contact');
        $header['bkConsigneePhone'] = $this->ci->input->post('bk_consignee_phone');
        $header['bkConsigneeFax'] = $this->ci->input->post('bk_consignee_fax');
        $header['bkActualWeight'] = $this->ci->input->post('bk_total_weight');
        $header['bkRequestColly'] = $this->ci->input->post('bk_total_colly');
        $header['bkTotalColly'] = $this->ci->input->post('bk_total_colly');
        $header['bkService'] = $this->ci->input->post('bk_service');
        $header['bkTransporter'] = 'UDARA';
        $header['bkPayment'] = $this->ci->input->post('bk_payment');
        $header['bkPackage'] = 'SPS';
        $header['bkSpecialInstruction'] = $this->ci->input->post('bk_special_instruction');
        $header['bkContentOfGoods'] = $this->ci->input->post('bk_content_of_goods')."-".$this->ci->input->post('bk_commodity');
        $header['bkInsertBy'] = $customer_account['customer_id'];
        $header['bkInsertDate'] = date('Y-m-d H:i:s');

        $colly = $this->ci->input->post('bk_colly');
        $dimensi_L = $this->ci->input->post('bk_dimensi_L');
        $dimensi_W = $this->ci->input->post('bk_dimensi_W');
        $dimensi_H = $this->ci->input->post('bk_dimensi_H');
        $volumeWeight = $this->ci->input->post('bk_volume_weight');
        $weight = $this->ci->input->post('bk_weight');
        $chargePacking = $this->ci->input->post('bk_type_pac');
        $subCharge = $this->ci->input->post('bk_surcharge_list');
//        $actual_weight = $this->ci->input->post('bk_actual_weight');

        $volume = $this->ci->Mastervolume_model->getRowUdara();
        foreach ($colly as $key => $value) {
            $detail[$key]['bkCodeDetailId'] = $header['bkCodeId']."-".$key;
            $detail[$key]['bkCodeId'] = $header['bkCodeId'];
            $detail[$key]['bkDimensi_L'] = $dimensi_L[$key];
            $detail[$key]['bkDimensi_W'] = $dimensi_W[$key];
            $detail[$key]['bkDimensi_H'] = $dimensi_H[$key];
            $detail[$key]['bkVolumeWeight'] = $volumeWeight[$key];
            $detail[$key]['bkWeight'] = $weight[$key];
            $detail[$key]['bkActualWeight'] = dimensionalWeight([['width' => intval($dimensi_W[$key]), 'height' => intval($dimensi_H[$key]), 'length' => intval($dimensi_L[$key]), 'weight' => intval($weight[$key])]], $volume, $customer_account);
            $detail[$key]['bkTotalColly'] = $value;
            $detail[$key]['bkChargePacking'] = $chargePacking[$key];
            $detail[$key]['bkSubCharge'] = @$this->ci->Mastersurcharges_model->find(['surchargesCommodity' => $subCharge[$key]])->surchargesCode;
        }

        return ['header' => $header, 'detail' => $detail];
    }
}