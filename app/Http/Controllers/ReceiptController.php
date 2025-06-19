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
            $cut = "\x1D\x56\x00"; // Full cut
            $qrData = "1234";
            $qrLen = strlen($qrData) + 3;
            $pL = $qrLen % 256;
            $pH = intval($qrLen / 256);
    
            $qr = "";
            $qr .= "\x1D\x28\x6B\x03\x00\x31\x43\x03";          // Module size
            $qr .= "\x1D\x28\x6B\x03\x00\x31\x45\x30";          // Error correction level L
            $qr .= "\x1D\x28\x6B" . chr($pL) . chr($pH) . "\x31\x50\x30" . $qrData; // Store data
            $qr .= "\x1D\x28\x6B\x03\x00\x31\x51\x30";          // Print the QR
    
            $lines = [];
            $lines[] = "** MY STORE **";
            $lines[] = "----------------------------";
            $lines[] = "Coffee              x2   9.00";
            $lines[] = "Cake                x1   5.50";
            $lines[] = "----------------------------";
            $lines[] = "TOTAL:                  14.50";
            $lines[] = "Thank you!";
            $lines[] = "\n\n\n";
    
            $receiptText = implode("\n", $lines) . $qr . $cut;
    
            return response()->json([
                'text' => $receiptText,
            ]);
    
        } catch (\Exception $e) {
            \Log::error('Print receipt error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Internal server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
}
