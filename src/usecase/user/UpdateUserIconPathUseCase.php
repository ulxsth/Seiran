<?php
session_start();
require_once dirname(__DIR__, 2) . "/repository/UserRepository.php";

$icon = $_FILES['icon'];
$repository = new UserRepository();
$user = $repository->findById($_POST['id']);

if (!is_uploaded_file($icon['tmp_name'])) {
  $_SESSION['error_message'] = 'アイコン:ファイルがアップロードされていません。';
  header('Location: /seiran/view/user/edit.php?id=' . $user->getId());
  exit;
}

// アップロードされたファイルが画像であることを確認する
if (getimagesize($icon['tmp_name']) === false) {
  $_SESSION['error_message'] = 'アイコン:ファイルが画像ではありません。';
  header('Location: /seiran/view/user/edit.php?id=' . $user->getId());
  exit;
}

// アップロードされたファイルが許容されるファイル形式であることを確認する
$allowed_image_types = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF, IMAGETYPE_BMP);
$detected_image_type = exif_imagetype($_FILES["icon"]["tmp_name"]);
if (!in_array($detected_image_type, $allowed_image_types)) {
    $_SESSION['error_message'] = "アイコン:許容されるファイル形式はJPG、JPEG、PNG、GIF、BMPのみです。";
    header('Location: /seiran/view/user/edit.php?id=' . $user->getId());
    exit;
}

// アップロードされたファイルが許容されるサイズであることを確認する
$max_file_size = 5000000; // 5MB
$uploaded_image = $_FILES["icon"]["tmp_name"];
list($width, $height, $type, $attr) = getimagesize($uploaded_image);
if ($width > 2000 || $height > 2000 || $width != $height) {
    $_SESSION['error_message'] = "アイコン:画像の幅と高さは2000px以下で、アスペクト比は1:1である必要があります。";
    header('Location: /seiran/view/user/edit.php?id=' . $user->getId());
    exit;
}
if ($_FILES["icon"]["size"] > $max_file_size) {
  $_SESSION['error_message'] = "アイコン:ファイルサイズが大きすぎます。5MB以下のファイルをアップロードしてください。";
  header('Location: /seiran/view/user/edit.php?id=' . $user->getId());
    exit;
}

// ユーザ検索

if (is_null($user)) {
  header('Location: /seiran/view/error/404.php');
  exit;
}
if ($user->getId() != $_SESSION["user"]["id"]) {
  header('Location: /seiran/view/error/403.php');
  exit;
}

$filename = uniqid() . '.' . pathinfo($icon['name'], PATHINFO_EXTENSION);
$path = '/assets/img/user/' . $filename;
move_uploaded_file($icon['tmp_name'], dirname(__DIR__, 3) . $path);
$user->setIconPath($filename);
$repository->update($user);

header('Location: /seiran/view/user/edit.php?id=' . $user->getId());
?>


