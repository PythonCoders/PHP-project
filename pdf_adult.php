<?php
require('WriteHTML.php');
include('mail_fin_adult.php');
include('temp_adult.php');

$name = $_POST['Name'];
$date = $_POST['Date'];
$t=time();
$day= date("Y-m-d",$t);
$pdfname = $name.$day.".pdf";
$total = $_POST['total'];
$pdf=new PDF_HTML();
 
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 20);
 
$pdf->AddPage();
$pdf->SetFont('Arial','B',20);
$pdf->WriteHTML('<para><h1>PATIENT HEALTH QUESTIONAIRE: PHQ-9</em></h1><br></para>');
 
$pdf->SetFont('Arial','',18);
$htmlTable1='
<TABLE>
<TR>
<br>
<br>
<TD>Name:'.$_POST['Name'].'<br><br></TD>
<TD>Date:'.$_POST['Date'].'<br><br><br><br></TD>
</TR>
</TABLE>
<br>
<pre>
<br>
1. Little interest or pleasure in doing things-'.$_POST['Q2'].'<br><br>
2. Feeling down or depressed or hopeless-'.$_POST['Q1'].'<br><br>
3. Trouble falling or staying asleep, or sleeping too much-'.$_POST['Q3'].'<br><br>
4. Feeling tired or having little energy-'.$_POST['Q4'].'<br><br>
5. Poor appetite or overeating-'.$_POST['Q5'].'<br><br>
6. Feeling bad about yourself ot that you are a failure or have <br><br>
   let yourself or your family down-'.$_POST['Q6'].'<br><br>
7. Trouble concentrating on things such as reading <br><br>
   newspaper or watching TV-'.$_POST['Q7'].'<br><br>
8. Moving or speaking so slowly that other people could have<br><br>
   noticed? Or the oppsite, being so fidgety or restless that<br><br>
   you have been moving around a lot more than usual-'.$_POST['Q8'].'<br><br>
9. Thoughts that you would be better off dead or of hurting<br><br>
   yourself in some way-'.$_POST['Q9'].'<br><br></pre>';
$pdf->WriteHTML("<br><br><br>$htmlTable1");
$pdf->SetFont('Arial','B',18);

$pdf->WriteHTML("<br>Total score is = $total");


$pdf->Output("./pdfs/".$pdfname);

include('xml_adult.php');

?>


