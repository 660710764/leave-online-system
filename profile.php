<?php 
    session_start();
    
    if (empty($_SESSION['logincheck']) || $_SESSION['role'] != "Employee") {
        header('Location: login.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลส่วนตัว - ระบบการลา</title>
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/profile.css">
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
                <li class="nav-item active">
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

    <main class="main-content">
        <div class="profile-container">
            <div class="profile-header">
                <div class="profile-avatar">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h1>ข้อมูลส่วนตัว</h1>
                <h2><?php echo ($_SESSION['first_name'] . " " . $_SESSION['last_name']); ?></h2>
            </div>
            
            <div class="profile-content">
                <div class="profile-section">
                    <div class="profile-item">
                        <div class="profile-label">
                            <i class="fas fa-id-badge"></i>
                            <span>รหัสพนักงาน</span>
                        </div>
                        <div class="profile-value">
                            <?php echo ($_SESSION['id']); ?>
                        </div>
                    </div>
                    
                    <div class="profile-item">
                        <div class="profile-label">
                            <i class="fas fa-envelope"></i>
                            <span>Email</span>
                        </div>
                        <div class="profile-value">
                            <?php echo ($_SESSION['email']); ?>
                        </div>
                    </div>
                    
                    <div class="profile-item">
                        <div class="profile-label">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>ที่อยู่</span>
                        </div>
                        <div class="profile-value">
                            <?php echo ($_SESSION['addres']); ?>
                        </div>
                    </div>
                    
                    <div class="profile-item">
                        <div class="profile-label">
                            <i class="fas fa-building"></i>
                            <span>แผนก</span>
                        </div>
                        <div class="profile-value">
                            <?php echo ($_SESSION['department']); ?>
                        </div>
                    </div>
                    
                    <div class="profile-item">
                        <div class="profile-label">
                            <i class="fas fa-user-tag"></i>
                            <span>ตำแหน่ง</span>
                        </div>
                        <div class="profile-value">
                            <?php echo ($_SESSION['role']); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>