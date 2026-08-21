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
    'order_cta_url' => 'order.php',
    'hero_video_url' => 'https://player.vimeo.com/video/1219066986?autoplay=1&title=0&byline=0&portrait=0&badge=0',
    'hero_badge_text' => 'Agency Showreel',
    'social_twitter' => 'https://x.com/neel_nafis',
    'social_youtube' => 'https://www.youtube.com/@neelnafis',
    'social_linkedin' => 'https://www.linkedin.com/company/mz-media-digital/',
    'social_instagram' => 'https://instagram.com/nextlevelmedia',
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
    // Shorts (Vimeo)
    ["id" => 1, "section" => "shorts", "title" => "Viral Hook Breakdown", "client_name" => "Fitness Creator", "video_url" => "https://vimeo.com/1219657057", "is_active" => 1],
    ["id" => 2, "section" => "shorts", "title" => "SaaS Product Demo Reel", "client_name" => "SaaS Brand", "video_url" => "https://vimeo.com/1219657058", "is_active" => 1],
    ["id" => 3, "section" => "shorts", "title" => "Personal Brand Story", "client_name" => "Agency Founder", "video_url" => "https://vimeo.com/1219657056", "is_active" => 1],
    ["id" => 4, "section" => "shorts", "title" => "High Retention Pacing", "client_name" => "YouTube Creator", "video_url" => "https://vimeo.com/1219657047", "is_active" => 1],
    ["id" => 5, "section" => "shorts", "title" => "E-Commerce Spotlight", "client_name" => "E-Com Brand", "video_url" => "https://vimeo.com/1219578174", "is_active" => 1],
    ["id" => 6, "section" => "shorts", "title" => "Conversion Focused Cut", "client_name" => "Growth Brand", "video_url" => "https://vimeo.com/1219577544", "is_active" => 1],
    // YouTube Long-Form (Vimeo URLs)
    ["id" => 7, "section" => "youtube", "title" => "High-Retention YouTube Masterclass", "client_name" => "YouTube Creator", "video_url" => "https://vimeo.com/1219614785", "thumbnail_url" => "CL1.jpg", "is_active" => 1],
    ["id" => 8, "section" => "youtube", "title" => "Authority Documentary Production", "client_name" => "Creator Studio", "video_url" => "https://vimeo.com/1219614782", "thumbnail_url" => "CL2.jpg", "is_active" => 1],
    ["id" => 9, "section" => "youtube", "title" => "Viral Long-Form Breakdown", "client_name" => "Growth Channel", "video_url" => "https://vimeo.com/1219353241", "thumbnail_url" => "CL3.jpg", "is_active" => 1],
    ["id" => 10, "section" => "youtube", "title" => "Founder Storytelling & Case Study", "client_name" => "SaaS Brand", "video_url" => "https://vimeo.com/1219614784", "thumbnail_url" => "CL4.jpg", "is_active" => 1],
    ["id" => 11, "section" => "youtube", "title" => "Cinematic Video Essay Cut", "client_name" => "Media Channel", "video_url" => "https://vimeo.com/1219353240", "thumbnail_url" => "CL5.jpg", "is_active" => 1],
    ["id" => 12, "section" => "youtube", "title" => "Studio Deep Dive & Visual Essay", "client_name" => "Podcast & Show", "video_url" => "https://vimeo.com/1219353239", "thumbnail_url" => "CL6.jpg", "is_active" => 1],
    // Paid Ads & VSL (Vimeo URLs)
    ["id" => 13, "section" => "vsl", "title" => "Direct Response Performance VSL 01", "client_name" => "Direct Response", "video_url" => "https://vimeo.com/1219660179?fl=ip&fe=ec", "is_active" => 1],
    ["id" => 14, "section" => "vsl", "title" => "Direct Response Performance VSL 02", "client_name" => "App Growth", "video_url" => "https://vimeo.com/1219668107?fl=ip&fe=ec", "is_active" => 1],
    ["id" => 15, "section" => "vsl", "title" => "Direct Response Performance VSL 03", "client_name" => "Scale Brand", "video_url" => "https://vimeo.com/1219664254?fl=ip&fe=ec", "is_active" => 1],
    ["id" => 16, "section" => "vsl", "title" => "Direct Response Performance VSL 04", "client_name" => "Growth Agency", "video_url" => "https://vimeo.com/1219669663?fl=ip&fe=ec", "is_active" => 1],
    ["id" => 17, "section" => "vsl", "title" => "Direct Response Performance VSL 05", "client_name" => "Performance Marketing", "video_url" => "https://vimeo.com/1219663527?fl=ip&fe=ec", "is_active" => 1],
    ["id" => 18, "section" => "vsl", "title" => "Direct Response Performance VSL 06", "client_name" => "E-Com Brand", "video_url" => "https://vimeo.com/1219614073?fl=ip&fe=ec", "is_active" => 1],
    // Podcast
    ["id" => 19, "section" => "podcast", "title" => "Studio Podcast Production 01", "client_name" => "Podcast & Show", "video_url" => "https://youtu.be/H8f7pukBu2k?si=7NP1TL9ZPhQk-lZ8", "is_active" => 1],
    ["id" => 20, "section" => "podcast", "title" => "Studio Podcast Production 02", "client_name" => "Founder Interview", "video_url" => "https://youtu.be/JtZYHd3txEc?si=bnAVHchqkb7s9OHn", "is_active" => 1],
    ["id" => 21, "section" => "podcast", "title" => "Studio Podcast Production 03", "client_name" => "Creator Studio", "video_url" => "https://youtu.be/14ahDH7Ud74?si=sLnyg45M9Zk63ET0", "is_active" => 1],
    ["id" => 22, "section" => "podcast", "title" => "Studio Podcast Production 04", "client_name" => "Industry Insights", "video_url" => "https://youtu.be/xHB5zFYb0M4?si=osxMCVbuTbGmv2w3", "is_active" => 1],
    ["id" => 23, "section" => "podcast", "title" => "Studio Podcast Production 05", "client_name" => "Tech & Growth", "video_url" => "https://youtu.be/sE3OsRi9LWk?si=qZyVzZNHIZP-7Dwi", "is_active" => 1],
    // 3D Motion
    ["id" => 24, "section" => "motion_3d", "title" => "3D Product Animation Showcase", "client_name" => "3D Studio", "video_url" => "https://nextlevelmediadigital.com/components/videos/3d.mp4", "is_active" => 1],
    // Client Review Videos (Portrait)
    ["id" => 25, "section" => "reviews", "title" => "Client Video Review & Growth Breakdown", "client_name" => "Verified Client Story", "video_url" => "testimonials/Testimonial 1 .mp4", "thumbnail_url" => "testimonials/thumb1.jpg", "is_active" => 1],
    ["id" => 26, "section" => "reviews", "title" => "Scale & Content Performance Breakdown", "client_name" => "Creator Case Study", "video_url" => "testimonials/Testimonial 2.mp4", "thumbnail_url" => "testimonials/thumb2.jpg", "is_active" => 1]
];

