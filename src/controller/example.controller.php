<?php


use Symfony\Component\HttpFoundation\Request;

class Example
{
    private $item_model;


    public function __construct()
    {
        $this->item_model = new ExampleModel();
    }

    // Retorna todos os chamados de acordo com o filtro
    public function index(Request $request)
    {
        try {
            $result_model = $this->item_model->index();

            if (empty($result_model)) {
                throw new Exception("Sem dados");
            }


            $data['status'] = true;
            $data['code'] = 200;
            $data['response'] = true;
            return $data;
        } catch (Exception $e) {
            $data['status'] = false;
            $data['code'] = 500;
            $data['error'] = $e->getMessage();
            return $data;
        }
    }
}
