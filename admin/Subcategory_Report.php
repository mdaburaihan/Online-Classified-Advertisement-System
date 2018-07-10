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
    $this->Cell(0,10,'Subcategory Report','LRB',1,'C');
    $this->Ln(10);


    // Ensure table header is printed
    parent::Header();
}
}


// Connect to database
$link = mysqli_connect('localhost','root','','online_classified_advertisement');


$pdf = new PDF();

$pdf->SetTitle("Subcategory Report");

$pdf->AddPage();


$prop = array('padding'=>2);
$pdf->Image('../Images/logo.png',12,12,30,12);

$pdf->Table($link,"SELECT subcat_name AS Subcategory,cat_name AS Category,IF(subcategory.status=0, 'Inactive','Active') AS Status,DATE_FORMAT(subcategory.date,'%d-%m-%Y') AS Date,name AS Admin 
    FROM subcategory
    INNER JOIN category ON category.cat_id=subcategory.cat_id  
    INNER JOIN admin_registration ON admin_registration.admin_id=subcategory.admin_id 
    ORDER BY subcategory.date DESC",$prop);


$pdf->Output();
?>