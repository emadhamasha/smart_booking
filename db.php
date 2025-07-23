<?php
/**
 * ملف الاتصال بقاعدة البيانات باستخدام PDO
 * تم تحسينه ليكون دالة قابلة لإعادة الاستخدام مع معالجة أخطاء محسنة
 */

function getPDOConnection() {
    $host = 'localhost';       // اسم المضيف لقاعدة البيانات
    $db   = 'smart_booking';   // اسم قاعدة البيانات
    $user = 'root';            // اسم المستخدم لقاعدة البيانات
    $pass = '';                // كلمة المرور (فارغة في الإعداد الافتراضي لـ XAMPP)
    $charset = 'utf8mb4';      // الترميز المستخدم

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        return $pdo;
    } catch (PDOException $e) {
        // عرض رسالة خطأ واضحة مع إيقاف تنفيذ السكربت
        die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
    }
}
?>
