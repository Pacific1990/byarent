<?php

namespace App\Repositories;

use App\Models\File;
use Auth;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class FileRepository
{
    /**
     * @var File
     */
    protected $file;

    /**
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * @param File $file
     * @param array $inputs
     */
    private function save(File $file, Array $inputs)
    {
        $file->house_id = $inputs['houses'];
        $file->picture = $inputs['picture'];
        $file->created_by = Auth::user()->id;
        $file->updated_by = Auth::user()->id;

        $file->save();
    }

    /**
     * @param $n
     * @return mixed
     */
    public function getPaginate($n)
    {
        return $this->file->orderBy('id', 'DESC')->paginate($n);
    }

    /**
     * @param array $inputs
     * @return mixed
     */
    public function store(Array $inputs)
    {
        $file = new $this->file;
        $this->save($file, $inputs);
        return $file;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->file->findOrFail($id);
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