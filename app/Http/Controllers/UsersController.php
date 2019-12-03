<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Mail;
use App\Handlers\ImageUploadHandler;
use App\Models\Signature;
use App\Http\Requests\signatureRequest;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store', 'index', 'confirmEmail']
        ]);

        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        $statuses = $user->statuses()
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
        return view('users.show', compact('user', 'statuses'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $this->sendEmailConfirmationTo($user);
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show', [$user]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $users = $user->find(Auth::id());
        $signature = $users->signatures()->latest('id')->first();

        return view('users.edit', compact('user', 'signature'));
    }

    public function update(User $user, Request $request, ImageUploadHandler $handler, Signature $signature)
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);

        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->avatar) {
            $result = $handler->save($request->avatar, 'avatars', $user->id, 416);

            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        //个人签名
        if ($request->signature) {
//            $signature->updateOrCreate(['content' => $request->signature], [ ['content' => $request->signature], ['user_id' => Auth::id()] ]);
            $signature['content'] = $request->signature;
            $signature['user_id'] = Auth::id();
            $signature->save();
        }

        $user->update($data);

        session()->flash('success', '个人资料更新成功！');

        return redirect()->route('users.show', $user);
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }

    protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $to = $user->email;
        $subject = "感谢注册 Twitter 应用！请确认你的邮箱。";

        Mail::send($view, $data, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });
    }

    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜你，激活成功！');
        return redirect()->route('users.show', [$user]);
    }

    public function followings(User $user)
    {
        $users = $user->followings()->paginate(30);
        $title = $user->name . '关注的人';
        return view('users.show_follow', compact('users', 'title'));
    }

    public function followers(User $user)
    {
        $users = $user->followers()->paginate(30);
        $title = $user->name . '的粉丝';
        return view('users.show_follow', compact('users', 'title'));
    }

    protected function getSignature(User $user)
    {
        $users = $user->find(Auth::id());
        $signature = $users->signatures()->latest('id')->first();
        return $signature;
    }

}
