<?php
$page_title = 'Finance & Income/Expense Tracker';
require_once('layout_header.php');

$msg = '';
$error = '';
$filter_type = $_GET['type'] ?? 'all';

// Handle Add Transaction
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_transaction'])) {
    $type = trim($_POST['type'] ?? 'income');
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? 'Client Payment');
    $amount = floatval($_POST['amount'] ?? 0);
    $payment_method = trim($_POST['payment_method'] ?? 'Bank Transfer');
    $transaction_date = trim($_POST['transaction_date'] ?? date('Y-m-d'));
    $order_id = !empty($_POST['order_id']) ? intval($_POST['order_id']) : null;
    $notes = trim($_POST['notes'] ?? '');

    if (empty($title) || $amount <= 0) {
        $error = 'Please provide a valid transaction title and amount.';
    } else {
        save_financial_record([
            'type' => $type,
            'title' => $title,
            'category' => $category,
            'amount' => $amount,
            'payment_method' => $payment_method,
            'transaction_date' => $transaction_date,
            'order_id' => $order_id,
            'notes' => $notes
        ]);

        // If this was linked to an order as income, optionally update the order's paid_amount
        if ($type === 'income' && $order_id) {
            $all_orders = get_all_orders();
            foreach ($all_orders as $ord) {
                if ($ord['id'] == $order_id) {
                    $new_paid = floatval($ord['paid_amount'] ?? 0) + $amount;
                    $total_cost = floatval($ord['order_amount'] ?? 0);
                    $new_st = 'Unpaid';
                    if ($new_paid >= $total_cost && $total_cost > 0) {
                        $new_st = 'Paid';
                    } elseif ($new_paid > 0) {
                        $new_st = 'Partial';
                    }
                    $ord['paid_amount'] = $new_paid;
                    $ord['payment_status'] = $new_st;
                    update_order_full($order_id, $ord);
                    break;
                }
            }
        }

        $msg = strtoupper($type) . ' transaction of $' . number_format($amount, 2) . ' recorded successfully!';
    }
}

// Handle Delete Transaction
if (isset($_GET['delete'])) {
    $del_id = intval($_GET['delete']);
    if ($del_id > 0) {
        delete_financial_record($del_id);
        $msg = 'Transaction record deleted.';
    }
}

// Fetch all finances and summary
$all_finances = get_all_finances();
$all_orders = get_all_orders();
$summary = get_finance_summary();

// Filter list
$finances = [];
if ($filter_type !== 'all') {
    $finances = array_values(array_filter($all_finances, fn($f) => ($f['type'] ?? '') === $filter_type));
} else {
    $finances = $all_finances;
}
?>

<!-- Page Header -->
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
  <div>
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-1">
      <a href="index.php" class="hover:text-white transition-colors">Admin</a>
      <span>/</span>
      <span class="text-indigo-400 font-bold">Finances & Accounting</span>
    </div>
    <h1 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight font-display">Income & Expense Tracker</h1>
    <p class="text-sm sm:text-base text-slate-300 mt-1">Track agency revenue, production expenses, profit margins, and client payment receivables.</p>
  </div>
  
  <div class="flex items-center gap-3">
    <a href="#newTransactionBox" class="adm-btn-primary">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
      </svg>
      <span>+ Record Transaction</span>
    </a>
  </div>
</div>

<!-- Alert Banners -->
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

<?php if (!empty($error)): ?>
  <div class="mb-6 p-4 rounded-xl bg-red-500/15 border border-red-500/30 text-red-200 text-sm font-semibold flex items-center justify-between gap-3">
    <div class="flex items-center gap-2.5">
      <svg class="w-5 h-5 text-red-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
      </svg>
      <span><?= htmlspecialchars($error); ?></span>
    </div>
    <button onclick="this.parentElement.remove()" class="text-red-400 hover:text-white text-base font-bold">&times;</button>
  </div>
<?php endif; ?>

