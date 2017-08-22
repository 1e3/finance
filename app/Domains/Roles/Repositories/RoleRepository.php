<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/21/17
 * Time: 11:46 AM
 */

namespace App\Domains\Roles\Repositories;


use App\Core\Repositories\BaseRepository;
use App\Domains\Roles\Role;

class RoleRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = Role::class;
    }
}