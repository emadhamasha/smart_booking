<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

require_once 'db.php';

$pdo = getPDOConnection();

try {
    $stmt = $pdo->query("SELECT name, email, phone, datetime FROM appointments ORDER BY datetime DESC");
    $appointments = $stmt->fetchAll();
} catch (PDOException $e) {
    die("فشل في جلب بيانات المواعيد: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <title>بيانات المواعيد المحجوزة</title>
    <link rel="stylesheet" href="style.css" />
    <script>
        function fetchAppointments() {
            fetch('fetch_appointments.php')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('appointments-tbody');
                    tbody.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(appointment => {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                                <td>${appointment.name}</td>
                                <td>${appointment.email}</td>
                                <td>${appointment.phone}</td>
                                <td>${appointment.datetime}</td>
                            `;
                            tbody.appendChild(tr);
                        });
                    } else {
                        tbody.innerHTML = '<tr><td colspan="4" style="text-align:center;">لا توجد مواعيد محجوزة حالياً.</td></tr>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching appointments:', error);
                });
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchAppointments();
            setInterval(fetchAppointments, 50000); // تحديث كل 5 ثواني
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>بيانات المواعيد المحجوزة</h1>
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>رقم الهاتف</th>
                        <th>التاريخ والوقت</th>
                    </tr>
                </thead>
                <tbody id="appointments-tbody">
                    <tr><td colspan="4" style="text-align:center;">جارٍ تحميل البيانات...</td></tr>
                </tbody>
            </table>
        </div>
        <p>
            <a href="index.php">العودة للرئيسية</a> |
            <a href="logout.php">تسجيل الخروج</a>
        </p>
    </div>
</body>
</html>
