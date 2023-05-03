<?php


class Masterdirectory extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(
            [
                'Masterdirectory_model'
            ]
        );
    }

    public function getHubDirectoryPtp()
    {
        $data = $this->Masterdirectory_model->getHubPtp(
            [
                'direcCode' => $this->input->post('kd_city'),
                'direcGroup' => 'PTP',
                'direcActive <>' => '0'
            ]
        );
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['Hub' => $data->direcHub1]));
    }

    public function autocomplete()
    {
        $city = $this->Masterdirectory_model->getPtp();
        $data = [];
        foreach ($city as $key => $value) {
            $data[strtoupper($value->direcCityName).'@'.$value->direcCode] = null;
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}