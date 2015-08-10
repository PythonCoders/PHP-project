<?php
	$doc = new DOMDocument("1.0");
	$doc->formatOutput = true;
	
	$threshold = 2;
	$total = $_POST['total'];
	$name = $_POST['NameChild'];
	$date = $_POST['DateChild'];
	$t=time();
	$day= date("Y-m-d",$t);
	$sent_time = date("h:i:sa",$t);
	$xmlname = $name.$day.".xml";
	$pdfname = $name.$day.".pdf";
	$tempname = $name.$day.".txt";
	
	
	
	if($total<$threshold)
	$sub = $name."-".$day."-"."Total-$total";
	else
	$sub = $name."-".$day."-"."Criteria met:Total-$total";
	
	$filedata = file_get_contents($tempname, true);

	
	$root = $doc->createElement('N2NMessage');
	$root = $doc->appendChild($root);

	$root->setAttribute('version', '1.0');
	$root->setAttribute('release', '006');
	$root->setAttribute('xmlns', 'http://www.surescripts.com/messaging');

	$header = $doc->createElement('Header');
	$header =$root->appendChild($header);

	$to = $doc->createElement('To');
	$to = $header->appendChild($to);
	$to->setAttribute('Qualifier', 'DIRECT');
	$text = $doc->createTextNode('phq9adult@MicroMDDirect.com');
	$text = $to->appendChild($text);

	$from = $doc->createElement('From');
	$from = $header->appendChild($from);
	$from->setAttribute('Qualifier', 'DIRECT');
	$text = $doc->createTextNode('phq9adult@MicroMDDirect.com');
	$text = $from->appendChild($text);

	$msgID = $doc->createElement('MessageID');
	$msgID = $header->appendChild($msgID);
	$text = $doc->createTextNode('B05AC28B-65120-5DF879E6');
	$text = $msgID->appendChild($text);

	$sentTime = $doc->createElement('SentTime');
	$sentTime = $header->appendChild($sentTime);
	$text = $doc->createTextNode(   $day . $sent_time );
	$text = $sentTime->appendChild($text);
	

	$senderSw = $doc->createElement('SenderSoftware');
	$senderSw = $header->appendChild($senderSw);

	$senderSWDeveloper = $doc->createElement('SenderSoftwareDeveloper');
	$senderSWDeveloper = $senderSw->appendChild($senderSWDeveloper);
	$text = $doc->createTextNode('Henry Schein Medical Systems');
	$text = $senderSWDeveloper->appendChild($text);

	$senderSWProduct = $doc->createElement('SenderSoftwareProduct');
	$senderSWProduct = $senderSw->appendChild($senderSWProduct);
	$text = $doc->createTextNode('MicroMD EMR');
	$text = $senderSWProduct->appendChild($text);
	
	$senderSWVersion = $doc->createElement('SenderSoftwareVersionRelease');
	$senderSWVersion = $senderSw->appendChild($senderSWVersion);
	$text = $doc->createTextNode('10.5.02.140');
	$text = $senderSWVersion->appendChild($text);

	$body = $doc->createElement('Body');
	$body =$root->appendChild($body);

	$clinicalMsg = $doc->createElement('ClinicalMessage');
	$clinicalMsg = $body->appendChild($clinicalMsg);

	$subject = $doc->createElement('Subject');
	$subject = $clinicalMsg->appendChild($subject);
	$text = $doc->createTextNode($sub);
	$text = $subject->appendChild($text);

	$document = $doc->createElement('Document');
	$document = $clinicalMsg->appendChild($document);

	$plainText = $doc->createElement('PlainText');
	$plainText = $document->appendChild($plainText);
	$text = $doc->createTextNode('1.Feeling down or depressed or hopeless-'.$_POST['Q1'].'
2.Little interest or pleasure in doing things-'.$_POST['Q2'].'
3. Trouble falling or staying asleep, or sleeping too much-'.$_POST['Q3'].'

4. Feeling tired or having little energy-'.$_POST['Q4'].'
5. Poor appetite or overeating-'.$_POST['Q5'].'

6. Feeling bad about yourself ot that you are a failure or have
   let yourself or your family down-'.$_POST['Q6'].'
7. Trouble concentrating on things such as reading 
   newspaper or watching TV-'.$_POST['Q7'].'
8. Moving or speaking so slowly that other people could have
   noticed? Or the oppsite, being so fidgety or restless that
   you have been moving around a lot more than usual-'.$_POST['Q8'].'
9. Thoughts that you would be better off dead or of hurting

   yourself in some way-'.$_POST['Q9'].  '
   Total score is = '.$_POST['total'].'');
	$text = $plainText->appendChild($text);

	$htmlText = $doc->createElement('HTMLText');
	$htmlText = $document->appendChild($htmlText);
	$text = $doc->createTextNode('
		<![CDATA[<?xml version="1.0" ?>
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta content="TX18_HTM 18.0.402.500" name="GENERATOR" />
		<title></title>
		</head>
		<body style="font-family:\'Arial\';font-size:12pt;text-align:left;">
		<p style="margin-top:0pt;margin-bottom:0pt;"><span style="font-family:\'Tahoma\';font-size:10pt;color:#000000;">bodymsg</span></p>
		</body>
		</html>]]>
		');
	$text = $htmlText->appendChild($text);	

	$attachment = $doc->createElement('Attachment');
	$attachment = $clinicalMsg->appendChild($attachment);

	$docName = $doc->createElement('DocumentName');
	$docName = $attachment->appendChild($docName);
	$text = $doc->createTextNode($pdfname);
	$text = $docName->appendChild($text);

	$file = $doc->createElement('File');
	$file = $attachment->appendChild($file);

	$docType = $doc->createElement('DocumentType');
	$docType = $file->appendChild($docType);
	$text = $doc->createTextNode('application/pdf');
	$text = $docType->appendChild($text);

	$docData = $doc->createElement('DocumentData');
	$docData = $file->appendChild($docData);
	$text = $doc->createTextNode(base64_encode($filedata));
	$text = $docData->appendChild($text);
	
	unlink($tempname);

	echo "Saving all the document:\n";
	echo $doc->save("./xml/".$xmlname) . "\n";


?>