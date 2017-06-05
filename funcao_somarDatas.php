<?php
/*
 * Esta função calcula uma data futura
 * @access public
 * @param $data, $dias, $meses, $ano
 */
function SomarData($data, $dias, $meses, $ano){ 
   //passe a data no formato Y-m-d
   $data = explode("-", $data);
   $newData = date("Y-m-d", mktime(0, 0, 0, $data[1] + $meses, $data[2] + $dias, $data[0] + $ano) );
   return $newData;
}


?>
