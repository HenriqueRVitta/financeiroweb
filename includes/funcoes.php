<?php

/*** ARRAY COM DIAS DA SEMANA EM PORTUGUÊS ***/
$semanaBr = array('Sun' => 'Domingo','Mon' => 'Segunda-Feira','Tue' => 'Terca-Feira','Wed' => 'Quarta-Feira','Thu' => 'Quinta-Feira','Fri' => 'Sexta-Feira','Sat' => 'Sábado');

$semanaBr_sem_feira = array('Sun' => 'Domingo','Mon' => 'Segunda','Tue' => 'Terca','Wed' => 'Quarta','Thu' => 'Quinta','Fri' => 'Sexta','Sat' => 'Sábado');

/*** ARRAY COM MESES EM PORTUGUÊS ***/
$mesBr = array('Jan' => 'Janeiro','Feb' => 'Fevereiro','Mar' => 'Marco','Apr' => 'Abril','May' => 'Maio','Jun' => 'Junho','Jul' => 'Julho','Aug' => 'Agosto','Nov' => 'Novembro','Sep' => 'Setembro','Oct' => 'Outubro','Dec' => 'Dezembro');

/*** FUNÇÃO PARA RETORNAR O DIA DA SEMANA ***/
function diasemana($data) {
    $ano =  substr("$data", 0, 4);
    $mes =  substr("$data", 5, -3);
    $dia =  substr("$data", 8, 9);

    $diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );

    switch($diasemana) {
        case"0": $semana = "Domingo";       break;
        case"1": $semana = "Segunda-Feira"; break;
        case"2": $semana = "Terça-Feira";   break;
        case"3": $semana = "Quarta-Feira";  break;
        case"4": $semana = "Quinta-Feira";  break;
        case"5": $semana = "Sexta-Feira";   break;
        case"6": $semana = "Sábado";        break;
    }

    echo "$semana";
}

/*** FUNÇÃO PARA RETORNAR O NÚMERO DO DIA DA SEMANA ***/
function nDiasemana($data) {
    $ano =  substr("$data", 0, 4);
    $mes =  substr("$data", 5, -3);
    $dia =  substr("$data", 8, 9);

    $nDiasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );

    return $nDiasemana;
}

/*** FUNÇÃO PARA RETORNAR O MES ***/
function mes($data) {
    switch($data) {
        case"01": $data = "Janeiro";  break;
        case"02": $data = "Fevereiro";break;
        case"03": $data = "Março";    break;
        case"04": $data = "Abril";    break;
        case"05": $data = "Maio";     break;
        case"06": $data = "Junho";    break;
        case"07": $data = "Julho";    break;
        case"08": $data = "Agosto";   break;
        case"09": $data = "Setembro"; break;
        case"10": $data = "Outubro";  break;
        case"11": $data = "Novembro"; break;
        case"12": $data = "Dezembro"; break;
    }

    return "$data";
}

/*** FUNÇÃO PARA SOMAR HORAS ***/
function somaHora($hora1,$hora2){
    $h1 = explode(":",$hora1);
    $h2 = explode(":",$hora2);

    @$segundo = $h1[2] + $h2[2] ;
    @$minuto  = $h1[1] + $h2[1] ;
    $horas   = $h1[0] + $h2[0] ;
    $dia   	= 0 ;

    if($segundo > 59){
        $segundodif = $segundo - 60;
        $segundo = $segundodif;
        $minuto = $minuto + 1;
    }

    if($minuto > 59){
        $minutodif = $minuto - 60;
        $minuto = $minutodif;
        $horas = $horas + 1;
    }

    if($horas > 24){
        $num = 0;

        (int)$num = $horas / 24;
        $horaAtual = (int)$num * 24;
        $horasDif = $horas - $horaAtual;

        $horas = $horasDif;

        for($i = 1; $i <= (int)$num; $i++){
            $dia +=  1 ;
        }

    }

    if(strlen($horas) == 1){
        $horas = "0".$horas;
    }

    if(strlen($minuto) == 1){
        $minuto = "0".$minuto;
    }

    if(strlen($segundo) == 1){
        $segundo = "0".$segundo;
    }

    return  $horas.":".$minuto.":".$segundo;
}

/*** FUNÇÃO PARA SOMAR HORAS EM ARRAY ***/
function somaHoraArray($array){
    //inicializa a variavel segundos com 0
    $segundos = 0;

    foreach ( $array as $tempo ){ //percorre o array $tempo
        @list( $h, $m, $s ) = explode( ':', $tempo ); //explode a variavel tempo e coloca as horas em $h, minutos em $m, e os segundos em $s

    //transforma todas os valores em segundos e add na variavel segundos

        $segundos += $h * 3600;
        $segundos += $m * 60;
        $segundos += $s;

    }

    $horas = floor( $segundos / 3600 ); //converte os segundos em horas e arredonda caso nescessario
    $segundos %= 3600; // pega o restante dos segundos subtraidos das horas
    $minutos = floor( $segundos / 60 );//converte os segundos em minutos e arredonda caso nescessario
    $segundos %= 60;// pega o restante dos segundos subtraidos dos minutos

    if(strlen($horas) == 1){
        $horas = "0".$horas;
    }

    if(strlen($minutos) == 1){
        $minutos = "0".$minutos;
    }

    if(strlen($segundos) == 1){
        $segundos = "0".$segundos;
    }

    return $horas.":".$minutos.":".$segundos;
}

