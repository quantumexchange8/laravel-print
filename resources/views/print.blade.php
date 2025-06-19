<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Print Receipt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: monospace; padding: 20px; }
        button { padding: 10px 20px; font-size: 18px; }
    </style>
</head>
<body>
    <h2>Print Receipt</h2>
    <button onclick="printReceipt({{ $orderId }})">🖨️ Print Now</button>

    <script>
    async function printReceipt(orderId) {
        try {
            const res = await fetch(`/receipt/${orderId}`);
            if (!res.ok) throw new Error("HTTP " + res.status);
            const data = await res.json();
            const base64 = btoa(unescape(encodeURIComponent(data.text)));
            alert("Sending to RawBT...");
            window.location.href = `rawbt:base64,${base64}`;
        } catch (err) {
            alert("Print failed: " + err.message);
            console.error("Print error", err);
        }
    }
    </script>
</body>
</html>
