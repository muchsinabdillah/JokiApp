<?php

namespace App\Http\Controllers;

use TCPDF; 
use Milon\Barcode\DNS1D;

class PrintResiController extends Controller
{
    protected $pdf;

    public function __construct()
    {
        $this->pdf = new TCPDF('P', 'mm', 'A5', true, 'UTF-8', false);
		$this->d = new DNS1D();
    }

    public function index()
    { 
        $this->pdf->AddPage();

		$this->d->setStorPath(__DIR__ . '/cache/'); 
		$html =  view('dashboard.invoice.invoice')->render();

        $this->pdf->writeHTML($html);

        $this->pdf->Output('hello_world.pdf');
    } 
	public function bypas(){
		return view('dashboard.invoice.invoice');
	}
}