/*** FUNÇÃO PARA RETORNAR QUANTIDADE DE DIAS ÚTEIS DO MÊS ***/
function dias_uteis($mes, $ano){

    // Primeiro dia do mês
    $firstday = date("M-d-Y", mktime(0, 0, 0, $mes, 1, $ano));

    // Último dia do mês
    $lastday = date("M-d-Y", mktime(0, 0, 0, $mes + 1, 0, $ano));

    $count = 0;
    $workday = 0;

    while( ($lastday > $firstday) && ($count <= 32) ){
        $firstday = date("M-d-Y", mktime(0, 0, 0, $mes, $count + 1, $ano));

        if ( ( date("w", mktime(0, 0, 0, $mes, $count + 1, $ano)) > 0 ) && ( date("w", mktime(0, 0, 0, $mes, $count + 1, $ano))))
            $workday += 1;
            $count += 1;

    }
    return $workday;
}

/*** FUNÇÃO PARA RETORNAR QUANTIDADE DE DOMINGOS DO MÊS ***/
function dias_domingos($month,$year){
    $selecDay =  "0";

    $i = 1;
    $f = date( "t", mktime( 0,0,0,$month,'01',$year ) );

    while( $i <= $f ){

        $date = $year . '-' . $month . '-' . $i;
        $tstamp = strtotime($date);
        $day = date("w", $tstamp);

        ( $day == $selecDay ? $week[] = $i . ',' : '');

        $i++;
    }

    return count($week);
}

/*** FUNÇÃO PARA RETORNAR QUANTIDADE DE SABADOS ENTRE DUAS DATAS ***/
function pegaSabadoPeriodo($inicio,$fim) {
    $inicioDT = new DateTime($inicio);
    $fimDT = new DateTime($fim);
    $fimDT->add( DateInterval::createFromDateString( '1 day' ) );

    $dia = 0;

    while( $inicioDT <= $fimDT ) {
        $dateSql = $inicioDT;
        $dataSql = $dateSql->format('Y-m-d');

        if(date('w', strtotime($dataSql)) == 6){
            $dia++;
        }

        $inicioDT->add( DateInterval::createFromDateString( '1 day' ) );
    }

    return $dia;
}

/*** FUNÇÃO PARA RETORNAR QUANTIDADE DE DOMINGOS ENTRE DUAS DATAS ***/
function pegaFDSPeriodo($inicio,$fim) {
    $inicioDT = new DateTime($inicio);
    $fimDT = new DateTime($fim);
    $fimDT->add( DateInterval::createFromDateString( '1 day' ) );

    $dom = 0;

    while( $inicioDT < $fimDT ) {
        $dateSql = $inicioDT;
        $dataSql = $dateSql->format('Y-m-d');

        if(date('w', strtotime($dataSql)) == 0){
            $dom++;
        }

        $inicioDT->add( DateInterval::createFromDateString( '1 day' ) );
    }

    return $dom;
}

/*** FUNÇÃO PARA RETORNAR O DOMINGO POSTERIOR A DATA ***/
function proximoDomingo($data, $saida = 'Y-m-d') {
    // Converte $data em um UNIX TIMESTAMP
    $timestamp = strtotime($data);

    // Calcula qual o dia da semana de $data
    // O resultado será um valor numérico:
    // 1 -> Segunda, 2 -> Terça, 3 -> Quarta, 4 -> Quinta, 5 -> Sexta, 6 -> Sábado, 7 -> Domingo
    $dia = date('N', $timestamp);

    if ($dia == 1) {
        $timestamp_final = $timestamp + ((5 + $dia) * 3600 * 24);
    }elseif($dia == 2){
        $timestamp_final = $timestamp + ((3 + $dia) * 3600 * 24);
    }elseif($dia == 3){
        $timestamp_final = $timestamp + ((1 + $dia) * 3600 * 24);
    }elseif($dia == 4){
        $timestamp_final = $timestamp + (($dia - 1) * 3600 * 24);
    }elseif($dia == 5){
        $timestamp_final = $timestamp + (($dia - 3) * 3600 * 24);
    }elseif($dia == 6){
        $timestamp_final = $timestamp + (($dia - 5) * 3600 * 24);
    }else{
        // É domingo, mantém a data de entrada
        $timestamp_final = $timestamp;
    }

    return date($saida, $timestamp_final);
}


/*** FUNÇÃO PARA CONVERSÃO DE HORA EM DECIMAL ***/
function decimalHours($time){
    $hms = explode(":", $time);

    return ($hms[0] + ($hms[1]/60) + ($hms[2]/3600));
}