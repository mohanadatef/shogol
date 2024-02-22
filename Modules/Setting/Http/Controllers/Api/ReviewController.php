<?php

namespace Modules\Setting\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Setting\Service\ReviewService;
use Modules\Setting\Http\Requests\Api\CreateReviewRequest;

class ReviewController extends BasicController
{
    protected $service;

    public function __construct(ReviewService $Service)
    {
        $this->middleware('auth:api');
        $this->service = $Service;
    }

    public function store(CreateReviewRequest $request)
    {
        $data = $this->service->store($request);
        if ($data) {
            return $this->createResponse($data, getCustomTranslation('done'));
        }
        return $this->unKnowError();
    }

}
