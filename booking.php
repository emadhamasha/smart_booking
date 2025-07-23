<?php
session_start();
require_once 'db.php';

$pdo = getPDOConnection(); // استدعاء دالة الاتصال بقاعدة البيانات

$lang = $_SESSION['lang'] ?? 'en';

function t($en, $ar) {
    global $lang;
    return $lang === 'ar' ? $ar : $en;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $datetime = trim($_POST['datetime'] ?? '');

    // تحقق من صحة التاريخ والوقت (اليوم التالي وما بعده، من 9 صباحًا حتى 8 مساءً)
    $selectedDateTime = DateTime::createFromFormat('Y-m-d\TH:i', $datetime);
    $now = new DateTime();
    $minDateTime = (clone $now)->modify('+1 day')->setTime(9, 0);
    $maxDateTime = (clone $now)->modify('+1 day')->setTime(20, 0);

    if (!$selectedDateTime || $selectedDateTime < $minDateTime || $selectedDateTime > $maxDateTime) {
        $message = t('Please select a date and time from tomorrow between 9 AM and 8 PM.', 'يرجى اختيار تاريخ ووقت من اليوم التالي بين الساعة 9 صباحًا و 8 مساءً.');
    } elseif ($name && $email && $phone && $datetime) {
        $stmt = $pdo->prepare("INSERT INTO appointments (name, email, phone, datetime) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$name, $email, $phone, $datetime])) {
            $message = t('Appointment booked successfully!', 'تم حجز الموعد بنجاح!');
        } else {
            $message = t('Failed to book appointment.', 'فشل في حجز الموعد.');
        }
    } else {
        $message = t('Please fill all fields.', 'يرجى ملء جميع الحقول.');
    }
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang === 'ar' ? 'ar' : 'en'; ?>" dir="<?php echo $lang === 'ar' ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8" />
    <title><?php echo t('Book Appointment', 'حجز موعد'); ?></title>
    <link rel="stylesheet" href="style.css" />
    <script>
        function setDateTimeConstraints() {
            const datetimeInput = document.getElementById('datetime');
            const now = new Date();
            // Set min to tomorrow 09:00
            const minDate = new Date(now.getFullYear(), now.getMonth(), now.getDate() + 1, 9, 0, 0);
            // Set max to tomorrow 20:00 (8 PM)
            const maxDate = new Date(now.getFullYear(), now.getMonth(), now.getDate() + 1, 20, 0, 0);

            function toDatetimeLocal(date) {
                const pad = (num) => num.toString().padStart(2, '0');
                return date.getFullYear() + '-' +
                    pad(date.getMonth() + 1) + '-' +
                    pad(date.getDate()) + 'T' +
                    pad(date.getHours()) + ':' +
                    pad(date.getMinutes());
            }

            datetimeInput.min = toDatetimeLocal(minDate);
            datetimeInput.max = toDatetimeLocal(maxDate);
        }

        function validateForm(event) {
            const datetimeInput = document.getElementById('datetime');
            const selected = new Date(datetimeInput.value);
            const now = new Date();
            const minDate = new Date(now.getFullYear(), now.getMonth(), now.getDate() + 1, 9, 0, 0);
            const maxDate = new Date(now.getFullYear(), now.getMonth(), now.getDate() + 1, 20, 0, 0);

            if (selected < minDate || selected > maxDate) {
                alert('يرجى اختيار موعد بين الساعة 9 صباحًا و 8 مساءً من اليوم التالي وما بعده.');
                event.preventDefault();
                return false;
            }
            return true;
        }

        document.addEventListener('DOMContentLoaded', () => {
            setDateTimeConstraints();
            const form = document.querySelector('form');
            form.addEventListener('submit', validateForm);
        });
    </script>
</head>
<body>
    <div class="container">
        <h1><?php echo t('Book Your Appointment', 'احجز موعدك'); ?></h1>
        <?php if ($message): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form method="POST" action="booking.php">
            <label for="name"><?php echo t('Name', 'الاسم'); ?>:</label>
            <input type="text" id="name" name="name" required />

            <label for="email"><?php echo t('Email', 'البريد الإلكتروني'); ?>:</label>
            <input type="email" id="email" name="email" required />

            <label for="phone"><?php echo t('Phone', 'رقم الهاتف'); ?>:</label>
            <input type="tel" id="phone" name="phone" required />

            <label for="datetime"><?php echo t('Date and Time', 'التاريخ والوقت'); ?>:</label>
            <input type="datetime-local" id="datetime" name="datetime" required />

            <button type="submit"><?php echo t('Book Now', 'احجز الآن'); ?></button>
        </form>
        <p><a href="index.php"><?php echo t('Back to Home', 'العودة للرئيسية'); ?></a></p>
    </div>
</body>
</html>
