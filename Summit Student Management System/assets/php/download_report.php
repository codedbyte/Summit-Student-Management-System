<?php
require('../fpdf/fpdf.php');
require('db_connect.php');

if (isset($_GET['report_type'])) {
    $report_type = $_GET['report_type'];

    // Instantiate PDF object
    $pdf = new FPDF();
    $pdf->AddPage();

    // Define colors, fonts, and line widths for styling
    $headerColor = [0, 102, 204]; // Dark blue for headers
    $rowColor1 = [240, 240, 240]; // Light gray for alternating rows
    $rowColor2 = [255, 255, 255]; // White for alternating rows
    $borderColor = [200, 200, 200]; // Light gray for borders
    $textColor = [50, 50, 50]; // Dark gray for text

    // Set font for the title
    $pdf->SetFont('Arial', 'B', 12); // Title font size
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(0, 10, ucfirst($report_type) . ' Report', 0, 1, 'C');
    $pdf->Ln(10); // Add space after the title

    // Define the query based on the report type
    switch ($report_type) {
        case 'enrollment':
            $query = "SELECT * FROM students ORDER BY form";
            break;
        case 'attendance':
            $query = "SELECT * FROM attendance ORDER BY form";
            break;
        case 'academics':
            $query = "SELECT * FROM academics ORDER BY form";
            break;
        default:
            die('Invalid report type.');
    }

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Group data by form
        $dataByForm = [];
        while ($row = $result->fetch_assoc()) {
            $form = $row['form'];
            if (!isset($dataByForm[$form])) {
                $dataByForm[$form] = [];
            }
            $dataByForm[$form][] = $row;
        }

        // Calculate column width based on the page width and number of columns
        $pdf->SetFont('Arial', '', 4); // Default font size for data
        $firstRow = reset($dataByForm); // Get the first form's rows to calculate column width
        if (!empty($firstRow)) {
            $numColumns = count($firstRow[0]);
            $columnWidth = ($pdf->GetPageWidth() - 20) / $numColumns; // Adjust for margins
        } else {
            $columnWidth = 40; // Default value if no columns are available
        }

        // Set header styles
        $pdf->SetFillColor($headerColor[0], $headerColor[1], $headerColor[2]);
        $pdf->SetTextColor(255, 255, 255); // White text for headers
        $pdf->SetDrawColor($borderColor[0], $borderColor[1], $borderColor[2]);
        $pdf->SetLineWidth(0.3);

        foreach ($dataByForm as $form => $rows) {
            // Add form header
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetTextColor(255, 255, 255); // White text for headers
            $pdf->SetFillColor($headerColor[0], $headerColor[1], $headerColor[2]); // Blue background
            $pdf->Cell(0, 10, 'Form ' . $form, 0, 1, 'L', true); // Form header with blue background
            $pdf->Ln(5); // Add space after the form header

            // Create table headers
            $pdf->SetFont('Arial', 'B', 6); // Font size for headers
            $pdf->SetTextColor(255, 255, 255); // White text for headers
            $pdf->SetFillColor($headerColor[0], $headerColor[1], $headerColor[2]); // Blue background for header

            $firstRow = reset($rows);
            foreach (array_keys($firstRow) as $key) {
                $pdf->Cell($columnWidth, 4, ucfirst($key), 1, 0, 'C', true); // Reduced header height
            }
            $pdf->Ln();

            // Reset text color for table rows
            $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
            $pdf->SetFont('Arial', '', 4); // Font size for data

            // Populate table rows with alternating row colors
            $rowToggle = false;
            foreach ($rows as $row) {
                $rowColor = $rowToggle ? $rowColor1 : $rowColor2;
                $pdf->SetFillColor($rowColor[0], $rowColor[1], $rowColor[2]);
                $rowToggle = !$rowToggle;

                foreach ($row as $column) {
                    $pdf->Cell($columnWidth, 4, $column, 1, 0, 'C', true); // Reduced cell height
                }
                $pdf->Ln();
            }

            $pdf->Ln(10); // Add space after each form section
        }
    } else {
        $pdf->SetFont('Arial', '', 6); // Font size for no data message
        $pdf->Cell(0, 10, 'No data found.', 0, 1, 'C');
    }

    // Output the PDF
    $pdf->Output('D', $report_type . '_report.pdf');
    exit;
}
?>
