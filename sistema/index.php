<?php
    session_start();
    require 'conecta.php';
    
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Controle</title>
</head>
<body>
    <header>
        <div class="container mt-2 text-center">
 <img src="../img/logo.jpg" alt="">
        </div>
    </header>
  
    <div class="container-fluid mt-4">

        <?php include('message.php'); ?>
        <?php include('paginacao.php'); ?>
        <?php
        // BUSCA
         $busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);

        // BUSCA
         $buscaTurma = filter_input(INPUT_GET, 'busca_turma', FILTER_SANITIZE_STRING);

        //  FILTRO TIPO
         $filtroTipo = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
         $filtroTipo = in_array($filtroTipo,['P1','P2']) ? $filtroTipo : '';



  
      //  FILTRO COMPONENTE
         $filtroComponente = filter_input(INPUT_GET, 'component', FILTER_SANITIZE_STRING);
         $filtroComponente = in_array($filtroComponente,['Geral','Matemática','Língua Portuguesa','Língua Inglesa','História','Geografia','Ciências','Artes','Educação Física']) ? $filtroComponente : '';


      //  FILTRO MATRICULA
         $filtroMatricula = filter_input(INPUT_GET, 'status_mat', FILTER_SANITIZE_STRING);
         $filtroMatricula = in_array($filtroMatricula,['Ativo','Ativo Readaptado','Ativo Permutado','Ativo Redução de Carga Horária','Licença Médica','Licença Maternidade','Licença Prêmio','Licença sem Vencimento','Vacância','Cedido','Exonerado']) ? $filtroMatricula : '';

      //  FILTRO ATUAÇÃO
         $filtroAtuacao = filter_input(INPUT_GET, 'acting', FILTER_SANITIZE_STRING);
         $filtroAtuacao = in_array($filtroAtuacao,['SEMED','Sala de Aula','Dirigente de Turno','Diretor(a)','Diretor Adjunto','Sala de Recursos','Implementador de Leitura','Outros']) ? $filtroAtuacao : '';

      //  FILTRO TURNO
         $filtroTurno = filter_input(INPUT_GET, 'turn', FILTER_SANITIZE_STRING);
         $filtroTurno = in_array($filtroTurno,['Matutino','Vespertino','Noturno']) ? $filtroTurno : '';

      //  FILTRO OUTRAS CONTRATAÇÕES
         $filtroOutras = filter_input(INPUT_GET, 'other', FILTER_SANITIZE_STRING);
         $filtroOutras = in_array($filtroOutras,['RET','Contrato']) ? $filtroOutras : '';



        //CONDIÇÕES
                $where = '';
                if ($busca || $filtroTipo || $filtroComponente || $filtroMatricula || $filtroAtuacao || $filtroTurno || $buscaTurma || $filtroOutras) {
                    $condicoes = [
                        strlen($busca) ? "nome_escola LIKE '%{$busca}%'" : null,
                        strlen($buscaTurma) ? "turma LIKE '%{$buscaTurma}%'" : null,
                        strlen($filtroTipo) ? 'tipo = "'. $filtroTipo. '"' : null,
                        strlen($filtroComponente) ? 'componente = "'. $filtroComponente. '"' : null,
                        strlen($filtroMatricula) ? 'status_matricula = "'. $filtroMatricula. '"' : null,
                        strlen($filtroAtuacao) ? 'atuacao = "'. $filtroAtuacao. '"' : null,
                        strlen($filtroTurno) ? 'turno = "'. $filtroTurno. '"' : null,
                        strlen($filtroOutras) ? 'outras_contratacoes = "'. $filtroOutras. '"' : null,
                    ];
            $where = implode(' AND ', array_filter($condicoes));
        }
        

        $query3 = "SELECT *
            FROM professores
            JOIN status_matricula ON professores.id = status_matricula.id";
     if ($where) {
        $query3 .= " WHERE {$where}";
    }
    
    $query3 .= " LIMIT $registros_por_pagina OFFSET $offset";
    
    $query_run3 = mysqli_query($con, $query3);

    $relatorio_link = 'relatorio.php?' . http_build_query([
        'busca' => $busca,
        'busca_turma' => $buscaTurma,
        'type' => $filtroTipo,
        'component' => $filtroComponente,
        'status_mat' => $filtroMatricula,
        'acting' => $filtroAtuacao,
        'turn' => $filtroTurno,
        'other' => $filtroOutras,
    ]);
        ?>
        

        <div class="row">
            <div class="">
                <div class="">
                    <div class="">
                        <h4>Detalhes
                            <a href="professor-create.php" class="btn btn-primary float-end">Adicionar Professor</a>
                            <a href="<?php echo $relatorio_link; ?>" class="btn btn-primary">Relatório</a>

                        </h4>
                    </div>
                    <section class="d-flex align-items-baseline mb-3">
                        <form action="" method="get">
                            <div class="row">
                                <div class="col">
                                    <label for="busca">Escola</label>
                                    <input type="text" name="busca" class="form-control" value="<?=$busca?>">
                                </div>
                                <div class="col">
                                    <label for="type">Tipo</label>
                                    <select name="type" class="form-select">
                                    <option value="tipo0">Selecione</option>
                                    <option value="P1" <?= $filtroTipo === 'P1' ? 'selected' : '' ?>>P1</option>
                                    <option value="P2" <?= $filtroTipo === 'P2' ? 'selected' : '' ?>>P2</option>
                                    </select>
                                </div>
                                <div class="col">
                                <label>Componente</label>
                                <select name="component" class="form-select">
                                  <option value="comp0">Selecione</option>
                                  <option value="Geral" <?= $filtroComponente === 'Geral' ? 'selected' : '' ?>>Geral</option>
                                  <option value="Matemática" <?= $filtroComponente === 'Matemática' ? 'selected' : '' ?>>Matemática</option>
                                  <option value="Língua Portuguesa" <?= $filtroComponente === 'Língua Portuguesa' ? 'selected' : '' ?>>Língua Portuguesa</option>
                                  <option value="História" <?= $filtroComponente === 'História' ? 'selected' : '' ?>>História</option>
                                  <option value="Geografia" <?= $filtroComponente === 'Geografia' ? 'selected' : '' ?>>Geografia</option>
                                  <option value="Ciências" <?= $filtroComponente === 'Ciências' ? 'selected' : '' ?>>Ciências</option>
                                  <option value="Artes" <?= $filtroComponente === 'Artes' ? 'selected' : '' ?>>Artes</option>
                                  <option value="Educação Física" <?= $filtroComponente === 'Educação Física' ? 'selected' : '' ?>>Educação Física</option>
                                </select>
                                </div>
                                <div class="col">
                                <label>Status</label>
                                <select name="status_mat" class="form-select">
                                  <option value="status0">Selecione</option>
                                  <option value="Ativo" <?= $filtroMatricula === 'Ativo' ? 'selected' : '' ?>>Ativo</option>
                                  <option value="Ativo Readaptado" <?= $filtroMatricula === 'Ativo Readaptado' ? 'selected' : '' ?>>Ativo Readaptado</option>
                                  <option value="Ativo Permutado" <?= $filtroMatricula === 'Ativo Permutado' ? 'selected' : '' ?>>Ativo Permutado</option>
                                  <option value="Ativo Redução de Carga Horária" <?= $filtroMatricula === 'Ativo Redução de Carga Horária' ? 'selected' : '' ?>>Ativo Redução de Carga Horária</option>
                                  <option value="Licença Médica" <?= $filtroMatricula === 'Licença Médica' ? 'selected' : '' ?>>Licença Médica</option>
                                  <option value="Licença Maternidade" <?= $filtroMatricula === 'Licença Maternidade' ? 'selected' : '' ?>>Licença Maternidade</option>
                                  <option value="Licença Prêmio" <?= $filtroMatricula === 'Licença Prêmio' ? 'selected' : '' ?>>Licença Prêmio</option>
                                  <option value="Licença sem Vencimento" <?= $filtroMatricula === 'Licença sem Vencimento' ? 'selected' : '' ?>>Licença sem Vencimento</option>
                                  <option value="Vacância" <?= $filtroMatricula === 'Vacância' ? 'selected' : '' ?>>Vacância</option>
                                  <option value="Cedido" <?= $filtroMatricula === 'Cedido' ? 'selected' : '' ?>>Cedido</option>
                                  <option value="Exonerado"  <?= $filtroMatricula === 'Exonerado' ? 'selected' : '' ?>>Exonerado</option>
                                </select>
                                </div>
                                <div class="col">
                                <label>Atuação</label>
                                <select name="acting" class="form-select">
                                  <option value="atua0">Selecione</option>
                                  <option value="SEMED" <?= $filtroAtuacao === 'SEMED' ? 'selected' : '' ?>>SEMED</option>
                                  <option value="Sala de Aula" <?= $filtroAtuacao === 'Sala de Aula' ? 'selected' : '' ?>>Sala de Aula</option>
                                  <option value="Dirigente de Turno" <?= $filtroAtuacao === 'Dirigente de Turno' ? 'selected' : '' ?>>Dirigente de Turno</option>
                                  <option value="Diretor" <?= $filtroAtuacao === 'Diretor(a)' ? 'selected' : '' ?>>Diretor</option>
                                  <option value="Diretor Adjunto" <?= $filtroAtuacao === 'Diretor Adjunto' ? 'selected' : '' ?>>Diretor Adjunto</option>
                                  <option value="Sala de Recursos" <?= $filtroAtuacao === 'Sala de Recursos' ? 'selected' : '' ?>>Sala de Recursos</option>
                                  <option value="Implementador de Leitura" <?= $filtroAtuacao === 'Implementador de Leitura' ? 'selected' : '' ?>>Implementador de Leitura</option>
                                  <option value="Outros" <?= $filtroAtuacao === 'Outros' ? 'selected' : '' ?>>Outros</option>
                                  
                                </select>
                                </div>
                                <div class="col">
                                <label for="turn">Turno</label>
                                <select class="form-select" name="turn">
                                  <option value="turno0">Selecione</option>
                                  <option value="Matutino" <?= $filtroTurno === 'Matutino' ? 'selected' : '' ?>>Matutino</option>
                                  <option value="Vespertino" <?= $filtroTurno === 'Vespertino' ? 'selected' : '' ?>>Vespertino</option>
                                  <option value="Noturno" <?= $filtroTurno === 'Noturno' ? 'selected' : '' ?>>Noturno</option>
                                </select>
                                </div>
                                <div class="col">
                                    <label for="busca">Turma</label>
                                    <input type="text" name="busca_turma" class="form-control" value="<?=$buscaTurma?>">
                                </div>
                                <div class="col">
                                <label for="other">Contratações</label>
                                <select class="form-select" name="other">
                                <option value="outro0" selected>Selecione</option>
                                <option value="RET" <?= $filtroOutras === 'RET' ? 'selected' : '' ?>>RET</option>
                                <option value="Contrato" <?= $filtroOutras === 'Contrato' ? 'selected' : '' ?>>Contrato</option>
                              </select>
                                </div>
                                <div class="col d-flex align-items-end">
                                    <button type="submit" class="btn btn-success">Filtrar</button>
                                    <div class="col" style="margin-left:15px;">
                                        <a href="?<?=http_build_query(array('busca' => '', 'type' => '', 'component' => '', 'status_mat' => ''))?>" class="btn btn-secondary">Limpar</a>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </section>
                    <div class="">

                        <table class="table table-responsive table-bordered table-striped" >
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Matrícula</th>
                                    <th>Tipo</th>
                                    <th>Componente</th>
                                    <th>Status da Matrícula</th>
                                    <th>Nome Permutado</th>
                                    <th>Data de início</th>
                                    <th>Data de Vencimento</th>
                                    <th>Atuação</th>
                                    <th>Nome da Escola</th>
                                    <th>Turno</th>
                                    <th>Turma</th>
                                    <th>Outras Contratações</th>
                                    <th>Outra Escola</th>
                                    <th>Outras Turma</th>
                                    <th>Outro Turno</th>
                                    
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT *
                                    FROM professores
                                    JOIN status_matricula
                                    ON professores.id = status_matricula.id;";
                                    $query_run = mysqli_query($con, $query);

                                    if($query_run3 !== false && mysqli_num_rows($query_run3) > 0)
                                    {
                                        foreach($query_run3 as $professor)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $professor['nome']; ?></td>
                                                <td><?= $professor['matricula']; ?></td>
                                                <td><?= $professor['tipo']; ?></td>
                                                <td><?= $professor['componente']; ?></td>
                                                <td ><?= $professor['status_matricula']; ?></td>
                                                <td><?= $professor['nome_premed']; ?></td>
                                                <td><?php if ($professor['data_inicio'] != '0000-00-00') { ?>
                                                <p class="form-control"><?= date('d/m/Y', strtotime($professor['data_inicio'])); ?></p>
                                            <?php } else { ?>
                                                <p class="form-control">Data não informada</p>
                                            <?php } ?></td>
                                                <td><?php if ($professor['data_fim'] != '0000-00-00') { ?>
                                                <p class="form-control"><?= date('d/m/Y', strtotime($professor['data_fim'])); ?></p>
                                            <?php } else { ?>
                                                <p class="form-control">Data não informada</p>
                                            <?php } ?></td>
                                                <td><?= $professor['atuacao']; ?></td>
                                                <td><?= $professor['nome_escola']; ?></td>
                                                <td><?= $professor['turno']; ?></td>
                                                <td><?= $professor['turma']; ?></td>
                                                <td><?= $professor['outras_contratacoes']; ?></td>
                                                <td><?= $professor['outra_escola']; ?></td>
                                                <td><?= $professor['outra_turma']; ?></td>
                                                <td><?= $professor['outra_turno']; ?></td>
                                                <td>
                                                    <a href="professor-view.php?id=<?= $professor['id']; ?>" class="btn btn-info btn-sm">Visualizar</a>
                                                    <a href="professor-edit.php?id=<?= $professor['id']; ?>" class="btn btn-success btn-sm">Editar</a>
                                                    <form action="code.php" method="POST" class="d-inline">
                                                        <button type="submit" name="delete_professor" value="<?=$professor['id'];?>" class="btn btn-danger btn-sm">Deletar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        foreach($query_run as $professor) {
                                        }
                                    }
                                ?>
                                 
                            </tbody>
                        </table>
                        <!-- exibir a paginação -->
                        <nav>
  <?php
    $busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);
    $buscaTurma = filter_input(INPUT_GET, 'busca_turma', FILTER_SANITIZE_STRING);
    $filtroTipo = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
    $filtroComponente = filter_input(INPUT_GET, 'component', FILTER_SANITIZE_STRING);
    $filtroMatricula = filter_input(INPUT_GET, 'status_mat', FILTER_SANITIZE_STRING);
    $filtroAtuacao = filter_input(INPUT_GET, 'acting', FILTER_SANITIZE_STRING);
    $filtroTurno = filter_input(INPUT_GET, 'turn', FILTER_SANITIZE_STRING);
    $filtroOutras = filter_input(INPUT_GET, 'other', FILTER_SANITIZE_STRING);
    $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT) ?: 1;
    
    if ($pagina_atual < 1) {
        $pagina_atual = 1;
    }
    
    if (!in_array($filtroTipo,['P1','P2'])) {
        $filtroTipo = null;
    }
    
    if (!in_array($filtroComponente,['Geral','Matemática','Língua Portuguesa','Língua Inglesa','História','Geografia','Ciências','Artes','Educação Física'])) {
        $filtroComponente = null;
    }
    
    if (!in_array($filtroMatricula,['Ativo','Ativo Readaptado','Ativo Permutado','Ativo Redução de Carga Horária','Licença Médica','Licença Maternidade','Licença Prêmio','Licença sem Vencimento','Vacância','Cedido','Exonerado'])) {
        $filtroMatricula = null;
    }
    
    if (!in_array($filtroAtuacao,['SEMED','Sala de Aula','Dirigente de Turno','Diretor(a)','Diretor Adjunto','Sala de Recursos','Implementador de Leitura','Outros'])) {
        $filtroAtuacao = null;
    }
    
    if (!in_array($filtroTurno,['Matutino','Vespertino','Noturno'])) {
        $filtroTurno = null;
    }
    
    $query_params = [
        'busca' => $busca,
        'busca_turma' => $buscaTurma,
        'type' => $filtroTipo,
        'component' => $filtroComponente,
        'status_mat' => $filtroMatricula,
        'acting' => $filtroAtuacao,
        'turn' => $filtroTurno,
        'other' => $filtroOutras,
    ];
    
    $query_params_string = http_build_query($query_params);
    
    $url = strtok($_SERVER["REQUEST_URI"], '?');
    $url .= '?' . $query_params_string;
    
    $total_paginas = ceil($total_registros_filtered / $registros_por_pagina);
    
    $paginas_filtradas = min($total_paginas, 9);
    $pagina_inicial = max(1, $pagina_atual - floor($paginas_filtradas / 2));
    $pagina_final = min($total_paginas, $pagina_inicial + $paginas_filtradas - 1);
    
    if ($pagina_atual > $total_paginas) {
        $pagina_atual = $total_paginas;
    }
   
    
  ?>

  <ul class="pagination">
    <li class="page-item <?php echo ($pagina_atual == 1)  ? 'disabled' : ''; ?>">
      <a class="page-link" href="<?php echo ($pagina_atual == 1) ? '#' : $url . '&pagina=' . ($pagina_atual - 1); ?>">Anterior</a>
    </li>

    <?php if ($pagina_inicial > 1): ?>
      <li class="page-item">
        <a class="page-link" href="<?php echo $url . '&pagina=1'; ?>">1</a>
      </li>

      <?php if ($pagina_inicial > 2): ?>
        <li class="page-item disabled">
          <a class="page-link" href="#">...</a>
        </li>
      <?php endif; ?>
    <?php endif; ?>

    <?php for ($i = $pagina_inicial; $i <= $pagina_final; $i++): ?>
  <?php if ($i <= $total_paginas && $i >= 1): ?>
    <li class="page-item <?php echo ($pagina_atual == $i)  ? 'active' : ''; ?>">
      <a class="page-link" href="<?php echo $url . '&pagina=' . $i; ?>"><?php echo $i; ?></a>
    </li>
  <?php endif; ?>
<?php endfor; ?>


    <?php if ($pagina_final < $total_paginas): ?>
      <?php if ($pagina_final < $total_paginas - 1): ?>
        <li class="page-item disabled">
          <a class="page-link" href="#">...</a>
        </li>
      <?php endif; ?>

      <li class="page-item <?php echo ($pagina_atual == $total_paginas) ? 'disabled' : ''; ?>">
  <a class="page-link" href="<?php echo ($pagina_atual == $total_paginas) ? '#' : $url . '&pagina=' . ($pagina_atual + 1); ?>">Próxima</a>
</li>
    <?php endif; ?>

  </ul>
</nav>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    

</body>
</html>