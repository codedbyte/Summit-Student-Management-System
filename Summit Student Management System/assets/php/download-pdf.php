<?php
require_once 'db_connect.php';
require_once '../fpdf/fpdf.php';

$category = $_GET['category'] ?? '';
$forms = $_GET['forms'] ?? '';

$formFilter = !empty($forms) ? explode(',', $forms) : [];

$query = "SELECT * FROM $category";
$params = [];
$types = '';

if ($category == 'students' || $category == 'attendance' || $category == 'academics') {
    if (!empty($formFilter)) {
        $placeholders = implode(',', array_fill(0, count($formFilter), '?'));
        $query .= " WHERE form IN ($placeholders)";
        $params = array_merge($params, $formFilter);
        $types .= str_repeat('s', count($formFilter));
    }
}

$stmt = $conn->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

$pdf = new FPDF();
$pdf->AddPage();

// Set background color to white
$pdf->SetFillColor(255, 255, 255); // White background
$pdf->Rect(0, 0, 210, 297, 'F');

// Add logo and headers
$pdf->Image('../img/logo2.png', 80, 10, 50); // Smaller logo
$pdf->Ln(40); // Margin-bottom of 20px for the logo
$pdf->SetFont('Arial', 'B', 16);
$pdf->Ln(10);
$pdf->Cell(0, 10, 'Student Management System', 0, 1, 'C');
$pdf->Cell(0, 10, ucfirst($category) . ' Report', 0, 1, 'C');

// If forms are selected, include them in the report title
if (!empty($formFilter)) {
    $pdf->Cell(0, 10, 'Forms: ' . implode(', ', $formFilter), 0, 1, 'C');
}

// Table Headers
$header = [];
if ($category == 'students') {
    $header = ['Student ID', 'First Name', 'Last Name', 'Form', 'Gender'];
} elseif ($category == 'attendance') {
    $header = ['Student ID', 'Admission Number', 'Date', 'Status', 'Form'];
} elseif ($category == 'academics') {
    $header = ['Student ID', 'Form', 'Admission Number', 'First Name', 'Last Name', 'Year', 'Term', 'Exam', 'Grade'];
} elseif ($category == 'notifications') {
    $header = ['Notification ID', 'Title', 'Date', 'Status'];
}

// Set header font and color
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(255, 215, 0); // Gold background for headers
$pdf->SetTextColor(0, 0, 0); // Black text for headers

// Calculate the width of each column
$widths = array_fill(0, count($header), 190 / count($header));

// Table Header Row
foreach ($header as $col) {
    $pdf->Cell($widths[array_search($col, $header)], 10, $col, 1, 0, 'C', true);
}
$pdf->Ln();

// Set body font and color
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0, 0, 128); // Dark blue text

// Fetching data and populating the table rows
while ($row = $result->fetch_assoc()) {
    foreach ($header as $col) {
        $field = strtolower(str_replace(' ', '_', $col));
        $pdf->Cell($widths[array_search($col, $header)], 10, $row[$field] ?? '', 1, 0, 'C');
    }
    $pdf->Ln();
}

// Determine the filename based on the filters
$filename = ucfirst($category) . '_report.pdf';
if (!empty($formFilter)) {
    $filename = ucfirst($category) . '_' . implode('_', $formFilter) . '_report.pdf';
}

// Save or output the PDF
$pdf->Output('D', $filename);

?>
