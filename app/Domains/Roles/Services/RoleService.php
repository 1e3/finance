<?php
namespace App\Domains\Roles\Services;

use App\Core\Services\BaseService;
use App\Domains\Roles\Repositories\RoleRepository;
use Carbon\Carbon;

class RoleService extends BaseService
{
    /**
     * RoleService constructor.
     * @param RoleRepository $repo
     */
    public function __construct(RoleRepository $repo)
    {
        $this->setRepo($repo);
    }

}