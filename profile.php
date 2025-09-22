<?php 
    session_start();
    
    if (empty($_SESSION['logincheck']) || $_SESSION['role'] != "Employee") {
        header('Location: login.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="profile.css">
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
                <a href="apply-leave.php" class="nav-link">
                    <i class="fas fa-plus-circle"></i>
                    <span>ยื่นการลา</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="leave-history.php" class="nav-link">
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
                <a href="process-logout.php" class="nav-link logout-btn" onclick="return confirm('คุณต้องการออกจากระบบใช่หรือไม่?')">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>ออกจากระบบ</span>
                </a>
            </li>
            </ul>
        </div>
    </nav>

    <div class="profile-container">
        <h1>ข้อมูลส่วนตัว</h1>
        <h2> <?php echo $_SESSION['first_name'] . " ". $_SESSION['last_name'] ?></h2>
        <h3><strong>รหัสพนักงาน : </strong><span style="color:#555;"><?php echo $_SESSION['id'] ?></span></h3> <hr>
        <h3><strong>Email : </strong><span style="color:#555;"><?php echo $_SESSION['email'] ?></span></h3> <hr>
        <h3><strong>ที่อยู่ : </strong><span style="color:#555;"><?php echo $_SESSION['addres'] ?></span></h3> <hr>
        <h3><strong>แผนก : </strong><span style="color:#555;"><?php echo $_SESSION['id'] ?></span></h3> <hr>
        <h3><strong>ต่ำแหน่ง : </strong><span style="color:#555;"><?php echo $_SESSION['id'] ?></span></h3>
    </div>
</body>
</html>