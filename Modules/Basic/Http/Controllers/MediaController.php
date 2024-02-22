<?php

namespace Modules\Basic\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Service\MediaService;

class MediaController extends BasicController
{
    private $service;

    public function __construct(MediaService $Service)
    {
        $this->middleware('auth');
        $this->service = $Service;
    }

    public function remove(Request $request)
    {
       $data= $this->service->remove($request);
       if($data)
       {
        return $this->deleteResponse(getCustomTranslation('Done'));
       }
        return $this->unKnowError();
    }
}
