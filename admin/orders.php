<?php
$page_title = 'Client Project Orders';
require_once('layout_header.php');

$msg = '';
$status_filter = $_GET['status'] ?? 'all';
$view_id = intval($_GET['id'] ?? 0);

// Handle Full Order Update (Status, Delivery Date, Pricing, Payments, Notes)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_order_details'])) {
    $order_id = intval($_POST['order_id'] ?? 0);
    $new_status = trim($_POST['status'] ?? 'Pending');
    $delivery_date = trim($_POST['delivery_date'] ?? '');
    $order_amount = floatval($_POST['order_amount'] ?? 0);
    $paid_amount = floatval($_POST['paid_amount'] ?? 0);
    $payment_status = trim($_POST['payment_status'] ?? 'Unpaid');
    $client_address = trim($_POST['client_address'] ?? '');
    $invoice_notes = trim($_POST['invoice_notes'] ?? '');
    $admin_notes = trim($_POST['admin_notes'] ?? '');

    // Auto compute payment status if paid amount is modified
    if ($paid_amount >= $order_amount && $order_amount > 0) {
        $payment_status = 'Paid';
    } elseif ($paid_amount > 0 && $paid_amount < $order_amount) {
        $payment_status = 'Partial';
    }

    if ($order_id > 0) {
        update_order_full($order_id, [
            'status' => $new_status,
            'delivery_date' => $delivery_date,
            'order_amount' => $order_amount,
            'paid_amount' => $paid_amount,
            'payment_status' => $payment_status,
            'client_address' => $client_address,
            'invoice_notes' => $invoice_notes,
            'admin_notes' => $admin_notes
        ]);

        // If payment was added and flagged, record in finances as income if requested
        if (isset($_POST['record_as_finance_income']) && $paid_amount > 0) {
            save_financial_record([
                'type' => 'income',
                'title' => "Payment for Order #{$order_id}",
                'category' => 'Client Project Payment',
                'amount' => $paid_amount,
                'payment_method' => 'Bank Transfer / Client Direct',
                'transaction_date' => date('Y-m-d'),
                'order_id' => $order_id,
                'notes' => "Auto-logged from Order #{$order_id}"
            ]);
        }

        $msg = "Order #{$order_id} details, delivery date, and payment status updated successfully!";
        $view_id = $order_id;
    }
}

// Fetch all orders
$all_orders = get_all_orders();
$orders = [];

if ($status_filter !== 'all') {
    $orders = array_values(array_filter($all_orders, function($o) use ($status_filter) {
        return ($o['status'] ?? 'Pending') === $status_filter;
    }));
} else {
    $orders = $all_orders;
}

// Compute status counts
$status_counts = [
    'all' => count($all_orders),
    'Pending' => 0,
    'In Review' => 0,
    'In Progress' => 0,
    'Completed' => 0,
    'Cancelled' => 0
];
foreach ($all_orders as $o) {
    $st = $o['status'] ?? 'Pending';
    if (isset($status_counts[$st])) {
        $status_counts[$st]++;
    }
}

// Fetch single order detail
$selected_order = null;
if ($view_id > 0) {
    foreach ($all_orders as $o) {
        if (($o['id'] ?? 0) == $view_id) {
            $selected_order = $o;
            break;
        }
    }
}
?>

<!-- Page Header -->
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
  <div>
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-1">
      <a href="index.php" class="hover:text-white transition-colors">Admin</a>
      <span>/</span>
      <span class="text-indigo-400 font-bold">Client Orders</span>
    </div>
    <h1 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight font-display">Client Project Briefs & Orders</h1>
    <p class="text-sm sm:text-base text-slate-300 mt-1">Manage project briefs, schedule delivery dates, record client payments, and generate professional PDF invoices.</p>
  </div>
  
  <div class="flex items-center gap-3">
    <a href="../order.php" target="_blank" class="adm-btn-primary">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
      </svg>
      <span>Live Order Form</span>
    </a>
  </div>
</div>

<!-- Alert Banner -->
<?php if (!empty($msg)): ?>
  <div class="mb-6 p-4 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-200 text-sm font-semibold flex items-center justify-between gap-3">
    <div class="flex items-center gap-2.5">
      <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
      </svg>
      <span><?= htmlspecialchars($msg); ?></span>
    </div>
    <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white text-base font-bold">&times;</button>
  </div>
