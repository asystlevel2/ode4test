<?php


class Ptp extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')):
            redirect('login', 'refresh');
        endif;
        if (!in_array(strtolower(get_class($this)), $this->session->userdata('privilege')['listroute'])) {
            show_404();
        }
        $this->load->library(['ptpservices','form_validation']);
        $this->load->model(
            [
                'bookingheader_model',
                'bookingdetail_model',
                'Reservationheader_model',
                'Reservationdetail_model',
                'masterdirectory_model',
                'mastervolume_model',
                'masterpacking_model',
                'mastercommodity_model',
                'mastersurcharges_model',
                'mastertypeservice_model',
                'mastertypepayment_model',
                'mastertypedelivery_model',
                'Ptp_model',
                'Masterhubrelasidestdetail_model'
            ]
        );
    }

    public function index()
    {
        redirect('ptp/create');
    }

    public function create()
    {
        $data['extra_js'] = array('jquery-1.11.3.min.js', 'materialize.min.js',);
        $data['account_customer'] = $this->session->userdata('account_information');
        $custCity = explode('@', $data['account_customer']['custCity'])[1];
        $data['shipper_hub'] = $this->Masterhubrelasidestdetail_model->getRowData(['relasidetailcitycode' => $custCity])['RelasiDetailDest'];
        $data['volume'] = $this->mastervolume_model->getRowUdara();
        $data['packinglist'] = $this->masterpacking_model->getForDropDown();
        $data['volumelist'] = $this->mastervolume_model->getAll();

        $paramService = "'".preg_replace('/[\,]/', "','", $data['account_customer']['custServices'])."'";
        $data['servicelist'] = $this->mastertypeservice_model->getParam(["serviceField IN ($paramService)"]);
        $data['paymentlist'] = $this->mastertypepayment_model->getAll();
        $data['typedeliverylist'] = $this->mastertypedelivery_model->getAll();
        $data['surchargelist'] = $this->mastersurcharges_model->getForDropDown();
        $data['view'] = $this->load->view('ptp/create', $data, true);
        $this->allfunction->parseTemplates($data);
    }

    public function save()
    {
        $data = $this->ptpservices->initializeData();

        $saveGroup = $this->Ptp_model->saveGroup($data);

        if (is_array($saveGroup)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($saveGroup));
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['status' => 1, 'message' => 'Sukses']));
    }
}