<!-- 4 Financial Summary KPI Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
  
  <!-- 1. Total Income -->
  <div class="adm-card p-6">
    <div class="flex items-center justify-between mb-3">
      <span class="text-sm font-bold text-slate-300">Total Income / Revenue</span>
      <div class="w-10 h-10 rounded-xl bg-emerald-500/15 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
        </svg>
      </div>
    </div>
    <div class="text-3xl sm:text-4xl font-extrabold text-emerald-400 tracking-tight font-mono">
      $<?= number_format($summary['total_income'], 2); ?>
    </div>
    <p class="text-xs text-slate-400 mt-2">Recorded client payments & income</p>
  </div>

  <!-- 2. Total Expenses -->
  <div class="adm-card p-6">
    <div class="flex items-center justify-between mb-3">
      <span class="text-sm font-bold text-slate-300">Total Expenses</span>
      <div class="w-10 h-10 rounded-xl bg-red-500/15 border border-red-500/30 flex items-center justify-center text-red-400">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
        </svg>
      </div>
    </div>
    <div class="text-3xl sm:text-4xl font-extrabold text-red-400 tracking-tight font-mono">
      $<?= number_format($summary['total_expense'], 2); ?>
    </div>
    <p class="text-xs text-slate-400 mt-2">Tools, freelancers, assets & hosting</p>
  </div>

  <!-- 3. Net Profit -->
  <div class="adm-card p-6">
    <div class="flex items-center justify-between mb-3">
      <span class="text-sm font-bold text-slate-300">Net Profit</span>
      <div class="w-10 h-10 rounded-xl bg-indigo-500/15 border border-indigo-500/30 flex items-center justify-center text-indigo-400">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
      </div>
    </div>
    <div class="text-3xl sm:text-4xl font-extrabold font-mono tracking-tight <?= $summary['net_profit'] >= 0 ? 'text-white' : 'text-red-400'; ?>">
      $<?= number_format($summary['net_profit'], 2); ?>
    </div>
    <p class="text-xs text-slate-400 mt-2">Income minus operational expenses</p>
  </div>

  <!-- 4. Client Due Balances -->
  <div class="adm-card p-6">
    <div class="flex items-center justify-between mb-3">
      <span class="text-sm font-bold text-slate-300">Outstanding Due Balances</span>
      <div class="w-10 h-10 rounded-xl bg-amber-500/15 border border-amber-500/30 flex items-center justify-center text-amber-400">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
      </div>
    </div>
    <div class="text-3xl sm:text-4xl font-extrabold text-amber-300 tracking-tight font-mono">
      $<?= number_format($summary['total_due'], 2); ?>
    </div>
    <p class="text-xs text-slate-400 mt-2">Pending client receivables</p>
  </div>

</div>

