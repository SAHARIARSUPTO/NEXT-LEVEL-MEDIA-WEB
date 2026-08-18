<?php
$page_title = 'Website Visitors & Leads';
require_once('layout_header.php');

$logs = get_all_analytics();

$country_stats = [];
$unique_ips = [];
$captured_emails = [];

foreach ($logs as $l) {
    $ip = $l['ip_address'] ?? '127.0.0.1';
    $unique_ips[$ip] = true;
    
    $country = !empty($l['country_name']) ? $l['country_name'] : 'Local Network';
    $country_stats[$country] = ($country_stats[$country] ?? 0) + 1;

    if (!empty($l['visitor_email'])) {
        $captured_emails[$l['visitor_email']] = [
            'email' => $l['visitor_email'],
            'ip' => $ip,
            'country' => $country,
            'last_seen' => $l['visited_at'] ?? date('Y-m-d H:i:s')
        ];
    }
}

arsort($country_stats);
$total_unique_ips = count($unique_ips);
$total_impressions = count($logs);
?>

<!-- Page Header -->
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
  <div>
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-1">
      <a href="index.php" class="hover:text-white transition-colors">Admin</a>
      <span>/</span>
      <span class="text-indigo-400 font-bold">Visitor Analytics</span>
    </div>
    <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight font-display">Website Visitors & Captured Leads</h1>
    <p class="text-sm sm:text-base text-slate-300 mt-1">See how many visitors arrive at your website, what countries they come from, and which clients submitted forms.</p>
  </div>
  
  <div class="flex items-center gap-3">
    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-xs sm:text-sm font-bold">
      <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
      <span>Live Visitor Tracking Active</span>
    </div>
  </div>
</div>

<!-- Top Metrics Grid -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
  
  <!-- 1. Unique Visitors -->
  <div class="adm-card p-6">
    <div class="flex items-center justify-between mb-3">
      <span class="text-sm font-bold text-slate-300">Unique Visitors (IPs)</span>
      <div class="w-10 h-10 rounded-xl bg-indigo-500/15 border border-indigo-500/30 flex items-center justify-center text-indigo-400">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
      </div>
    </div>
    <div class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight font-display"><?= number_format($total_unique_ips); ?></div>
    <p class="text-xs text-slate-400 mt-1.5">Distinct people who visited the site</p>
  </div>

  <!-- 2. Identified Client Leads -->
  <div class="adm-card p-6">
    <div class="flex items-center justify-between mb-3">
      <span class="text-sm font-bold text-slate-300">Identified Client Emails</span>
      <div class="w-10 h-10 rounded-xl bg-violet-500/15 border border-violet-500/30 flex items-center justify-center text-violet-400">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
      </div>
    </div>
    <div class="text-3xl sm:text-4xl font-extrabold text-violet-300 tracking-tight font-display"><?= count($captured_emails); ?></div>
    <p class="text-xs text-slate-400 mt-1.5">Clients who filled out order/contact forms</p>
  </div>

  <!-- 3. Total Page Hits -->
  <div class="adm-card p-6">
    <div class="flex items-center justify-between mb-3">
      <span class="text-sm font-bold text-slate-300">Total Page Views</span>
      <div class="w-10 h-10 rounded-xl bg-blue-500/15 border border-blue-500/30 flex items-center justify-center text-blue-400">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        </svg>
      </div>
    </div>
    <div class="text-3xl sm:text-4xl font-extrabold text-blue-300 tracking-tight font-display"><?= number_format($total_impressions); ?></div>
    <p class="text-xs text-slate-400 mt-1.5">Total times pages were loaded</p>
  </div>

</div>

