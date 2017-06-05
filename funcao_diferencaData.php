<?php
/*
 * Esta função calcula a diferença de dias entre duas datas
 * @access public
 * @param $data1, $data2, $operacao (1=soma, 2=subtrai)
 */
function calculaDiasData($data1, $data2, $operacao){
    $d1 = geraTimestamp($data1);
    $d2 = geraTimestamp($data2);
    
    // calcula a diferença entre dias, conforme operação passada
    switch ($operacao){
        case '1':
            $dif = $d2 + $d1;
        break;
        case '2':
            $dif = $d2 - $d1;
        break;        
    }
    // calcula a diferença de dias
    $dias = (int)floor($dif / (60 * 60 * 24));
    // formata mensagem de saída    
    if($dias == 1){
        return "1 dia";
    }else{
        return $dias." dias";
    }
}
?>
