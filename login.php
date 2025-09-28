<?php 
    session_start();
    include('db.php');
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <link rel="stylesheet" href="style/login.css">
</head>
<body>
    <div class="login-container">
        <h1>เข้าสู่ระบบ</h1>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="error-message"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
        <?php endif; ?>
        
        <form action="process/process-login.php" method="POST">
            <div class="form-group">
                <label for="username">ชื่อผู้ใช้งาน</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">รหัสผ่าน</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" name="login_user" class="btn-login">เข้าสู่ระบบ</button>
        </form>
    </div>
</body>
</html>