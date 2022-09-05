<?php

namespace App\Http\Controllers;

use App\Support\Invoice;

class DownloadInvoiceController
{
    public function index()
    {
        return Invoice::download();
    }
}