<?php
require(dirname(__FILE__) . '/fpdf.php');
require_once(dirname(__FILE__) . '/../../includes/dbconnect.php');
require_once(dirname(__FILE__) . '/../../includes/functions.php');

checklogin();

if(isset($_GET['list'])){
$id=$_GET['list'];
if($id){
	setRandom($id);
	}
	}

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


function CalculateSum()
{
    // Read file linesif(isset($_SESSION['random'])){
	 if(isset($_SESSION['random'])){
	 $slogid=$_SESSION['random'];

	$select=mysql_query("SELECT * FROM results where s_log_id='$slogid' order by grand_total desc");

    $TotalSum = array();

	$count=0;$compCount=0; $langCount=0; $inshaCount=0; $lughaCount=0;
		 $mathCount=0; $scienceCount=0; $socialCount=0;$creCount=0;$langTotalCount=0;
		 $grandTotalCount=0;$creSSTotalCount=0;	$lughaTotalCount=0;
	while($row=mysql_fetch_array($select))
		{
			$count=$count+1;
			$inshaCount=$inshaCount+$row['insha'];
			$lughaCount=$lughaCount+$row['lugha'];
			$compCount=$compCount+$row['composition'];
			$langCount=$langCount+$row['language'];
			$mathCount=$mathCount+$row['maths'];
			$scienceCount=$scienceCount+$row['science'];
			$creCount=$creCount+$row['cre'];
			$socialCount=$socialCount+$row['socialstudies'];
			$langTotalCount=$langTotalCount+$row['lang_total'];
			$lughaTotalCount=$lughaTotalCount+$row['lugha_total'];
			$creSSTotalCount=$creSSTotalCount+$row['cress_total'];
			$grandTotalCount=$grandTotalCount+$row['grand_total'];
		}

			$TotalSum[]=array("****","SUBJECT TOTAL",$langCount,$compCount,$langTotalCount,$lughaCount
			,$inshaCount,$lughaTotalCount,$mathCount,
			$scienceCount,$socialCount,$creCount,$creSSTotalCount,$grandTotalCount);
		 }


    return $TotalSum;
	 }

function CalculateAverage()
{
    // Read file linesif(isset($_SESSION['random'])){
	 if(isset($_SESSION['random'])){
	 $slogid=$_SESSION['random'];

	$select=mysql_query("SELECT * FROM results where s_log_id='$slogid' order by grand_total desc");

    $Average = array();

	$count=0;$compCount=0; $langCount=0; $inshaCount=0; $lughaCount=0;
		 $mathCount=0; $scienceCount=0; $socialCount=0;$creCount=0;$langTotalCount=0;
		 $grandTotalCount=0;$creSSTotalCount=0;	$lughaTotalCount=0;

		 $avelang=0;$aveicompo=0;$avelangTotal=0;$avelugha=0;
			$aveinsha=0;$avelughaTotal=0;$avemath=0;
			$avescience=0;$avesocialS=0;$avecre=0;$avecresocialTotal=0;$aveGrandTotal=0;
	while($row=mysql_fetch_array($select))
		{
			$count=$count+1;
			$inshaCount=$inshaCount+$row['insha'];
			$lughaCount=$lughaCount+$row['lugha'];
			$compCount=$compCount+$row['composition'];
			$langCount=$langCount+$row['language'];
			$mathCount=$mathCount+$row['maths'];
			$scienceCount=$scienceCount+$row['science'];
			$creCount=$creCount+$row['cre'];
			$socialCount=$socialCount+$row['socialstudies'];
			$langTotalCount=$langTotalCount+$row['lang_total'];
			$lughaTotalCount=$lughaTotalCount+$row['lugha_total'];
			$creSSTotalCount=$creSSTotalCount+$row['cress_total'];
			$grandTotalCount=$grandTotalCount+$row['grand_total'];

			$aveicompo=round(($compCount)/$count,2);
			$avelang=round(($langCount)/$count,2);
			$avelangTotal=round(($langTotalCount)/$count,2);
			$aveinsha=round(($inshaCount)/$count,2);
			$avelugha=round(($lughaCount)/$count,2);
			$avelughaTotal=round(($lughaTotalCount)/$count,2);
			$avemath=round(($mathCount)/$count,2);
			$avescience=round(($scienceCount)/$count,2);
			$avesocialS=round(($socialCount)/$count,2);
 			$avecre=round(($creCount)/$count,2);
			$avecresocialTotal=round($creSSTotalCount/$count,2);
			$aveGrandTotal=round($grandTotalCount/$count,2);

		}

			$Average[]=array("****","SUBJECT AVERAGE",$avelang,$aveicompo,$avelangTotal,$avelugha
			,$aveinsha,$avelughaTotal,$avemath,
			$avescience,$avesocialS,$avecre,$avecresocialTotal,$aveGrandTotal);
		 }


    return $Average;
	 }
	 function CalculateClassAverage()
{
    // Read file linesif(isset($_SESSION['random'])){
	 if(isset($_SESSION['random'])){
	 $slogid=$_SESSION['random'];

	$select=mysql_query("SELECT * FROM results where s_log_id='$slogid' order by grand_total desc");

    $Average = array();

	$count=0;$compCount=0; $langCount=0; $inshaCount=0; $lughaCount=0;
		 $mathCount=0; $scienceCount=0; $socialCount=0;$creCount=0;$langTotalCount=0;
		 $grandTotalCount=0;$creSSTotalCount=0;	$lughaTotalCount=0;

		 $avelang=0;$aveicompo=0;$avelangTotal=0;$avelugha=0;
			$aveinsha=0;$avelughaTotal=0;$avemath=0;
			$avescience=0;$avesocialS=0;$avecre=0;$avecresocialTotal=0;$aveGrandTotal=0;
	while($row=mysql_fetch_array($select))
		{
			$count=$count+1;
			$inshaCount=$inshaCount+$row['insha'];
			$lughaCount=$lughaCount+$row['lugha'];
			$compCount=$compCount+$row['composition'];
			$langCount=$langCount+$row['language'];
			$mathCount=$mathCount+$row['maths'];
			$scienceCount=$scienceCount+$row['science'];
			$creCount=$creCount+$row['cre'];
			$socialCount=$socialCount+$row['socialstudies'];
			$langTotalCount=$langTotalCount+$row['lang_total'];
			$lughaTotalCount=$lughaTotalCount+$row['lugha_total'];
			$creSSTotalCount=$creSSTotalCount+$row['cress_total'];
			$grandTotalCount=$grandTotalCount+$row['grand_total'];

			$aveGrandTotal=round($grandTotalCount/$count,2);

		}

			$ClassAverage=$aveGrandTotal/5;
		 }


    return $ClassAverage;
	 }

