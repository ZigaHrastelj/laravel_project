<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Connection;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BadgeController extends Controller
{
    public function createBadge(Request $request){
        $incomingFields = $request->validate([
            'slika' => 'required',
            'pogoj' => 'required',
            'ponovitev'=> 'required',
            'badgeCount'=>'required',
            'points'=>'required'
        ]);

        Badge::create($incomingFields);
        return redirect('/');
    }

    public function showBadgeEditScreen(Badge $badge){
       // if(auth()->user()->option !== 'Admin'){
        //    return redirect('/');
       // }else{
            return view('edit-badge', ['badge' => $badge]);
       // }
    }

    public function actuallyEditBadge(Badge $badge, Request $request){
      // if(auth()->user()->option !== 'Admin'){
       //     return redirect('/');
      //  }else{
        $incomingFields = $request->validate([
            'slika' => 'required',
            'pogoj' => 'required',
            'ponovitev' => 'required',
            'badgeCount'=>'required',
            'points'=>'required'
        ]);
        $incomingFields['slika'] = strip_tags($incomingFields['slika']);
        $incomingFields['pogoj'] = strip_tags($incomingFields['pogoj']);
        $incomingFields['ponovitev'] = strip_tags($incomingFields['ponovitev']);
        $incomingFields['badgeCount'] = strip_tags($incomingFields['badgeCount']);

        $badge->update($incomingFields);
        return redirect('/');
      // }
    }
    
    public function createConnection(Request $request){
      $incomingFields = $request->validate([
        'userId' => 'required',
        'BadgeId' => 'required',
        'TeacherId'=> 'required',
        'PostId'=> 'required'
    ]);
    Connection::create($incomingFields);
    User::where('id', $request->userId)->update(['allPoints' => $allPoints+$request->BadgeId->points]);
    return redirect('/');
    }

    public function addPic(Request $request){
      $target_dir = "C:\Users\Žiga\Desktop\ourfirstapp\public\uploads/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      // Check if image file is a actual image or fake image
      if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        } else {
          echo "File is not an image.";
          $uploadOk = 0;
        }
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
    }
    return redirect('/');
  }
}