<!-- Record Transaction Form Box -->
<div id="newTransactionBox" class="adm-card p-6 sm:p-8 mb-8">
  <div class="border-b border-white/[0.08] pb-4 mb-6">
    <h2 class="text-xl sm:text-2xl font-bold text-white font-display flex items-center gap-2">
      <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
      </svg>
      <span>Record Income or Expense</span>
    </h2>
    <p class="text-sm text-slate-300 mt-0.5">Add a new financial transaction to update your studio books.</p>
  </div>

  <form action="finances.php" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-5 items-end">
    <input type="hidden" name="save_transaction" value="1" />

    <!-- Type -->
    <div class="sm:col-span-2">
      <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Type *</label>
      <select name="type" required class="adm-input text-sm font-bold" onchange="toggleCategoryOptions(this.value)">
        <option value="income">🟢 Income (Money In)</option>
        <option value="expense">🔴 Expense (Money Out)</option>
      </select>
    </div>

    <!-- Category -->
    <div class="sm:col-span-3">
      <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Category *</label>
      <select name="category" id="categorySelect" required class="adm-input text-sm font-semibold">
        <option value="Client Project Payment">Client Project Payment</option>
        <option value="Monthly Retainer">Monthly Retainer</option>
        <option value="Consulting / Strategy">Consulting / Strategy</option>
        <option value="Affiliate / Referral">Affiliate / Referral</option>
        <option value="Other Income">Other Income</option>
      </select>
    </div>

    <!-- Title -->
    <div class="sm:col-span-4">
      <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Description / Title *</label>
      <input type="text" name="title" required placeholder="e.g. 50% Deposit for SaaS Video" class="adm-input text-sm font-semibold" />
    </div>

    <!-- Amount -->
    <div class="sm:col-span-3">
      <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Amount ($ USD) *</label>
      <input type="number" step="0.01" min="0.01" name="amount" required placeholder="500.00" class="adm-input text-sm font-mono font-bold" />
    </div>

    <!-- Linked Client Order (Optional) -->
    <div class="sm:col-span-4">
      <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Link to Client Order (Optional)</label>
      <select name="order_id" class="adm-input text-sm">
        <option value="">-- No specific order --</option>
        <?php foreach ($all_orders as $ord): ?>
          <option value="<?= $ord['id']; ?>">
            Order #<?= $ord['id']; ?> - <?= htmlspecialchars($ord['client_name']); ?> ($<?= number_format(floatval($ord['order_amount'] ?? 0), 2); ?>)
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Payment Method -->
    <div class="sm:col-span-3">
      <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Payment Method</label>
      <select name="payment_method" class="adm-input text-sm font-semibold">
        <option value="Bank Transfer / Wire">Bank Transfer / Wire</option>
        <option value="Stripe / Credit Card">Stripe / Credit Card</option>
        <option value="PayPal">PayPal</option>
        <option value="Wise">Wise</option>
        <option value="Crypto (USDT/BTC)">Crypto (USDT/BTC)</option>
        <option value="Cash / Other">Cash / Other</option>
      </select>
    </div>

    <!-- Date -->
    <div class="sm:col-span-3">
      <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Date</label>
      <input type="date" name="transaction_date" value="<?= date('Y-m-d'); ?>" class="adm-input text-sm font-mono" />
    </div>

    <!-- Submit Button -->
    <div class="sm:col-span-2">
      <button type="submit" class="w-full adm-btn-primary py-3 text-sm font-bold">
        <span>Save Entry</span>
      </button>
    </div>

  </form>
</div>

