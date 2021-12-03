<?php
session_start();
require('fpdf.php');
include_once '../includes/dbconnect.php';
class PDF extends FPDF
{
// Load data
function LoadData()
{
    // Read file linesif(isset($_SESSION['random'])){
	 if(isset($_SESSION['random'])){
	 $slogid=$_SESSION['random'];
	 
		  $select=mysql_query("SELECT * FROM results where s_log_id='$slogid' order by grand_total desc");
		  
    $data = array();
	$count=0;
	while($row=mysql_fetch_array($select))
		{
			$count=$count+1;
			
			$data[]=array($count,$row['student_name'],$row['language'],$row['composition'],$row['lang_total'],$row['lugha']
			,$row['insha'],$row['lugha_total'],$row['maths'],
			$row['science'],$row['socialstudies'],$row['cre'],$row['cress_total'],$row['grand_total']);
		  
		}
   
    return $data;
}
}


// Simple table
function BasicTable($basicHeader)
{
    //
			
    
}

// Better table
function ImprovedTable($header, $data)
{
    // Column widths
    $w = array(10,54,16,16,16,16,16,16,18,20,22,16,16,25);
    // Header
	$this->SetFont('','B');
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Data
    foreach($data as $row)
	
    {
		 $this->SetFont('');
        $this->Cell($w[0],6,$row[0],1,0,'C');
        $this->Cell($w[1],6,$row[1],1,0,'C');
		$this->Cell($w[2],6,$row[2],1,0,'C');
        $this->Cell($w[3],6,$row[3],1,0,'C');
		$this->SetFont('','B');
		 $this->Cell($w[4],6,$row[4],1,0,'C');
		 $this->SetFont('');
        $this->Cell($w[5],6,$row[5],1,0,'C');
		$this->Cell($w[6],6,$row[6],1,0,'C');
		$this->SetFont('','B');
        $this->Cell($w[7],6,$row[7],1,0,'C');
        $this->Cell($w[8],6,$row[8],1,0,'C');
        $this->Cell($w[9],6,$row[9],1,0,'C');
		$this->SetFont('');
		 $this->Cell($w[10],6,$row[10],1,0,'C');
        $this->Cell($w[11],6,$row[11],1,0,'C');
		$this->SetFont('','B');
		$this->Cell($w[12],6,$row[12],1,0,'C');
		 $this->Cell($w[13],6,$row[13],1,0,'C');
       
		
        $this->Ln();
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}


}

$pdf = new PDF();
// Column headings
$header = array('', 'CANDIDATE NAME', 'LANG', 'COMP','TOTAL','LUGHA',
'INSHA','JUMLA','MATHS','SCIENCE','S/STUDIES','C.R.E','TOTAL','Grand Total');
if(isset($_SESSION['random']))
	{
			   $logRandom=$_SESSION['random'];
			   $result=mysql_query("SELECT county.county_name, district.district_name, school.school_name,profile.teacher_name, class.class_name, term.exam_term_name, system_log.s_class_name,system_log.s_other_info 
			   FROM county, district, school, profile, class, term, system_log 
			   WHERE system_log_id='$logRandom' 
			   AND system_log.s_county_id=county.county_id 
			   AND system_log.s_district_id=district.district_id 
			   AND system_log.s_school_id=school.school_id 
			   AND system_log.s_teacher_id=profile.teacher_id 
			   AND system_log.s_class_id=class.class_id 
			   AND system_log.s_term_id=term.term_id 
						 ");
		$row=mysql_fetch_array($result);
		$countyHeader= $row['county_name']." COUNTY EDUCATION DEPARTMENT \n";
		$districtHeader= $row['district_name']." DISTRICT \n";
		$termHeader=$row['exam_term_name'];
		$current_year="YEAR : ".date('Y')."\n\n";
		$other_infoHeader=" ".$row['s_other_info'];
		$schoolHeader= $row['school_name']."\n";
		$classHeader="CLASS : ".$row['class_name']."-".$row['s_class_name']."\n";
		
		
		
	}
// Data loading
$data = $pdf->LoadData();
$pdf->SetFont('Arial','',12);
$pdf->AddPage();
$pdf->SetFont('','U');
$pdf->SetXY(100,12); 
$pdf->Write(5,$countyHeader);
$pdf->SetXY(120,18);
$pdf->Write(5,$districtHeader);
$pdf->SetXY(170,24);
$pdf->Write(5,$other_infoHeader);
$pdf->SetXY(75,24);
$pdf->Write(5,$schoolHeader);
$pdf->SetXY(80,30);
$pdf->Write(5,$termHeader);
$pdf->SetXY(150,30);
$pdf->Write(5,$classHeader);
$pdf->SetXY(200,30);
$pdf->Write(5,$current_year);
$pdf->ImprovedTable($header,$data);
$pdf->Output();
?>