<?php endif; ?>

<!-- Selected Order Detail Drawer / Card -->
<?php if ($selected_order): 
  $ord_amt = floatval($selected_order['order_amount'] ?? 0);
  $paid_amt = floatval($selected_order['paid_amount'] ?? 0);
  $due_amt = max(0, $ord_amt - $paid_amt);
?>
  <div class="mb-8 adm-card p-6 sm:p-8 border-indigo-500/50 shadow-2xl shadow-indigo-950/40 ring-1 ring-indigo-500/30">
    
    <!-- Detail Top Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 mb-6 border-b border-white/[0.08]">
      <div>
        <div class="flex items-center gap-3 mb-1.5">
          <span class="px-3 py-1 rounded-lg bg-indigo-600 text-white font-mono text-xs font-extrabold">
            ORDER #<?= $selected_order['id']; ?>
          </span>
          <span class="text-xs sm:text-sm text-slate-300 font-medium">
            Received <?= date('F d, Y \a\t H:i', strtotime($selected_order['created_at'])); ?>
          </span>
        </div>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-white font-display">
          <?= htmlspecialchars($selected_order['client_name']); ?>
        </h2>
      </div>

      <!-- Action Buttons -->
      <div class="flex items-center gap-3">
        <a href="invoice.php?id=<?= $selected_order['id']; ?>" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow-lg shadow-emerald-600/30 transition-all">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
          </svg>
          <span>Generate Invoice (PDF)</span>
        </a>

        <a href="orders.php<?= $status_filter !== 'all' ? '?status='.$status_filter : ''; ?>" class="adm-btn-secondary text-xs sm:text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
          <span>Close</span>
        </a>
      </div>
    </div>

    <!-- Client & Project Specs Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
      
      <!-- Client Information -->
      <div class="p-5 rounded-2xl bg-black/40 border border-white/10 space-y-3 text-sm">
        <div class="text-xs font-bold uppercase tracking-wider text-slate-400 pb-2 border-b border-white/[0.08]">
          Client Information
        </div>
        <div class="flex items-center justify-between">
          <span class="text-slate-400">Email Address:</span>
          <a href="mailto:<?= htmlspecialchars($selected_order['client_email']); ?>" class="font-bold text-indigo-400 hover:underline">
            <?= htmlspecialchars($selected_order['client_email']); ?>
          </a>
        </div>
        <div class="flex items-center justify-between">
          <span class="text-slate-400">Phone / WhatsApp:</span>
          <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $selected_order['contact_number']); ?>" target="_blank" class="font-bold text-white hover:text-indigo-300">
            <?= htmlspecialchars($selected_order['contact_number']); ?>
          </a>
        </div>
        <div class="flex items-center justify-between">
          <span class="text-slate-400">Company / Brand:</span>
          <span class="font-bold text-slate-200"><?= htmlspecialchars($selected_order['company_name'] ?: 'Individual Creator'); ?></span>
        </div>
      </div>

      <!-- Project Specifications -->
      <div class="p-5 rounded-2xl bg-black/40 border border-white/10 space-y-3 text-sm">
        <div class="text-xs font-bold uppercase tracking-wider text-slate-400 pb-2 border-b border-white/[0.08]">
          Project Details & Turnaround
        </div>
        <div class="flex items-center justify-between">
          <span class="text-slate-400">Services Requested:</span>
          <span class="font-bold text-white"><?= htmlspecialchars($selected_order['service_types']); ?></span>
        </div>
        <div class="flex items-center justify-between">
          <span class="text-slate-400">Client's Desired Turnaround:</span>
          <span class="font-bold text-amber-300"><?= htmlspecialchars($selected_order['deadline'] ?: 'Standard'); ?></span>
        </div>
        <div class="flex items-center justify-between">
          <span class="text-slate-400">Target Delivery Date:</span>
          <span class="font-bold font-mono text-emerald-400">
            <?= !empty($selected_order['delivery_date']) ? date('M d, Y', strtotime($selected_order['delivery_date'])) : 'Not scheduled yet'; ?>
          </span>
        </div>
      </div>

    </div>

    <!-- Description & Reference Links -->
    <div class="space-y-4 mb-6">
      <div>
        <label class="block text-sm font-bold text-slate-200 mb-2">Project Brief Description:</label>
        <div class="p-5 rounded-2xl bg-black/50 border border-white/10 text-sm sm:text-base text-slate-100 leading-relaxed whitespace-pre-wrap font-sans">
          <?= htmlspecialchars($selected_order['project_description']); ?>
        </div>
      </div>

      <?php if (!empty($selected_order['reference_links'])): ?>
        <div>
          <label class="block text-sm font-bold text-slate-200 mb-2">Reference Links & Assets:</label>
          <div class="p-4 rounded-xl bg-black/50 border border-white/10 text-xs sm:text-sm font-mono text-indigo-300 break-all">
            <?= htmlspecialchars($selected_order['reference_links']); ?>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <!-- Financial & Status Management Form -->
    <form action="orders.php" method="POST" class="p-6 rounded-2xl bg-black/40 border border-indigo-500/30 space-y-6">
      <input type="hidden" name="save_order_details" value="1" />
      <input type="hidden" name="order_id" value="<?= $selected_order['id']; ?>" />

      <div class="border-b border-white/10 pb-3">
        <h3 class="text-base font-bold text-white font-display flex items-center gap-2">
          <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
          </svg>
          <span>Production Pipeline, Delivery Schedule & Billing</span>
        </h3>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <!-- Status -->
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Order Status</label>
          <select name="status" class="adm-input text-sm font-bold">
            <?php
              $all_statuses = ['Pending', 'In Review', 'In Progress', 'Completed', 'Cancelled'];
              foreach ($all_statuses as $st) {
                  $sel = ($selected_order['status'] === $st) ? 'selected' : '';
                  echo "<option value='{$st}' {$sel}>{$st}</option>";
              }
            ?>
          </select>
        </div>

        <!-- Target Delivery Date -->
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Target Delivery Date</label>
          <input 
            type="date" 
            name="delivery_date" 
            value="<?= htmlspecialchars($selected_order['delivery_date'] ?? ''); ?>" 
            class="adm-input text-sm font-mono font-bold" 
          />
        </div>

        <!-- Total Project Price -->
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Total Agreed Price ($ USD)</label>
          <input 
            type="number" 
            step="0.01" 
            min="0" 
            name="order_amount" 
            value="<?= htmlspecialchars($selected_order['order_amount'] ?? '0.00'); ?>" 
            class="adm-input text-sm font-mono font-bold" 
          />
        </div>

        <!-- Amount Paid -->
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Amount Paid ($ USD)</label>
          <input 
            type="number" 
            step="0.01" 
            min="0" 
            name="paid_amount" 
            value="<?= htmlspecialchars($selected_order['paid_amount'] ?? '0.00'); ?>" 
            class="adm-input text-sm font-mono font-bold text-emerald-400" 
          />
        </div>

      </div>

      <!-- Financial Calculation Pill -->
      <div class="p-4 rounded-xl bg-white/[0.03] border border-white/10 flex flex-wrap items-center justify-between gap-4 text-xs sm:text-sm">
        <div class="flex items-center gap-6">
          <div>
            <span class="text-slate-400">Total Price:</span>
            <span class="font-mono font-bold text-white ml-1">$<?= number_format($ord_amt, 2); ?></span>
          </div>
          <div>
            <span class="text-slate-400">Paid:</span>
            <span class="font-mono font-bold text-emerald-400 ml-1">$<?= number_format($paid_amt, 2); ?></span>
          </div>
          <div>
            <span class="text-slate-400">Remaining Due:</span>
            <span class="font-mono font-extrabold text-amber-400 ml-1">$<?= number_format($due_amt, 2); ?></span>
          </div>
        </div>

        <div class="flex items-center gap-2">
          <input type="checkbox" name="record_as_finance_income" id="recFinance" class="rounded accent-indigo-600">
          <label for="recFinance" class="text-slate-300 font-semibold cursor-pointer">
            Log this payment into Financial Tracker
          </label>
        </div>
      </div>

      <!-- Additional Details: Client Address & Admin Notes -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Client Billing Address (For Invoice)</label>
          <input 
            type="text" 
            name="client_address" 
            placeholder="e.g. 123 Creator Ave, Los Angeles, CA / UK / Global" 
            value="<?= htmlspecialchars($selected_order['client_address'] ?? ''); ?>" 
            class="adm-input text-sm" 
          />
        </div>

        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Internal Private Admin Notes</label>
          <input 
            type="text" 
            name="admin_notes" 
            placeholder="e.g. Rough cut sent on WhatsApp. Waiting for final sound check." 
            value="<?= htmlspecialchars($selected_order['admin_notes'] ?? ''); ?>" 
            class="adm-input text-sm" 
          />
        </div>
      </div>

      <div class="flex justify-end gap-3 pt-2">
        <button type="submit" class="adm-btn-primary px-8 py-3 text-sm font-bold">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          <span>Save Changes & Updates</span>
        </button>
      </div>

    </form>

  </div>
