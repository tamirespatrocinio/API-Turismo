<?php

class Operacao
{

    private $con;

    function __construct()
    {
        require_once dirname(__FILE__) . './Conexao.php';

        $bd = new Conexao();

        $this->con = $bd->connect();
    }

    function createDicastb($campo_2, $campo_3, $campo_4, $campo_5, $campo_6, $campo_7, $campo_8, $campo_9, $campo_10)
    {

        $stmt = $this->con->prepare("insert into dicastb values(?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("s,s,s,s,s,s,s,s,s", $campo_2, $campo_3, $campo_4, $campo_5, $campo_6, $campo_7, $campo_8, $campo_9, $campo_10);

        if ($stmt->execute())
            return true;
        return false;
    }

    function getDicastb()
    {
        $stmt = $this->con->prepare("Select * from dicastb");
        $stmt->execute();
        $stmt->bind_result($uid, $regiao, $estado, $cidade, $imgLogo, $imgPoTur01, $imgPoTur02, $imgGast, $pontosturisticos, $gastronomilocal);

        $dicas = array();

        while ($stmt->fetch()) {

            $dica = array();

            $dica['uid'] = $uid;
            $dica['regiao'] = $regiao;
            $dica['estado'] = $estado;
            $dica['cidade'] = $cidade;
            $dica['imgLogo'] = $imgLogo;
            $dica['imgPoTur01'] = $imgPoTur01;
            $dica['imgPoTur02'] = $imgPoTur02;
            $dica['imgGast'] = $imgGast;
            $dica['pontosturisticos'] = $pontosturisticos;
            $dica['gastronomialocal'] = $gastronomilocal;

            array_push($dicas, $dica);
        }
        return $dicas;
    }

    function updateDicastb($campo_1, $campo_2, $campo_3, $campo_4, $campo_5, $campo_6, $campo_7, $campo_8, $campo_9, $campo_10)
    {

        $stmt = $this->con->prepare("update dicastb set regiao=?, estado=?, cidade=?, imgLogo=?, imgPoTur01=?, imgPoTur02=?, imgGast=?, pontosturisticos=?, gastronomialocal=? where uid=?");

        $stmt->bind_param("s,s,s,s,s,s,s,s,s,i", $campo_2, $campo_3, $campo_4, $campo_5, $campo_6, $campo_7, $campo_8, $campo_9, $campo_10, $campo_1);

        if ($stmt->execute())
            return true;
        return false;
    }

    function deleteDicastb()
    {
        $stmt = $this->con->prepare("delete from dicastb where uid=?");
        $stmt->bind_param("i", $campo_1);
        if ($stmt->execute())
            return true;
        return false;
    }
}
