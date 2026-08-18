<?php
$page_title = 'Image & File Manager';
require_once('layout_header.php');

$upload_dir = __DIR__ . '/../uploads/';
if (!is_dir($upload_dir)) {
    @mkdir($upload_dir, 0777, true);
}

$msg = '';
$error = '';

// Handle File Upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['media_file'])) {
    $file = $_FILES['media_file'];
    
    if ($file['error'] === UPLOAD_ERR_OK) {
        $allowed_exts = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg', 'mp4', 'pdf'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed_exts)) {
            // Sanitize filename
            $raw_name = pathinfo($file['name'], PATHINFO_FILENAME);
            $clean_name = preg_replace('/[^a-zA-Z0-9_-]/', '_', $raw_name);
            $new_filename = $clean_name . '_' . time() . '.' . $ext;
            $target_path = $upload_dir . $new_filename;
            
            if (move_uploaded_file($file['tmp_name'], $target_path)) {
                $msg = "File \"{$new_filename}\" uploaded successfully!";
            } else {
                $error = "Failed to save the uploaded file. Please check folder permissions.";
            }
        } else {
            $error = "Invalid file type. Allowed formats: JPG, PNG, WEBP, GIF, SVG, MP4, PDF.";
        }
    } else {
        $error = "Please choose a valid file to upload.";
    }
}

// Handle File Deletion
if (isset($_GET['delete'])) {
    $file_to_delete = basename($_GET['delete']);
    $file_path = $upload_dir . $file_to_delete;
    
    if (file_exists($file_path) && is_file($file_path)) {
        @unlink($file_path);
        $msg = "File \"{$file_to_delete}\" deleted successfully.";
    }
}

// Fetch all uploaded files
$files = [];
if (is_dir($upload_dir)) {
    $scanned = scandir($upload_dir);
    foreach ($scanned as $f) {
        if ($f !== '.' && $f !== '..' && !is_dir($upload_dir . $f)) {
            $full_path = $upload_dir . $f;
            $files[] = [
                'name' => $f,
                'size' => filesize($full_path),
                'date' => filemtime($full_path),
                'ext' => strtolower(pathinfo($f, PATHINFO_EXTENSION)),
                'url' => 'uploads/' . $f,
                'full_url' => 'https://nextlevelmediadigital.com/uploads/' . $f
            ];
        }
    }
    // Sort newest first
    usort($files, fn($a, $b) => $b['date'] <=> $a['date']);
}
?>

<!-- Page Header with Large Clear Text -->
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
  <div>
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-1">
      <a href="index.php" class="hover:text-white transition-colors">Admin</a>
      <span>/</span>
      <span class="text-indigo-400 font-bold">Image & File Manager</span>
    </div>
    <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight font-display">Image & Media Manager</h1>
    <p class="text-sm sm:text-base text-slate-300 mt-1">Upload images, thumbnails, or videos directly to your website storage and copy links with 1 click.</p>
  </div>
  
  <div class="flex items-center gap-3">
    <a href="#uploadBox" class="adm-btn-primary">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
      </svg>
      <span>Upload New File</span>
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

<!-- Main Upload Box -->
<div id="uploadBox" class="adm-card p-6 sm:p-8 mb-8">
  <div class="border-b border-white/[0.08] pb-4 mb-6">
    <h2 class="text-lg sm:text-xl font-bold text-white font-display">Upload Image or Video</h2>
    <p class="text-sm text-slate-300 mt-0.5">Select any image (JPG, PNG, WEBP, SVG) or video to save it into your website uploads folder.</p>
  </div>

  <form action="media.php" method="POST" enctype="multipart/form-data" class="space-y-4">
    <div class="border-2 border-dashed border-white/20 hover:border-indigo-500/50 rounded-2xl p-8 sm:p-10 text-center bg-white/[0.02] transition-colors cursor-pointer relative" onclick="document.getElementById('fileInput').click()">
      <input type="file" name="media_file" id="fileInput" required class="hidden" onchange="showSelectedFileName(this)" />
      
      <div class="w-14 h-14 mx-auto rounded-2xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400 mb-3">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
      </div>

      <p class="text-base font-bold text-white mb-1" id="fileLabel">Click here to choose an image or file</p>
      <p class="text-xs text-slate-400">Supports PNG, JPG, WEBP, SVG, MP4, GIF (Max size: 50MB)</p>
    </div>

    <div class="flex justify-end pt-2">
      <button type="submit" class="adm-btn-primary px-8 py-3 text-sm font-bold">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
        </svg>
        <span>Upload File to Server</span>
      </button>
    </div>
  </form>
</div>

