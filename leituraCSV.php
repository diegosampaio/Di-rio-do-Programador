<?php
    // faz a leitura do arquivo e transforma o mesmo em um array
    $arquivo = file('TABMUN-SIAFI.csv');

    foreach ($arquivo as $key => $ln) {
        if ($key > 0) {
            $dados = explode(",", $ln);

            var_dump($dados);
        }

    }
