<?php
session_start();
?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Criar aluno</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Adicionar professor
                            <a href="index.php" class="btn btn-danger float-end">VOLTAR</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">

                            <div class="mb-3">
                                <label>Nome</label>
                                <input type="text" name="nome" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Matrícula</label>
                                <input type="text" name="matricula" class="form-control">
                            </div>
                            <!-- Tipo -->
                            <div class="mb-3">
                                <label>Tipo</label>
                                <select name="tipo" class="form-select">
                                  <option value="tipo0" selected>Selecione</option>
                                  <option value="P1">P1</option>
                                  <option value="P2">P2</option>
                                </select>
                            </div>
                            <!-- Componentes -->
                            <div class="mb-3">
                                <label>Componente</label>
                                <select name="componente" class="form-select">
                                  <option value="comp0" selected>Selecione</option>
                                  <option value="Geral">Geral</option>
                                  <option value="Matemática">Matemática</option>
                                  <option value="Língua Portuguesa">Língua Portuguesa</option>
                                  <option value="História">História</option>
                                  <option value="Geografia">Geografia</option>
                                  <option value="Ciências">Ciências</option>
                                  <option value="Artes">Artes</option>
                                  <option value="Educação Física">Educação Física</option>
                                </select>
                            </div>
                            <!-- Status da Matricula -->
                            <div class="mb-3">
                                <label>Status da Matrícula</label>
                                <select id="selectStatus" name="status_matricula" class="form-select">
                                  <option value="status0" selected>Selecione</option>
                                  <option value="Ativo">Ativo</option>
                                  <option value="Ativo Readaptado">Ativo Readaptado</option>
                                  <option value="Ativo Permutado">Ativo Permutado</option>
                                  <option value="Ativo Redução de Carga Horária">Ativo Redução de Carga Horária</option>
                                  <option value="Licença Médica">Licença Médica</option>
                                  <option value="Licença Maternidade">Licença Maternidade</option>
                                  <option value="Licença Prêmio">Licença Prêmio</option>
                                  <option value="Licença sem Vencimento">Licença sem Vencimento</option>
                                  <option value="Vacância">Vacância</option>
                                  <option value="Cedido">Cedido</option>
                                  <option value="Exonerado">Exonerado</option>
                                </select>
                            </div>
                            <div id="campo1" class="mb-3" style="display: none;">
                            <label>Nome Permutado</label>
                              <input type="text" name="nome_premed" class="form-control">
                            </div>
                            <div class="container-md row g-3 mb-3" >
                            <div id="campo2" class="col-2" style="display: none;">
                              <label for="data_inicio">Data de Início</label>
                            <input type="date" name="data_inicio" class="form-control">
                            </div>

                              <div id="campo3" class="col-2" style="display: none;">
                              <label for="data_fim">Data de Vencimento</label>
                                <input type="date" name="data_fim" class="form-control">
                              </div>
                            </div>
                            <!-- Atuação -->
                            <div class="mb-3">
                                <label>Atuação</label>
                                <select id="selectAtuacao" name="atuacao" class="form-select">
                                  <option value="atua0" selected>Selecione</option>
                                  <option value="SEMED">SEMED</option>
                                  <option value="Sala de Aula">Sala de Aula</option>
                                  <option value="Dirigente de Turno">Dirigente de Turno</option>
                                  <option value="Diretor(a)">Diretor(a)</option>
                                  <option value="Diretor Adjunto">Diretor Adjunto</option>
                                  <option value="Sala de Recursos">Sala de Recursos</option>
                                  <option value="Implementador de Leitura">Implementador de Leitura</option>
                                  <option value="Outros">Outros</option>
                                  
                                </select>
                                <!-- Nome da Escola -->
                                <div class="mb-3">
                                  <label for="nome_escola">Nome da Escola</label>
                                  <input type="text" name="nome_escola" class="form-control" id="nomeEscola">

                                </div>
                            </div>

                            <div class="container-md row g-3 mb-3" >
                              <div class="col">
                                <label for="turno">Turno</label>
                                <select class="form-select" name="turno" id="turno" required>
                                  <option value="turno0" selected>Selecione</option>
                                  <option value="Matutino">Matutino</option>
                                  <option value="Vespertino">Vespertino</option>
                                  <option value="Noturno">Noturno</option>
                                </select>
                              </div>
                              <div class="col">
                                <label for="turma">Turma</label>
                                <input type="text" class="form-control" name="turma" id="turma">
                              </div>
                            </div>
                            
                            <div class="mb-3">
                              <label for="outros">Outras Contratações</label>
                              <select class="form-select" name="outras_contratacoes" id="selectOutra">
                                <option value="outro0" selected>Selecione</option>
                                <option value="RET">RET</option>
                                <option value="Contrato">Contrato</option>
                              </select>
                              </div>
                              <div class="col" id="campo_outra1" class="mb-3" style="display: none;">
                                <label for="outra_escola">Outra Escola</label>
                                <input type="text" class="form-control" name="outra_escola" id="outra_escola">
                              </div>
                              <div class="col" id="campo_outra2" class="mb-3" style="display: none;">
                                <label for="outra_turma">Outra Turma</label>
                                <input type="text" class="form-control" name="outra_turma" id="outra_turma">
                              </div>
                              <div class="col" id="campo_outra3" class="mb-3" style="display: none;">
                                <label for="outra_turno">Outro Turno</label>
                                <select class="form-select" name="outra_turno" id="outra_turno">
                                  <option value="outra_turno0" selected>Selecione</option>
                                  <option value="Matutino">Matutino</option>
                                  <option value="Vespertino">Vespertino</option>
                                  <option value="Noturno">Noturno</option>
                                </select>
                              </div>
                            </div>
                              <div class="mb-3">
                              <button type="submit" name="save_professor" class="btn btn-primary">Salvar</button>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      var selectStatus =  document.getElementById("selectStatus");
      var campo1 =  document.getElementById("campo1");
      var campo2 =  document.getElementById("campo2");
      var campo3 =  document.getElementById("campo3");

      selectStatus.addEventListener("change", function(){
        if(this.value === "Ativo Permutado"){
          campo1.style.display = "block";
          campo2.style.display = "block";
          campo3.style.display = "block";
        } else if (this.value === "Exonerado"){
          campo1.style.display = "none";
          campo2.style.display = "block";
          campo3.style.display = "none";
        }else if (this.value === "Ativo Receptado"){
          campo1.style.display = "none";
          campo2.style.display = "none";
          campo3.style.display = "none";
        }else if (this.value === "Ativo Redução de Carga Horária"){
          campo1.style.display = "none";
          campo2.style.display = "none";
          campo3.style.display = "none";
        } else{
          campo1.style.display = "none";
          campo2.style.display = "block";
          campo3.style.display = "block";
        }
      })

      var selectOutra =  document.getElementById("selectOutra");
      var campo_outra1 =  document.getElementById("campo_outra1");
      var campo_outra2 =  document.getElementById("campo_outra2");
      var campo_outra3 =  document.getElementById("campo_outra3");

      selectOutra.addEventListener("change", function(){
        if(this.value === "outro0"){
          campo_outra1.style.display = "none";
          campo_outra2.style.display = "none";
          campo_outra3.style.display = "none";
      } else{
        campo_outra1.style.display = "block";
        campo_outra2.style.display = "block";
        campo_outra3.style.display = "block";
        }
      })

   </script> 
</body>
</html>