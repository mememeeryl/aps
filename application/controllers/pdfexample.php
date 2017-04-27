<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class pdfexample extends CI_Controller {
  
    function __construct()
    {
        parent::__construct();
        $this->load->library("Pdf_Library");
        $this->load->model('Pdf_Model');
    }
  	
   function create_pdf() {
    //============================================================+
    // File name   : example_001.php
    //
    // Description : Example 001 for TCPDF class
    //               Default Header and Footer
    //
    // Author: Muhammad Saqlain Arif
    //
    // (c) Copyright:
    //               Muhammad Saqlain Arif
    //               PHP Latest Tutorials
    //               http://www.phplatesttutorials.com/
    //               saqlain.sial@gmail.com
    //============================================================+
 
   
  
    // create new PDF document
	//if ($this->session->userdata('logged_in')){
			//$session_data = $this->session->userdata('logged_in');
			//$org = $session_data['username'];
  	$org = 'JEMA';
    $term = '1';
			
	//	}
    $pdf = new TCPDF('L', PDF_UNIT, array('203.2','349.9'), true, 'UTF-8', false);    
  
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Muhammad Saqlain Arif');
    $pdf->SetTitle('TCPDF Example 001');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');   
  
    // set default header data
    $pdf->SetHeaderData("cso.png", "20", "Council of Student Organizations", "Activity Processing System— " . $org ."\n Document Tracking System", array(41, 112, 30), array(16, 35, 13));
    $pdf->setFooterData(array(14, 66, 6), array(0,0,0)); 
  
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
  
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED); 
  
    // set margins
    $pdf->SetMargins('.3', PDF_MARGIN_TOP, '.3');
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);    
  
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
  
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  
  
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }   
  
    // ---------------------------------------------------------    
  
    // set default font subsetting mode
    $pdf->setFontSubsetting(true);   
  
    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('helvetica', '', 5, '', true);   
  
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage(); 
  
    // set text shadow effect

    // Set some content to print
    $table = '<table border="1">';
    $table .= '<col width ="100">
                <col width ="20">
                <col width ="20">
                <col width ="20">';
    $table .= '<tr>
                <th colspan ="4">General  Details</th>
                <th colspan ="4">Activity Details</th>
                <th colspan ="4">Submission Details</th>
                <th colspan = "4">Status Details</th>
                </tr>
            ';
    $table .='<tr> 
              <th>Activity Title</th>
              <th>Activity Particulars</th>
              <th>Term</th>
              <th>Tie Up</th>
              <th>Nature of Activity</th>
              <th>Type of Activity</th>
              <th>Venue</th>
              <th>Date</th>
              <th>Time</th>
              <th>Officer Name</th>
              <th>Email Address</th>
              <th>Contact Number</th>
              <th>Date of Submission</th>
              <th>Status</th>
              <th>Checked By</th>
              <th>Date Checked</th>
              <th>Remarks</th>
              </tr>

  
           <tbody><tr>
                         <td>hi</td>
                         <td>hi</td>
                          <td>hi</td>
                         <td>hi</td>
                          <td>hi</td>
                         <td>hi</td>
                          <td>hi</td>
                         <td>hi</td>
                          <td>hi</td>
                         <td>hi</td>
                          <td>hi</td>
                         <td>hi</td>
                            <td>hi</td>
                         <td>hi</td>
                          <td>hi</td>
                         <td>hi</td>
                   <tr>';
    $table .='  </table>';
    $pdf->writeHTMLCell(0, 0, '', '', $table, 0, 1, 0, true, 'C', true);
  
    // Print text using writeHTMLCell()
  
    // ---------------------------------------------------------    
  
    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    $pdf->Output('example_001.pdf', 'I');    
  
    //============================================================+
    // END OF FILE
    //============================================================+
    }
}
  
/* End of file c_test.php */
/* Location: ./application/controllers/c_test.php */