<?php
namespace App\Domains\Roles\Services;

use App\Core\Services\BaseService;
use App\Domains\Models\Users\Repositories\UserRepository;
use App\Domains\Roles\Repositories\RoleRepository;

class RoleService extends BaseService
{
    private $userRepo;

    /**
     * RoleService constructor.
     * @param RoleRepository $repo
     * @param UserRepository $userRepo
     */
    public function __construct(RoleRepository $repo, UserRepository $userRepo)
    {
        $this->setRepo($repo);
        $this->userRepo = $userRepo;
    }

    public function attachPerms($role_id, $perms)
    {
        $role = $this->repo->findById($role_id);
        if (!$role){
            throw new \Exception("Role not found",404);
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
            throw new \Exception("Role not found",404);
        }

        if (is_array($perms)){
            $role->detachPermissions($perms);
        }else{
            $role->detachPermission($perms);
        }
    }

    public function attachUsers($role_id, $users)
    {
        $users_ids = (is_array($users)) ? $users : [$users] ;
        $users = $this->userRepo->whereInIds($users_ids)->doQuery();

        $role = $this->repo->findById($role_id);
        if (!$role){
            throw new \Exception("Role not found",404);
        }


        if ($users->isEmpty())
            throw new \Exception("Users not found",404);

        $role->users()->attach($users->pluck('id')->toArray());

    }

    public function detachUsers($role_id, $users)
    {
        $role = $this->repo->findById($role_id);
        if (!$role){
            throw new \Exception("Role not found",404);
        }

        $users = (is_array($users)) ? $users : [$users] ;
        $users = $this->userRepo->whereInIds($users)->doQuery();

        if ($users->isEmpty())
            throw new \Exception("Users not found",404);

        $role->users()->detach($users->pluck('id')->toArray());
    }

}