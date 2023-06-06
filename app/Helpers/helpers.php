<?php

function imageUpload($file) {
  
  try {
    $data = [];
    $name = date('YmdHis').rand(1, 1000).'.'.$file->description->extension();
    $path = public_path().'/image';
    $file->description->move($path, $name);
    if (!empty($file->link)) {
      array_push($data, ['name' => $name, 'path' => '/image', 'url' => $file->link]);
    } else {
      array_push($data, ['name' => $name, 'path' => '/image']);
    }
  } catch (\Exception $e) {
    return [];
  }
  return json_encode($data);
  
}

function imageRemove($file, $type = 0) {

  if ($type == 0) {
    $description = json_decode($file->description);
  } else {
    if (empty($file)) return true;
    $description = json_decode($file);
  }

  try {
    foreach ($description as $desc) {
      $path = $desc->path."/".$desc->name;
    }
    unlink(public_path().$path);
  } catch (\Exception $e) {
    return false;
  }
  return true;
}

function multiImageUpload($files) {
  
  try {
    $data = [];
    foreach($files->file('description') as $index => $file) {
      $name = date('YmdHis').rand(1, 1000).'.'.$file->extension();
      $path = public_path().'/image';
      $file->move($path, $name);
      if (!empty($files->link) && !empty($files->link[$index])) {
        array_push($data, ['name' => $name, 'path' => '/image', 'url' => $files->link[$index]]);
      } else {
        array_push($data, ['name' => $name, 'path' => '/image']);
      }
    }
  } catch (\Exception $e) {
    return [];
  }
  return json_encode($data);

}

function multiImageRemove($file, $type = 0) {

  if ($type == 0)
    $description = json_decode($file->description);
  else if ($type == 1)
    $description = json_decode($file);

  try {
    foreach ($description as $desc) {
      $path = $desc->path."/".$desc->name;
      unlink(public_path().$path);
    }
  } catch (\Exception $e) {
    return false;
  }
  
  return true;
}