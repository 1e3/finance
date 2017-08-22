<?php
namespace App\Domains\Roles\Services;

use App\Core\Services\BaseService;
use App\Domains\Roles\Repositories\RoleRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function attachPerms($role_id, $perms)
    {
        $role = $this->repo->findById($role_id);
        if (!$role){
            throw (new ModelNotFoundException)->setModel(get_class($this->repo->model));
        }

        if (is_array($perms)){
            $role->attachPermissions($perms);
        }else{
            $role->attachPermission($perms);
        }
    }

    public function detachPerms($role_id, $perms)
    {
        $role = $this->repo->findById($role_id);
        if (!$role){
            throw (new ModelNotFoundException)->setModel(get_class($this->repo->model));
        }

        if (is_array($perms)){
            $role->detachPermissions($perms);
        }else{
            $role->detachPermission($perms);
        }
    }

}