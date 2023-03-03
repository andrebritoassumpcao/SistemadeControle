<?php
require 'vendor/autoload.php';


require 'conecta.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

// Define o nome do arquivo a ser baixado
$filename = 'planilha.xls';



// Define os cabeçalhos HTTP antes de qualquer outra saída ser enviada para o navegador
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');

// Cria uma nova planilha
$spreadsheet = new Spreadsheet();
$i = 2;
$sheet = $spreadsheet->getActiveSheet();

$sheet->getPageSetup()->setPrintArea('A1:P'.$i);
// Define as propriedades da planilha
$spreadsheet->getProperties()
->setTitle('Planilha Professores')
->setSubject('Assunto')
->setDescription('Descrição')
->setKeywords('palavras-chave');

// Cria uma nova aba na planilha

$sheet->getPageSetup()->setFitToWidth(1);
$sheet->getPageSetup()->setFitToHeight(0);
$sheet->setSelectedCell('A1');

$sheet->setTitle('Professores');

// Define o cabeçalho da planilha
$sheet->setCellValue('A1', 'Nome');
$sheet->setCellValue('B1', 'Matrícula');
$sheet->setCellValue('C1', 'Tipo');
$sheet->setCellValue('D1', 'Componente');
$sheet->setCellValue('E1', 'Status da Matrícula');
$sheet->setCellValue('F1', 'Nome Permutado');
$sheet->setCellValue('G1', 'Data de início');
$sheet->setCellValue('H1', 'Data de Vencimento');
$sheet->setCellValue('I1', 'Atuação');
$sheet->setCellValue('J1', 'Nome da Escola');
$sheet->setCellValue('K1', 'Turno');
$sheet->setCellValue('L1', 'Turma');
$sheet->setCellValue('M1', 'Outras Contratações');
$sheet->setCellValue('N1', 'Outra Escola');
$sheet->setCellValue('O1', 'Outras Turma');
$sheet->setCellValue('P1', 'Outro Turno');

include 'relatorio.php';
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
    $sql .= " AND (p.nome LIKE '%$busca%' OR p.matricula LIKE '%$busca%') ";
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
    $sql .= " AND sm.status_matricula = '$filtroMatricula' ";
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

// Executar a consulta SQL
$resultado = mysqli_query($con, $sql);
                                      
if ($resultado && mysqli_num_rows($resultado) > 0) {
  while ($professor = mysqli_fetch_assoc($resultado)) {
    $sheet->setCellValue('A'.$i, $professor['nome']);
    $sheet->setCellValue('B'.$i, $professor['matricula']);
    $sheet->setCellValue('C'.$i, $professor['tipo']);
    $sheet->setCellValue('D'.$i, $professor['componente']);
    $sheet->setCellValue('E'.$i, $professor['status_matricula']);
    $sheet->setCellValue('F'.$i, $professor['nome_premed']);
    $sheet->setCellValue('G'.$i, $professor['data_inicio']);
    $sheet->setCellValue('H'.$i, $professor['data_fim']);
    $sheet->setCellValue('I'.$i, $professor['atuacao']);
    $sheet->setCellValue('J'.$i, $professor['nome_escola']);
    $sheet->setCellValue('K'.$i, $professor['turno']);
    $sheet->setCellValue('L'.$i, $professor['turma']);
    $sheet->setCellValue('M'.$i, $professor['outras_contratacoes']);
    $sheet->setCellValue('N'.$i, $professor['outra_escola']);
    $sheet->setCellValue('O'.$i, $professor['outras_turmas']);
    $sheet->setCellValue('P'.$i, $professor['outro_turno']);
    
    $i++;
}}
// Cria um objeto Writer
$writer = new Xlsx($spreadsheet);

// Escreve a planilha no buffer de saída
$writer->save($filename);

// Interrompe a execução do script
exit();
