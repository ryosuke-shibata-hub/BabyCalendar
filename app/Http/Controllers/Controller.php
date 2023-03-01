<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->myBackgroundLogo = config('const.Images.BackGroundImg.Dir');
        $this->logo = config('const.Images.Logo.Dir');
        $this->myBackgroundLogoPath = config('const.Images.BackGroundImg.Path');
        $this->logoPath = config('const.Images.Logo.Path');
        $this->myImagePath = config('const.Images.MyImg.Path');
        $this->countImg = config('const.Images.Count.MAX');
    }
}
