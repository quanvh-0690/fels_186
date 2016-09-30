<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserController extends Controller
{
    private $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function index()
    {
        $users = $this->userRepository
            ->where('role', config('user.role.member'))
            ->orderBy('created_at', 'desc')
            ->paginate(config('setting.user.index_page_size'));
        
        return view('admin.user.index', compact('users'));
    }
    
    public function create()
    {
        return view('admin.user.create');
    }
    
    public function store(UserRequest $request)
    {
        $data = $request->only('name', 'email', 'password');
        $data['password'] = bcrypt($data['password']);
        $user = $this->userRepository->create($data);
        if ($user) {
            return redirect()->route('admin.users.index')->with([
                'status' => 'success',
                'message' => trans('messages.admin.users.add.success')
            ]);
        }
    
        return redirect()->back()->with([
            'status' => 'danger',
            'message' => trans('messages.admin.users.add.failed')
        ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        if ($user) {
            return view('admin.user.edit', compact('user', 'lessons'));
        }
        
        return redirect()->route('admin.users.index')->with([
            'status' => 'danger',
            'message' => trans('messages.admin.users.edit.not_found')
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $params = $request->only('name', 'password');
        $user = $this->userRepository->update($params, $id);
        if ($user) {
            return redirect()->route('admin.users.index')->with([
                'status' => 'success',
                'message' => trans('messages.admin.users.edit.success')
            ]);
        }
        
        return redirect()->back()->with([
            'status' => 'danger',
            'message' => trans('messages.admin.users.edit.failed')
        ]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->userRepository->delete($id)) {
            return redirect()->route('admin.users.index')->with([
                'status' => 'success',
                'message' => trans('messages.admin.users.delete.success')
            ]);
        }
        
        return redirect()->back()->with([
            'status' => 'danger',
            'message' => trans('messages.admin.users.delete.failed')
        ]);
    }
    
    public function show($id)
    {
        $user = $this->userRepository->find($id);
        if ($user) {
            return view('admin.user.show', compact('user'));
        }
        
        return redirect()->route('admin.users.index')->with([
            'status' => 'danger',
            'message' => trans('messages.admin.users.show.not_found')
        ]);
    }
    
    public function search()
    {
        $keyword = request('keyword');
        $baseUrl = route('admin.users.index');
        $users = $this->userRepository
            ->where('role', config('user.role.member'))
            ->where(function ($query) use ($keyword) {
                $query->orWhere('name', 'LIKE', "%$keyword%")->orWhere('email', 'LIKE', "%$keyword%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(config('setting.user.index_page_size'));
        
        return view('admin.user.index', compact('users', 'baseUrl'));
    }
}