// Simple table
function BasicTable($headerSeparator, $TotalSum)
{
    //// Column widths
    $w = array(10,54,16,16,16,16,16,16,18,20,22,16,16,25);
	$this->Ln();
	// Header
	$this->SetFont('','B');
    for($i=0;$i<count($headerSeparator);$i++)
        $this->Cell($w[$i],7,$headerSeparator[$i],1,0,'C');
    $this->Ln();
    // Data
    foreach($TotalSum as $row)
	{
		 $this->SetFont('');
        $this->Cell($w[0],6,$row[0],1,0,'C');
		$this->SetFont('','B');
        $this->Cell($w[1],6,$row[1],1,0,'C');
		$this->SetFont('');
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
// Simple table
function AverageTable($headerSeparator, $Average)
{
    //// Column widths
    $w = array(10,54,16,16,16,16,16,16,18,20,22,16,16,25);$this->Ln();
	// Header
	$this->SetFont('','B');
    for($i=0;$i<count($headerSeparator);$i++)
        $this->Cell($w[$i],7,$headerSeparator[$i],1,0,'C');
    $this->Ln();
    // Data
    foreach($Average as $row)
	{
		  $this->SetFont('');
        $this->Cell($w[0],6,$row[0],1,0,'C');
		$this->SetFont('','B');
        $this->Cell($w[1],6,$row[1],1,0,'C');
		$this->SetFont('');
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
		$this->SetFont('','B');
        $this->Cell($w[1],6,$row[1],1,0,'L');
		$this->SetFont('');
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
$headerSeparator= array('', '', '', '','','',
'','','','','','','','');
if(isset($_SESSION['random']))
	{
			   $logRandom=$_SESSION['random'];
			   $result=mysql_query("SELECT county.county_name, district.district_name, school.school_name,profile.teacher_name, class.class_name, term.exam_term_name, system_log.s_class_name,system_log.s_log_year,system_log.s_other_info
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
		$current_year="YEAR : ".$row['s_log_year']."\n\n";
		$other_infoHeader=" ".$row['s_other_info'];
		$schoolHeader= $row['school_name']."\n";
		$classHeader="CLASS : ".$row['class_name']."-".$row['s_class_name']."\n";



	}
	else{
		echo" Table not Selected. please Log in to select the table.";
		}
// Data loading
$data = $pdf->LoadData();
$Average =  $pdf->CalculateAverage();
$TotalSum = $pdf->CalculateSum();
$ClassAverage= $pdf->CalculateClassAverage();
$pdf->SetFont('Arial','',12);
$pdf->AddPage();
$pdf->SetFont('','B');
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
$pdf->BasicTable($headerSeparator, $TotalSum);
$pdf->AverageTable($headerSeparator, $Average);
$pdf->SetFont('','B');
$pdf->Write(5,"CLASS AVERAGE: ".$ClassAverage);

$pdf->Output();
?>
