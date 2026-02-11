<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;

final class HomeController
{
    public function index(): string
    {
        // داده‌ها بر اساس رزومه (بعدا:contentReference[oaicite:8]{index=8}
        $data = [
            'site' => 'devshayan',
            'name' => 'Shayan Namayandeh',
            'headline' => 'توسعه‌دهنده PHP و وردپرس | طراح فرانت‌اند',
            'summary' => 'توسعه‌دهنده ارشد PHP و وردپرس با بیش از ۴ سال تجربه در طراحی و پیاده‌سازی وب‌سایت‌های فروشگاهی، آموزشی، شرکتی و چندفروشندگی. متخصص در توسعه فرانت‌اند با تمرکز بر UX و بهینه‌سازی عملکرد.',
            'quick' => [
                ['label' => 'تجربه', 'value' => '+۴ سال'],
                ['label' => 'حوزه', 'value' => 'PHP/WordPress/Frontend'],
                ['label' => 'شهر', 'value' => 'تهران'],
            ],
            'contacts' => [
                ['label' => 'Email', 'value' => 'namayandeshayan@gmail.com', 'href' => 'mailto:namayandeshayan@gmail.com'],
                ['label' => 'Phone', 'value' => '+989351794610', 'href' => 'tel:+989351794610'],
                ['label' => 'Website', 'value' => 'doroosamooz.ir', 'href' => 'https://doroosamooz.ir'],
                ['label' => 'GitHub', 'value' => 'roseshayan', 'href' => 'https://github.com/roseshayan'],
                ['label' => 'LinkedIn', 'value' => 'shayan-namayandeh', 'href' => 'https://www.linkedin.com/in/shayan-namayandeh'],
                ['label' => 'Telegram', 'value' => 'SudoShayanNA', 'href' => 'https://t.me/SudoShayanNA'],
                ['label' => 'Instagram', 'value' => 'shayan.namayandeh', 'href' => 'https://instagram.com/shayan.namayandeh'],
            ],
            'skills' => [
                'Backend' => ['PHP', 'MySQL', 'REST API', 'OOP', 'MVC'],
                'Frontend' => ['HTML', 'CSS', 'JavaScript (ES6+)', 'jQuery', 'Bootstrap', 'Performance'],
                'WordPress' => ['Theme Development', 'Plugin Development', 'WooCommerce', 'Wordpress Security', 'Elementor'],
                'Mobile' => ['Flutter'],
                'Tools' => ['Git', 'Figma', 'Adobe XD', 'Altium Designer', 'Arduino'],
            ],
            'skillBars' => [
                ['title' => 'PHP & MySQL', 'value' => 85],
                ['title' => 'WordPress (Theme/Plugin)', 'value' => 95],
                ['title' => 'JavaScript (ES6+)', 'value' => 85],
                ['title' => 'HTML/CSS', 'value' => 95],
                ['title' => 'Git', 'value' => 90],
                ['title' => 'REST API', 'value' => 85],
                ['title' => 'Flutter', 'value' => 70],
                ['title' => 'Performance Optimization', 'value' => 80],
            ],
            'experience' => [
                [
                    'period' => 'مهر ۱۴۰۳ - اکنون',
                    'company' => 'شرکت دارا اعتماد ایرانیان',
                    'location' => 'تهران (پروژه‌ای/دورکاری)',
                    'items' => [
                        'طراحی و برنامه‌نویسی وب‌سایت ایران کردیت (مشابه ایرانی‌کارت) با PHP و JavaScript',
                        'طراحی وب‌سایت صرافی حافظ (کانادا) با وردپرس',
                        'طراحی و برنامه‌نویسی وب‌سایت صرافی صبا (ترکیه)',
                        'پشتیبانی وب‌سایت‌های شرکت',
                    ],
                ],
                [
                    'period' => 'مرداد ۱۴۰۲ - اکنون',
                    'company' => 'شرکت حمل و نقل آموت بار',
                    'location' => 'تهران',
                    'items' => [
                        'طراحی و برنامه‌نویسی سیستم صدور بارنامه آنلاین',
                        'پشتیبانی و بهینه‌سازی وب‌سایت شرکت',
                        'طراحی و برنامه‌نویسی اپلیکیشن آموت بار با Flutter و PHP (مشابه ترابرنت)',
                    ],
                ],
                [
                    'period' => 'مرداد ۱۴۰۲ - اردیبهشت ۱۴۰۳',
                    'company' => 'کارنیل وب',
                    'location' => 'تهران',
                    'items' => [
                        'توسعه وب‌سایت‌های وردپرسی با قابلیت‌های سفارشی',
                        'بهینه‌سازی سرعت لود صفحات تا +۸۰٪',
                    ],
                ],
                [
                    'period' => 'اردیبهشت ۱۴۰۱ - اسفند ۱۴۰۱',
                    'company' => 'آرمانیک',
                    'location' => 'تهران',
                    'items' => [
                        'برنامه‌نویسی قالب و افزونه‌های اختصاصی وردپرس',
                        'توسعه وب‌سایت‌های شرکتی و فروشگاهی',
                    ],
                ],
            ],
            'projects' => [
                ['title' => 'دروس آموز', 'stack' => 'WordPress + Elementor', 'desc' => 'وب‌سایت ارائه دوره‌های آموزشی', 'href' => 'https://doroosamooz.ir'],
                ['title' => 'IranCredits', 'stack' => 'PHP + JavaScript', 'desc' => 'فروش گیفت‌کارت و پرداخت بین‌المللی (مشابه ایرانی‌کارت)', 'href' => 'https://irancredits.com'],
                ['title' => 'Saba Exchange', 'stack' => 'PHP + JavaScript', 'desc' => 'نمایش لحظه‌ای قیمت‌ها (طلا/دلار/یورو و...)', 'href' => 'https://saba-exchange.com'],
                ['title' => 'Amut App', 'stack' => 'PHP + JavaScript', 'desc' => 'سیستم صدور بارنامه آنلاین', 'href' => 'https://amutapp.ir'],
                ['title' => 'Sarafy Hafez', 'stack' => 'WordPress + Elementor', 'desc' => 'سایت شرکتی صرافی حافظ (کانادا)', 'href' => 'https://sarafyhafez.ca'],
            ],
            'education' => [
                ['period' => 'مهر ۱۳۹۹ - بهمن ۱۴۰۴', 'title' => 'کارشناسی مهندسی برق (الکترونیک)', 'place' => 'دانشگاه سمنان', 'meta' => 'معدل: ۱۴'],
                ['period' => 'مهر ۱۳۹۶ - خرداد ۱۳۹۹', 'title' => 'دیپلم برق (الکترونیک)', 'place' => 'هنرستان نمونه دولتی دکتر اکبریه (تبریز)', 'meta' => 'معدل: ۱۸.۵۷'],
            ],
            'teaching' => [
                'مدرس دوره طراحی وب (HTML/CSS)',
                'مدرس دوره PHP و MySQL',
                'مربی دوره‌های ICDL و طراحی وب (jQuery/Bootstrap/JS)',
                'آزمونگر رسمی دوره توسعه‌دهنده وب با PHP (سازمان فنی و حرفه‌ای)',
            ],
        ];
        return View::render('home', ['data' => $data, 'title' => 'devshayan | ' . $data['name']]);
    }
}
