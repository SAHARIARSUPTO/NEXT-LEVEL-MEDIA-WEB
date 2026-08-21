<?php
$page_title = 'Client Inquiries & Direct Messages';
require_once('layout_header.php');

$all_inquiries = get_all_inquiries();

// Handle status updates or deletes
$action = $_GET['action'] ?? '';
$inquiry_id = intval($_GET['id'] ?? 0);

if ($action === 'delete' && $inquiry_id > 0) {
    global $pdo;
    $inquiries = get_json_file('inquiries', []);
    $inquiries = array_values(array_filter($inquiries, function($inq) use ($inquiry_id) {
        return ($inq['id'] ?? 0) != $inquiry_id;
    }));
    save_json_file('inquiries', $inquiries);

    if ($pdo) {
        try {
            $stmt = $pdo->prepare("DELETE FROM contact_inquiries WHERE id = ?");
            $stmt->execute([$inquiry_id]);
        } catch (Exception $e) {}
    }
    header("Location: inquiries.php?msg=deleted");
    exit;
}

if ($action === 'mark_read' && $inquiry_id > 0) {
    global $pdo;
    $inquiries = get_json_file('inquiries', []);
    foreach ($inquiries as &$inq) {
        if (($inq['id'] ?? 0) == $inquiry_id) {
            $inq['status'] = 'Read';
            break;
        }
    }
    save_json_file('inquiries', $inquiries);

    if ($pdo) {
        try {
            $stmt = $pdo->prepare("UPDATE contact_inquiries SET status = 'Read' WHERE id = ?");
            $stmt->execute([$inquiry_id]);
        } catch (Exception $e) {}
    }
    header("Location: inquiries.php?msg=updated");
    exit;
}

// Refresh inquiries
$all_inquiries = get_all_inquiries();
$total_count = count($all_inquiries);
$unread_count = count(array_filter($all_inquiries, function($inq) {
    return ($inq['status'] ?? '') === 'Unread';
}));
?>

<!-- Header -->
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
  <div>
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-1">
      <span>Admin Control Center</span>
      <span>/</span>
      <span class="text-indigo-400 font-bold">Client Inquiries</span>
    </div>
    <h1 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight font-display">Client Inquiries & Direct Messages</h1>
    <p class="text-sm sm:text-base text-slate-300 mt-1">Review direct touch queries, contact form messages, and client outreach submissions.</p>
  </div>
  
  <div class="flex items-center gap-3">
    <div class="px-4 py-2 rounded-xl bg-indigo-500/10 border border-indigo-500/30 text-indigo-300 text-sm font-bold">
      <?= $unread_count; ?> Unread / <?= $total_count; ?> Total
    </div>
  </div>
</div>

<?php if (isset($_GET['msg'])): ?>
  <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-sm font-bold flex items-center gap-2">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    <span>Action completed successfully.</span>
  </div>
<?php endif; ?>

<!-- Inquiries Table Card -->
<div class="adm-card p-6 sm:p-7">
  <?php if (empty($all_inquiries)): ?>
    <div class="text-center py-16 px-4">
      <div class="w-14 h-14 mx-auto rounded-2xl bg-indigo-500/10 border border-indigo-500/30 flex items-center justify-center text-indigo-400 mb-4">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
        </svg>
      </div>
      <h3 class="text-lg font-bold text-white mb-1">No Client Messages Yet</h3>
      <p class="text-sm text-slate-400 max-w-md mx-auto">Client inquiries submitted from the website footer or contact page will appear here instantly.</p>
    </div>
  <?php else: ?>
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-slate-200">
        <thead>
          <tr class="text-slate-400 border-b border-white/[0.08] text-xs font-bold uppercase tracking-wider">
            <th class="pb-3 pr-4">Sender</th>
            <th class="pb-3 pr-4">Subject</th>
            <th class="pb-3 pr-4">Query Message</th>
            <th class="pb-3 pr-4">Received</th>
            <th class="pb-3 pr-4">Status</th>
            <th class="pb-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/[0.06]">
          <?php foreach ($all_inquiries as $inq): 
            $is_unread = ($inq['status'] ?? '') === 'Unread';
          ?>
            <tr class="hover:bg-white/[0.03] transition-colors <?= $is_unread ? 'bg-indigo-500/[0.04]' : ''; ?>">
              <td class="py-4 pr-4">
                <div class="font-bold text-white text-sm sm:text-base"><?= htmlspecialchars($inq['name'] ?? 'Client'); ?></div>
                <a href="mailto:<?= htmlspecialchars($inq['email'] ?? ''); ?>" class="text-xs text-indigo-400 hover:underline font-mono block mt-0.5"><?= htmlspecialchars($inq['email'] ?? ''); ?></a>
                <?php if (!empty($inq['phone'])): ?>
                  <div class="text-xs text-slate-400 font-mono mt-0.5"><?= htmlspecialchars($inq['phone']); ?></div>
                <?php endif; ?>
              </td>
              <td class="py-4 pr-4 text-xs sm:text-sm font-semibold text-slate-300">
                <?= htmlspecialchars($inq['subject'] ?? 'Direct Touch'); ?>
              </td>
              <td class="py-4 pr-4 max-w-xs sm:max-w-md text-xs sm:text-sm text-slate-300 leading-relaxed">
                <?= nl2br(htmlspecialchars($inq['message'] ?? '')); ?>
              </td>
              <td class="py-4 pr-4 whitespace-nowrap text-xs font-mono text-slate-400">
                <?= !empty($inq['created_at']) ? date('M d, Y H:i', strtotime($inq['created_at'])) : 'Recent'; ?>
              </td>
              <td class="py-4 pr-4">
                <?php if ($is_unread): ?>
                  <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-500/15 border border-amber-500/30 text-amber-300">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                    Unread
                  </span>
                <?php else: ?>
                  <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-slate-500/15 border border-slate-500/30 text-slate-300">
                    Read
                  </span>
                <?php endif; ?>
              </td>
              <td class="py-4 text-right whitespace-nowrap space-x-2">
                <?php if ($is_unread): ?>
                  <a href="inquiries.php?action=mark_read&id=<?= $inq['id']; ?>" class="px-2.5 py-1.5 rounded-lg bg-indigo-600/20 hover:bg-indigo-600 border border-indigo-500/30 text-indigo-300 hover:text-white font-bold text-xs transition-all inline-block">
                    Mark Read
                  </a>
                <?php endif; ?>
                <a href="mailto:<?= htmlspecialchars($inq['email'] ?? ''); ?>?subject=Re:%20<?= urlencode($inq['subject'] ?? 'Your Inquiry to Next Level Media'); ?>" class="px-2.5 py-1.5 rounded-lg bg-emerald-600/20 hover:bg-emerald-600 border border-emerald-500/30 text-emerald-300 hover:text-white font-bold text-xs transition-all inline-block">
                  Reply
                </a>
                <a href="inquiries.php?action=delete&id=<?= $inq['id']; ?>" onclick="return confirm('Are you sure you want to delete this message?');" class="px-2.5 py-1.5 rounded-lg bg-red-600/20 hover:bg-red-600 border border-red-500/30 text-red-300 hover:text-white font-bold text-xs transition-all inline-block">
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

<?php require_once('layout_footer.php'); ?>