<?php endif; ?>

<!-- Filters & Search Toolbar -->
<div class="mb-6 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
  
  <!-- Status Tabs -->
  <div class="flex items-center gap-2 overflow-x-auto pb-2 sm:pb-0 text-sm">
    <a href="orders.php?status=all" class="px-4 py-2 rounded-xl font-bold transition-all whitespace-nowrap <?= $status_filter === 'all' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'bg-[#0e0e13] border border-[#23283c] text-slate-300 hover:text-white'; ?>">
      All Orders (<?= $status_counts['all']; ?>)
    </a>

    <a href="orders.php?status=Pending" class="px-4 py-2 rounded-xl font-bold transition-all whitespace-nowrap <?= $status_filter === 'Pending' ? 'bg-amber-500 text-black shadow-md' : 'bg-[#0e0e13] border border-[#23283c] text-amber-300 hover:bg-amber-500/10'; ?>">
      Pending (<?= $status_counts['Pending']; ?>)
    </a>

    <a href="orders.php?status=In Progress" class="px-4 py-2 rounded-xl font-bold transition-all whitespace-nowrap <?= $status_filter === 'In Progress' ? 'bg-purple-600 text-white shadow-md' : 'bg-[#0e0e13] border border-[#23283c] text-purple-300 hover:bg-purple-500/10'; ?>">
      In Progress (<?= $status_counts['In Progress']; ?>)
    </a>

    <a href="orders.php?status=Completed" class="px-4 py-2 rounded-xl font-bold transition-all whitespace-nowrap <?= $status_filter === 'Completed' ? 'bg-emerald-600 text-white shadow-md' : 'bg-[#0e0e13] border border-[#23283c] text-emerald-300 hover:bg-emerald-500/10'; ?>">
      Completed (<?= $status_counts['Completed']; ?>)
    </a>
  </div>

  <!-- Search Filter Input -->
  <div class="relative w-full sm:w-72">
    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
      </svg>
    </div>
    <input 
      type="text" 
      id="orderSearchInput" 
      placeholder="Search client name, email..." 
      class="adm-input text-sm pl-10 py-2.5" 
      onkeyup="filterOrdersTable()" 
    />
  </div>

