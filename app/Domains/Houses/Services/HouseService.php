<?php
namespace App\Domains\Houses\Services;

use App\Core\Services\BaseService;
use App\Domains\Houses\Repositories\HouseRepository;

class HouseService extends BaseService
{
    public function __construct(HouseRepository $repo)
    {
        $this->setRepo($repo);
    }
}