<?php
    namespace LEANGA;
    
    require_once('tcpdf/tcpdf.php');
    
    use TCPDF;
    
    class Handler_PDF extends TCPDF{
        private $pdf;
        
        public function __construct(){
            parent::__construct('P', 'mm', 'A4', true, 'UTF-8', false);
            $this->SetPrintHeader(false);
            //$this->SetPrintFooter(false);
            $this->SetFont('helvetica', '', 10);
        }
        public function Footer() {
            $this->SetY(-15);
            $this->SetFont('helvetica', 'I', 8);
            $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        }
        
    }