<?php
  App::import('Vendor','tcpdf/tcpdf');
  class MYTCPDF  extends TCPDF {
    var $xfootertext  = '';

    function Header() {
    }

    function Footer() {
      $this->SetY(-20);
      $this->SetDrawColor(204, 0, 0);
      $this->SetFont('arial', '', 10);
      $this->SetTextColor(204,0,0);
      $this->Cell(170, 1, '', 'T',0,'L', 0);
      $this->SetY(-22);
      $this->Cell(0, 5, $this->PageNo(), 0, 1, 'R', 0);
      $this->SetFont('arial','',6);
      $this->SetTextColor(0, 0, 0);
      $this->SetY(-16);
      $this->writeHTML($this->xfootertext, true, 0, true, 0);
    }
  }
?>
