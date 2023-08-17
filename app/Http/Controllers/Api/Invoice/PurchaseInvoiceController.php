<?php

namespace App\Http\Controllers\Api\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Invoice\Invoice;
use Illuminate\Http\Request;

class PurchaseInvoiceController extends Controller
{
    function createPurchase(Request $request)
    {
        $purchase = new Invoice();

        $purchase->invoice_ref = 'PUR_' . time() . rand(46, 2350);
        $purchase->type = 'purchase';
        $purchase->invoice_status = $request->invoice_status;
        $purchase->payment_status = $request->payment_status;
        $purchase->invoice_date = $request->invoice_date;
        $purchase->note = $request->invoice_note;
        $purchase->created_by = auth()->user()->id;

        $purchase->party_id = $request->supplier_id;
        $purchase->warehouse_id = $request->warehouse_id;
        $purchase->discount_type = 'flat';
        $purchase->discount = $request->discount??0;
        $purchase->invoice_tax_rate = $request->invoice_tax_rate??0;

        $purchase->total_amount = $request->total_amount;
        $purchase->paid_amount = 0;
        $purchase->due_amount = 0;
        $purchase->returned_amount = 0;

        $purchase->save();
    }
}
