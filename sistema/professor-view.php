<?php
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

    <title>Detalhes do Professor</title>
</head>

<body>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Dados do Professor
                            <a href="index.php" class="btn btn-danger float-end">VOLTAR</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if (isset($_GET['id'])) {
                            $prof_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM professores p JOIN status_matricula m ON p.id = m.id WHERE p.id='$prof_id';";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                $professor = mysqli_fetch_array($query_run);
                        ?>

                                <div class="mb-3">
                                    <label>Nome</label>
                                    <p class="form-control">
                                        <?= $professor['nome']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Matrícula</label>
                                    <p class="form-control">
                                        <?= $professor['matricula']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Tipo</label>
                                    <p class="form-control">
                                        <?= $professor['tipo']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Componente</label>
                                    <p class="form-control">
                                        <?= $professor['componente']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Status da Matricula</label>
                                    <p class="form-control">
                                        <?= $professor['status_matricula']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Nome Permutado</label>
                                    <p class="form-control">
                                        <?= $professor['nome_premed']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Data de Início</label>
                                    <p class="form-control">
                                        <?= date('d/m/Y', strtotime($professor['data_inicio'])); ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Data de Vencimento</label>
                                    <p class="form-control">
                                        <?= date('d/m/Y', strtotime($professor['data_fim'])); ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Atuação</label>
                                    <p class="form-control">
                                        <?= $professor['atuacao']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Nome da Escola</label>
                                    <p class="form-control">
                                        <?= $professor['nome_escola']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Turno</label>
                                    <p class="form-control">
                                        <?= $professor['turno']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Turma</label>
                                    <p class="form-control">
                                        <?= $professor['turma']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Outras Contratações</label>
                                    <p class="form-control">
                                        <?= $professor['outras_contratacoes']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Outra Escola</label>
                                    <p class="form-control">
                                        <?= $professor['outra_escola']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Outra Turma</label>
                                    <p class="form-control">
                                        <?= $professor['outra_turma']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Outro Turno</label>
                                    <p class="form-control">
                                        <?= $professor['outra_turno']; ?>
                                    </p>
                                </div>


                        <?php
                            } else {
                                echo "<h4>Nenhum ID encontrado</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>