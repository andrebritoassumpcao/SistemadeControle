<?php
session_start();
require 'conecta.php';

if (isset($_POST['delete_professor'])) {
    $prof_id = mysqli_real_escape_string($con, $_POST['delete_professor']);

    $query = "DELETE FROM professores WHERE id = $prof_id";
    $query2 = "DELETE FROM status_matricula WHERE id_professor = $prof_id";
    $query_run = mysqli_query($con, $query);
    $query_run2 = mysqli_query($con, $query2);


    if ($query_run && $query_run2) {
        $_SESSION['message'] = "Professor excluido com sucesso";
        header("Location:index.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Não foi possivel excluir o professor";
        header("Location:index.php");
        exit(0);
    }
}



if (isset($_POST['update_professor'])) {
    $prof_id = mysqli_real_escape_string($con, $_POST['id_professor']);

    $nome = mysqli_real_escape_string($con, $_POST['nome']);
    $matricula = mysqli_real_escape_string($con, $_POST['matricula']);
    $tipo = mysqli_real_escape_string($con, $_POST['tipo']);
    $componente = mysqli_real_escape_string($con, $_POST['componente']);
    $status_matricula = mysqli_real_escape_string($con, $_POST['status_matricula']);
    $nome_premed = mysqli_real_escape_string($con, $_POST['nome_premed']);
    $data_inicio = mysqli_real_escape_string($con, $_POST['data_inicio']);
    $data_fim = mysqli_real_escape_string($con, $_POST['data_fim']);
    $atuacao = mysqli_real_escape_string($con, $_POST['atuacao']);
    $nome_escola = mysqli_real_escape_string($con, $_POST['nome_escola']);
    $turno = mysqli_real_escape_string($con, $_POST['turno']);
    $turma = mysqli_real_escape_string($con, $_POST['turma']);
    $outras_contratacoes = mysqli_real_escape_string($con, $_POST['outras_contratacoes']);
    $outra_escola = mysqli_real_escape_string($con, $_POST['outra_escola']);
    $outra_turma = mysqli_real_escape_string($con, $_POST['outra_turma']);
    $outra_turno = mysqli_real_escape_string($con, $_POST['outra_turno']);

    $query = "UPDATE professores SET nome = '$nome', matricula = '$matricula', tipo = '$tipo', componente = '$componente', status_matricula = '$status_matricula', atuacao = '$atuacao',nome_escola = '$nome_escola',turno = '$turno',turma = '$turma',outras_contratacoes = '$outras_contratacoes', outra_escola = '$outra_escola', outra_turma ='$outra_turma', outra_turno ='$outra_turno' WHERE id = $prof_id";
    $query_run = mysqli_query($con, $query);

    $query2 = "UPDATE status_matricula SET nome_premed = '$nome_premed', data_inicio = '$data_inicio', data_fim = '$data_fim' WHERE id_professor = $prof_id";
    $query_run2 = mysqli_query($con, $query2);



    if ($query_run && $query_run2) {
        $_SESSION['message'] = "Professor atualizado com sucesso";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Professor não atualizado";
        header("Location: index.php");
        exit(0);
    }
}


if (isset($_POST['save_professor'])) {
    $nome = mysqli_real_escape_string($con, $_POST['nome']);
    $matricula = mysqli_real_escape_string($con, $_POST['matricula']);
    $tipo = mysqli_real_escape_string($con, $_POST['tipo']);
    $componente = mysqli_real_escape_string($con, $_POST['componente']);
    $status_matricula = mysqli_real_escape_string($con, $_POST['status_matricula']);
    $nome_premed = mysqli_real_escape_string($con, $_POST['nome_premed']);
    $data_inicio = mysqli_real_escape_string($con, $_POST['data_inicio']);
    $data_fim = mysqli_real_escape_string($con, $_POST['data_fim']);
    $atuacao = mysqli_real_escape_string($con, $_POST['atuacao']);
    $nome_escola = mysqli_real_escape_string($con, $_POST['nome_escola']);
    $turno = mysqli_real_escape_string($con, $_POST['turno']);
    $turma = mysqli_real_escape_string($con, $_POST['turma']);
    $outras_contratacoes = mysqli_real_escape_string($con, $_POST['outras_contratacoes']);
    $outra_escola = mysqli_real_escape_string($con, $_POST['outra_escola']);
    $outra_turma = mysqli_real_escape_string($con, $_POST['outra_turma']);
    $outra_turno = mysqli_real_escape_string($con, $_POST['outra_turno']);

    $query = "INSERT INTO professores (nome,matricula,tipo,componente,status_matricula,atuacao,nome_escola,turno,turma,outras_contratacoes,outra_escola,outra_turma,outra_turno) VALUES ('$nome','$matricula','$tipo','$componente','$status_matricula','$atuacao','$nome_escola','$turno','$turma','$outras_contratacoes','$outra_escola','$outra_turma','$outra_turno')";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $last_id = mysqli_insert_id($con);

        $query2 = "INSERT INTO status_matricula (id_professor,nome_premed, data_inicio, data_fim)
      VALUES ('$last_id', '$nome_premed', '$data_inicio', '$data_fim')";

        $query_run2 =  mysqli_query($con, $query2);
        if ($query_run && $query_run2) {
            $_SESSION['message'] = "Professor cadastrado com sucesso!";
            header("Location: professor-create.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Professor não cadastrado";
            header("Location: professor-create.php");
            exit(0);
        }
    }
}
