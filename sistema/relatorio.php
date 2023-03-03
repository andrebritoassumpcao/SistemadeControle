<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>planilha</title>
</head>

<body>
  <?php
  session_start();
  require 'conecta.php';


  ?>

  <table class="table table-responsive table-bordered table-striped">
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
      </tr>
    </thead>
    <tbody>
      <?php

      // Receber parâmetros de busca
      $busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);
      $buscaTurma = filter_input(INPUT_GET, 'busca_turma', FILTER_SANITIZE_STRING);
      $filtroTipo = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
      $filtroComponente = filter_input(INPUT_GET, 'component', FILTER_SANITIZE_STRING);
      $filtroMatricula = filter_input(INPUT_GET, 'status_mat', FILTER_SANITIZE_STRING);
      $filtroAtuacao = filter_input(INPUT_GET, 'acting', FILTER_SANITIZE_STRING);
      $filtroTurno = filter_input(INPUT_GET, 'turn', FILTER_SANITIZE_STRING);
      $filtroOutras = filter_input(INPUT_GET, 'other', FILTER_SANITIZE_STRING);

      // Montar a consulta SQL com os parâmetros recebidos
      $sql = "SELECT * FROM professores p
        JOIN status_matricula sm ON p.id = sm.id
        WHERE 1=1 "; // Colocar "1=1" para facilitar na concatenação das cláusulas

      if (!empty($busca)) {
        $sql .= " AND (p.nome_escola LIKE '%$busca%' OR p.matricula LIKE '%$busca%') ";
      }

      if (!empty($buscaTurma)) {
        $sql .= " AND p.turma = '$buscaTurma' ";
      }

      if (!empty($filtroTipo)) {
        $sql .= " AND p.tipo = '$filtroTipo' ";
      }

      if (!empty($filtroComponente)) {
        $sql .= " AND p.componente = '$filtroComponente' ";
      }

      if (!empty($filtroMatricula)) {
        $sql .= " AND p.status_matricula = '$filtroMatricula' ";
      }

      if (!empty($filtroAtuacao)) {
        $sql .= " AND p.atuacao = '$filtroAtuacao' ";
      }

      if (!empty($filtroTurno)) {
        $sql .= " AND p.turno = '$filtroTurno' ";
      }

      if (!empty($filtroOutras)) {
        $sql .= " AND p.outras_contratacoes = '$filtroOutras' ";
      }
      $planilha_link = 'planilha.php?' . http_build_query([
        'busca' => $busca,
        'busca_turma' => $buscaTurma,
        'type' => $filtroTipo,
        'component' => $filtroComponente,
        'status_mat' => $filtroMatricula,
        'acting' => $filtroAtuacao,
        'turn' => $filtroTurno,
        'other' => $filtroOutras,
      ]);
      // Executar a consulta SQL

      $query = "SELECT *
                                    FROM professores
                                    JOIN status_matricula
                                    ON professores.id = status_matricula.id;";
      $query_run = mysqli_query($con, $query);

      $resultado = mysqli_query($con, $sql);

      if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($professor = mysqli_fetch_assoc($resultado)) {
      ?>
          <tr>
            <td><?= $professor['nome']; ?></td>
            <td><?= $professor['matricula']; ?></td>
            <td><?= $professor['tipo']; ?></td>
            <td><?= $professor['componente']; ?></td>
            <td><?= $professor['status_matricula']; ?></td>
            <td><?= $professor['nome_premed']; ?></td>
            <td><?php if ($professor['data_inicio'] != '0000-00-00') { ?>
                <p class="form-control"><?= date('d/m/Y', strtotime($professor['data_inicio'])); ?></p>
              <?php } else { ?>
                <p class="form-control">Data não informada</p>
              <?php } ?>
            </td>
            <td><?php if ($professor['data_fim'] != '0000-00-00') { ?>
                <p class="form-control"><?= date('d/m/Y', strtotime($professor['data_fim'])); ?></p>
              <?php } else { ?>
                <p class="form-control">Data não informada</p>
              <?php } ?>
            </td>
            <td><?= $professor['atuacao']; ?></td>
            <td><?= $professor['nome_escola']; ?></td>
            <td><?= $professor['turno']; ?></td>
            <td><?= $professor['turma']; ?></td>
            <td><?= $professor['outras_contratacoes']; ?></td>
            <td><?= $professor['outra_escola']; ?></td>
            <td><?= $professor['outra_turma']; ?></td>
            <td><?= $professor['outra_turno']; ?></td>
            <td>

              </form>
            </td>
          </tr>
      <?php
        }
      } else {
        foreach ($query_run as $professor) {
        }
      }
      ?>

    </tbody>
  </table>
  </div>
  <script>
    function openPopup() {
      var popup = window.open("", "myPopup", "width=400, height=300");
      var content = '<div class="container mt-3 mb-3"><a href="planilha.php?busca=<?php echo $busca ?>&busca_turma=<?php echo $buscaTurma ?>&type=<?php echo $filtroTipo ?>&component=<?php echo $filtroComponente ?>&status_mat=<?php echo $filtroMatricula ?>&acting=<?php echo $filtroAtuacao ?>&turn=<?php echo $filtroTurno ?>&other=<?php echo $filtroOutras ?>" class="btn btn-primary">Baixar arquivo</a></div>';
      popup.document.write(content);
    }

    window.onload = openPopup;
  </script>

</body>

</html>