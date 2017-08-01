<?php
namespace App\Domains\Categories\Services;

use App\Core\Services\BaseService;
use App\Domains\Categories\Repositories\CategoryRepository;

class CategoryService extends BaseService
{
    public function __construct(CategoryRepository $repo)
    {
        $this->setRepo($repo);
    }
}