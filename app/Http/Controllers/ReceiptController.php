<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function showPrintPage($id)
    {
        return view('print', ['orderId' => $id]);
    }

    public function getReceipt($id)
    {
        try {
            // TEMP: use hardcoded sample order (no DB)
            $lines = [];
            $lines[] = "** MY STORE **";
            $lines[] = "----------------------------";
            $lines[] = "Coffee              x2   9.00";
            $lines[] = "Cake                x1   5.50";
            $lines[] = "----------------------------";
            $lines[] = "TOTAL:                  14.50";
            $lines[] = "Thank you!";
            $lines[] = "\n\n\n";

            $receiptText = implode("\n", $lines);

            return response()->json([
                'text' => $receiptText,
            ]);

        } catch (\Exception $e) {
            // Log and return error for debugging
            \Log::error('Print receipt error: ' . $e->getMessage());

            return response()->json([
                'error' => 'Internal server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
