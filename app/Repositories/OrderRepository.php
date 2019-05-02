<?php

namespace App\Repositories;

use App\Models\Order;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class OrderRepository
{
    /**
     * @var Order
     */
    protected $order;

    /**
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @param Order $order
     * @param array $inputs
     */
    private function save(Order $order, Array $inputs)
    {
        $order->house_id = $inputs['houses'];
        $order->user_id = $inputs['users'];
        $order->date = $inputs['date'];
        $order->time = $inputs['time'];
        $order->quantity = $inputs['quantity'];
        $order->created_by = Auth::user()->id;
        $order->updated_by = Auth::user()->id;

        $order->save();
    }

    /**
     * @param $n
     * @return mixed
     */
    public function getPaginate($n)
    {
        return $this->order->paginate($n);
    }

    /**
     * @param array $inputs
     * @return mixed
     */
    public function store(Array $inputs)
    {
        $order = new $this->order;
        $this->save($order, $inputs);
        return $order;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->order->findOrFail($id);
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