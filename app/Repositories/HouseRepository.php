<?php

namespace App\Repositories;

use App\Models\House;
use Auth;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class HouseRepository
{
    /**
     * @var House
     */
    protected $house;

    /**
     * @param House $house
     */
    public function __construct(House $house)
    {
        $this->house = $house;
    }

    /**
     * @param House $house
     * @param array $inputs
     */
    private function save(House $house, Array $inputs)
    {
        $house->name = $inputs['name'];
        $house->description = $inputs['description'];
        $house->price = $inputs['price'];
        $house->user_id = Auth::user()->id;
        $house->picture = isset($inputs['picture']) ? $inputs['picture'] : 'houses.png';
        $house->rent = isset($inputs['rent']);
        $house->created_by = Auth::user()->id;
        $house->updated_by = Auth::user()->id;

        $house->save();
    }

    /**
     * @param $n
     * @return mixed
     */
    public function getPaginate($n)
    {
        return $this->house->orderBy('id', 'DESC')->paginate($n);
    }

    /**
     * @param array $inputs
     * @return mixed
     */
    public function store(Array $inputs)
    {
        $house = new $this->house;
        $this->save($house, $inputs);
        return $house;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->house->findOrFail($id);
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