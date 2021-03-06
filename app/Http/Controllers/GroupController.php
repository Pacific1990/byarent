<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Repositories\GroupRepository;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * @var GroupRepository
     */
    protected $groupRepository;
    protected $nbrPerPage = 10;
    protected $module;
    protected $repository;

    /**
     * @param GroupRepository $groupRepository
     */
    public function __construct(
        GroupRepository $groupRepository
    ){
        $this->middleware('auth');

        $this->module = 'groups';
        $this->repository = $groupRepository;
        $this->groupRepository = $groupRepository;
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
        $page = array('title' => 'Groups', 'module' => $this->module);
        return view($this->module . '/index', compact('values', 'links', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = array('title' => 'Groups', 'module' => $this->module);
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
        $page = array('title' => 'Groups', 'module' => $this->module);
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
        $page = array('title' => 'Groups', 'module' => $this->module);
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
