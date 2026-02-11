<?php
declare(strict_types=1);
namespace App\Controllers\Admin;
use App\Core\Uploader;
use App\Core\View;
use App\Repositories\SettingsRepository;
final class SettingsController extends BaseAdminController{
  public function index(): string{
    $this->start(); $this->guardAdmin();
    $s=SettingsRepository::all();
    return View::render('admin/settings',['title'=>'Settings','s'=>$s],'admin/layout');
  }
  public function save(): string{
    $this->start(); $this->guardAdmin(); csrf_verify();
    $s=SettingsRepository::all();
    $kv=[
      'site_name'=>trim((string)($_POST['site_name']??'devshayan')),
      'hero_name'=>trim((string)($_POST['hero_name']??'')),
      'hero_headline'=>trim((string)($_POST['hero_headline']??'')),
      'hero_summary'=>trim((string)($_POST['hero_summary']??'')),
      'availability_text'=>trim((string)($_POST['availability_text']??'')),
      'footer_text'=>trim((string)($_POST['footer_text']??'')),
      'contact_email'=>trim((string)($_POST['contact_email']??'')),
      'contact_phone'=>trim((string)($_POST['contact_phone']??'')),
      'contact_github'=>trim((string)($_POST['contact_github']??'')),
      'contact_linkedin'=>trim((string)($_POST['contact_linkedin']??'')),
      'contact_website'=>trim((string)($_POST['contact_website']??'')),
    ];
    // آپلودها
    $logo=Uploader::save($_FILES['logo']??[],['png'],2*1024*1024,'logo');
    if($logo){ Uploader::deleteIfLocal($s['logo_path']??null); $kv['logo_path']=$logo; }
    $profile=Uploader::save($_FILES['profile_image']??[],['png','jpg','jpeg','webp'],3*1024*1024,'profile');
    if($profile){ Uploader::deleteIfLocal($s['profile_image_path']??null); $kv['profile_image_path']=$profile; }
    $resume=Uploader::save($_FILES['resume_pdf']??[],['pdf'],10*1024*1024,'resume');
    if($resume){ Uploader::deleteIfLocal($s['resume_path']??null); $kv['resume_path']=$resume; }
    SettingsRepository::setMany($kv);
    redirect('/admin/settings');
  }
}