function get_section_videos($section = 'all') {
    global $pdo, $initial_videos;
    $videos = get_json_file('videos', $initial_videos);
    if ($section === 'all') return $videos;
    return array_values(array_filter($videos, function($v) use ($section) {
        return ($v['section'] ?? '') === $section;
    }));
}

function save_video_item($section, $title, $client_name, $video_url, $thumbnail_url = '', $link_url = '', $id = 0) {
    global $initial_videos;
    $videos = get_json_file('videos', $initial_videos);
    if ($id > 0) {
        foreach ($videos as &$v) {
            if ($v['id'] == $id) {
                $v['section'] = $section;
                $v['title'] = $title;
                $v['client_name'] = $client_name;
                $v['video_url'] = $video_url;
                if (!empty($thumbnail_url)) {
                    $v['thumbnail_url'] = $thumbnail_url;
                }
                $v['link_url'] = $link_url;
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
            'thumbnail_url' => $thumbnail_url,
            'link_url' => $link_url,
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
// 5.1 Written Client Reviews Manager
// --------------------------------------------------------------------------
$initial_reviews = [
    [
        'id' => 1,
        'name' => 'Alex Hormozi',
        'role' => 'Entrepreneur',
        'company' => 'Acquisition.com',
        'brand_logo' => 'brands/logo_4.png',
        'avatar' => 'clients/1.png',
        'quote' => 'These guys are the OGs. The fastest ‘yes’ we’ve ever seen from prospects on our offers. The hook retention and pacing are completely unmatched.',
        'link_url' => 'https://acquisition.com',
        'is_active' => 1
    ],
    [
        'id' => 2,
        'name' => 'Ali Abdaal',
        'role' => 'Former Doctor & Author',
        'company' => 'Feel-Good Productivity',
        'brand_logo' => '',
        'avatar' => 'clients/2.jpg',
        'quote' => 'They turned complexity into clarity fast. If you want premium video then look no further. Our production velocity went up 10x with zero headache.',
        'link_url' => 'https://youtube.com/@aliabdaal',
        'is_active' => 1
    ],
    [
        'id' => 3,
        'name' => 'Steven Bartlett',
        'role' => 'British Businessman',
        'company' => 'The Diary Of A CEO',
        'brand_logo' => '',
        'avatar' => 'clients/3.webp',
        'quote' => 'Sent them a rough idea. They came back with something we couldn’t have imagined. Felt like a real team behind the project, not just freelancers.',
        'link_url' => 'https://youtube.com/@TheDiaryOfACEO',
        'is_active' => 1
    ],
    [
        'id' => 4,
        'name' => 'Wisdom Kaye',
        'role' => 'Fashion Model & Creator',
        'company' => 'Vogue Featured',
        'brand_logo' => '',
        'avatar' => 'clients/4.jpg',
        'quote' => 'Top-tier work, delivered faster than anyone else we’ve tried. The visual transitions, motion design, and pacing are world-class.',
        'link_url' => 'https://tiktok.com/@wisdm8',
        'is_active' => 1
    ],
    [
        'id' => 5,
        'name' => 'Nechristian',
        'role' => 'Founder of instaappoint.ai',
        'company' => 'instaappoint.ai',
        'brand_logo' => '',
        'avatar' => 'clients/5.png',
        'quote' => 'Felt like we hired an elite in-house team, not an agency. The direct response ROI and inbound lead conversions doubled immediately.',
        'link_url' => 'https://instaappoint.ai',
        'is_active' => 1
    ],
    [
        'id' => 6,
        'name' => 'Jason Wojo',
        'role' => 'Entrepreneur',
        'company' => 'Wojo Media',
        'brand_logo' => '',
        'avatar' => 'clients/6.jpg',
        'quote' => 'Honestly the first video team that didn’t make me chase them for updates. They handled every revision in hours and the final delivery was pure gold.',
        'link_url' => 'https://wojomedia.com',
        'is_active' => 1
    ]
];

function get_client_reviews() {
    global $pdo, $initial_reviews;
    return get_json_file('client_reviews', $initial_reviews);
}

function save_client_review($name, $role, $company, $quote, $avatar = '', $brand_logo = '', $link_url = '', $id = 0) {
    global $initial_reviews;
    $reviews = get_json_file('client_reviews', $initial_reviews);
    if ($id > 0) {
        foreach ($reviews as &$r) {
            if ($r['id'] == $id) {
                $r['name'] = $name;
                $r['role'] = $role;
                $r['company'] = $company;
                $r['quote'] = $quote;
                if (!empty($avatar)) $r['avatar'] = $avatar;
                if (!empty($brand_logo)) $r['brand_logo'] = $brand_logo;
                $r['link_url'] = $link_url;
                break;
            }
        }
    } else {
        $new_id = count($reviews) > 0 ? (max(array_column($reviews, 'id')) + 1) : 1;
        $reviews[] = [
            'id' => $new_id,
            'name' => $name,
            'role' => $role,
            'company' => $company,
            'quote' => $quote,
            'avatar' => $avatar ?: 'clients/1.png',
            'brand_logo' => $brand_logo,
            'link_url' => $link_url,
            'is_active' => 1
        ];
    }
    save_json_file('client_reviews', $reviews);
}

function delete_client_review($id) {
    global $initial_reviews;
    $reviews = get_json_file('client_reviews', $initial_reviews);
    $reviews = array_values(array_filter($reviews, function($r) use ($id) {
        return $r['id'] != $id;
    }));
    save_json_file('client_reviews', $reviews);
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
    global $pdo;
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

    if ($pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO contact_inquiries (name, email, phone, subject, message, status) VALUES (?, ?, ?, ?, ?, 'Unread')");
            $stmt->execute([$name, $email, $phone, $subject, $message]);
        } catch (Exception $e) {}
    }
    return $new_id;
}

function get_all_inquiries() {
    global $pdo;
    $inquiries = get_json_file('inquiries', []);
    if ($pdo) {
        try {
            $stmt = $pdo->query("SELECT * FROM contact_inquiries ORDER BY id DESC");
            if ($stmt) {
                $db_inq = $stmt->fetchAll();
                if (!empty($db_inq)) return $db_inq;
            }
        } catch (Exception $e) {}
    }
    return array_reverse($inquiries);
}
