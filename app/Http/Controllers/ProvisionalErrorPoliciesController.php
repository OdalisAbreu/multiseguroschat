<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoices;
use App\Models\ProvisionalErrorPolicies;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProvisionalErrorPoliciesController extends Controller
{

    public function index()
    {
        $transactionDetail = ProvisionalErrorPolicies::with('invoice', 'invoice.client')->get();
        return Inertia::render('AdminPages/ErrorPolicies', [
            'transactionDetail' => $transactionDetail
        ]);
    }
}
