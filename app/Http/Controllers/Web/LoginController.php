<?php

namespace App\Http\Controllers\Web;

use App\Entities\User;
use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct(private EntityManager $entityManager)
    {
    }

    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin');
        }
        return view('auth');
    }

    public function login(Request $request)
    {
        $password = $request->input('password');
        if ($password === env('SITE_PASSWORD')) {
            $repository = $this->entityManager->getRepository(User::class);
            /** @var User|null $user */
            $user = $repository->find(1);
            if (isset($user)) {
                Auth::login($user);
                return redirect()->route('admin');
            }
        }

        return redirect()->route('loginForm')->with('error', 'Неверный пароль');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('main');
    }
}
