<?php
require('../public/fpdf/fpdf.php');

class PDF extends FPDF
{

    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../public/Images/logo.png', 10, 8, 50, );
        $this->Image('../public/Images/itsmigra.jpg', 180, 8, 25);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 16);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30, 10, '', 0, 0, 'C');
        //$this->Cell(30,10,'Reporte de usuarioes',0,0,'C');
        // Salto de línea
        $this->Ln(20);


    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('PirataOne-Regular', '', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'C');
    }
}


$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage('portrit', 'letter');
//AGREGAR FUENTES
$pdf->AddFont('Foldit', '', 'Foldit-VariableFont_wght.php');
$pdf->AddFont('Crimoson_italica', '', 'CrimsonText-Italic.php');
$pdf->AddFont('AlienLeagueII', '', 'AlienLeagueII.php');
$pdf->AddFont('PirataOne-Regular', '', 'PirataOne-Regular.php');
//$pdf->SetTextColor(0, 46, 109);

$pdf->SetFont('courier', 'b', 15); //$pdf->SetFont('FUENTE', 'ESTILO(UBI)', TAMAÑO DE FUENTE);

$pdf->Cell(200, 10, utf8_decode('INSTITUTO TECNOLÓGICO SUPERIOR DE SAN MIGUEL EL GRANDE'), 0, 1, 'C', ); //$pdf->Cell(TAMAÑO DE RRECUADRO , ALTO , utf8_decode=CARACTERES ESPECIALES ('TEXTO.'), RECUADRO(1 O 0), (SALTO DE LINEA 1 O 0), 'POSICION DE TEXTO(L,C,R)', RELLENO);
$pdf->Ln(7); //salto de linea
$pdf->Cell(200, 10, utf8_decode('INGENIERÍA EN TECNOLOGÍAS DE LA INFORMACIÓN Y COMUNICACIONES'), 0, 1, 'C', 0);
$pdf->Ln(7);
$pdf->Cell(200, 10, utf8_decode('INTEGRANTES:'), 0, 1, 'C', 0);
$pdf->Ln(7);
$pdf->SetFont('courier', '', 15);
$pdf->Cell(200, 10, utf8_decode('MARCELO GAYTAN RAMIREZ'), 0, 1, 'C', 0);
$pdf->Ln(7);
$pdf->Cell(200, 10, utf8_decode('NANCY DANIELA GARCIA MORALES'), 0, 1, 'C', 0);
$pdf->Ln(7);
$pdf->Cell(200, 10, utf8_decode('ANAYELI REYES MARTINEZ'), 0, 1, 'C', 0);
$pdf->Ln(7);
$pdf->Cell(200, 10, utf8_decode('ERNESTINA MARTINEZ LOPEZ'), 0, 1, 'C', 0);
$pdf->Ln(7);
$pdf->Cell(200, 10, utf8_decode('ALICIA HERNANDEZ SANCHEZ'), 0, 1, 'C', 0);
$pdf->Ln(7);
$pdf->SetFont('courier', 'b', 15);
$pdf->Cell(80, 10, utf8_decode('CUARTO'), 0, 0, 'R', 0);
$pdf->SetFont('courier', '', 15);
$pdf->Cell(30, 10, utf8_decode('SEMESTRE '), 0, 0, 'L', 0);
$pdf->SetFont('courier', 'b', 15);
$pdf->Cell(30, 10, utf8_decode('GRUPO: '), 0, 0, 'R', 0);
$pdf->SetFont('courier', '', 15);
$pdf->Cell(50, 10, utf8_decode(' A'), 0, 1, 'L', 0);
$pdf->Ln(7);
$pdf->SetFont('courier', 'b', 15);
$pdf->Cell(70, 10, utf8_decode('DOCENTE:'), 0, 0, 'R', 0);
$pdf->SetFont('courier', '', 15);
$pdf->Cell(100, 10, utf8_decode('ING. ROBERTO CARLOS PÉREZ ORTIZ'), 0, 1, 'L', 0);
$pdf->Ln(7);
$pdf->SetFont('courier', 'b', 15);
$pdf->Cell(100, 10, utf8_decode('MATERIA: '), 0, 0, 'R', 0);
$pdf->SetFont('courier', '', 15);
$pdf->Cell(100, 10, utf8_decode(' PROGRAMACION II'), 0, 1, 'L', 0);
$pdf->Ln(7);
$pdf->Cell(200, 10, utf8_decode('SAN MIGUEL EL GRANDE, TLAXIACO, OAXACA; A '. $fecha = date('d').' DE ' . $fecha = date('M').' DEL '. $fecha = date('Y')), 0, 1, 'C', 0);


$pdf->SetTextColor(0, 0, 0);


$pdf->AddPage('', 'letter');
$pdf->SetFont('arial', '', 16);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 20, strtoupper('reporte de habitaciones'), 0, 1, 'C', 0);
$pdf->SetFont('arial', 'B', 8);
$pdf->SetFillColor(255, 228, 196);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetDrawColor(80, 80, 0);

//conexion
require_once 'principalModelo.php';
$sql = "SELECT * FROM habitaciones INNER JOIN tipos on habitaciones.habitacion_tipo = tipos.tipo_id INNER JOIN estados on habitaciones.habitacion_estado = estados.estado_id ORDER BY habitacion_codigo ASC";

$consulta = "SELECT * FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.categoria_id ORDER BY producto_nombre ASC";


$conexion = conexion();
$conexion = $conexion->query($sql);
$datos = $conexion->fetchAll();

$pdf->Cell(60, 10, strtoupper('Codigo de habitacion'), 1, 0, 'C', 1);
$pdf->Cell(60, 10, strtoupper('Tipo de habitacion'), 1, 0, 'C',1 );
$pdf->Cell(60, 10, strtoupper('Estado de habitacion'), 1, 1, 'C',1 );

    foreach ($datos as $row) {
        
            $pdf->Cell(60, 10, $row['habitacion_codigo'] , 1, 0, 'C', 0);
            $pdf->Cell(60, 10, $row['tipo_nombre'] , 1, 0, 'C', 0);
            $pdf->Cell(60, 10, $row['estado_nombre'] , 1, 1, 'C', 0);
        }

$pdf->Output();

?>