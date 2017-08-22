<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/21/17
 * Time: 11:42 AM
 */

namespace App\Domains\Houses\Repositories;


use App\Core\Repositories\BaseRepository;
use App\Domains\Houses\House;

class HouseRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = House::class;
    }

    public function whereHasUser($house, $user_id)
    {
        $this->newQuery()
            ->residents()
            ->where('user_house.user_id', '=', $user_id);
        //->where('user_house.house_id', '=', $house);

        return $this;
    }
}