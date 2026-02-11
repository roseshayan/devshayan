<?php
declare(strict_types=1);
namespace App\Repositories;
use App\Core\Database;
final class BlogRepository{
  public static function listPublic(): array{
    $pdo=Database::pdo();
    $st=$pdo->prepare("SELECT id,title,slug,excerpt,cover_path,published_at FROM blog_posts WHERE status='published' AND (published_at IS NULL OR published_at<=NOW()) ORDER BY published_at DESC,id DESC");
    $st->execute();
    return $st->fetchAll();
  }
  public static function findPublicBySlug(string $slug): ?array{
    $pdo=Database::pdo();
    $st=$pdo->prepare("SELECT * FROM blog_posts WHERE slug=? AND status='published' AND (published_at IS NULL OR published_at<=NOW()) LIMIT 1");
    $st->execute([$slug]);
    $r=$st->fetch();
    return $r?:null;
  }
  public static function listAdmin(): array{
    $pdo=Database::pdo();
    return $pdo->query("SELECT id,title,slug,status,published_at,updated_at FROM blog_posts ORDER BY updated_at DESC,id DESC")->fetchAll();
  }
  public static function findById(int $id): ?array{
    $pdo=Database::pdo();
    $st=$pdo->prepare("SELECT * FROM blog_posts WHERE id=? LIMIT 1");
    $st->execute([$id]);
    $r=$st->fetch();
    return $r?:null;
  }
  public static function uniqueSlug(string $slug,?int $excludeId=null): string{
    $pdo=Database::pdo();
    $base=$slug; $i=2;
    while(true){
      if($excludeId){
        $st=$pdo->prepare("SELECT id FROM blog_posts WHERE slug=? AND id<>? LIMIT 1");
        $st->execute([$slug,$excludeId]);
      }else{
        $st=$pdo->prepare("SELECT id FROM blog_posts WHERE slug=? LIMIT 1");
        $st->execute([$slug]);
      }
      if(!$st->fetch()) return $slug;
      $slug=$base.'-'.$i; $i++;
    }
  }
  public static function create(array $d): int{
    $pdo=Database::pdo();
    $st=$pdo->prepare("INSERT INTO blog_posts(title,slug,excerpt,content,cover_path,status,published_at,created_at,updated_at) VALUES(?,?,?,?,?,?,?,NOW(),NOW())");
    $st->execute([(string)$d['title'],(string)$d['slug'],(string)$d['excerpt'],(string)$d['content'],$d['cover_path']??null,(string)$d['status'],$d['published_at']?:null]);
    return (int)$pdo->lastInsertId();
  }
  public static function update(int $id,array $d): void{
    $pdo=Database::pdo();
    $st=$pdo->prepare("UPDATE blog_posts SET title=?,slug=?,excerpt=?,content=?,cover_path=?,status=?,published_at=?,updated_at=NOW() WHERE id=?");
    $st->execute([(string)$d['title'],(string)$d['slug'],(string)$d['excerpt'],(string)$d['content'],$d['cover_path']??null,(string)$d['status'],$d['published_at']?:null,$id]);
  }
  public static function delete(int $id): void{
    $pdo=Database::pdo();
    $st=$pdo->prepare("DELETE FROM blog_posts WHERE id=?");
    $st->execute([$id]);
  }
}
