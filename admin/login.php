<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('../config/db.php');

$error = '';

if (!empty($_SESSION['admin_logged_in'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $error = 'Please enter both your username and password.';
    } else {
        if ($pdo) {
            $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ? LIMIT 1");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password_hash'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_user_id'] = $user['id'];
                $_SESSION['admin_username'] = $user['username'];
                header('Location: index.php');
                exit;
            } else {
                $error = 'Invalid username or password. Please try again.';
            }
        } else {
            // Fallback if database is offline
            if ($username === 'admin' && $password === 'admin123') {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = 'admin';
                header('Location: index.php');
                exit;
            } else {
                $error = 'Invalid admin credentials.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="h-full bg-black">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Portal Login | Next Level Media</title>
  <link rel="icon" href="../main-logo.png" type="image/png" />
  
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700;800&display=swap" rel="stylesheet">
  
  <style>
    body {
      background-color: #000000;
      color: #ffffff;
      font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    
    .login-card {
      background: #0b0b0f;
      border: 1px solid #1e1e28;
      border-radius: 1.25rem;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.9);
    }
    .login-input {
      width: 100%;
      background: #050508;
      border: 1px solid #282836;
      border-radius: 0.75rem;
      padding: 0.875rem 1rem 0.875rem 3rem;
      color: #ffffff;
      font-size: 0.9375rem;
      font-weight: 500;
      outline: none;
      transition: all 0.2s ease;
    }
    .login-input:focus {
      border-color: #6366f1;
      background: #08080d;
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.35);
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative bg-black">

  <div class="w-full max-w-md relative z-10">
    
    <!-- Brand Header -->
    <div class="text-center mb-8">
      <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-tr from-indigo-500 to-violet-600 p-2.5 flex items-center justify-center shadow-lg shadow-indigo-500/20 mb-4">
        <img src="../main-logo.png" alt="Logo" class="w-full h-full object-contain">
      </div>
      <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight font-display">Next Level Admin</h1>
      <p class="text-sm text-slate-300 mt-1">Sign in to manage website content, orders, and videos</p>
    </div>

    <!-- Login Card -->
    <div class="login-card p-8 sm:p-10">
      
      <?php if (!empty($error)): ?>
        <div class="mb-6 p-4 rounded-xl bg-red-500/15 border border-red-500/30 text-red-200 text-sm font-semibold flex items-center gap-3">
          <svg class="w-5 h-5 text-red-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
          </svg>
          <span><?= htmlspecialchars($error); ?></span>
        </div>
      <?php endif; ?>

      <form action="login.php" method="POST" class="space-y-5">
        
        <!-- Username Field -->
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Username</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
            </div>
            <input 
              type="text" 
              name="username" 
              required 
              autofocus 
              placeholder="admin" 
              value="admin" 
              class="login-input" 
            />
          </div>
        </div>

        <!-- Password Field -->
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Password</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
            </div>
            <input 
              type="password" 
              name="password" 
              required 
              placeholder="••••••••" 
              value="admin123" 
              class="login-input" 
            />
          </div>
        </div>

        <!-- Submit Button -->
        <button 
          type="submit" 
          class="w-full mt-2 py-3.5 px-4 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-extrabold text-sm tracking-wide uppercase transition-all shadow-lg shadow-indigo-600/30 flex items-center justify-center gap-2 cursor-pointer"
        >
          <span>Sign In to Admin Panel</span>
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
          </svg>
        </button>

      </form>

      <!-- Default Credential Hint -->
      <div class="mt-6 pt-5 border-t border-white/[0.08] text-center">
        <p class="text-xs text-slate-400">
          Default Credentials: <span class="font-mono text-white font-bold">admin</span> / <span class="font-mono text-white font-bold">admin123</span>
        </p>
      </div>

    </div>

    <!-- Back to Website Link -->
    <div class="text-center mt-6">
      <a href="../index.php" class="text-sm font-semibold text-slate-400 hover:text-white transition-colors inline-flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span>Back to Live Website</span>
      </a>
    </div>

  </div>

</body>
</html>
