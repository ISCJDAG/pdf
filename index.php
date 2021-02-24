<?php
require_once 'lib/FPDF/fpdf.php';

class PDF extends FPDF
{
    function dateTable($header, $data)
    {
        /* Header */
        $this->SetY(36, true);
        $this->SetX(60, true);
        $this->Image('img/arabeDAte.png', 73, 44, 20, 4, 'PNG');
        $this->Cell(45, 12, $header, 1, 0, 'C');
        $this->Ln();
        /* Data */

        $this->SetY(36, true);
        $this->SetX(105, true);
        $this->Cell(45, 12, $data, 1, 0, 'C');
        $this->Ln();
    }

    public function secondTable($headers, $header_details, $header_requesting, $data_detail, $data_request)
    {
        /**
         * headers
         */
        $this->SetFont('Arial', 'B', 8);
        foreach ($headers as $thead) {
            $this->Cell(85, 12, $thead, 1, 0, 'C');
        }
        $this->Ln();

        /**
         * headers and data
         */

        for ($i = 0; $i < count($header_details); $i++) {
            $this->SetX(20, true);
            $this->Cell(42.5, 10, $header_details[$i], 1, 0, 'C');
            $this->Cell(42.5, 10, $data_detail[$i], 1, 0, 'C');
            $this->Cell(42.5, 10, $header_requesting[$i], 1, 0, 'C');
            $this->Cell(42.5, 10, $data_request[$i], 1, 0, 'C');
            $this->Ln();
        }
    }

    public function transportationTable($headers, $data, $comments)
    {

        //headers
        for ($i = 0; $i < count($headers); $i++) {
            $this->setTextColor(0, 0, 0);
            if ($i == 0) {
                $this->Cell(82, 10, $headers[$i], 1, 0, 'C');
            }
            if ($i > 0) {
                $this->Cell(29.5, 10, $headers[$i], 1, 0, 'C');
            }
        }
        $this->Ln();

        //data information
        for ($x = 0; $x < 3; $x++) {
            $numRow = $x + 1;
            $this->setTextColor(0, 0, 0);
            $this->SetX(20, true);
            if ($x == 0) {
                $this->Cell(10, 10, $numRow, 1, 0, 'C');
                // $this->Cell(72, 10, $data[$x], 1, 0, 'C');
                // $this->Cell(72, 10, $data[$x], 1, 0, 'C');
                for ($a = 0; $a < count($headers); $a++) {
                    if ($a == 0) {
                        $this->Cell(72, 10, $data[$a], 1, 0, 'C');
                    }
                    if ($a > 0) {
                        $this->Cell(29.5, 10, $data[$a], 1, 0, 'C');
                    }
                }
                $this->Ln();
            }
            if ($x > 0) {
                $this->Cell(10, 10, $numRow, 1, 0, 'C');
                for ($a = 0; $a < count($headers); $a++) {
                    if ($a == 0) {
                        $this->Cell(72, 10, $data[$a], 1, 0, 'C');
                    }
                    if ($a > 0) {
                        $this->Cell(29.5, 10, $data[$a], 1, 0, 'C');
                    }
                }
                $this->Ln();
            }
        }
        //tableComment
        $this->SetX(20, true);
        $this->Cell(170.5, 9, 'COMMENTS:', 1, 0, 'L');
        $this->Ln();
        $this->SetX(20, true);
        $this->Cell(170.5, 11, $comments, 1, 0, 'L');
    }

    public function tableVehicleDetail($headers, $data)
    {
        //headers
        for ($i = 0; $i < count($headers); $i++) {
            if ($i == 0) {
                $this->Cell(7, 10, $headers[$i], 1, 0, 'C');
            }
            if ($i == 1) {
                $this->Cell(40, 10, $headers[$i], 1, 0, 'C');
            }
            if ($i > 1) {
                $this->Cell(25, 10, $headers[$i], 1, 0, 'C');
            }
        }
        $this->Ln();

        //si es objeto JSON o array se funciona igual solo cambia los datos
        //data[0]->elcampo a ocupar.
        $this->SetX(18, true);
        for ($i = 0; $i < count($data); $i++) {

            if ($i == 0) {
                $this->Cell(7, 10, $data[$i], 1, 0, 'C');
            }
            if ($i == 1) {
                $this->Cell(40, 10, $data[$i], 1, 0, 'C');
            }
            if ($i > 1) {
                $this->Cell(25, 10, $data[$i], 1, 0, 'C');
            }
        }
        $this->Ln();
    }

