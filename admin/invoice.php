<?php
require_once('auth_check.php');
require_once('../config/db.php');

$order_id = intval($_GET['id'] ?? 0);
if ($order_id <= 0) {
    header('Location: orders.php');
    exit;
}

$all_orders = get_all_orders();
$order = null;
foreach ($all_orders as $o) {
    if (($o['id'] ?? 0) == $order_id) {
        $order = $o;
        break;
    }
}

if (!$order) {
    die("Error: Order #{$order_id} not found.");
}

$invoice_num = 'NLM-INV-' . date('Y', strtotime($order['created_at'])) . '-' . str_pad($order['id'], 3, '0', STR_PAD_LEFT);
$issue_date = date('M d, Y', strtotime($order['created_at']));
$delivery_date = !empty($order['delivery_date']) ? date('M d, Y', strtotime($order['delivery_date'])) : (!empty($order['deadline']) ? htmlspecialchars($order['deadline']) : 'Within 5-7 Days');

$total_price = floatval($order['order_amount'] ?? 0);
if ($total_price <= 0) {
    if (!empty($order['budget_range'])) {
        if (preg_match('/([0-9,]+)/', $order['budget_range'], $m)) {
            $total_price = floatval(str_replace(',', '', $m[1]));
        }
    }
}
$paid_amount = floatval($order['paid_amount'] ?? 0);
$due_amount = max(0, $total_price - $paid_amount);

$status_str = 'PAYMENT DUE';
$status_badge_bg = 'bg-amber-100 text-amber-800 border-amber-300';
if ($paid_amount >= $total_price && $total_price > 0) {
    $status_str = 'PAID IN FULL';
    $status_badge_bg = 'bg-emerald-100 text-emerald-800 border-emerald-300';
} elseif ($paid_amount > 0) {
    $status_str = 'PARTIAL PAYMENT';
    $status_badge_bg = 'bg-blue-100 text-blue-800 border-blue-300';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Invoice <?= $invoice_num; ?> | Next Level Media</title>
  <link rel="icon" href="../main-logo.png" type="image/png" />
  
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background-color: #0b0d14;
      color: #0f172a;
      -webkit-font-smoothing: antialiased;
    }
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }

    /* Strict Single-Page Print Optimization */
    @page {
      size: A4 portrait;
      margin: 8mm 10mm;
    }
    @media print {
      body {
        background-color: #ffffff !important;
        padding: 0 !important;
        margin: 0 !important;
      }
      .no-print {
        display: none !important;
      }
      .invoice-card {
        box-shadow: none !important;
        border: none !important;
        padding: 0 !important;
        margin: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
      }
      .page-break-avoid {
        break-inside: avoid;
        page-break-inside: avoid;
      }
    }
  </style>
