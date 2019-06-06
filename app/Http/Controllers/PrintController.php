<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Mpdf\Mpdf;

class PrintController extends Controller
{
    public function agents() {
        $agents = Agent::all();

        $mpdf = new Mpdf();
        $view = view('pdf.agents', ['agents' => $agents])->render();
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }
}