    function lastTable($L, $R, $l, $r)
    {
        /**
         * headers and data
         */

        for ($i = 0; $i < count($L); $i++) {
            $this->SetX(18, true);
            $this->Cell(65, 10, $L[$i], 1, 0, 'L');
            $this->Cell(43, 10, $l[$i], 1, 0, 'C');
            $this->Cell(65, 10, $R[$i] . ' ' . $r[$i], 1, 0, 'L');
            //$this->Cell(42.5, 10, , 1, 0, 'C');
            $this->Ln();
        }
        //lastComments

    }
    ////
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFillColor(245, 245, 245);
//logos
$pdf->Image('img/world.png', 53, 10, 20, 20, 'PNG');
$pdf->Image('img/shield.png', 140, 10, 20, 20, 'PNG');

//Title
$pdf->SetX(77, true);
$pdf->SetFont('Arial', 'BU', 12);
$pdf->Cell(40, 10, 'VISITORS REQUEST FORMS');

//picsArabes
$pdf->Image('img/titleAreabe.png', 87, 18, 38, 10, 'PNG');
$pdf->Image('img/email.png', 72, 26, 70, 10, 'PNG');

//DATE

$pdf->SetFont('Arial', 'B', 12);
//$data == > fecha que esta aqui..
$pdf->dateTable('DATE OF REQUEST', '2021 - 02 - 24');

////Segunda seccion de mi tabla del pdf......
$header     = array('DETAILS OF THE EVENT', 'REQUESTING PARTY'); //no cambiar header por default
$headerV1   = array('DATE', 'TIME', 'PLACE', 'PURPOSE OF VISIT'); //no cambiar nada...
$headerV2   = array('NAME', 'CONTACT #', 'ACCOMPANIED', 'UNIT / SECTION');
//cambiar por el array de tu valor o variable de valores to details eventes.
$data   = array('2021-02-24', '18:50', 'Africa', 'to see my love');
//cambiar por el array de tu valor o variable de valores to Requesting Party
$data2  = array('name', 'contact3232', 'accompanied', 'unit secret');

$pdf->SetY(53, true);
$pdf->SetX(20, true);
$pdf->secondTable($header, $headerV1, $headerV2, $data, $data2);

//DETAILS OF VISITORS
$pdf->SetX(80, true);
$pdf->SetFont('Arial', 'BU', 12);
$pdf->Cell(40, 10, 'DETAILS OF VISITORS');
$pdf->Ln();
$pdf->Image('img/arabeTitle2.png', 84, 112, 40, 5, 'PNG');

//titleBlue
$pdf->SetY(120, true);
$pdf->SetX(44, true);
$pdf->setFont('Arial', 'B', '6');
$pdf->SetTextColor(0, 168, 255);
$pdf->Cell(30, 10, 'NOTE: IF TRANSPORT IS REQUIRED THE REQUESTING UNIT SHOULD PREPARE THE TRANSPORTATION WAIVER');

//DetailVisitorTable
$header_deVisitor = array('VISITOR NAME, TITLE & ORGANIZATION', 'CONTACT #', 'LOCATION OF PICK-UP', 'GZ BADGE
YES/NO');


//si es json el que manejas coviertelo a json y modificas un poco la funcion y listo..
$datos =  array(
    0 => array(
        'visitor1', 'contact34', 'Inglad', 'YES'
    ),
    1 => array(
        'Visitor2', 'contact94', 'Germany', 'YES'
    ),
    2 => array(
        'Visitor3', 'contact74', 'Japan', 'YES'
    )
);
$objJSON = json_encode($datos);
//$deVisitor_data     = array('visitor1', 'contact34', 'Inglad', 'YES');
//$deVisitor_data2    = array('Visitor2', 'contact94', 'Germany', 'YES');
//$deVisitor_data3    = array('Visitor3', 'contact74', 'Japan', 'YES');
$cooments = 'super programmer';
$pdf->SetY(127, true);
$pdf->SetX(20, true);
$pdf->transportationTable($header_deVisitor, $objJSON, $cooments);


//VehicleDetails
$pdf->SetY(185, true);
$pdf->SetX(84, true);
$pdf->SetFont('Arial', 'BU', 12);
$pdf->Cell(20, 10, 'VEHICLE DETAILS');
$pdf->Ln();
$pdf->Image('img/vehiclesDetails.png', 84, 193, 40, 3, 'PNG');

//table vehiculeDetail
$vehicle_detail_hader = array('NO:', 'DRIVER NAME', 'VEHICLE MAKE', 'TYPE / MODEL', 'VEHICLE PLATE #', 'COLOR', 'VIN');
$date_vehicle = array('1', 'DriverMAx', 'JAJAJA', 'HB Mazda', '67-90-908', 'white', 'fasdf24234');
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetY(200, true);
$pdf->SetX(18, true);
$pdf->tableVehicleDetail($vehicle_detail_hader, $date_vehicle);

//TO BE FILLED OUT BY UNDSS-I-GFU
$pdf->SetY(220, true);
$pdf->SetX(64, true);
$pdf->SetFont('Arial', 'BU', 12);
$pdf->Cell(20, 10, 'TO BE FILLED OUT BY UNDSS-I-GFU');
$pdf->Ln();
$pdf->Image('img/lastTable.png', 84, 227, 40, 5, 'PNG');

//lastTable

$headsL = array('DATE/TIME RECEIVED', 'TRANSPORTATION REQUIRED: YES / NO');
$headR = array('Approved by: ', 'Signature:');
$dataL = array('2021-02-24', 'NO');
$dataR = array('YES', 'Jose Jose');
$pdf->SetY(233, true);
$pdf->SetFont('Arial', 'B', 8);
$pdf->lastTable($headsL, $headR, $dataL, $dataR);

//lastComments
$lastComment = 'Boombo Jaash';
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetX(18, true);
$pdf->Cell(173, 3, 'COMMENTS: (specific instructions to the guards for access or search procedures to be applied)', 1, 'L');
$pdf->Ln();
$pdf->SetX(18, true);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(173, 17, $lastComment, 1, 'L');


$pdf->Output();