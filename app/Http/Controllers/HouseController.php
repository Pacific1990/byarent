<?php

namespace App\Http\Controllers;

use App\Http\Requests\HouseCreateRequest;
use App\Http\Requests\HouseUpdateRequest;
use App\Repositories\HouseRepository;

use Illuminate\Http\Request;

class HouseController extends Controller
{
    /**
     * @var HouseRepository
     */
    protected $houseRepository;
    /**
     * @var int
     */
    protected $nbrPerPage = 10;
    protected $module;
    protected $repository;

    /**
     * @param HouseRepository $houseRepository
     */
    public function __construct(
        HouseRepository $houseRepository
    ){
        $this->middleware('auth');

        $this->module = 'houses';
        $this->repository = $houseRepository;
        $this->houseRepository = $houseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = $this->repository->getPaginate($this->nbrPerPage);
        $links = $values->render();
        $page = array('title' => 'Houses', 'module' => $this->module);
        return view($this->module . '/index', compact('values', 'links', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = array('title' => 'Houses', 'module' => $this->module);
        return view($this->module.'/create',  compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($id = $request->id) {
            $this->repository->update($id, $request->all());
            return redirect($this->module)->withOk("Opération effectuée avec success");
        } else {
            $this->repository->store($request->all());
            return redirect($this->module)->withOk("Opération effectuée avec success");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $value = $this->repository->getById($id);
        $page = array('title' => 'Houses', 'module' => $this->module);
        return view($this->module.'/show',  compact('value', 'page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $value = $this->repository->getById($id);
        $page = array('title' => 'Houses', 'module' => $this->module);
        return view($this->module.'/edit',  compact('value', 'page'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->destroy($id);
        return back();
    }

}
