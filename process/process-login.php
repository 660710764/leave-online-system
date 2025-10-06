<?php 
    session_start();
    include('../db.php');

    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    if (!empty($username) && !empty($password)) {
        $query = mysqli_query($connect, "
        SELECT e.*, d.department_name
        FROM employees e
        LEFT JOIN departments d ON e.department_id = d.department_id
        WHERE e.first_name = '{$username}'");

        $row = mysqli_num_rows($query);

        if ($row == 1) {
            $user = mysqli_fetch_assoc($query);

            if($password == $user['password']) {
                $_SESSION['logincheck'] = true;
                $_SESSION['id'] = $user['employee_id'];
                $_SESSION['username'] = $user['first_name'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['last_name'] = $user['last_name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['addres'] = $user['addres'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['department'] = $user['department_name'];
;

                if($_SESSION['role'] == 'บุคลากร'){
                    header('location: ../index.php');
                    exit();
                } else if ($_SESSION['role'] == "หัวหน้าหมวด"){
                    header('location: ../dashboard.php');
                    exit();
                }
            } else {
                $_SESSION['message'] = "รหัสผ่านไม่ถูกต้อง";
                header('location: ../login.php');
                exit();
            }
        } else {
            $_SESSION['message'] = "ไม่พบผู้ใช้";
            header('location: ../login.php');
            exit();
        }
    } else {
        $_SESSION['message'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
        header('location: ../login.php');
        exit();
    }
?>