<?php

require_once '../model/Operacao.php';

function isTheseParametersAvailable($params)
{
    $avalilable = true;
    $missingparams = "";

    foreach ($params as $param) {
        if (!isset($_POST[$param]) || strlen($_POST[$param]) <= 0) {
            $avalilable = false;
            $missingparams = $missingparams . ", " . $param;
        }
    }
    if (!$avalilable) {
        $response = array();
        $response['error'] = true;
        $response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . 'missing';

        echo json_encode($response);

        die();
    }
}

$response =  array();

if (isset($_GET['apicall'])) {
    switch ($_GET['apicall']) {

        case 'createDicastb':
            isTheseParametersAvailable(array('campo_2', 'campo_3', 'campo_4', 'campo_5', 'campo_6', 'campo_7', 'campo_8', 'campo_9', 'campo_10'));

            $db = new Operacao();

            $result = $db->createDicastb(
                $_POST['campo_2'],
                $_POST['campo_3'],
                $_POST['campo_4'],
                $_POST['campo_5'],
                $_POST['campo_6'],
                $_POST['campo_7'],
                $_POST['campo_8'],
                $_POST['campo_9'],
                $_POST['campo_10'],
            );
            if ($result) {
                $response['error'] = false;
                $response['message'] = 'Dados inseridos com sucesso.';
                $response['dadoscreate'] = $db->getDicastb();
            } else {
                $response['error'] = true;
                $response['message'] = 'Dados não foram inseridos.';
            }
            break;

        case 'getDicastb':
            $db = new Operacao();
            $response['error'] = false;
            $response['message'] = 'Dados listados com sucesso.';
            $response['dadoslista'] = $db->getDicastb();
            break;

        case 'updateDicastb':
            isTheseParametersAvailable(array('campo_1, campo_2', 'campo_3', 'campo_4', 'campo_5', 'campo_6', 'campo_7', 'campo_8', 'campo_9', 'campo_10'));

            $db = new Operacao();
            $result = $db->updateDicastb(
                $_POST['campo_1'],
                $_POST['campo_2'],
                $_POST['campo_3'],
                $_POST['campo_4'],
                $_POST['campo_5'],
                $_POST['campo_6'],
                $_POST['campo_7'],
                $_POST['campo_8'],
                $_POST['campo_9'],
                $_POST['campo_10'],
            );
            if ($result) {
                $response['error'] = false;
                $response['message'] = 'Dados atualizados com sucesso.';
                $response['dadosalterar'] = $db->getDicastb();
            } else {
                $response['error'] = true;
                $response['message'] = 'Dados não foram atualizados.';
            }
            break;

        case 'deleteDicastb':
            if (isset($_GET['uid'])) {
                $db = new Operacao();

                if ($db->deleteDicastb($_GET['uid'])) {
                    $response['error'] = false;
                    $response['message'] = 'Dados excluídos com sucesso.';
                    $response['dadosdeletar'] = $db->getDicastb();
                } else {
                    $response['error'] = true;
                    $response['message'] = 'Algo deu errado.';
                }
            } else {
                $response['error'] = true;
                $response['message'] = 'Dados não deletados.';
            }
            break;
    }
} else {
    $response['error'] = true;
    $response['message'] = 'Chamada de API com defeito.';
}

echo json_encode($response);
