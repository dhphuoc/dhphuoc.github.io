<?php
define('API_KEY', 'DHP07-TDS');
$last_key = API_KEY;
function isAuthorized($key) {
    return $key === API_KEY;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $key = isset($_POST['key']) ? $_POST['key'] : '';
    if ($key !== $last_key) {
        http_response_code(403);
        $dulieu = [
            "status" => 'close',
            "msg" => 'Máy chủ đã được đóng do admin đang nâng cấp tool',
        ];
        echo json_encode($dulieu, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }
    if (!isAuthorized($key)) {
        http_response_code(403);
        $dulieu = [
            "status" => 'error',
            "msg" => 'Không được phép truy cập máy chủ',
        ];
        echo json_encode($dulieu, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    if ($action === 'open') {
        $dulieu = [
            "status" => 'success',
            "msg" => 'Máy chủ tds đã được mở, bạn có thể chạy tool sau 5s',
        ];
        echo json_encode($dulieu, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } elseif ($action === 'close') {
        $dulieu = [
            "status" => 'error',
            "msg" => 'Máy chủ đã đóng, admin đang nấp cấp tool',
        ];
        echo json_encode($dulieu, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } else {
        $dulieu = [
            "status" => 'error',
            "msg" => 'Hành động khả nghi',
        ];
        echo json_encode($dulieu, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
} else {
    $dulieu = [
        "status" => 'error',
        "msg" => 'bug gì đấy bạn trẻ ơi',
    ];
    echo json_encode($dulieu, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
?>