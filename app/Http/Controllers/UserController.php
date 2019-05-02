<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Repositories\GroupRepository;

use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;
    protected $groupRepository;
    protected $repository;
    protected $module;
    protected $title;
    protected $nbrPerPage = 10;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        GroupRepository $groupRepository,
        UserRepository $userRepository
    ){
        $this->middleware('auth');

        $this->title = 'Users';
        $this->module = 'users';
        $this->repository = $userRepository;
        $this->userRepository = $userRepository;
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
        $page = array('title' => $this->title, 'module' => $this->module);
        return view($this->module.'/index', compact('values', 'links', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = $this->groupRepository->getPaginate(10);
        $page = array('title' => $this->title, 'module' => $this->module);
        return view($this->module.'/create',  compact('page', 'groups'));
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
        $groups = $this->groupRepository->getPaginate(10);
        $value = $this->repository->getById($id);
        $page = array('title' => 'Groups', 'module' => $this->module);
        return view($this->module.'/edit',  compact('value', 'page', 'groups'));
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
