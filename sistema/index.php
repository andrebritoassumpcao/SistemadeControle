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
         $filtroMatricula = in_array($filtroMatricula,['Ativo Readaptado','Ativo Permutado','Ativo Redução de Carga Horária','Licença Médica','Licença Maternidade','Licença Prêmio','Licença sem Vencimento','Vacância','Cedido','Exonerado']) ? $filtroMatricula : '';

      //  FILTRO ATUAÇÃO
         $filtroAtuacao = filter_input(INPUT_GET, 'acting', FILTER_SANITIZE_STRING);
         $filtroAtuacao = in_array($filtroAtuacao,['SEMED','Sala de Aula','Dirigente de Turno','Diretor','Diretor Adjunto','Sala de Recursos','Implementador de Leitura','Outros']) ? $filtroAtuacao : '';

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

        $query_run3 = mysqli_query($con, $query3);
        ?>
        

        <div class="row">
            <div class="">
                <div class="">
                    <div class="">
                        <h4>Detalhes
                            <a href="professor-create.php" class="btn btn-primary mb-3 float-end">Adicionar Professor</a>
                        </h4>
                    </div>
                    <section>
                        <form action="" method="get">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="busca">Buscar por Escola</label>
                                    <input type="text" name="busca" class="form-control" value="<?=$busca?>">
                                </div>
                                <div class="col mb-3">
                                    <label for="type">Tipo</label>
                                    <select name="type" class="form-select">
                                    <option value="tipo0">Selecione</option>
                                    <option value="P1" <?= $filtroTipo === 'P1' ? 'selected' : '' ?>>P1</option>
                                    <option value="P2" <?= $filtroTipo === 'P2' ? 'selected' : '' ?>>P2</option>
                                    </select>
                                </div>
                                <div class="col mb-3">
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
                                <div class="col mb-3">
                                <label>Status da Matrícula</label>
                                <select name="status_mat" class="form-select">
                                  <option value="status0">Selecione</option>
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
                                <div class="col mb-3">
                                <label>Atuação</label>
                                <select name="acting" class="form-select">
                                  <option value="atua0">Selecione</option>
                                  <option value="SEMED" <?= $filtroAtuacao === 'SEMED' ? 'selected' : '' ?>>SEMED</option>
                                  <option value="Sala de Aula" <?= $filtroAtuacao === 'Sala de Aula' ? 'selected' : '' ?>>Sala de Aula</option>
                                  <option value="Dirigente de Turno" <?= $filtroAtuacao === 'Dirigente de Turno' ? 'selected' : '' ?>>Dirigente de Turno</option>
                                  <option value="Diretor" <?= $filtroAtuacao === 'Diretor' ? 'selected' : '' ?>>Diretor</option>
                                  <option value="Diretor Adjunto" <?= $filtroAtuacao === 'Diretor Adjunto' ? 'selected' : '' ?>>Diretor Adjunto</option>
                                  <option value="Sala de Recursos" <?= $filtroAtuacao === 'Sala de Recursos' ? 'selected' : '' ?>>Sala de Recursos</option>
                                  <option value="Implementador de Leitura" <?= $filtroAtuacao === 'Implementador de Leitura' ? 'selected' : '' ?>>Implementador de Leitura</option>
                                  <option value="Outros" <?= $filtroAtuacao === 'Outros' ? 'selected' : '' ?>>Outros</option>
                                  
                                </select>
                                </div>
                                <div class="col mb-3">
                                <label for="turn">Turno</label>
                                <select class="form-select" name="turn">
                                  <option value="turno0">Selecione</option>
                                  <option value="Matutino" <?= $filtroTurno === 'Matutino' ? 'selected' : '' ?>>Matutino</option>
                                  <option value="Vespertino" <?= $filtroTurno === 'Vespertino' ? 'selected' : '' ?>>Vespertino</option>
                                  <option value="Noturno" <?= $filtroTurno === 'Noturno' ? 'selected' : '' ?>>Noturno</option>
                                </select>
                                </div>
                                <div class="col mb-3">
                                    <label for="busca">Buscar por Turma</label>
                                    <input type="text" name="busca_turma" class="form-control" value="<?=$buscaTurma?>">
                                </div>
                                <div class="col mb-3">
                                <label for="other">Outras Contratações</label>
                                <select class="form-select" name="other">
                                <option value="outro0" selected>Selecione</option>
                                <option value="RET" <?= $filtroOutras === 'RET' ? 'selected' : '' ?>>RET</option>
                                <option value="Contrato" <?= $filtroOutras === 'Contrato' ? 'selected' : '' ?>>Contrato</option>
                              </select>
                                </div>
                                <div class="col d-flex align-items-end mb-3">
                                    <button type="submit" class="btn btn-success">Filtrar</button>
                                    <div class="col d-flex align-items-end" style="margin-left:15px;">
                                        <a href="?<?=http_build_query(array('busca' => '', 'type' => '', 'component' => '', 'status_mat' => ''))?>" class="btn btn-secondary">Limpar filtros</a>
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

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>