</div>

<!-- Orders Table -->
<div class="adm-card p-6 sm:p-7">
  <?php if (empty($orders)): ?>
    <div class="text-center py-12 px-4">
      <p class="text-base font-bold text-slate-200">No orders found under this filter</p>
      <p class="text-sm text-slate-400 mt-1">Submit a new project brief to test the system.</p>
    </div>
  <?php else: ?>
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-slate-200" id="ordersTable">
        <thead>
          <tr class="text-slate-400 border-b border-white/[0.08] text-xs font-bold uppercase tracking-wider">
            <th class="pb-3 pr-3">ID</th>
            <th class="pb-3 pr-4">Client Name & Contact</th>
            <th class="pb-3 pr-4">Services Requested</th>
            <th class="pb-3 pr-4">Delivery Date</th>
            <th class="pb-3 pr-4">Payment & Due</th>
            <th class="pb-3 pr-4">Status</th>
            <th class="pb-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/[0.06]">
          <?php foreach ($orders as $o): 
            $o_total = floatval($o['order_amount'] ?? 0);
            $o_paid = floatval($o['paid_amount'] ?? 0);
            $o_due = max(0, $o_total - $o_paid);
          ?>
            <tr class="order-row hover:bg-white/[0.03] transition-colors">
              <td class="py-4 pr-3 font-mono font-bold text-slate-400">
                #<?= $o['id']; ?>
              </td>
              <td class="py-4 pr-4">
                <div class="font-bold text-white text-base client-name"><?= htmlspecialchars($o['client_name']); ?></div>
                <div class="text-xs text-slate-400 mt-0.5 client-contact"><?= htmlspecialchars($o['client_email']); ?> &bull; <?= htmlspecialchars($o['contact_number']); ?></div>
              </td>
              <td class="py-4 pr-4 max-w-[200px] truncate text-slate-200 font-medium client-service">
                <?= htmlspecialchars($o['service_types']); ?>
              </td>
              <td class="py-4 pr-4 whitespace-nowrap">
                <?php if (!empty($o['delivery_date'])): ?>
                  <span class="font-mono text-xs font-bold text-emerald-400 block">
                    <?= date('M d, Y', strtotime($o['delivery_date'])); ?>
                  </span>
                  <span class="text-[11px] text-slate-400">Scheduled Target</span>
                <?php else: ?>
                  <span class="text-xs text-amber-300 font-medium block"><?= htmlspecialchars($o['deadline'] ?: 'Approx 5-7 days'); ?></span>
                  <span class="text-[11px] text-slate-500">Requested</span>
                <?php endif; ?>
              </td>
              <td class="py-4 pr-4 whitespace-nowrap">
                <?php if ($o_total > 0): ?>
                  <div class="font-mono font-bold text-white text-sm">$<?= number_format($o_total, 2); ?></div>
                  <?php if ($o_due > 0): ?>
                    <span class="text-xs font-bold text-amber-400 font-mono">Due: $<?= number_format($o_due, 2); ?></span>
                  <?php else: ?>
                    <span class="text-xs font-bold text-emerald-400">Paid in Full</span>
                  <?php endif; ?>
                <?php else: ?>
                  <span class="text-slate-400 font-mono text-xs"><?= htmlspecialchars($o['budget_range'] ?: 'TBD'); ?></span>
                <?php endif; ?>
              </td>
              <td class="py-4 pr-4">
                <?php
                  $st = $o['status'] ?? 'Pending';
                  $badge_class = 'status-badge-pending';
                  if ($st === 'In Review') $badge_class = 'status-badge-review';
                  elseif ($st === 'In Progress') $badge_class = 'status-badge-progress';
                  elseif ($st === 'Completed') $badge_class = 'status-badge-completed';
                  elseif ($st === 'Cancelled') $badge_class = 'status-badge-cancelled';
                ?>
                <span class="status-badge <?= $badge_class; ?>">
                  <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                  <?= htmlspecialchars($st); ?>
                </span>
              </td>
              <td class="py-4 text-right whitespace-nowrap space-x-2">
                <a href="invoice.php?id=<?= $o['id']; ?>" target="_blank" title="Download / Print Invoice" class="px-2.5 py-1.5 rounded-lg bg-emerald-600/20 hover:bg-emerald-600 border border-emerald-500/30 text-emerald-300 hover:text-white font-bold text-xs transition-all inline-block">
                  Invoice PDF
                </a>
                <a href="orders.php?id=<?= $o['id']; ?><?= $status_filter !== 'all' ? '&status='.$status_filter : ''; ?>" class="px-3.5 py-1.5 rounded-lg bg-indigo-600/20 hover:bg-indigo-600 border border-indigo-500/30 hover:border-indigo-500 text-indigo-300 hover:text-white font-bold text-xs transition-all inline-block">
                  Manage &rarr;
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<script>
function filterOrdersTable() {
  const query = document.getElementById('orderSearchInput').value.toLowerCase();
  const rows = document.querySelectorAll('.order-row');
  
  rows.forEach(row => {
    const text = row.innerText.toLowerCase();
    row.style.display = text.includes(query) ? '' : 'none';
  });
}
</script>

<?php require_once('layout_footer.php'); ?>