<!-- Uploaded Media Gallery & File List -->
<div class="adm-card p-6 sm:p-8">
  <div class="flex items-center justify-between pb-4 mb-6 border-b border-white/[0.08]">
    <div>
      <h2 class="text-lg sm:text-xl font-bold text-white font-display">Uploaded Media Files (<?= count($files); ?>)</h2>
      <p class="text-sm text-slate-300 mt-0.5">Click "Copy Link" on any image to copy its URL and use it in your website or SEO settings.</p>
    </div>
  </div>

  <?php if (empty($files)): ?>
    <div class="text-center py-12 px-4">
      <div class="w-12 h-12 mx-auto rounded-xl bg-white/[0.04] border border-white/[0.08] flex items-center justify-center text-slate-400 mb-3">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
      </div>
      <p class="text-base font-bold text-slate-200">No media uploaded yet</p>
      <p class="text-sm text-slate-400 mt-1">Use the upload box above to add your first image or logo.</p>
    </div>
  <?php else: ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
      <?php foreach ($files as $f): 
        $is_img = in_array($f['ext'], ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg']);
        $size_kb = round($f['size'] / 1024, 1);
      ?>
        <div class="rounded-xl bg-[#0f111a] border border-white/10 hover:border-indigo-500/40 p-4 transition-all flex flex-col justify-between group">
          
          <div>
            <!-- Preview Box -->
            <div class="w-full h-40 rounded-lg bg-black/40 border border-white/[0.06] overflow-hidden flex items-center justify-center mb-3 relative">
              <?php if ($is_img): ?>
                <img src="../<?= htmlspecialchars($f['url']); ?>" alt="<?= htmlspecialchars($f['name']); ?>" class="w-full h-full object-contain" loading="lazy">
              <?php else: ?>
                <div class="text-center p-4">
                  <div class="text-2xl font-bold font-mono text-indigo-400 uppercase"><?= htmlspecialchars($f['ext']); ?></div>
                  <div class="text-xs text-slate-400 mt-1">Media File</div>
                </div>
              <?php endif; ?>
            </div>

            <!-- Filename & Details -->
            <div class="space-y-1">
              <div class="text-sm font-bold text-white truncate" title="<?= htmlspecialchars($f['name']); ?>">
                <?= htmlspecialchars($f['name']); ?>
              </div>
              <div class="text-xs text-slate-400 flex items-center justify-between font-mono">
                <span><?= $size_kb; ?> KB</span>
                <span><?= date('M d, Y', $f['date']); ?></span>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="mt-4 pt-3 border-t border-white/[0.08] flex items-center justify-between gap-2">
            <button 
              type="button" 
              onclick="copyToClipboard('<?= htmlspecialchars($f['full_url']); ?>', this)" 
              class="flex-1 py-1.5 px-3 rounded-lg bg-indigo-600/20 hover:bg-indigo-600 border border-indigo-500/30 hover:border-indigo-500 text-indigo-300 hover:text-white font-bold text-xs transition-all flex items-center justify-center gap-1.5 cursor-pointer"
            >
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
              </svg>
              <span>Copy Link</span>
            </button>

            <a 
              href="media.php?delete=<?= urlencode($f['name']); ?>" 
              onclick="return confirm('Are you sure you want to delete this file: <?= htmlspecialchars(addslashes($f['name'])); ?>?')" 
              class="p-1.5 rounded-lg bg-red-500/10 hover:bg-red-500 border border-red-500/20 text-red-400 hover:text-white transition-all"
              title="Delete File"
            >
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
              </svg>
            </a>
          </div>

        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<!-- cPanel Guidance Info Card for Non-Tech Users -->
<div class="mt-8 adm-card p-6 border-blue-500/20 bg-blue-500/[0.02]">
  <div class="flex items-start gap-4">
    <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/30 flex items-center justify-center text-blue-400 shrink-0">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
      </svg>
    </div>
    <div class="space-y-1 text-sm">
      <h4 class="font-bold text-white">How to manage files directly via cPanel File Manager:</h4>
      <p class="text-slate-300">If you ever need to upload large batches of files directly in cPanel: Log into your cPanel &rarr; click <strong>File Manager</strong> &rarr; navigate to <strong>public_html / uploads</strong>. Any images uploaded there will automatically show up here!</p>
    </div>
  </div>
</div>

<script>
function showSelectedFileName(input) {
  if (input.files && input.files[0]) {
    document.getElementById('fileLabel').innerText = 'Selected: ' + input.files[0].name;
  }
}

function copyToClipboard(text, btn) {
  navigator.clipboard.writeText(text).then(() => {
    const orig = btn.innerHTML;
    btn.innerHTML = '<span>Copied!</span>';
    btn.classList.add('bg-emerald-600', 'text-white');
    setTimeout(() => {
      btn.innerHTML = orig;
      btn.classList.remove('bg-emerald-600', 'text-white');
    }, 2000);
  });
}
</script>

<?php require_once('layout_footer.php'); ?>
