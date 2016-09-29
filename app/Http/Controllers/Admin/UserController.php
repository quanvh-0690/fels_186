<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    
    public function search()
    {
        $keyword = request('keyword');
        $users = $this->userRepository
            ->where('role', config('user.role.member'))
            ->where(function ($query) use ($keyword) {
                $query->orWhere('name', 'LIKE', "%$keyword%")->orWhere('email', 'LIKE', "%$keyword%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(config('setting.user.index_page_size'));
        
        return view('admin.user.index', compact('users'));
    }
}
