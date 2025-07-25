نظام الحجز الذكي

نظرة عامة
هذا نظام بسيط لحجز المواعيد مبني باستخدام PHP و MySQL. يتيح للمستخدمين حجز المواعيد ويوفر واجهة إدارة لعرض وإدارة هذه المواعيد.

الميزات
- نموذج حجز مواعيد سهل الاستخدام مع التحقق من صحة البيانات.
- قيود على التاريخ والوقت: الحجز مسموح فقط من اليوم التالي بين الساعة 9 صباحًا و 8 مساءً.
- نظام تسجيل دخول للمشرف لحماية بيانات المواعيد.
- صفحة المشرف لعرض المواعيد المحجوزة مع تحديث تلقائي كل 5 ثوانٍ.
- تصميم واجهة حديثة وجذابة ومتجاوبة.
- اتصال آمن بقاعدة البيانات باستخدام PDO مع معالجة الأخطاء.

هيكل المشروع
- db.php: إعداد اتصال قاعدة البيانات باستخدام PDO.
- booking.php: نموذج حجز المواعيد ومعالجتها.
- admin_appointments.php: صفحة المشرف لعرض المواعيد (تتطلب تسجيل دخول).
- fetch_appointments.php: نقطة نهاية API لجلب بيانات المواعيد لصفحة المشرف.
- login.php: صفحة تسجيل دخول المشرف.
- logout.php: سكربت تسجيل خروج المشرف.
- style.css: ملف التنسيق الخاص بالمشروع.
- index.php: الصفحة الرئيسية مع التنقل.

التثبيت والإعداد
1. قم بتثبيت XAMPP أو أي بيئة PHP + MySQL.
2. استورد ملف database.sql إلى خادم MySQL لإنشاء قاعدة البيانات والجداول المطلوبة.
3. ضع ملفات المشروع في مجلد الجذر لخادم الويب (مثل htdocs في XAMPP).
4. عدل بيانات الاتصال بقاعدة البيانات في db.php إذا لزم الأمر.
5. افتح نموذج الحجز عبر الرابط http://localhost/your_project_folder/booking.php.
6. افتح لوحة المشرف عبر الرابط http://localhost/your_project_folder/admin_appointments.php.

بيانات دخول المشرف
- اسم المستخدم: admin
- كلمة المرور: admin123

(هذه البيانات مدمجة في ملف login.php لأغراض التبسيط. في بيئة الإنتاج، يُفضل استخدام نظام إدارة مستخدمين آمن.)

الاستخدام
- يمكن للمستخدمين حجز المواعيد من خلال النموذج.
- يمكن للمشرفين تسجيل الدخول لعرض وإدارة المواعيد.
- تقوم صفحة المشرف بتحديث البيانات تلقائيًا كل 10 ثوانٍ لعرض أحدث الحجوزات.

ملاحظات
- يتم التحقق من صحة التاريخ والوقت على جانب العميل والخادم.
- يستخدم المشروع جلسات PHP لإدارة تسجيل دخول المشرف.

الترخيص
المشروع مفتوح المصدر ومجاني للاستخدام.

التواصل
لأي استفسارات أو دعم، يرجى التواصل مع مسؤول المشروع.
