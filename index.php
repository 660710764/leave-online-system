<?php 
    session_start();
    include('db.php');
    include('process/process-index.php');

    if (empty($_SESSION['logincheck']) || $_SESSION['role'] != "Employee") {
        header('Location: login.php');
        exit();
    }

    $leave_balance = getLeaveBalance($connect, $_SESSION['id']);
    $leave_summary = getLeaveRequestSummary($connect, $_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบลางาน</title>
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/leave.css">
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
    <div class="welcome-container">
        <h1 class="welcome-text"><?php echo "สวัสดีคุณ ". $_SESSION['first_name'] . " " . $_SESSION['last_name'] . " 🙏"; ?></h1>
    </div>
    <div class="dashboard-container">

    <!-- วันลาคงเหลือ -->
    <div class="leave-balance-container">
        <h2 class="leave-balance-title">วันลาคงเหลือ</h2>
        <div class="leave-balance-grid">
            <?php foreach ($leave_balance as $type => $remain): ?>
                <div class="leave-balance-item">
                    <div class="leave-type"><?php echo $type; ?></div>
                    <div class="leave-days">
                        <?php echo $remain; ?>
                        <span class="leave-days-unit">วัน</span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <!-- สรุปสถานะการลา -->
    <div class="leave-summary-section">
        <h2 class="leave-summary-title">สรุปสถานะการลา</h2>
        <div class="leave-summary-container">
            <div class="leave-summary-item pending">
                <div class="summary-header">
                    <div class="summary-icon">⏳</div>
                    <div class="summary-type">รออนุมัติ</div>
                </div>
                <div class="summary-total"><?php echo $leave_summary['รออนุมัติ']; ?><span class="summary-label">รายการ</span></div>
            </div>
            
            <div class="leave-summary-item approved">
                <div class="summary-header">
                    <div class="summary-icon">✅</div>
                    <div class="summary-type">อนุมัติแล้ว</div>
                </div>
                <div class="summary-total"><?php echo $leave_summary['อนุมัติ']; ?><span class="summary-label">รายการ</span></div>
            </div>
            
            <div class="leave-summary-item rejected">
                <div class="summary-header">
                    <div class="summary-icon">❌</div>
                    <div class="summary-type">ไม่อนุมัติ</div>
                </div>
                <div class="summary-total"><?php echo $leave_summary['ไม่อนุมัติ']; ?><span class="summary-label">รายการ</span></div>
            </div>
        </div>
    </div>
    </div>

    <div class="action-buttons-container">
        <a href="form.php" class="action-button-link">
            <button class="action-button primary">
                <i class="fas fa-plus-circle"></i>
                ยื่นการลา
            </button>
        </a>
        <a href="history.php" class="action-button-link">
            <button class="action-button secondary">
                <i class="fas fa-history"></i>
                ดูประวัติการลา
            </button>
        </a>
    </div>

</body>
</html>