<?php

// Include the main TCPDF library (search for installation path).
require_once('/var/www/html/tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('You');
$pdf->setTitle('Your title');
$pdf->setSubject('Your subject\'s title');
$pdf->setKeywords('TCPDF test page');

// set default header data
//$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/tcpdf/examples/lang/lit.php')) {
	require_once(dirname(__FILE__).'/tcpdf/examples/lang/lit.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

$pdf->setFont('freeserif', '', 24);

$pdf->AddPage();

$html = '<div style="text-align:center">
<img src="tcpdf/examples/images/tcpdf_box.svg" alt="test alt attribute" width="100" height="100" border="0" />
</div>';

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Ln(5);

$html = '<div style="text-align:center"><span style="font-size: xx-large;">PAŽYMĖJIMAS</span></div>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Ln(25);

$pdf->setFont('freeserif', 'B', 14);

$html = '<div style="text-align:center"><span style="font-size: medium;">Visas vardas ir pavardė</span></div>';

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Ln(8);

$pdf->setFont('freeserif', '', 12);

$html = '<div style="text-align:center"><span style="font-size: medium;">DATA NUO - DATA IKI</span></div>';

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Ln(5);

$pdf->setFont('freeserif', '', 12);

$html = '<div style="text-align:justify"><span style="font-size: medium;">Aiškinamasis raštas. Aiškinamasis raštas. Aiškinamasis raštas. Aiškinamasis raštas.</span></div>';

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Ln(33);

$html = '
<table border="0" cellspacing="3" cellpadding="4">
	<tr>
		<th align="left">Asmens pareigos</th>
		<th>&nbsp;</th>
		<th align="right">Vardas ir Pavardė</th>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>';

$pdf->writeHTML($html, true, false, true, false, '');

$x = $pdf->getX();
$y = $pdf->getY();

$pdf->Image('tcpdf/examples/images/logo_example.png', $x+33, $y-22, 40, 40, 'PNG', '', '', true, 300, '', false, false, 0, false, false, false);

$pdf->setX($x);
$y2 = $pdf->getY();
$pdf->setY($y2+20);

$html = '<div style="text-align:left"><span style="font-size: medium;">Registracijos duomenys.</span></div>';

$pdf->writeHTML($html, true, false, true, false, '');

// set style for barcode
$style = array(
	'border' => 2,
	'vpadding' => 'auto',
	'hpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255)
	'module_width' => 1, // width of a single module in points
	'module_height' => 1 // height of a single module in points
);

$x3 = $pdf->getX();
$y3 = $pdf->getY();

// QRCODE,H : QR-CODE Best error correction
$pdf->write2DBarcode('https://localhost/?get_certificate=secure_mesh_code_of_this_certificate', 'QRCODE,H', $x3+130, $y3+8, 50, 50, $style, 'N');
$pdf->Text($x3+130, $y3+3, 'Available Online');

$pdf->lastPage();

$pdf->Output('Your_earned_certificate.pdf', 'I');

?>
