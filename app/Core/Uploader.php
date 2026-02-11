<?php
declare(strict_types=1);
namespace App\Core;
final class Uploader{
  public static function save(array $file,array $allowExt,int $maxBytes,string $prefix): ?string{
    if(($file['error']??UPLOAD_ERR_NO_FILE)!==UPLOAD_ERR_OK) return null;
    $tmp=(string)($file['tmp_name']??'');
    if($tmp===''||!is_uploaded_file($tmp)) return null;
    $size=(int)($file['size']??0);
    if($size<=0||$size>$maxBytes) return null;
    $name=(string)($file['name']??'');
    $ext=strtolower(pathinfo($name,PATHINFO_EXTENSION));
    if($ext===''||!in_array($ext,$allowExt,true)) return null;
    $dir=dirname(__DIR__,2).'/public/uploads';
    if(!is_dir($dir)) mkdir($dir,0775,true);
    $rand=bin2hex(random_bytes(6));
    $fname=$prefix.'_'.date('Ymd_His').'_'.$rand.'.'.$ext;
    $dest=$dir.'/'.$fname;
    if(!move_uploaded_file($tmp,$dest)) return null;
    return '/uploads/'.$fname;
  }
  public static function deleteIfLocal(?string $path): void{
    if(!$path) return;
    if(str_starts_with($path,'/uploads/')){
      $full=dirname(__DIR__,2).'/public'.$path;
      if(is_file($full)) @unlink($full);
    }
  }
}
