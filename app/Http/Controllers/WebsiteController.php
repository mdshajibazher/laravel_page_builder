<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function uri(){
        $pageBuilder = app()->make('phpPageBuilder');
        $pageBuilder->handlePublicRequest();
    }
}
