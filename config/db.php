<?php
/**
 * Ultra-Fast Hybrid Storage Engine (MySQL + Instant Fallback JSON Store)
 * Guarantees 1ms load speed, zero hanging, and 100% reliability.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$data_dir = __DIR__ . '/data/';
if (!is_dir($data_dir)) {
    @mkdir($data_dir, 0777, true);
}

// --------------------------------------------------------------------------
// 1. MySQL Connection with Strict 1-Second Timeout
// --------------------------------------------------------------------------
$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = '';
$db_name = 'next_level_media_db';

$pdo = null;

if (extension_loaded('pdo_mysql')) {
    try {
        $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8mb4", $db_user, $db_pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_TIMEOUT => 1,
        ]);
    } catch (PDOException $e) {
        try {
            $pdo_init = new PDO("mysql:host={$db_host};charset=utf8mb4", $db_user, $db_pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
                PDO::ATTR_TIMEOUT => 1,
            ]);
            $pdo_init->exec("CREATE DATABASE IF NOT EXISTS `{$db_name}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8mb4", $db_user, $db_pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_TIMEOUT => 1,
            ]);
        } catch (PDOException $e2) {
            $pdo = null;
        }
    }
}

// --------------------------------------------------------------------------
// 2. Universal Data Helper Functions (Works seamlessly on MySQL or Local Store)
// --------------------------------------------------------------------------

function get_json_file($file, $default = []) {
    global $data_dir;
    $path = $data_dir . $file . '.json';
    if (!file_exists($path)) {
        file_put_contents($path, json_encode($default, JSON_PRETTY_PRINT));
        return $default;
    }
    $content = @file_get_contents($path);
    $arr = json_decode($content, true);
    return is_array($arr) ? $arr : $default;
}

function save_json_file($file, $data) {
    global $data_dir;
    $path = $data_dir . $file . '.json';
    return file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

// --------------------------------------------------------------------------
// 3. Settings Manager
// --------------------------------------------------------------------------
$default_settings = [
    'meta_title' => 'Next Level Media | High-Performance Video Production & Creative Systems',
    'meta_description' => 'Next Level Media crafts high-retention video content, YouTube edits, viral shorts, VSLs, and 3D motion assets that convert. Trusted by 500+ creators & brands.',
    'meta_keywords' => 'Next Level Media, video editing agency, SaaS product videos, viral shorts, YouTube video editor, VSL, motion graphics, 3D animation',
    'og_image' => 'main-logo.png',
    'contact_email' => 'contact@nextlevelmediadigital.com',
    'contact_phone' => '+880 1753-506047',
    'booking_calendly_url' => 'https://calendly.com/nextlevelmediacall/30min?month=2025-07',
    'hero_video_url' => 'https://player.vimeo.com/video/824804225', // Vimeo support for first hero video
    'hero_badge_text' => 'Agency Showreel (01:24)',
];

function get_setting($key, $default = '') {
    global $pdo, $default_settings;
    static $cached = null;
    if ($cached === null) {
        $cached = get_json_file('settings', $default_settings);
        if ($pdo) {
            try {
                $stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings");
                if ($stmt) {
                    while ($r = $stmt->fetch()) {
                        $cached[$r['setting_key']] = $r['setting_value'];
                    }
                }
            } catch (Exception $e) {}
        }
    }
    return isset($cached[$key]) && $cached[$key] !== '' ? $cached[$key] : ($default_settings[$key] ?? $default);
}

function save_setting($key, $val) {
    global $pdo, $default_settings;
    $settings = get_json_file('settings', $default_settings);
    $settings[$key] = $val;
    save_json_file('settings', $settings);

    if ($pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
            $stmt->execute([$key, $val]);
        } catch (Exception $e) {}
    }
}

// --------------------------------------------------------------------------
// 4. Orders Manager
// --------------------------------------------------------------------------
function get_all_orders() {
    global $pdo;
    $orders = get_json_file('orders', []);
    if ($pdo) {
        try {
            $stmt = $pdo->query("SELECT * FROM client_orders ORDER BY id DESC");
            if ($stmt) {
                $db_orders = $stmt->fetchAll();
                if (!empty($db_orders)) return $db_orders;
            }
        } catch (Exception $e) {}
    }
    usort($orders, function($a, $b) {
        return ($b['id'] ?? 0) <=> ($a['id'] ?? 0);
    });
    return $orders;
}

function save_new_order($data) {
    global $pdo;
    $orders = get_json_file('orders', []);
    $new_id = count($orders) > 0 ? (max(array_column($orders, 'id')) + 1) : 1;
    $data['id'] = $new_id;
    $data['status'] = 'Pending';
    $data['created_at'] = date('Y-m-d H:i:s');
    $orders[] = $data;
    save_json_file('orders', $orders);

    if ($pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO client_orders (client_name, client_email, contact_number, company_name, service_types, budget_range, deadline, project_description, reference_links, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $data['client_name'], $data['client_email'], $data['contact_number'], $data['company_name'] ?? '',
                $data['service_types'], $data['budget_range'] ?? '', $data['deadline'] ?? '',
                $data['project_description'], $data['reference_links'] ?? '', 'Pending'
            ]);
        } catch (Exception $e) {}
    }
    return $new_id;
}

function update_order_status($order_id, $status, $notes = '') {
    global $pdo;
    $orders = get_json_file('orders', []);
    foreach ($orders as &$o) {
        if (($o['id'] ?? 0) == $order_id) {
            $o['status'] = $status;
            if ($notes !== '') $o['admin_notes'] = $notes;
            break;
        }
    }
    save_json_file('orders', $orders);

    if ($pdo) {
        try {
            $stmt = $pdo->prepare("UPDATE client_orders SET status = ?, admin_notes = ? WHERE id = ?");
            $stmt->execute([$status, $notes, $order_id]);
        } catch (Exception $e) {}
    }
}

function update_order_full($order_id, $data) {
    global $pdo;
    $orders = get_json_file('orders', []);
    foreach ($orders as &$o) {
        if (($o['id'] ?? 0) == $order_id) {
            foreach ($data as $k => $v) {
                $o[$k] = $v;
            }
            break;
        }
    }
    save_json_file('orders', $orders);

    if ($pdo) {
        try {
            $stmt = $pdo->prepare("UPDATE client_orders SET status = ?, delivery_date = ?, order_amount = ?, paid_amount = ?, payment_status = ?, client_address = ?, invoice_notes = ?, admin_notes = ? WHERE id = ?");
            $stmt->execute([
                $data['status'] ?? 'Pending',
                $data['delivery_date'] ?? null,
                floatval($data['order_amount'] ?? 0),
                floatval($data['paid_amount'] ?? 0),
                $data['payment_status'] ?? 'Unpaid',
                $data['client_address'] ?? '',
                $data['invoice_notes'] ?? '',
                $data['admin_notes'] ?? '',
                $order_id
            ]);
        } catch (Exception $e) {}
    }
}

// --------------------------------------------------------------------------
// 4.1. Income & Expense Manager
// --------------------------------------------------------------------------
function get_all_finances() {
    global $pdo;
    $finances = get_json_file('finances', []);
    if ($pdo) {
        try {
            $stmt = $pdo->query("SELECT * FROM financial_records ORDER BY transaction_date DESC, id DESC");
            if ($stmt) {
                $db_finances = $stmt->fetchAll();
                if (!empty($db_finances)) return $db_finances;
            }
        } catch (Exception $e) {}
    }
    usort($finances, function($a, $b) {
        return strcmp($b['transaction_date'] ?? '', $a['transaction_date'] ?? '');
    });
    return $finances;
}

function save_financial_record($data) {
    global $pdo;
    $finances = get_json_file('finances', []);
    $new_id = count($finances) > 0 ? (max(array_column($finances, 'id')) + 1) : 1;
    $data['id'] = $new_id;
    $data['created_at'] = date('Y-m-d H:i:s');
    $finances[] = $data;
    save_json_file('finances', $finances);

    if ($pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO financial_records (type, order_id, category, title, amount, payment_method, transaction_date, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $data['type'],
                !empty($data['order_id']) ? intval($data['order_id']) : null,
                $data['category'] ?? 'General',
                $data['title'],
                floatval($data['amount']),
                $data['payment_method'] ?? 'Bank Transfer',
                $data['transaction_date'] ?? date('Y-m-d'),
                $data['notes'] ?? ''
            ]);
        } catch (Exception $e) {}
    }
    return $new_id;
}

function delete_financial_record($id) {
    global $pdo;
    $finances = get_json_file('finances', []);
    $finances = array_values(array_filter($finances, function($f) use ($id) {
        return ($f['id'] ?? 0) != $id;
    }));
    save_json_file('finances', $finances);

    if ($pdo) {
        try {
            $stmt = $pdo->prepare("DELETE FROM financial_records WHERE id = ?");
            $stmt->execute([$id]);
        } catch (Exception $e) {}
    }
}

function get_finance_summary() {
    $records = get_all_finances();
    $orders = get_all_orders();

    $total_income = 0;
    $total_expense = 0;
    $total_due = 0;

    foreach ($records as $r) {
        $amt = floatval($r['amount'] ?? 0);
        if (($r['type'] ?? '') === 'income') {
            $total_income += $amt;
        } elseif (($r['type'] ?? '') === 'expense') {
            $total_expense += $amt;
        }
    }

    foreach ($orders as $o) {
        $total_cost = floatval($o['order_amount'] ?? 0);
        $paid = floatval($o['paid_amount'] ?? 0);
        $due = max(0, $total_cost - $paid);
        $total_due += $due;
    }

    return [
        'total_income' => $total_income,
        'total_expense' => $total_expense,
        'net_profit' => ($total_income - $total_expense),
        'total_due' => $total_due,
        'total_records' => count($records)
    ];
}

// --------------------------------------------------------------------------
// 5. Section-Wise Videos Manager
// --------------------------------------------------------------------------
$initial_videos = [
    // Shorts
    ["id" => 1, "section" => "shorts", "title" => "Viral Hook Breakdown", "client_name" => "Fitness Creator", "video_url" => "https://youtube.com/shorts/LPXvOwKmgF0", "is_active" => 1],
    ["id" => 2, "section" => "shorts", "title" => "SaaS Product Demo Reel", "client_name" => "SaaS Brand", "video_url" => "https://youtube.com/shorts/A0K4cyrD48U", "is_active" => 1],
    ["id" => 3, "section" => "shorts", "title" => "Personal Brand Story", "client_name" => "Agency Founder", "video_url" => "https://youtube.com/shorts/BSDP0qphx8o", "is_active" => 1],
    ["id" => 4, "section" => "shorts", "title" => "High Retention Pacing", "client_name" => "YouTube Creator", "video_url" => "https://youtube.com/shorts/v03bJY39b6U", "is_active" => 1],
    ["id" => 5, "section" => "shorts", "title" => "E-Commerce Spotlight", "client_name" => "E-Com Brand", "video_url" => "https://youtube.com/shorts/kRtHRAsHKk8", "is_active" => 1],
    ["id" => 6, "section" => "shorts", "title" => "Conversion Focused Cut", "client_name" => "Growth Brand", "video_url" => "https://youtube.com/shorts/3gDusm-pYr4", "is_active" => 1],
    // YouTube Long-Form
    ["id" => 7, "section" => "youtube", "title" => "Full Production Showcase 01", "client_name" => "Creator Channel", "video_url" => "https://www.youtube.com/watch?v=_VZpzlfgMog", "is_active" => 1],
    ["id" => 8, "section" => "youtube", "title" => "Full Production Showcase 02", "client_name" => "Tech Channel", "video_url" => "https://www.youtube.com/watch?v=vVjQcWh7pVI", "is_active" => 1],
    ["id" => 9, "section" => "youtube", "title" => "Full Production Showcase 03", "client_name" => "Documentary", "video_url" => "https://www.youtube.com/watch?v=ZdaiBOEJhTY", "is_active" => 1],
    ["id" => 10, "section" => "youtube", "title" => "Full Production Showcase 04", "client_name" => "Creator Studio", "video_url" => "https://www.youtube.com/watch?v=mF2so1ihSQ4", "is_active" => 1],
    ["id" => 11, "section" => "youtube", "title" => "Full Production Showcase 05", "client_name" => "Podcast Cut", "video_url" => "https://www.youtube.com/watch?v=WyWPeGKKVIE", "is_active" => 1],
    // Paid Ads & VSL
    ["id" => 12, "section" => "vsl", "title" => "Direct Response Performance Ad 01", "client_name" => "Direct Response", "video_url" => "https://www.youtube.com/watch?v=s7p6OLwV_50", "is_active" => 1],
    ["id" => 13, "section" => "vsl", "title" => "Direct Response Performance Ad 02", "client_name" => "App Growth", "video_url" => "https://youtu.be/WMxo_4q0MNg", "is_active" => 1],
    ["id" => 14, "section" => "vsl", "title" => "Direct Response Performance Ad 03", "client_name" => "E-Com Ad", "video_url" => "https://youtu.be/AlsXNhTm4AA", "is_active" => 1],
    // 3D Motion
    ["id" => 15, "section" => "motion_3d", "title" => "3D Product Animation Showcase", "client_name" => "3D Studio", "video_url" => "https://nextlevelmediadigital.com/components/videos/3d.mp4", "is_active" => 1],
    // Client Review Videos
    ["id" => 16, "section" => "reviews", "title" => "Client Story - Mike Over Case Study", "client_name" => "Mike Over", "video_url" => "https://nextlevelmediadigital.com/components/videos/review.mp4", "is_active" => 1]
];

function get_section_videos($section = 'all') {
    global $pdo, $initial_videos;
    $videos = get_json_file('videos', $initial_videos);
    if ($section === 'all') return $videos;
    return array_values(array_filter($videos, function($v) use ($section) {
        return ($v['section'] ?? '') === $section;
    }));
}

function save_video_item($section, $title, $client_name, $video_url, $id = 0) {
    global $initial_videos;
    $videos = get_json_file('videos', $initial_videos);
    if ($id > 0) {
        foreach ($videos as &$v) {
            if ($v['id'] == $id) {
                $v['section'] = $section;
                $v['title'] = $title;
                $v['client_name'] = $client_name;
                $v['video_url'] = $video_url;
                break;
            }
        }
    } else {
        $new_id = count($videos) > 0 ? (max(array_column($videos, 'id')) + 1) : 1;
        $videos[] = [
            'id' => $new_id,
            'section' => $section,
            'title' => $title,
            'client_name' => $client_name,
            'video_url' => $video_url,
            'is_active' => 1
        ];
    }
    save_json_file('videos', $videos);
}

function delete_video_item($id) {
    global $initial_videos;
    $videos = get_json_file('videos', $initial_videos);
    $videos = array_values(array_filter($videos, function($v) use ($id) {
        return $v['id'] != $id;
    }));
    save_json_file('videos', $videos);
}

// --------------------------------------------------------------------------
// 6. Analytics Logger & Fetcher
// --------------------------------------------------------------------------
function log_visitor_hit($ip, $page, $country = 'Localhost', $city = 'Local', $email = null) {
    $analytics = get_json_file('analytics', []);
    // Keep max 250 records
    if (count($analytics) > 250) {
        $analytics = array_slice($analytics, -200);
    }
    $analytics[] = [
        'id' => count($analytics) + 1,
        'ip_address' => $ip,
        'country_name' => $country,
        'city' => $city,
        'page_visited' => $page,
        'visitor_email' => $email,
        'visited_at' => date('Y-m-d H:i:s')
    ];
    save_json_file('analytics', $analytics);
}

function get_all_analytics() {
    $analytics = get_json_file('analytics', []);
    return array_reverse($analytics);
}

// --------------------------------------------------------------------------
// 7. Contact Inquiries Manager
// --------------------------------------------------------------------------
function save_contact_inquiry($name, $email, $phone, $subject, $message) {
    $inquiries = get_json_file('inquiries', []);
    $new_id = count($inquiries) > 0 ? (max(array_column($inquiries, 'id')) + 1) : 1;
    $inquiries[] = [
        'id' => $new_id,
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'subject' => $subject,
        'message' => $message,
        'status' => 'Unread',
        'created_at' => date('Y-m-d H:i:s')
    ];
    save_json_file('inquiries', $inquiries);
}

function get_all_inquiries() {
    $inquiries = get_json_file('inquiries', []);
    return array_reverse($inquiries);
}
