<?php


class Mastersurcharges extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(
            [
                'Mastersurcharges_model'
            ]
        );
    }

    public function autocomplete()
    {
        $commodity = $this->Mastersurcharges_model->getAll();
        $data = [];
        foreach ($commodity as $key => $value) {
            $data[$value->surchargesCommodity] = null;
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}