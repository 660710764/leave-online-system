<?php
    include("process/process-history.php");

    $history = $GLOBALS['history_data'];
    $leave_usage = $GLOBALS['leave_usage_data'];
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ประวัติการลา</title>
    <link rel="stylesheet" href="style/history.css">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
                <i class="fas fa-calendar-check"></i>
                <span>ระบบการลา</span>
            </div>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span>หน้าหลัก</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="form.php" class="nav-link">
                        <i class="fas fa-plus-circle"></i>
                        <span>ยื่นการลา</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="history.php" class="nav-link">
                        <i class="fas fa-history"></i>
                        <span>ประวัติการลา</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="profile.php" class="nav-link">
                        <i class="fas fa-user-circle"></i>
                        <span>ข้อมูลส่วนตัว</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="process/process-logout.php" class="nav-link logout-btn" onclick="return confirm('คุณต้องการออกจากระบบใช่หรือไม่?')">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>ออกจากระบบ</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <h2>ประวัติการลา</h2>

    <div class="history-section-title">รายการประวัติการลา</div>
    
    <div class="history-table-container">
        <table>
            <thead>
                <tr>
                    <th>ประเภทการลา</th>
                    <th>วันที่เริ่ม</th>
                    <th>วันที่สิ้นสุด</th>
                    <th>จำนวนวัน</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($history)): ?>
                    <?php foreach ($history as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['type_name']) ?></td>
                            <td><?= htmlspecialchars($row['start_date']) ?></td>
                            <td><?= htmlspecialchars($row['end_date']) ?></td>
                            <td><?= $row['total_days'] ?> วัน</td>
                            <td>
                                <?php
                                    $status = $row['status'];
                                    $statusClass = '';

                                    $status = trim($status);
                                    
                                    if ($status === 'รออนุมัติ' || $status === 'pending') {
                                        $statusClass = 'status-pending';
                                    } elseif ($status === 'ไม่อนุมัติ' || $status === 'reject') {
                                        $statusClass = 'status-rejected';
                                    } elseif ($status === 'อนุมัติ' || $status === 'approved') {
                                        $statusClass = 'status-approved';
                                    }
                                ?>
                                <span class="status-badge <?= $statusClass ?>">
                                    <?= htmlspecialchars($status) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="no-data-row">ไม่มีข้อมูลการลา</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>