<!-- Ledger Transactions Table -->
<div class="adm-card p-6 sm:p-8">
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 mb-6 border-b border-white/[0.08]">
    <div>
      <h2 class="text-xl sm:text-2xl font-bold text-white font-display">Transactions Ledger</h2>
      <p class="text-sm text-slate-300 mt-0.5">Complete record of financial activity</p>
    </div>

    <!-- Filter Tabs -->
    <div class="flex items-center gap-2 text-sm">
      <a href="finances.php?type=all" class="px-3.5 py-1.5 rounded-lg font-bold transition-all <?= $filter_type === 'all' ? 'bg-indigo-600 text-white' : 'bg-white/[0.05] text-slate-300 hover:text-white'; ?>">
        All
      </a>
      <a href="finances.php?type=income" class="px-3.5 py-1.5 rounded-lg font-bold transition-all <?= $filter_type === 'income' ? 'bg-emerald-600 text-white' : 'bg-white/[0.05] text-emerald-300 hover:text-white'; ?>">
        Income Only
      </a>
      <a href="finances.php?type=expense" class="px-3.5 py-1.5 rounded-lg font-bold transition-all <?= $filter_type === 'expense' ? 'bg-red-600 text-white' : 'bg-white/[0.05] text-red-300 hover:text-white'; ?>">
        Expenses Only
      </a>
    </div>
  </div>

  <?php if (empty($finances)): ?>
    <div class="text-center py-12 px-4">
      <p class="text-base font-bold text-slate-200">No financial transactions recorded yet</p>
      <p class="text-sm text-slate-400 mt-1">Use the form above to add your first income or expense entry.</p>
    </div>
  <?php else: ?>
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-slate-200">
        <thead>
          <tr class="text-slate-400 border-b border-white/[0.08] text-xs font-bold uppercase tracking-wider">
            <th class="pb-3 pr-4">Date</th>
            <th class="pb-3 pr-4">Type</th>
            <th class="pb-3 pr-4">Category</th>
            <th class="pb-3 pr-4">Description / Title</th>
            <th class="pb-3 pr-4">Payment Method</th>
            <th class="pb-3 pr-4">Linked Order</th>
            <th class="pb-3 pr-4">Amount</th>
            <th class="pb-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/[0.06]">
          <?php foreach ($finances as $item): 
            $is_income = ($item['type'] === 'income');
          ?>
            <tr class="hover:bg-white/[0.03] transition-colors">
              <td class="py-4 pr-4 font-mono text-slate-300 whitespace-nowrap text-xs sm:text-sm">
                <?= date('M d, Y', strtotime($item['transaction_date'])); ?>
              </td>
              <td class="py-4 pr-4">
                <?php if ($is_income): ?>
                  <span class="px-2.5 py-1 rounded-full bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 font-bold text-xs">
                    + Income
                  </span>
                <?php else: ?>
                  <span class="px-2.5 py-1 rounded-full bg-red-500/20 border border-red-500/40 text-red-300 font-bold text-xs">
                    - Expense
                  </span>
                <?php endif; ?>
              </td>
              <td class="py-4 pr-4 text-slate-300 font-medium">
                <?= htmlspecialchars($item['category'] ?? 'General'); ?>
              </td>
              <td class="py-4 pr-4 font-bold text-white max-w-xs truncate">
                <?= htmlspecialchars($item['title']); ?>
              </td>
              <td class="py-4 pr-4 text-slate-300 text-xs">
                <?= htmlspecialchars($item['payment_method'] ?? 'Bank Transfer'); ?>
              </td>
              <td class="py-4 pr-4 text-xs font-mono">
                <?php if (!empty($item['order_id'])): ?>
                  <a href="orders.php?id=<?= $item['order_id']; ?>" class="text-indigo-400 font-bold hover:underline">
                    Order #<?= $item['order_id']; ?>
                  </a>
                <?php else: ?>
                  <span class="text-slate-500">N/A</span>
                <?php endif; ?>
              </td>
              <td class="py-4 pr-4 font-mono font-extrabold text-base whitespace-nowrap <?= $is_income ? 'text-emerald-400' : 'text-red-400'; ?>">
                <?= $is_income ? '+' : '-'; ?>$<?= number_format(floatval($item['amount']), 2); ?>
              </td>
              <td class="py-4 text-right whitespace-nowrap">
                <a href="finances.php?delete=<?= $item['id']; ?><?= $filter_type !== 'all' ? '&type='.$filter_type : ''; ?>" onclick="return confirm('Delete transaction record for: <?= htmlspecialchars(addslashes($item['title'])); ?>?')" class="px-3 py-1.5 rounded-lg bg-red-500/10 hover:bg-red-500 border border-red-500/20 text-red-400 hover:text-white font-bold text-xs transition-all">
                  Delete
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
function toggleCategoryOptions(type) {
  const select = document.getElementById('categorySelect');
  select.innerHTML = '';
  
  if (type === 'income') {
    select.innerHTML = `
      <option value="Client Project Payment">Client Project Payment</option>
      <option value="Monthly Retainer">Monthly Retainer</option>
      <option value="Consulting / Strategy">Consulting / Strategy</option>
      <option value="Affiliate / Referral">Affiliate / Referral</option>
      <option value="Other Income">Other Income</option>
    `;
  } else {
    select.innerHTML = `
      <option value="Freelancer / Editor Payout">Freelancer / Editor Payout</option>
      <option value="Voiceover / Sound FX Assets">Voiceover / Sound FX Assets</option>
      <option value="Software & Plugins (Adobe/Motion)">Software & Plugins (Adobe/Motion)</option>
      <option value="Server / Web Hosting">Server / Web Hosting</option>
      <option value="Marketing & Ad Spend">Marketing & Ad Spend</option>
      <option value="Equipment / Hardware">Equipment / Hardware</option>
      <option value="Misc Operating Expense">Misc Operating Expense</option>
    `;
  }
}
</script>

<?php require_once('layout_footer.php'); ?>
