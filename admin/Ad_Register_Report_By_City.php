<?php
require('mysql_table.php');


$FromDate =$_GET['fromdate'];
$ToDate =$_GET['todate'];
$cityId =$_GET['cityid'];

class PDF extends PDF_MySQL_Table
{
    
	function Header()
	{
		$frm = $_GET['fromdate'];
		$to = $_GET['todate'];
    // Title
		$this->SetFont('Times','',16);
		$this->Cell(0,6,'Online Classified Advertisement System','LRT',1,'C');
		$this->SetFont('Times','',12);
        $this->Cell(0,6,'Email: classified@gmail.com','LR',1,'C');
        $this->Cell(0,6,'Contact No: 9854785456','LR',1,'C');
		$this->SetFont('Arial','',14);
		$this->Cell(0,6,"Advertisement Register From ". $frm ." To ". $to,'LRB',1,'C');
		$this->Ln(10);


    // Ensure table header is printed
		parent::Header();
	}
}


// Connect to database
$link = mysqli_connect('localhost','root','','online_classified_advertisement');


$pdf = new PDF();

$pdf->SetTitle("Advertisement Register Report");

$pdf->AddPage('L','A4');
$pdf->Image('../Images/logo.png',12,12,30,12);

$prop = array('padding'=>2);



$query="SELECT 
ad_details.ad_id as AdId,
DATE(ad_details.date) as Date,
ad_details.title as Title,
ad_details.price as Price,	
CASE ad_details.active_status 
WHEN 0 THEN 'Inactive'
WHEN 1 THEN 'Active'
WHEN 2 THEN 'Deleted'
WHEN 3 THEN 'Sold'
WHEN 4 THEN 'Blocked'
ELSE 'None'
END AS Status,
category.cat_name as Category,
subcategory.subcat_name as Subcategory,
city.city_name as City
FROM ad_details
LEFT JOIN category ON category.cat_id = ad_details.cat_id
LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
LEFT JOIN city ON city.city_id = ad_details.city_id
WHERE ad_details.city_id ='$cityId' AND DATE(ad_details.date) BETWEEN '$FromDate' AND '$ToDate'";

$pdf->Table($link,$query,$prop);

$pdf->Output();
?>