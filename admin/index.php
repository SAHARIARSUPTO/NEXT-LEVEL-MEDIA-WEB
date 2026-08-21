<?php
$page_title = 'Admin Dashboard';
require_once('layout_header.php');

// Fast Data Fetching
$all_orders = get_all_orders();
$all_videos = get_section_videos('all');
$all_analytics = get_all_analytics();
$all_inquiries = get_all_inquiries();
$finances_summary = get_finance_summary();

$today = date('Y-m-d');
$today_visits = count(array_filter($all_analytics, function($a) use ($today) {
    return isset($a['visited_at']) && strpos($a['visited_at'], $today) === 0;
}));

$total_visits = count($all_analytics);
$total_orders = count($all_orders);
$pending_orders = count(array_filter($all_orders, function($o) {
    return ($o['status'] ?? '') === 'Pending';
}));
$in_progress_orders = count(array_filter($all_orders, function($o) {
    return ($o['status'] ?? '') === 'In Progress';
}));

// Find upcoming deliveries
$upcoming_deliveries = array_filter($all_orders, function($o) {
    return in_array($o['status'] ?? '', ['Pending', 'In Review', 'In Progress']);
});
usort($upcoming_deliveries, function($a, $b) {
    $dateA = !empty($a['delivery_date']) ? $a['delivery_date'] : '9999-12-31';
    $dateB = !empty($b['delivery_date']) ? $b['delivery_date'] : '9999-12-31';
    return strcmp($dateA, $dateB);
});
$upcoming_deliveries = array_slice($upcoming_deliveries, 0, 4);

$recent_orders = array_slice($all_orders, 0, 5);

// Country counts
$country_counts = [];
foreach ($all_analytics as $a) {
    $c = !empty($a['country_name']) ? $a['country_name'] : 'Local Network';
    $country_counts[$c] = ($country_counts[$c] ?? 0) + 1;
}
arsort($country_counts);
$top_countries = array_slice($country_counts, 0, 5, true);
?>

<!-- Header Section -->
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
  <div>
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-1">
      <span>Admin Control Center</span>
      <span>/</span>
      <span class="text-indigo-400 font-bold">Overview</span>
    </div>
    <h1 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight font-display">Welcome Back, <?= htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?>!</h1>
    <p class="text-sm sm:text-base text-slate-300 mt-1">Here is a quick summary of your agency orders, delivery deadlines, income, and website traffic.</p>
  </div>
  
  <!-- Action Shortcuts -->
  <div class="flex items-center gap-3">
    <a href="finances.php" class="adm-btn-secondary">
      <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
      </svg>
      <span>Finances ($<?= number_format($finances_summary['net_profit'], 0); ?> Net)</span>
    </a>
    <a href="orders.php" class="adm-btn-primary">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
      </svg>
      <span>Manage Orders (<?= $total_orders; ?>)</span>
    </a>
  </div>
</div>

<!-- Big KPI Metrics Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
  
  <!-- 1. Active Client Orders -->
  <div class="adm-card p-6 relative">
    <div class="flex items-center justify-between mb-3">
      <span class="text-sm font-bold text-slate-300">Client Orders</span>
      <div class="w-10 h-10 rounded-xl bg-indigo-500/15 border border-indigo-500/30 flex items-center justify-center text-indigo-400">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
        </svg>
      </div>
    </div>
    <div class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight font-display"><?= number_format($total_orders); ?></div>
    <div class="mt-3 pt-3 border-t border-white/[0.08] flex items-center justify-between text-xs text-slate-300">
      <span>Pending / In Progress:</span>
      <span class="font-bold text-amber-400 font-mono"><?= number_format($pending_orders + $in_progress_orders); ?> active</span>
    </div>
  </div>

  <!-- 2. Revenue / Income -->
  <div class="adm-card p-6 relative">
    <div class="flex items-center justify-between mb-3">
      <span class="text-sm font-bold text-slate-300">Total Income / Revenue</span>
      <div class="w-10 h-10 rounded-xl bg-emerald-500/15 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
      </div>
    </div>
    <div class="text-3xl sm:text-4xl font-extrabold text-emerald-400 tracking-tight font-mono">
      $<?= number_format($finances_summary['total_income'], 2); ?>
    </div>
    <div class="mt-3 pt-3 border-t border-white/[0.08] flex items-center justify-between text-xs text-slate-300">
      <span>Pending Due Receivables:</span>
      <span class="font-bold text-amber-400 font-mono">$<?= number_format($finances_summary['total_due'], 2); ?></span>
    </div>
  </div>

  <!-- 3. Net Studio Profit -->
  <div class="adm-card p-6 relative">
    <div class="flex items-center justify-between mb-3">
      <span class="text-sm font-bold text-slate-300">Net Profit</span>
      <div class="w-10 h-10 rounded-xl bg-blue-500/15 border border-blue-500/30 flex items-center justify-center text-blue-400">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
        </svg>
      </div>
    </div>
    <div class="text-3xl sm:text-4xl font-extrabold font-mono tracking-tight <?= $finances_summary['net_profit'] >= 0 ? 'text-white' : 'text-red-400'; ?>">
      $<?= number_format($finances_summary['net_profit'], 2); ?>
    </div>
    <div class="mt-3 pt-3 border-t border-white/[0.08] flex items-center justify-between text-xs text-slate-300">
      <span>Expenses Logged:</span>
      <span class="font-bold text-red-400 font-mono">$<?= number_format($finances_summary['total_expense'], 2); ?></span>
    </div>
  </div>

  <!-- 4. Today's Traffic -->
  <div class="adm-card p-6 relative">
    <div class="flex items-center justify-between mb-3">
      <span class="text-sm font-bold text-slate-300">Visitors Today</span>
      <div class="w-10 h-10 rounded-xl bg-violet-500/15 border border-violet-500/30 flex items-center justify-center text-violet-400">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        </svg>
      </div>
    </div>
    <div class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight font-display"><?= number_format($today_visits); ?></div>
    <div class="mt-3 pt-3 border-t border-white/[0.08] flex items-center justify-between text-xs text-slate-300">
      <span>Total Site Visits:</span>
      <span class="font-bold text-white font-mono"><?= number_format($total_visits); ?></span>
    </div>
  </div>

