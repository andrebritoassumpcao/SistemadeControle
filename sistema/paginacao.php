<?php
// Definir o número de registros por página
$registros_por_pagina = 45;

// Determinar o número da página atual
if (isset($_GET['pagina']) && is_numeric($_GET['pagina'])) {
    $pagina_atual = intval($_GET['pagina']);
} else {
    $pagina_atual = 1;
}

// Determinar o offset para a consulta SQL
$offset = ($pagina_atual - 1) * $registros_por_pagina;

// Montar a cláusula WHERE da consulta SQL
$where_clauses = [];
if (!empty($busca)) {
    $where_clauses[] = "busca = '$busca'";
}
if (!empty($busca_turma)) {
    $where_clauses[] = "busca_turma = '$busca_turma'";
}
if (!empty($filtroTipo)) {
    $where_clauses[] = "tipo = '$filtroTipo'";
}
if (!empty($filtroComponente)) {
    $where_clauses[] = "componente = '$filtroComponente'";
}
if (!empty($filtroMatricula)) {
    $where_clauses[] = "status_matricula = '$filtroMatricula'";
}
if (!empty($filtroAtuacao)) {
    $where_clauses[] = "atuacao = '$filtroAtuacao'";
}
if (!empty($filtroTurno)) {
    $where_clauses[] = "turno = '$filtroTurno'";
}
if (!empty($filtroOutras)) {
    $where_clauses[] = "outras_informacoes = '$filtroOutras'";
}
$where_clause = '';
if (!empty($where_clauses)) {
    $where_clause = 'WHERE ' . implode(' AND ', $where_clauses);
}

// Consulta SQL para recuperar os registros da página atual
$query = "SELECT * FROM professores JOIN status_matricula ON professores.id = status_matricula.id $where_clause LIMIT $registros_por_pagina OFFSET $offset";

$query_run = mysqli_query($con, $query);

// Contar o número total de registros
$query_count = "SELECT COUNT(*) as total_registros FROM professores JOIN status_matricula ON professores.id = status_matricula.id $where_clause";
$query_count_run = mysqli_query($con, $query_count);

$total_registros = 0;
if ($query_count_run !== false && mysqli_num_rows($query_count_run) > 0) {
    $total_registros = mysqli_fetch_assoc($query_count_run)['total_registros'];
}



$query_count_filtered = "SELECT COUNT(*) as total_registros FROM professores JOIN status_matricula ON professores.id = status_matricula.id $where_clause";
$query_count_filtered_run = mysqli_query($con, $query_count_filtered);

$total_registros_filtered = 0;
if ($query_count_filtered_run !== false && mysqli_num_rows($query_count_filtered_run) > 0) {
    $total_registros_filtered = mysqli_fetch_assoc($query_count_filtered_run)['total_registros'];
}

// Calcular o número de páginas
$paginas = ceil($total_registros / $registros_por_pagina);

if (!empty($where_clause)) {
    $query_count_filtered = "SELECT COUNT(*) as total_registros FROM professores JOIN status_matricula ON professores.id = status_matricula.id $where_clause";
    $query_count_filtered_run = mysqli_query($con, $query_count_filtered);

    $total_registros_filtered = 0;
    if ($query_count_filtered_run !== false && mysqli_num_rows($query_count_filtered_run) > 0) {
        $total_registros_filtered = mysqli_fetch_assoc($query_count_filtered_run)['total_registros'];
    }

    // Calcular o número de páginas filtradas
    $paginas_filtradas = ceil($total_registros_filtered / $registros_por_pagina);
} else {
    $paginas_filtradas = $paginas;
}
