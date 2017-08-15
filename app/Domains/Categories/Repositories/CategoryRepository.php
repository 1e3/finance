<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/21/17
 * Time: 11:40 AM
 */

namespace App\Domains\Categories\Repositories;


use App\Core\Repositories\BaseRepository;
use App\Domains\Categories\Category;

class CategoryRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = Category::class;
    }
}