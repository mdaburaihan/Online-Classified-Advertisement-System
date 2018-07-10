<?php
require('mysql_table.php');

class PDF extends PDF_MySQL_Table
{
function Header()
{
    // Title
    $this->SetFont('Times','',16);
    $this->Cell(0,6,'Online Classified Advertisement System','LRT',1,'C');
     $this->SetFont('Times','',12);
     $this->Cell(0,6,'Email: classified@gmail.com','LR',1,'C');
     $this->Cell(0,6,'Contact No: 9854785456','LR',1,'C');
     $this->SetFont('Arial','',18);
    $this->Cell(0,10,'Scheme Report','LRB',1,'C');
    $this->Ln(10);


    // Ensure table header is printed
    parent::Header();
}
}


// Connect to database
$link = mysqli_connect('localhost','root','','online_classified_advertisement');


$pdf = new PDF();

$pdf->SetTitle("Scheme Report");

$pdf->AddPage();
$pdf->Image('../Images/logo.png',12,12,30,12);

$pdf->AddCol('Ads',40,'Max Ads Allowed','L');
$pdf->AddCol('Days',40,'No of Days Valid','L');
$pdf->AddCol('Status',30,'','L');
$pdf->AddCol('Date',35,'','L');
$pdf->AddCol('Admin',40,'','L');

$prop = array('padding'=>2);

$pdf->Table($link,"SELECT ads AS Ads,days AS Days,IF(status=0, 'Inactive','Active') AS Status,DATE_FORMAT(scheme.date,'%d-%m-%Y') AS Date,name AS Admin FROM scheme INNER JOIN admin_registration ON admin_registration.admin_id=scheme.admin_id ORDER BY scheme.date DESC",$prop);


$pdf->Output();
?>