<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Core\View;
use App\Repositories\BlogRepository;
use App\Repositories\SettingsRepository;
final class BlogController{
  public function index(): string{
    $settings=SettingsRepository::all();
    $posts=BlogRepository::listPublic();
    return View::render('blog/index',['title'=>($settings['site_name']??'devshayan').' | Blog','settings'=>$settings,'posts'=>$posts],'layout');
  }
  public function show(string $slug): string{
    $settings=SettingsRepository::all();
    $post=BlogRepository::findPublicBySlug($slug);
    if(!$post){ http_response_code(404); return View::render('blog/404',['title'=>'404','settings'=>$settings],'layout'); }
    return View::render('blog/show',['title'=>(string)$post['title'],'settings'=>$settings,'post'=>$post],'layout');
  }
}
