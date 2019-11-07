<?php

include_once ('conexao.php');

//@pg_close($con); //Encerrrar Conexão

if (!$con) {
    echo '[{"erro": "Não foi possível conectar ao banco"';
    echo '}]';
} else {
    //echo "aaaaa";
    //SQL da listagem
//     $sql = "SELECT distinct to_char(tempo, 'HH24') as x,  trunc(maxima_t) as y  from maxima_minima 
//  WHERE tempo > current_timestamp - interval '24 hours'
//  group by tempo, maxima_t order by x";

// $sql = "SELECT distinct to_char(tempo, 'HH24') as x,  trunc(maxima_t) as y  from maxima_minima 
// WHERE tempo > current_timestamp - interval '24 hours'
// group by tempo, maxima_t order by x";

$sql = "SELECT distinct to_char(tempo, 'YYYY-MM-DD HH24:MI:SS') as x,  trunc(maxima_t) as y  from maxima_minima 
WHERE tempo > current_timestamp - interval '24 hours'
group by tempo, maxima_t order by x";



// $sql = "SELECT distinct to_char(tempo, 'YYYY-MM-DD HH24:MI:SS') as x,  trunc(maxima_t) as y  from maxima_minima 
// WHERE tempo > current_timestamp - interval '24 hours'
// group by tempo, maxima_t order by x";


    //$sql = "select * from estacaometeorologica;";

   
    // $sql = "select data_hora as x,t as y from estacaometeorologica order by data_hora";


   
    $result = pg_query($sql); //Executsar a SQL
    $n = pg_num_rows($result); //Número de Linhas retornadas

    if (!$result) {
        //Caso não haja retorno
        echo '[{"erro": "Há algum erro com a busca. Não retorna resultados"';
        echo '}]';
    } else if ($n < 1) {
        //Caso não tenha nenhum item
        echo '[{"erro": "Não há nenhum dado cadastrado"';
        echo '}]';        
    } else {
        //Mesclar resultados em um array
        for ($i = 0; $i < $n; $i++) {
            $dados[] = pg_fetch_assoc($result, $i);
        } echo json_encode($dados, JSON_PRETTY_PRINT);
    }
}
?>