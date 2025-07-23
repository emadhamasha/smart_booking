<?php
session_start();
$lang = $_SESSION['lang'] ?? 'en';

function t($en, $ar) {
    global $lang;
    return $lang === 'ar' ? $ar : $en;
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang === 'ar' ? 'ar' : 'en'; ?>" dir="<?php echo $lang === 'ar' ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8" />
    <title><?php echo t('Welcome to Smart Booking', 'مرحباً بكم في الحجز الذكي'); ?></title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="container">
        <h1><?php echo t('Welcome to Smart Booking System', 'مرحباً بكم في نظام الحجز الذكي'); ?></h1>
        <p><?php echo t('Book your appointments easily and get email reminders.', 'احجز مواعيدك بسهولة واحصل على تذكيرات عبر البريد الإلكتروني.'); ?></p>
        <a href="booking.php" class="button"><?php echo t('Book Now', 'احجز الآن'); ?></a>
        <a href="admin_appointments.php" class="button" style="margin-left: 10px;"><?php echo t('View Appointments (Admin)', 'عرض المواعيد (للمشرف)'); ?></a>
    </div>
</body>
</html>