</head>
<body class="py-6 px-3 sm:px-6 min-h-screen flex flex-col items-center justify-center">

  <!-- Top Action Toolbar (Hidden on Print / PDF) -->
  <div class="w-full max-w-[850px] mb-4 flex items-center justify-between gap-4 no-print">
    <a href="orders.php?id=<?= $order['id']; ?>" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold transition-all">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
      </svg>
      <span>Back to Order #<?= $order['id']; ?></span>
    </a>

    <div class="flex items-center gap-2">
      <button onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-extrabold shadow-lg shadow-indigo-600/30 transition-all cursor-pointer">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
        </svg>
        <span>Print / Save as PDF (1 Page)</span>
      </button>
    </div>
  </div>

  <!-- Printable Invoice Document (Strict 1-Page Tabular Architecture) -->
  <div class="invoice-card w-full max-w-[850px] bg-white rounded-2xl p-6 sm:p-8 shadow-2xl border border-slate-200 text-slate-800 text-[13px] leading-tight page-break-avoid">
    
    <!-- 1. Header: Brand Identity & Invoice Status Meta -->
    <div class="flex items-start justify-between gap-4 pb-4 mb-4 border-b-2 border-slate-900">
      
      <!-- Agency Identity -->
      <div class="flex items-start gap-3">
        <div class="w-11 h-11 rounded-xl bg-indigo-600 p-1.5 flex items-center justify-center shadow shrink-0">
          <img src="../main-logo.png" alt="Logo" class="w-full h-full object-contain">
        </div>
        <div>
          <h1 class="text-xl font-extrabold text-slate-900 tracking-tight font-display">NEXT LEVEL MEDIA</h1>
          <p class="text-[11px] font-bold text-indigo-600 uppercase tracking-wider">Video Production & Creative Systems</p>
          <div class="text-[11px] text-slate-500 font-mono mt-0.5 space-x-2">
            <span>nextlevelmediadigital.com</span>
            <span>&bull;</span>
            <span>contact@nextlevelmediadigital.com</span>
          </div>
        </div>
      </div>

      <!-- Invoice Title & Status Pill -->
      <div class="text-right">
        <div class="text-2xl font-black text-slate-900 font-display tracking-tight">INVOICE</div>
        <div class="text-xs font-mono font-bold text-indigo-600"><?= $invoice_num; ?></div>
        <div class="mt-1">
          <span class="inline-block px-2.5 py-0.5 rounded text-[10px] font-black uppercase tracking-wider border <?= $status_badge_bg; ?>">
            <?= $status_str; ?>
          </span>
        </div>
      </div>

    </div>

    <!-- 2. Metadata Tables Grid (Billed To & Project Details) -->
    <div class="grid grid-cols-2 gap-3 mb-4">
      
      <!-- Billed To Box -->
      <div class="border border-slate-200 rounded-xl p-3 bg-slate-50/60">
        <div class="text-[10px] font-bold uppercase tracking-wider text-indigo-700 mb-1.5 flex items-center gap-1 font-display">
          <span>Client Details (Billed To):</span>
        </div>
        <table class="w-full text-left text-[12px]">
          <tbody>
            <tr>
              <td class="font-bold text-slate-900 text-[13px] pb-0.5" colspan="2">
                <?= htmlspecialchars($order['client_name']); ?>
                <?php if (!empty($order['company_name'])): ?>
                  <span class="text-slate-500 font-normal text-[11px]"> (<?= htmlspecialchars($order['company_name']); ?>)</span>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <td class="text-slate-500 text-[11px] w-14">Email:</td>
              <td class="text-slate-800 font-medium text-[11px] truncate"><?= htmlspecialchars($order['client_email']); ?></td>
            </tr>
            <tr>
              <td class="text-slate-500 text-[11px]">Phone:</td>
              <td class="text-slate-800 font-medium text-[11px]"><?= htmlspecialchars($order['contact_number']); ?></td>
            </tr>
            <?php if (!empty($order['client_address'])): ?>
            <tr>
              <td class="text-slate-500 text-[11px]">Address:</td>
              <td class="text-slate-800 font-medium text-[11px] truncate"><?= htmlspecialchars($order['client_address']); ?></td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <!-- Invoice Specs Box -->
      <div class="border border-slate-200 rounded-xl p-3 bg-slate-50/60">
        <div class="text-[10px] font-bold uppercase tracking-wider text-indigo-700 mb-1.5 flex items-center gap-1 font-display">
          <span>Invoice & Timeline:</span>
        </div>
        <table class="w-full text-left text-[11px]">
          <tbody class="space-y-1">
            <tr>
              <td class="text-slate-500 py-0.5">Issue Date:</td>
              <td class="text-right font-mono font-bold text-slate-800"><?= $issue_date; ?></td>
            </tr>
            <tr>
              <td class="text-slate-500 py-0.5">Delivery Target:</td>
              <td class="text-right font-mono font-bold text-slate-800"><?= $delivery_date; ?></td>
            </tr>
            <tr>
              <td class="text-slate-500 py-0.5">Project Scope:</td>
              <td class="text-right font-semibold text-indigo-600 truncate max-w-[140px]"><?= htmlspecialchars($order['service_types']); ?></td>
            </tr>
            <tr>
              <td class="text-slate-500 py-0.5">Payment Terms:</td>
              <td class="text-right font-medium text-slate-700">Due Upon Delivery / Clearance</td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>

    <!-- 3. Primary Deliverables & Services Table -->
    <div class="border border-slate-200 rounded-xl overflow-hidden mb-4">
      <table class="w-full text-left text-[12px]">
        <thead class="bg-slate-900 text-white text-[10px] uppercase font-bold tracking-wider">
          <tr>
            <th class="py-2 px-3 w-8">#</th>
            <th class="py-2 px-3">Service Deliverables Description</th>
            <th class="py-2 px-3 text-center w-16">Qty</th>
            <th class="py-2 px-3 text-right w-24">Rate</th>
            <th class="py-2 px-3 text-right w-28">Amount ($)</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
          
          <!-- Line Item 1: Main Deliverables -->
          <tr class="bg-white">
            <td class="py-2.5 px-3 font-mono text-slate-400 font-bold">01</td>
            <td class="py-2.5 px-3">
              <div class="font-bold text-slate-900 text-[13px]"><?= htmlspecialchars($order['service_types']); ?></div>
              <div class="text-[11px] text-slate-500 line-clamp-2 mt-0.5 leading-snug">
                <?= htmlspecialchars(substr($order['project_description'], 0, 160)); ?><?= strlen($order['project_description']) > 160 ? '...' : ''; ?>
              </div>
            </td>
            <td class="py-2.5 px-3 text-center font-mono font-bold">1</td>
            <td class="py-2.5 px-3 text-right font-mono">$<?= number_format($total_price, 2); ?></td>
            <td class="py-2.5 px-3 text-right font-mono font-bold text-slate-900">$<?= number_format($total_price, 2); ?></td>
          </tr>

          <!-- Line Item 2: QA & Commercial Licensing -->
          <tr class="bg-slate-50/50">
            <td class="py-2 px-3 font-mono text-slate-400 font-bold">02</td>
            <td class="py-2 px-3">
              <div class="font-semibold text-slate-800 text-[11px]">Audio Mastering, Color Grading & Commercial Rights</div>
              <div class="text-[10px] text-slate-400">Includes 2 standard revision passes, pacing optimization, and raw asset archiving.</div>
            </td>
            <td class="py-2 px-3 text-center font-mono text-xs">1</td>
            <td class="py-2 px-3 text-right font-mono text-[11px] text-emerald-600 font-bold">INCLUDED</td>
            <td class="py-2 px-3 text-right font-mono text-[11px] text-emerald-600 font-bold">$0.00</td>
          </tr>

        </tbody>
      </table>
    </div>

    <!-- 4. Bottom Tabular Grid: Payment Methods & Totals Summary -->
    <div class="grid grid-cols-12 gap-3 mb-3">
      
      <!-- Left (7 cols): Payment Instructions & Terms -->
      <div class="col-span-7 space-y-2">
        <div class="border border-slate-200 rounded-xl p-3 bg-slate-50/70">
          <div class="text-[10px] font-bold uppercase tracking-wider text-slate-900 mb-1 font-display">Payment Instructions:</div>
          <table class="w-full text-[11px] text-slate-700">
            <tbody>
              <tr>
                <td class="text-slate-500 font-medium w-28">Bank Wire / SWIFT:</td>
                <td class="font-bold text-slate-800">Next Level Media Digital</td>
              </tr>
              <tr>
                <td class="text-slate-500 font-medium">PayPal / Wise:</td>
                <td class="font-bold text-indigo-600">contact@nextlevelmediadigital.com</td>
              </tr>
              <tr>
                <td class="text-slate-500 font-medium">Crypto (USDT):</td>
                <td class="font-bold text-slate-800">Available on request (TRC20 / BEP20)</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="p-2 text-[10px] text-slate-500 leading-tight">
          <p><strong>Terms:</strong> Full commercial copyright transferred upon 100% invoice settlement. Revisions covered within 14 days.</p>
        </div>
      </div>

      <!-- Right (5 cols): Strict Financial Totals Table -->
      <div class="col-span-5">
        <div class="border border-slate-300 rounded-xl overflow-hidden">
          <table class="w-full text-[12px]">
            <tbody class="divide-y divide-slate-200">
              <tr class="bg-slate-50">
                <td class="py-1.5 px-3 text-slate-600 font-medium">Subtotal:</td>
                <td class="py-1.5 px-3 text-right font-mono font-bold text-slate-900">$<?= number_format($total_price, 2); ?></td>
              </tr>
              <tr>
                <td class="py-1.5 px-3 text-slate-600 font-medium">Amount Paid:</td>
                <td class="py-1.5 px-3 text-right font-mono font-bold text-emerald-600">-$<?= number_format($paid_amount, 2); ?></td>
              </tr>
              <tr class="bg-slate-900 text-white">
                <td class="py-2 px-3 font-extrabold text-[12px] font-display uppercase tracking-wider">Balance Due:</td>
                <td class="py-2 px-3 text-right font-mono font-black text-[14px] text-amber-300">
                  $<?= number_format($due_amount, 2); ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>

    <!-- 5. Executive Footer -->
    <div class="pt-2 border-t border-slate-200 flex items-center justify-between text-[10px] text-slate-400">
      <div>Thank you for choosing <strong>Next Level Media Digital</strong>.</div>
      <div class="font-mono">Official Studio Invoice &bull; Generated <?= date('Y-m-d H:i'); ?></div>
    </div>

  </div>

</body>
</html>
