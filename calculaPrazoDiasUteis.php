/**
 * Função que cálcula dias úteis
 *
 * @param date $aPartirDe
 * @param int $quantidadeDeDias
 * @return void
 */
function calculaPrazoDiasUteis($aPartirDe, $quantidadeDeDias)
{
    //$aPartirDe = '17-04-2019';
    //$quantidadeDeDias = 10;
    $dateTime = new \DateTime($aPartirDe);

    $listaDiasUteis = [];
    $contador = 0;
    while ($contador < $quantidadeDeDias) {
        $dateTime->modify('+1 weekday'); // adiciona um dia pulando finais de semana
        $data = $dateTime->format('Y-m-d');
        if (!isFeriado($data)) {
            $listaDiasUteis[] = $data;
            $contador++;
        }
    }
    $someArray = json_decode(json_encode($listaDiasUteis), true);
    $final = end($someArray);
    $dataFinal = date('Y-m-d', strtotime(str_replace('-', '/', $final)));
    return $dataFinal;
}

function isFeriado($data)
{
    $listaFeriado = getListaDiasFeriado(date('Y', strtotime($data)));
    if (isset($listaFeriado[$data])) {
        return true;
    }
    return false;
}

function getListaDiasFeriado($ano = null)
{

    if ($ano === null) {
        $ano = intval(date('Y'));
    }

    $pascoa = easter_date($ano); // retorna data da pascoa do ano especificado
    $diaPascoa = date('j', $pascoa);
    $mesPacoa = date('n', $pascoa);
    $anoPascoa = date('Y', $pascoa);

    $feriados = [
        // Feriados nacionais fixos
        mktime(0, 0, 0, 1, 1, $ano),   // Confraternização Universal
        mktime(0, 0, 0, 4, 21, $ano),  // Tiradentes
        mktime(0, 0, 0, 5, 1, $ano),   // Dia do Trabalhador
        mktime(0, 0, 0, 9, 7, $ano),   // Dia da Independência
        mktime(0, 0, 0, 10, 12, $ano), // N. S. Aparecida
        mktime(0, 0, 0, 11, 2, $ano),  // Todos os santos
        mktime(0, 0, 0, 11, 15, $ano), // Proclamação da republica
        mktime(0, 0, 0, 12, 25, $ano), // Natal
        //
        // Feriados variaveis
        mktime(0, 0, 0, $mesPacoa, $diaPascoa - 48, $anoPascoa), // 2º feria Carnaval
        mktime(0, 0, 0, $mesPacoa, $diaPascoa - 47, $anoPascoa), // 3º feria Carnaval 
        mktime(0, 0, 0, $mesPacoa, $diaPascoa - 2, $anoPascoa),  // 6º feira Santa  
        mktime(0, 0, 0, $mesPacoa, $diaPascoa, $anoPascoa),      // Pascoa
        mktime(0, 0, 0, $mesPacoa, $diaPascoa + 60, $anoPascoa), // Corpus Christ
    ];

    sort($feriados);

    $listaDiasFeriado = [];
    foreach ($feriados as $feriado) {
        $data = date('Y-m-d', $feriado);
        $listaDiasFeriado[$data] = $data;
    }

    return $listaDiasFeriado;
}
