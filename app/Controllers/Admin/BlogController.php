<?php
declare(strict_types=1);
namespace App\Controllers\Admin;
use App\Core\Uploader;
use App\Core\View;
use App\Repositories\BlogRepository;
final class BlogController extends BaseAdminController{
  public function index(): string{
    $this->start(); $this->guard(['admin','editor']);
    $posts=BlogRepository::listAdmin();
    return View::render('admin/blog/index',['title'=>'Blog','posts'=>$posts],'admin/layout');
  }
  public function createForm(): string{
    $this->start(); $this->guard(['admin','editor']);
    return View::render('admin/blog/form',['title'=>'New Post','post'=>null],'admin/layout');
  }
  public function store(): string{
    $this->start(); $this->guard(['admin','editor']); csrf_verify();
    $title=trim((string)($_POST['title']??''));
    $slug=trim((string)($_POST['slug']??''));
    $excerpt=trim((string)($_POST['excerpt']??''));
    $content=trim((string)($_POST['content']??''));
    $status=(string)($_POST['status']??'draft');
    $publishedAt=trim((string)($_POST['published_at']??''));
    if($title===''){ redirect('/admin/blog/create'); }
    if($slug==='') $slug=slugify($title);
    $slug=BlogRepository::uniqueSlug($slug,null);
    $cover=Uploader::save($_FILES['cover']??[],['png','jpg','jpeg','webp'],4*1024*1024,'cover');
    $id=BlogRepository::create([
      'title'=>$title,'slug'=>$slug,'excerpt'=>$excerpt,'content'=>$content,
      'cover_path'=>$cover,'status'=>in_array($status,['draft','published'],true)?$status:'draft',
      'published_at'=>$publishedAt!==''?$publishedAt:null
    ]);
    redirect('/admin/blog/edit/'.$id);
  }
  public function editForm(string $id): string{
    $this->start(); $this->guard(['admin','editor']);
    $post=BlogRepository::findById((int)$id);
    if(!$post){ http_response_code(404); return '404 | Not Found'; }
    return View::render('admin/blog/form',['title'=>'Edit Post','post'=>$post],'admin/layout');
  }
  public function update(string $id): string{
    $this->start(); $this->guard(['admin','editor']); csrf_verify();
    $pid=(int)$id;
    $post=BlogRepository::findById($pid);
    if(!$post) redirect('/admin/blog');
    $title=trim((string)($_POST['title']??''));
    $slug=trim((string)($_POST['slug']??''));
    $excerpt=trim((string)($_POST['excerpt']??''));
    $content=trim((string)($_POST['content']??''));
    $status=(string)($_POST['status']??'draft');
    $publishedAt=trim((string)($_POST['published_at']??''));
    if($title==='') $title=(string)$post['title'];
    if($slug==='') $slug=slugify($title);
    $slug=BlogRepository::uniqueSlug($slug,$pid);
    $cover=$post['cover_path']??null;
    $newCover=Uploader::save($_FILES['cover']??[],['png','jpg','jpeg','webp'],4*1024*1024,'cover');
    if($newCover){ Uploader::deleteIfLocal($cover? (string)$cover:null); $cover=$newCover; }
    BlogRepository::update($pid,[
      'title'=>$title,'slug'=>$slug,'excerpt'=>$excerpt,'content'=>$content,
      'cover_path'=>$cover,'status'=>in_array($status,['draft','published'],true)?$status:'draft',
      'published_at'=>$publishedAt!==''?$publishedAt:null
    ]);
    redirect('/admin/blog/edit/'.$pid);
  }
  public function delete(string $id): string{
    $this->start(); $this->guard(['admin','editor']); csrf_verify();
    $pid=(int)$id;
    $post=BlogRepository::findById($pid);
    if($post){ Uploader::deleteIfLocal($post['cover_path']? (string)$post['cover_path']:null); BlogRepository::delete($pid); }
    redirect('/admin/blog');
  }
}
