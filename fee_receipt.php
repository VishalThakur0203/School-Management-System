<?php
require_once("connection.php");
require_once('fpdf.php');

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage('L', array(210, 150));
$pdf->SetFont('Times', '', 12);
$pdf->SetFont('Times', 'B', 24);
$pdf->SetTextColor(156, 0, 0);
$pdf->Cell(0, 0, 'Receipt', 0, 0, 'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(10);
$pdf->SetFont('Times', 'I', 18);
$pdf->Cell(0, 10, 'School Name', 0, 1, 'C');
$pdf->Line(1, $pdf->GetY(), 209, $pdf->GetY());
$pdf->Ln(10);

if (isset($_GET['data'])) {
    $receivedData = $_GET['data'];

    $query = "SELECT std_reg.*, student_payment.*, fee_payment.fee, fee_payment.signature 
              FROM std_reg 
              INNER JOIN student_payment ON std_reg.class = student_payment.course 
              INNER JOIN fee_payment ON std_reg.id = fee_payment.Roll_no 
              WHERE fee_payment.id='$receivedData'";
    
    $query_result = mysqli_query($con_status, $query);

    if ($query_result) {
        $stu_inf = mysqli_fetch_array($query_result);

        // Debugging output for array
       // echo "Debug: ";
        //print_r($stu_inf);

        ob_start(); // Start output buffering

        $pdf->Line(60, $pdf->GetY() + 2, 95, $pdf->GetY() + 2);
        $pdf->Line(165, $pdf->GetY() + 2, 205, $pdf->GetY() + 2);
        $pdf->Line(165, $pdf->GetY() + 12, 205, $pdf->GetY() + 12);
        $pdf->Line(60, $pdf->GetY() + 12, 95, $pdf->GetY() + 12);
        $pdf->Cell(180, 0, " Student Roll_no:    " . $stu_inf[0] . "                                   Student Name:   " . $stu_inf[4], 0, 1, 'C');
        $pdf->Cell(160, 20, "            Class/Section:        " . $stu_inf[1] . "" . $stu_inf[10] . "                          Session Year:     " . $stu_inf[2], 0, 1, 'C');
        $pdf->Line(50, $pdf->GetY() + 12, 100, $pdf->GetY() + 12);
        $pdf->Line(50, $pdf->GetY() + 25, 95, $pdf->GetY() + 25);
        $pdf->Line(165, $pdf->GetY() + 11, 205, $pdf->GetY() + 11);
        
        $pdf->Line(0, $pdf->GetY(), 209, $pdf->GetY());
        $pdf->Cell(60, 15, " Admission_Fee:    " . $stu_inf[13], 0, 0, 'C');
        $pdf->Cell(160, 15, " Examination_Fee:      " . $stu_inf[14], 0, 1, 'C');
        $pdf->Cell(60, 15, " Tuition_Fee:       " . $stu_inf[15], 0, 1, 'C');
        $pdf->Ln(3);
        $pdf->Cell(195, 10, "                                                                  Paid Amount--->     " . $stu_inf[20], 0, 1, 'C');
        $pdf->Cell(5, 0, "                                  Signature of student    ", 0, 0, 'C');

        // Check if the fee signature image file exists before adding it to the PDF
        if (!empty($stu_inf[21])) 
        {
            $feeSignaturePath = $stu_inf[21];

            // Output the file path for debugging
            //echo "Debug: Fee Signature Path: $feeSignaturePath<br>";

            // Check the image type using GD library
            $imageInfo = getimagesize($feeSignaturePath);
            $imageType = $imageInfo[2];

            // Check if the image is a JPEG
            if ($imageType == IMAGETYPE_JPEG) {
                $imageWidth = 60;
                $imageHeight = 40;
        
                $pdf->Image($feeSignaturePath, 10, $pdf->GetY() + 5, $imageWidth, $imageHeight);
            } else {
                echo "Error: The provided file is not a valid JPEG image";
            }
        }
        $pdf->Ln(3); 

        $pdf->Output('receipt.pdf', 'I');

        ob_end_flush();

        exit;
    } else {
        echo "Error: Unable to retrieve data";
    }
} else {
    echo "No data received";
}
?>
