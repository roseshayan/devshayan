<?php
declare(strict_types=1);
require dirname(__DIR__).'/vendor/autoload.php';
$dotenv=Dotenv\Dotenv::createImmutable(dirname(__DIR__));
if(is_file(dirname(__DIR__).'/.env')) $dotenv->load();
use App\Core\Database;
$pdo=Database::pdo();
$adminEmail=$_ENV['ADMIN_EMAIL']??'admin@devshayan.local';
$adminPass=$_ENV['ADMIN_PASSWORD']??'admin1234';
$editorEmail=$_ENV['EDITOR_EMAIL']??'editor@devshayan.local';
$editorPass=$_ENV['EDITOR_PASSWORD']??'editor1234';
$upsertUser=function(string $name,string $email,string $pass,string $role) use($pdo){
  $st=$pdo->prepare("SELECT id FROM users WHERE email=? LIMIT 1"); $st->execute([$email]);
  if($st->fetch()) return;
  $hash=password_hash($pass,PASSWORD_DEFAULT);
  $st=$pdo->prepare("INSERT INTO users(name,email,password_hash,role) VALUES(?,?,?,?)");
  $st->execute([$name,$email,$hash,$role]);
};
$upsertUser('Admin',$adminEmail,$adminPass,'admin');
$upsertUser('Editor',$editorEmail,$editorPass,'editor');
// تنظیمات اولیه سایت
$defaults=[
  'site_name'=>'devshayan',
  'nav_blog_label'=>'Blog',
  'hero_name'=>'Shayan Namayandeh',
  'hero_headline'=>'PHP / WordPress / Front-End Developer',
  'hero_summary'=>'Senior PHP & WordPress developer with 4+ years of experience building e-commerce, educational, corporate and multi-vendor websites. Strong focus on performance and UX.',
  'availability_text'=>'Available for projects',
  'footer_text'=>'© '.date('Y').' devshayan',
  'contact_email'=>'namayandeshayan@gmail.com',
  'contact_phone'=>'+989351794610',
  'contact_github'=>'https://github.com/roseshayan',
  'contact_linkedin'=>'https://www.linkedin.com/in/shayan-namayandeh',
  'contact_website'=>'https://doroosamooz.ir'
];
$st=$pdo->prepare("INSERT INTO settings(`key`,`value`) VALUES(?,?) ON DUPLICATE KEY UPDATE `value`=VALUES(`value`)");
foreach($defaults as $k=>$v){ $st->execute([$k,(string)$v]); }
echo "SEEDED\n";
