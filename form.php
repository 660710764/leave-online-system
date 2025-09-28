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
</head>
<body>
    <div>
        <form action="">
            <div>
                <div>
                    <label for="type">ประเภทการลา</label>
                    <select name="type-leave" id="type-leave">
                        <option value="ลาป่วย">ลาป่วย</option>
                        <option value="ลากิจ">ลากิจ</option>
                        <option value="ลาพักร้อน">ลาพักร้อน</option>
                    </select>
                </div>
                <div>
                    <label for="reason">วันที่เริ่มลา</label>
                    <input type="date" name="start-date" id="start-date">

                    <label for="reason">วันที่สิ้นสุดการลา</label>
                    <input type="date" name="start-date" id="start-date">
                </div>
                <div>
                    <label for="reason">เหตุผลการลา</label>
                    <input type="text" name="reason" id="reason">

                    <label for="contact">ข้อมูลการติดต่อระหว่างลา</label>
                    <input type="text" name="contact" id="contact">

                    <label for="file">แนบเอกสาร (ไฟล์ JPG, JPEG, PNG หรือ PDF ขนาดไม่เกิน 5 MB)</label>
                    <input type="file" name="file" id="file">
                </div>
            </div>
        </form>
    </div>
</body>
</html>