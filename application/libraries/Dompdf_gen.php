<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php'; // Pastikan ini sesuai dengan path vendor composer Anda

use Dompdf\Dompdf;
use Dompdf\Options;

class Dompdf_gen {

    protected $dompdf;

    public function __construct() {
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $this->dompdf = new Dompdf($options);
    }

    public function loadHtml($html) {
        $this->dompdf->loadHtml($html);
    }

    public function setPaper($paper, $orientation = 'portrait') {
        $this->dompdf->setPaper($paper, $orientation);
    }

    public function render() {
        $this->dompdf->render();
    }

    public function stream($filename = "document.pdf", $options = []) {
        $this->dompdf->stream($filename, $options);
    }
}
