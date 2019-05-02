<?php

namespace App\Repositories;

use App\Models\Group;
use Auth;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class GroupRepository
{
    /**
     * @var Group
     */
    protected $group;

    /**
     * @param Group $group
     */
    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    /**
     * @param Group $group
     * @param array $inputs
     */
    private function save(Group $group, Array $inputs)
    {
        $group->name = $inputs['name'];
        $group->description = $inputs['description'];
        $group->created_by = Auth::user()->id;
        $group->updated_by = Auth::user()->id;

        $group->save();
    }

    /**
     * @param $n
     * @return mixed
     */
    public function getPaginate($n)
    {
        return $this->group->orderBy('id', 'DESC')->paginate($n);
    }

    /**
     * @param array $inputs
     * @return mixed
     */
    public function store(Array $inputs)
    {
        $group = new $this->group;
        $this->save($group, $inputs);
        return $group;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->group->findOrFail($id);
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