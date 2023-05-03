<?php


class Ptpreport extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')):
            redirect('login', 'refresh');
        endif;
        if (!in_array(strtolower(get_class($this)), $this->session->userdata('privilege')['listroute'])) {
            show_404();
        }
        $this->load->model(['Bookingheader_model', 'Bookingdetail_model', 'Reservationheader_model', 'Reservationdetail_model']);
    }

    public function index()
    {
        $data['extra_js'] = array('jquery-1.11.3.min.js', 'materialize.min.js', 'footable.min.js', 'footable.filter.min.js', 'footable.paginate.min.js', 'footable-loader.js');
        $data['extra_css'] = array('footable.min.css');
        $data['account_customer'] = $this->session->userdata('account_information');
        $data['view'] = $this->load->view('ptpreport/index', $data, true);
        $this->allfunction->parseTemplates($data);
    }

    public function dataTablesReservation()
    {
        $data = $this->Reservationheader_model->ajaxDataTables();
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function dataTablesBooking()
    {
        $data = $this->Bookingheader_model->ajaxDataTables();
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function getChildDetail()
    {
        $data = $this->Reservationdetail_model->ajaxGetDetailByCodeId();
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function getChildDetailBooking()
    {
        $data = $this->Bookingdetail_model->ajaxGetDetailByCodeId();
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}