<?php

namespace App\Repositories;

use App\Models\User;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param User $user
     * @param array $inputs
     */
    private function save(User $user, Array $inputs)
    {
        $user->name = $inputs['name'];
        $user->email = $inputs['email'];
        $user->admin = isset($inputs['admin']);
        $user->group_id = isset($inputs['groups']) ? $inputs['groups'] : 2;

        $user->save();
    }

    /**
     * @param $n
     * @return mixed
     */
    public function getPaginate($n)
    {
        return $this->user->paginate($n);
    }

    /**
     * @param array $inputs
     * @return mixed
     */
    public function store(Array $inputs)
    {
        $user = new $this->user;
        if(!empty($inputs['password'])) {
            $user->password = bcrypt($inputs['password']);
        }
        $this->save($user, $inputs);
        return $user;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->user->findOrFail($id);
    }

    /**
     * @param $id
     * @param array $inputs
     */
    public function update($id, Array $inputs)
    {
        $this->save($this->getById($id), $inputs);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $this->getById($id)->delete();
    }

}