</div>

<!-- Delivery Deadlines & Production Queue Section -->
<div class="adm-card p-6 sm:p-7 mb-8">
  <div class="flex items-center justify-between pb-4 mb-5 border-b border-white/[0.08]">
    <div>
      <h2 class="text-lg sm:text-xl font-bold text-white font-display flex items-center gap-2">
        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <span>Production Queue & Order Delivery Dates</span>
      </h2>
      <p class="text-xs sm:text-sm text-slate-300 mt-0.5">Upcoming delivery commitments and client turnaround targets</p>
    </div>
    <a href="orders.php" class="text-xs sm:text-sm font-bold text-indigo-400 hover:text-indigo-300 flex items-center gap-1">
      <span>View All Orders &rarr;</span>
    </a>
  </div>

  <?php if (empty($upcoming_deliveries)): ?>
    <div class="text-center py-6 text-sm text-slate-400">
      No active orders currently in production queue.
    </div>
  <?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
      <?php foreach ($upcoming_deliveries as $deliv): 
        $has_exact_date = !empty($deliv['delivery_date']);
        $deliv_txt = $has_exact_date ? date('M d, Y', strtotime($deliv['delivery_date'])) : ($deliv['deadline'] ?: 'Approx 5-7 Days');
        
        $diff_text = 'Scheduled';
        if ($has_exact_date) {
            $days = round((strtotime($deliv['delivery_date']) - time()) / 86400);
            if ($days < 0) {
                $diff_text = abs($days) . ' days overdue';
            } elseif ($days == 0) {
                $diff_text = 'Due Today!';
            } elseif ($days == 1) {
                $diff_text = 'Due Tomorrow';
            } else {
                $diff_text = 'In ' . $days . ' days';
            }
        }
      ?>
        <div class="p-4 rounded-2xl bg-black/40 border border-white/10 hover:border-indigo-500/40 transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-2">
              <span class="px-2 py-0.5 rounded-md bg-indigo-500/20 text-indigo-300 font-mono text-xs font-bold">
                #<?= $deliv['id']; ?>
              </span>
              <span class="text-xs font-bold <?= strpos($diff_text, 'overdue') !== false ? 'text-red-400' : 'text-emerald-400'; ?>">
                <?= $diff_text; ?>
              </span>
            </div>
            <div class="font-bold text-white text-base truncate"><?= htmlspecialchars($deliv['client_name']); ?></div>
            <div class="text-xs text-slate-400 truncate mt-0.5"><?= htmlspecialchars($deliv['service_types']); ?></div>
          </div>

          <div class="mt-4 pt-3 border-t border-white/[0.08] flex items-center justify-between text-xs">
            <div>
              <span class="text-slate-500 block text-[10px] uppercase font-bold">Delivery Date:</span>
              <span class="font-mono font-bold text-white"><?= $deliv_txt; ?></span>
            </div>
            <a href="orders.php?id=<?= $deliv['id']; ?>" class="px-2.5 py-1 rounded-lg bg-white/[0.05] hover:bg-indigo-600 text-slate-300 hover:text-white font-bold transition-all">
              Manage &rarr;
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
  
  <!-- Left Column (8 cols): Recent Orders & Messages -->
  <div class="lg:col-span-8 space-y-8">
    
    <!-- Recent Orders Card -->
    <div class="adm-card p-6 sm:p-7">
      <div class="flex items-center justify-between mb-6 pb-4 border-b border-white/[0.08]">
        <div>
          <h2 class="text-lg sm:text-xl font-bold text-white font-display">Recent Client Orders</h2>
          <p class="text-xs sm:text-sm text-slate-300 mt-0.5">Latest project briefs and financial statuses</p>
        </div>
        <a href="orders.php" class="text-sm font-bold text-indigo-400 hover:text-indigo-300 transition-colors flex items-center gap-1">
          <span>View All (<?= $total_orders; ?>)</span>
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </a>
      </div>

      <?php if (empty($recent_orders)): ?>
        <div class="text-center py-10 px-4">
          <p class="text-base font-bold text-slate-200">No client orders yet</p>
          <div class="mt-4">
            <a href="../order.php" target="_blank" class="adm-btn-secondary text-xs">Test Order Form &rarr;</a>
          </div>
        </div>
      <?php else: ?>
        <div class="overflow-x-auto">
          <table class="w-full text-left text-sm text-slate-200">
            <thead>
              <tr class="text-slate-400 border-b border-white/[0.08] text-xs font-bold uppercase tracking-wider">
                <th class="pb-3 pr-4">Client</th>
                <th class="pb-3 pr-4">Services</th>
                <th class="pb-3 pr-4">Delivery</th>
                <th class="pb-3 pr-4">Status</th>
                <th class="pb-3 text-right">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-white/[0.06]">
              <?php foreach ($recent_orders as $ord): ?>
                <tr class="hover:bg-white/[0.03] transition-colors">
                  <td class="py-4 pr-4">
                    <div class="font-bold text-white text-sm sm:text-base"><?= htmlspecialchars($ord['client_name']); ?></div>
                    <div class="text-xs text-slate-400 mt-0.5"><?= htmlspecialchars($ord['client_email']); ?></div>
                  </td>
                  <td class="py-4 pr-4 max-w-[200px] truncate text-slate-200 text-xs sm:text-sm font-medium">
                    <?= htmlspecialchars($ord['service_types']); ?>
                  </td>
                  <td class="py-4 pr-4 whitespace-nowrap text-xs font-mono font-bold text-slate-300">
                    <?= !empty($ord['delivery_date']) ? date('M d, Y', strtotime($ord['delivery_date'])) : htmlspecialchars($ord['deadline'] ?: 'Pending'); ?>
                  </td>
                  <td class="py-4 pr-4">
                    <?php
                      $st = $ord['status'] ?? 'Pending';
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
                    <a href="invoice.php?id=<?= $ord['id']; ?>" target="_blank" class="px-2.5 py-1.5 rounded-lg bg-emerald-600/20 hover:bg-emerald-600 border border-emerald-500/30 text-emerald-300 hover:text-white font-bold text-xs transition-all inline-block">
                      Invoice
                    </a>
                    <a href="orders.php?id=<?= $ord['id']; ?>" class="px-3 py-1.5 rounded-lg bg-indigo-600/20 hover:bg-indigo-600 border border-indigo-500/30 text-indigo-300 hover:text-white font-bold text-xs transition-all inline-block">
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

    <!-- Recent Client Inquiries & Direct Messages Card -->
    <div class="adm-card p-6 sm:p-7">
      <div class="flex items-center justify-between mb-6 pb-4 border-b border-white/[0.08]">
        <div>
          <h2 class="text-lg sm:text-xl font-bold text-white font-display">Recent Client Inquiries</h2>
          <p class="text-xs sm:text-sm text-slate-300 mt-0.5">Direct touch submissions from footer CTA & contact forms</p>
        </div>
        <a href="inquiries.php" class="text-sm font-bold text-indigo-400 hover:text-indigo-300 transition-colors flex items-center gap-1">
          <span>View All (<?= count($all_inquiries); ?>)</span>
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </a>
      </div>

      <?php $recent_inq = array_slice($all_inquiries, 0, 5); ?>
      <?php if (empty($recent_inq)): ?>
        <div class="text-center py-8 px-4">
          <p class="text-sm font-bold text-slate-300">No client messages received yet</p>
        </div>
      <?php else: ?>
        <div class="overflow-x-auto">
          <table class="w-full text-left text-sm text-slate-200">
            <thead>
              <tr class="text-slate-400 border-b border-white/[0.08] text-xs font-bold uppercase tracking-wider">
                <th class="pb-3 pr-4">Client</th>
                <th class="pb-3 pr-4">Message Preview</th>
                <th class="pb-3 pr-4">Status</th>
                <th class="pb-3 text-right">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-white/[0.06]">
              <?php foreach ($recent_inq as $inq): ?>
                <tr class="hover:bg-white/[0.03] transition-colors">
                  <td class="py-3.5 pr-4">
                    <div class="font-bold text-white text-sm"><?= htmlspecialchars($inq['name'] ?? 'Client'); ?></div>
                    <div class="text-xs text-slate-400 font-mono"><?= htmlspecialchars($inq['email'] ?? ''); ?></div>
                  </td>
                  <td class="py-3.5 pr-4 max-w-[280px] truncate text-xs sm:text-sm text-slate-300">
                    <?= htmlspecialchars($inq['message'] ?? ''); ?>
                  </td>
                  <td class="py-3.5 pr-4 whitespace-nowrap">
                    <?php if (($inq['status'] ?? '') === 'Unread'): ?>
                      <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-bold bg-amber-500/15 border border-amber-500/30 text-amber-300">
                        Unread
                      </span>
                    <?php else: ?>
                      <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-bold bg-slate-500/15 border border-slate-500/30 text-slate-400">
                        Read
                      </span>
                    <?php endif; ?>
                  </td>
                  <td class="py-3.5 text-right whitespace-nowrap space-x-2">
                    <a href="inquiries.php" class="px-2.5 py-1 rounded-lg bg-indigo-600/20 hover:bg-indigo-600 border border-indigo-500/30 text-indigo-300 hover:text-white font-bold text-xs transition-all inline-block">
                      View All &rarr;
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>

  </div>

  <!-- Right Column (4 cols): Geographic Breakdown & Quick Tools -->
  <div class="lg:col-span-4 space-y-8">
    
    <!-- Top Visitor Locations -->
    <div class="adm-card p-6">
      <div class="flex items-center justify-between mb-5 pb-3 border-b border-white/[0.08]">
        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-300 font-display">Top Visitor Locations</h3>
        <a href="analytics.php" class="text-xs font-bold text-indigo-400 hover:underline">Full Log &rarr;</a>
      </div>

      <?php if (empty($top_countries)): ?>
        <div class="text-center py-6 text-sm text-slate-400">No visitor locations logged yet.</div>
      <?php else: ?>
        <div class="space-y-4">
          <?php 
            $max_c = max(array_values($top_countries)) ?: 1;
            foreach ($top_countries as $country_name => $count): 
              $pct = round(($count / $max_c) * 100);
          ?>
            <div>
              <div class="flex items-center justify-between text-xs sm:text-sm mb-1.5">
                <span class="font-bold text-slate-200"><?= htmlspecialchars($country_name); ?></span>
                <span class="font-mono text-slate-400 font-semibold"><?= $count; ?> visits</span>
              </div>
              <div class="w-full h-2 bg-white/[0.06] rounded-full overflow-hidden">
                <div class="h-full bg-indigo-500 rounded-full" style="width: <?= $pct; ?>%"></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>

    <!-- Quick Shortcuts Card -->
    <div class="adm-card p-6">
      <h3 class="text-xs font-bold uppercase tracking-wider text-slate-300 font-display mb-4 pb-3 border-b border-white/[0.08]">
        Quick Management Tools
      </h3>
      
      <div class="space-y-2.5">
        <a href="finances.php" class="flex items-center justify-between p-3.5 rounded-xl bg-white/[0.02] hover:bg-indigo-600/15 border border-white/[0.06] hover:border-indigo-500/40 text-sm font-bold text-slate-200 hover:text-white transition-all group">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-400">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <span>Finances & Accounting</span>
          </div>
          <span class="text-slate-400 group-hover:text-white font-bold">&rarr;</span>
        </a>

        <a href="videos.php" class="flex items-center justify-between p-3.5 rounded-xl bg-white/[0.02] hover:bg-indigo-600/15 border border-white/[0.06] hover:border-indigo-500/40 text-sm font-bold text-slate-200 hover:text-white transition-all group">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-indigo-500/10 flex items-center justify-center text-indigo-400">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
              </svg>
            </div>
            <span>Manage Website Videos</span>
          </div>
          <span class="text-slate-400 group-hover:text-white font-bold">&rarr;</span>
        </a>

        <a href="media.php" class="flex items-center justify-between p-3.5 rounded-xl bg-white/[0.02] hover:bg-indigo-600/15 border border-white/[0.06] hover:border-indigo-500/40 text-sm font-bold text-slate-200 hover:text-white transition-all group">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-indigo-500/10 flex items-center justify-center text-indigo-400">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
            </div>
            <span>Upload Images & Files</span>
          </div>
          <span class="text-slate-400 group-hover:text-white font-bold">&rarr;</span>
        </a>
      </div>
    </div>

  </div>

</div>

<?php require_once('layout_footer.php'); ?>
