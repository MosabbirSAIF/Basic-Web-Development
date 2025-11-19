<?php
$u = __DIR__ . '/uploads';
if (!is_dir($u)) mkdir($u, 0755, true);
$allowed = ['jpg','jpeg','png','gif','webp'];
$errors = []; $success = '';
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_FILES['image'])) {
    $title = trim($_POST['title'] ?? '');
    $f = $_FILES['image'];
    if ($f['error'] !== UPLOAD_ERR_OK) $errors[] = 'Upload error: '.$f['error'];
    else {
        $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) $errors[] = 'Unsupported file type';
        else {
            $name = uniqid('', true).'.'.$ext;
            $target = $u . '/' . $name;
            if (move_uploaded_file($f['tmp_name'], $target)) {
                $meta = ['title' => $title ?: 'Untitled', 'time' => date('Y-m-d H:i')];
                file_put_contents($u . '/' . $name . '.json', json_encode($meta, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
                $success = 'Uploaded';
            } else $errors[] = 'Failed to save file';
        }
    }
}
$files = array_values(array_diff(scandir($u), ['.','..']));
$images = [];
foreach ($files as $f) {
    $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
    if (in_array($ext, $allowed)) {
        $metafile = $u . '/' . $f . '.json';
        if (is_file($metafile)) {
            $j = json_decode(file_get_contents($metafile), true) ?: [];
            $title = $j['title'] ?? 'Untitled';
            $time  = $j['time'] ?? date('Y-m-d H:i', filemtime($u.'/'.$f));
        } else {
            $title = 'Untitled';
            $time  = date('Y-m-d H:i', filemtime($u.'/'.$f));
        }
        $images[$f] = ['title'=>$title,'time'=>$time];
    }
}
$images = array_reverse($images);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Gallery</title>
<style>
body{font-family:Arial,sans-serif;background:#f5f5f5;padding:20px;margin:0}
.container{max-width:900px;margin:0 auto}
form{background:#fff;padding:12px;border-radius:8px;margin-bottom:16px;display:flex;gap:8px;align-items:center}
input[type="text"]{flex:1;padding:8px}
input[type="file"]{padding:6px}
button{padding:8px 12px;border:0;background:#007bff;color:#fff;border-radius:6px;cursor:pointer}
.gallery{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px}
.card{background:#fff;padding:8px;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,.08)}
.card img{width:100%;height:140px;object-fit:cover;border-radius:6px}
.title{font-weight:700;margin-top:6px}
.time{font-size:12px;color:#666}
.message{margin-bottom:8px;color:green}
.error{color:red}
</style>
</head>
<body>
<div class="container">
  <h2>Image Gallery</h2>
  <?php if($success):?><div class="message"><?=htmlspecialchars($success)?></div><?php endif;?>
  <?php foreach($errors as $e):?><div class="error"><?=htmlspecialchars($e)?></div><?php endforeach;?>
  <form method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Title (optional)">
    <input type="file" name="image" accept="image/*" required>
    <button type="submit">Upload</button>
  </form>

  <div class="gallery">
    <?php if(empty($images)):?><p>No images found.</p><?php else: ?>
      <?php foreach($images as $file=>$info): $url='uploads/'.rawurlencode($file); ?>
        <div class="card">
          <a href="<?= $url ?>" target="_blank"><img src="<?= $url ?>" alt="<?=htmlspecialchars($info['title'])?>"></a>
          <div class="title"><?=htmlspecialchars($info['title'])?></div>
          <div class="time"><?=htmlspecialchars($info['time'])?></div>
        </div>
      <?php endforeach;?>
    <?php endif;?>
  </div>
</div>
</body>
</html>
