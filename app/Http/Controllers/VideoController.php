<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Video;
use App\User;
class VideoController extends Controller
{
    public function upload(Request $r){
    $request = $r;
 	$user = Auth::user();
if (!Input::file('file')->isValid()) {
  die('{"OK": 0, "info": "Failed to move uploaded file."}');
}
$chunk = isset($request->chunk) ? intval($request->chunk) : 0;
$chunks = isset($request->chunks) ? intval($request->chunks) : 0;

if (!file_exists('uploads/videos/'.$user->id)) {
    mkdir('uploads/videos/'.$user->id, 0777, true);
}
//$fileName = isset($request->name) ? $request->name : 'unknown-name';
$fileName = isset($request->name) ? $request->name : 'unknown-name';
$filePath = "uploads/videos/".$user->id."/".$fileName;
// Open temp file
$out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
  
if ($out) {
  // Read binary input stream and append it to temp file
  $in = @fopen($request->file('file')->getPathName(), "rb");
 
  if ($in) {
    while ($buff = fread($in, 4096))
      fwrite($out, $buff);
  } else
    die('{"OK": 0, "info": "Failed to open input stream."}');
 
  @fclose($in);
  @fclose($out);
 
  @unlink($request->file('file')->getPathName());
} else
  die('{"OK": 0, "info": "Failed to open output stream."}');
 
 
	// Check if file has been uploaded
	if (!$chunks || $chunk == $chunks - 1) {
  // Strip the temp .part suffix off
  rename($filePath.".part", $filePath);
  $vid = new Video;
  $vid->user()->associate($user);
  $vid->fileName = $fileName;
  $vid->title = $fileName;
  $vid->save();
  $newFilePath = "uploads/videos/".$user->id."/".$user->id.'-'.$vid->id.'-'.time().'.'.File::extension($fileName);
  $vid->url = $newFilePath;
  $vid->save();

  rename($filePath, $newFilePath);
	}
	die('{"OK": 1, "info": "Upload successful."}');
    
    }
}
