<?php


class Mastercommodity extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(
            [
                'Mastercommodity_model'
            ]
        );
    }

    public function autocomplete()
    {
        $commodity = $this->Mastercommodity_model->getAll();
        $data = [];
        foreach ($commodity as $key => $value) {
            $data[$value->name] = null;
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}