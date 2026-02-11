<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Core\View;
use App\Repositories\SettingsRepository;
final class HomeController{
  public function index(): string{
    $settings=SettingsRepository::all();
    // داده‌های رزومه (مرحله ۳ کامل CRUD می‌کنیم)
    $data=[
      'name'=>$settings['hero_name']??'Shayan Namayandeh',
      'headline'=>$settings['hero_headline']??'PHP / WordPress / Front-End Developer',
      'summary'=>$settings['hero_summary']??'',
      'availability'=>$settings['availability_text']??'Available for projects',
      'profile_image'=>$settings['profile_image_path']??'https://placehold.co/400x400',
      'resume'=>$settings['resume_path']??null,
      'contacts'=>[
        ['label'=>'Email','value'=>$settings['contact_email']??'','href'=>'mailto:'.($settings['contact_email']??'')],
        ['label'=>'Phone','value'=>$settings['contact_phone']??'','href'=>'tel:'.($settings['contact_phone']??'')],
        ['label'=>'Website','value'=>$settings['contact_website']??'','href'=>$settings['contact_website']??'#'],
        ['label'=>'GitHub','value'=>'','href'=>$settings['contact_github']??'#'],
        ['label'=>'LinkedIn','value'=>'','href'=>$settings['contact_linkedin']??'#'],
      ],
      'skillBars'=>[
        ['title'=>'WordPress (Theme/Plugin)','value'=>95],
        ['title'=>'PHP & MySQL','value'=>85],
        ['title'=>'JavaScript (ES6+)','value'=>85],
        ['title'=>'HTML/CSS','value'=>95],
        ['title'=>'Git','value'=>90],
        ['title'=>'REST API','value'=>85],
        ['title'=>'Flutter','value'=>70],
        ['title'=>'Performance Optimization','value'=>80],
      ],
      'stacks'=>[
        'Backend'=>['PHP','MySQL','REST API','OOP','MVC','Security'],
        'Frontend'=>['HTML','CSS','JavaScript (ES6+)','jQuery','Bootstrap','Performance'],
        'WordPress'=>['Theme Dev','Plugin Dev','WooCommerce','Security','Elementor'],
        'Mobile'=>['Flutter'],
        'Tools'=>['Git','Figma','Adobe XD','Altium Designer','Arduino'],
      ],
      'projects'=>[
        ['title'=>'Doroos Amooz','stack'=>'WordPress + Elementor','desc'=>'Educational platform','href'=>$settings['contact_website']??'#'],
        ['title'=>'IranCredits','stack'=>'PHP + JavaScript','desc'=>'Gift cards & international payments','href'=>'https://irancredits.com'],
        ['title'=>'Saba Exchange','stack'=>'PHP + JavaScript','desc'=>'Live prices dashboard','href'=>'https://saba-exchange.com'],
        ['title'=>'Amut App','stack'=>'PHP + JavaScript','desc'=>'Online waybill system','href'=>'https://amutapp.ir'],
      ]
    ];
    return View::render('home',['title'=>($settings['site_name']??'devshayan').' | Home','settings'=>$settings,'data'=>$data],'layout');
  }
}
