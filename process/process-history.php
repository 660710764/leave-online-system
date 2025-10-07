<?php
    include('./db.php');

    $employee_id = 1;

    $sql = "SELECT lr.leave_id, lt.type_name, lr.start_date, lr.end_date, 
                DATEDIFF(lr.end_date, lr.start_date) + 1 AS total_days,
                lr.status
            FROM leave_requests lr
            JOIN leave_types lt ON lr.leave_type_id = lt.leave_type_id
            WHERE lr.employee_id = ?
            ORDER BY lr.start_date DESC";

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $history = [];
    while ($row = $result->fetch_assoc()) {
        $history[] = $row;
    }

    $leave_limits = [
        'ลาป่วย' => 30,
        'ลาพักร้อน' => 15,
        'ลากิจ' => 10
    ];

    $leave_usage = [];
    foreach ($leave_limits as $type => $limit) {
        $leave_usage[$type] = [
            'used' => 0,
            'limit' => $limit
        ];
    }

    if (!empty($history)) {
        foreach ($history as $row) {
            $type_name = $row['type_name'];
            if (isset($leave_usage[$type_name]) && $row['status'] == 'approved') {
                $leave_usage[$type_name]['used'] += $row['total_days'];
            }
        }
    }

    $stmt->close();
    $connect->close();
?>