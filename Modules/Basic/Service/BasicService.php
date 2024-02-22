<?php

namespace Modules\Basic\Service;

use Modules\Acl\Traits\messageEmailTrait;
use Modules\Acl\Traits\otpTrait;

class BasicService
{
    use messageEmailTrait,otpTrait;

    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    public function changeStatus($id,$key)
    {
        $data=$this->repo->updateValue($id,$key);
        ActiveLog(null, actionType()['sa'], '');
        return $data;
    }

    public function show($id)
    {
        $data=$this->repo->findOne($id);
        ActiveLog($data, actionType()['va'], '');
        return $data;
    }
}
