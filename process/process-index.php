<?php
function getLeaveBalance($connect, $employee_id) {
    $leave_limits = [
        'ลาป่วย'   => 30,
        'ลาพักร้อน' => 15,
        'ลากิจ'     => 5
    ];

    $sql = "
        SELECT lt.type_name, SUM(DATEDIFF(lr.end_date, lr.start_date) + 1) as used_days
        FROM Leave_Requests lr
        JOIN Leave_Types lt ON lr.leave_type_id = lt.leave_type_id
        WHERE lr.employee_id = ? AND lr.status = 'อนุมัติ'
        GROUP BY lt.type_name
    ";

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $leave_used = [];
    while ($row = $result->fetch_assoc()) {
        $leave_used[$row['type_name']] = $row['used_days'];
    }

    $leave_balance = [];
    foreach ($leave_limits as $type => $limit) {
        $used = isset($leave_used[$type]) ? $leave_used[$type] : 0;
        $remain = $limit - $used;
        if ($remain < 0) $remain = 0;

        $leave_balance[$type] = $remain;
    }

    return $leave_balance;
}

function getLeaveRequestSummary($connect, $employee_id) {
    $sql = "
        SELECT status, COUNT(*) as total
        FROM Leave_Requests
        WHERE employee_id = ?
        GROUP BY status
    ";

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $summary = [
        'รออนุมัติ'  => 0,
        'อนุมัติ' => 0,
        'ไม่อนุมัติ'   => 0
    ];

    while ($row = $result->fetch_assoc()) {
        $summary[$row['status']] = $row['total'];
    }

    return $summary;
}
?>