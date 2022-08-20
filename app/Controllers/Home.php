<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends BaseController
{
    public function index()
    {
        $dados = $this->request->getVar();

        if (!isset($dados['only_content'])) {
            echo View('structure/header');
        }

        echo View('home/index');

        if (!isset($dados['only_content'])) {
            echo View('structure/footer');
        }
    }
}
