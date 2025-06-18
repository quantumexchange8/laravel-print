<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class ReceiptController extends Controller
{
    public function showPrintPage($id)
    {
        return view('print', ['orderId' => $id]);
    }

    public function getReceipt($id)
    {
        $order = Order::with('items')->findOrFail($id);

        $lines = [];
        $lines[] = "** MY STORE **";
        $lines[] = "----------------------------";
        foreach ($order->items as $item) {
            $lines[] = sprintf("%-20s x%-2d %6.2f", $item->name, $item->quantity, $item->price);
        }
        $lines[] = "----------------------------";
        $lines[] = sprintf("TOTAL: %22.2f", $order->total);
        $lines[] = "Thanks for shopping!";
        $lines[] = "\n\n\n";

        $receiptText = implode("\n", $lines);

        return response()->json([
            'text' => $receiptText,
        ]);
    }
}
