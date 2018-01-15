<?php

namespace App\Repositories\Admin;

use App\Models\Admin\UserCampus;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCampusRepository
 * @package App\Repositories
 * @version November 10, 2017, 3:45 pm -05
 *
 * @method UserCampus findWithoutFail($id, $columns = ['*'])
 * @method UserCampus find($id, $columns = ['*'])
 * @method UserCampus first($columns = ['*'])
*/
class UserCampusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'campus_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCampus::class;
    }
}
