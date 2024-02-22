<?php

namespace Modules\Basic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Basic\Traits\ApiResponseTrait;

class BasicController extends Controller
{
    use ApiResponseTrait;

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function changeStatus($id)
    {
        $this->service->changeStatus($id, 'status');
    }

    public function destroy($id)
    {
        return response()->json(['message'=>$this->service->delete($id)]);
    }

    public function list(Request $request)
    {
        return $this->service->list($request, true, $this->perPage());
    }
    public function perPage()
    {
        return !isset(Request()->perPage) ? 10 : Request()->perPage;
    }

    public function pagination()
    {
        return !isset(Request()->pagination) ? false : Request()->pagination;
    }
}