<!-- Middle Section: Geo Breakdown & Captured Leads -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-8">
  
  <!-- Top Locations (6 cols) -->
  <div class="lg:col-span-6 adm-card p-6 sm:p-7">
    <div class="flex items-center justify-between mb-5 pb-3 border-b border-white/[0.08]">
      <h3 class="text-xs font-bold uppercase tracking-wider text-slate-300 font-display">Top Visitor Locations</h3>
      <span class="text-xs text-slate-400 font-mono">Visits</span>
    </div>

    <?php if (empty($country_stats)): ?>
      <div class="text-center py-8 text-sm text-slate-400">No visitor locations recorded yet.</div>
    <?php else: ?>
      <div class="space-y-4">
        <?php 
          $max_visits = max(array_values($country_stats)) ?: 1;
          foreach (array_slice($country_stats, 0, 8, true) as $c_name => $v_count): 
            $pct = round(($v_count / $max_visits) * 100);
        ?>
          <div>
            <div class="flex items-center justify-between text-sm mb-1.5">
              <span class="font-bold text-white"><?= htmlspecialchars($c_name); ?></span>
              <span class="font-mono text-slate-300 font-bold"><?= $v_count; ?> visits</span>
            </div>
            <div class="w-full h-2 bg-white/[0.06] rounded-full overflow-hidden">
              <div class="h-full bg-indigo-500 rounded-full" style="width: <?= $pct; ?>%"></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- Captured Emails / Lead Identification (6 cols) -->
  <div class="lg:col-span-6 adm-card p-6 sm:p-7">
    <div class="flex items-center justify-between mb-5 pb-3 border-b border-white/[0.08]">
      <h3 class="text-xs font-bold uppercase tracking-wider text-slate-300 font-display">Identified Client Profiles</h3>
      <span class="text-xs text-slate-400 font-mono"><?= count($captured_emails); ?> Captured</span>
    </div>

    <?php if (empty($captured_emails)): ?>
      <div class="text-center py-8 text-sm text-slate-400">
        No visitor emails captured yet. Emails are automatically linked whenever a client submits an order or contact message!
      </div>
    <?php else: ?>
      <div class="space-y-3 max-h-[300px] overflow-y-auto pr-1">
        <?php foreach ($captured_emails as $ce): ?>
          <div class="p-3.5 rounded-xl bg-white/[0.02] border border-white/[0.08] flex items-center justify-between gap-3 text-sm">
            <div class="space-y-0.5">
              <div class="font-bold text-white"><?= htmlspecialchars($ce['email']); ?></div>
              <div class="text-xs text-slate-400 font-mono">IP: <?= htmlspecialchars($ce['ip']); ?></div>
            </div>
            <div class="text-right">
              <span class="px-2.5 py-1 rounded-md bg-indigo-500/20 text-indigo-300 font-bold text-xs">
                <?= htmlspecialchars($ce['country']); ?>
              </span>
              <div class="text-xs text-slate-400 mt-1 font-mono">
                <?= date('M d, H:i', strtotime($ce['last_seen'])); ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

</div>

<!-- Real-Time Activity Logs Table -->
<div class="adm-card p-6 sm:p-7">
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 mb-6 border-b border-white/[0.08]">
    <div>
      <h3 class="text-lg sm:text-xl font-bold text-white font-display">Live Website Visitor Activity Stream</h3>
      <p class="text-xs sm:text-sm text-slate-300 mt-0.5">Real-time incoming page loads and visitor sessions</p>
    </div>
    
    <div class="relative w-full sm:w-72">
      <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
      </div>
      <input 
        type="text" 
        id="analyticsSearch" 
        placeholder="Filter by IP, page..." 
        class="adm-input text-sm pl-10 py-2" 
        onkeyup="filterAnalyticsTable()" 
      />
    </div>
  </div>

  <?php if (empty($logs)): ?>
    <div class="text-center py-10 text-sm text-slate-400">
      No visitor activity logged yet. Visit pages on the website to generate visitor records.
    </div>
  <?php else: ?>
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-slate-200" id="analyticsTable">
        <thead>
          <tr class="text-slate-400 border-b border-white/[0.08] text-xs font-bold uppercase tracking-wider">
            <th class="pb-3 pr-4">Time</th>
            <th class="pb-3 pr-4">IP Address</th>
            <th class="pb-3 pr-4">Country / Location</th>
            <th class="pb-3 pr-4">Page Visited</th>
            <th class="pb-3 pr-4">Device</th>
            <th class="pb-3 text-right">Identified Client</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/[0.06] text-xs sm:text-sm">
          <?php foreach (array_slice($logs, 0, 75) as $l): ?>
            <tr class="log-row hover:bg-white/[0.03] transition-colors">
              <td class="py-3.5 pr-4 text-slate-300 whitespace-nowrap font-mono">
                <?= date('H:i:s M d', strtotime($l['visited_at'] ?? 'now')); ?>
              </td>
              <td class="py-3.5 pr-4 font-mono font-bold text-indigo-400">
                <?= htmlspecialchars($l['ip_address'] ?? '127.0.0.1'); ?>
              </td>
              <td class="py-3.5 pr-4 text-white font-semibold">
                <?= htmlspecialchars($l['country_name'] ?? 'Local Network'); ?>
              </td>
              <td class="py-3.5 pr-4 text-violet-300 max-w-xs truncate font-semibold font-mono text-xs">
                <?= htmlspecialchars($l['page_visited'] ?? '/'); ?>
              </td>
              <td class="py-3.5 pr-4 text-slate-300">
                <?= htmlspecialchars($l['device_type'] ?? 'Desktop'); ?> / <?= htmlspecialchars($l['browser'] ?? 'Chrome'); ?>
              </td>
              <td class="py-3.5 text-right">
                <?php if (!empty($l['visitor_email'])): ?>
                  <span class="px-2.5 py-1 rounded-md bg-violet-500/20 border border-violet-500/40 text-violet-200 font-bold text-xs">
                    <?= htmlspecialchars($l['visitor_email']); ?>
                  </span>
                <?php else: ?>
                  <span class="text-slate-500 text-xs">Anonymous</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<script>
function filterAnalyticsTable() {
  const query = document.getElementById('analyticsSearch').value.toLowerCase();
  const rows = document.querySelectorAll('.log-row');
  
  rows.forEach(row => {
    const text = row.innerText.toLowerCase();
    row.style.display = text.includes(query) ? '' : 'none';
  });
}
</script>

<?php require_once('layout_footer.php'); ?>
