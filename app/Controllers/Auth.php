<?php

namespace App\Controllers;

use App\Models\User;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn') === true) {
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'email' => 'required|max_length[100]',
                'password' => 'required|max_length[255]',
            ];

            if (! $this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', 'Enter both your username and password.');
            }

            $credentials = $this->request->getPost(['email', 'password']);
            $user = (new User())->where('email', $credentials['email'])->first();

            // New accounts should store passwords with password_hash(). The second
            // condition keeps existing classroom databases with plaintext passwords working.
            $validPassword = $user !== null
                && (password_verify($credentials['password'], $user['password'])
                    || hash_equals((string) $user['password'], (string) $credentials['password']));

            if (! $validPassword) {
                return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
            }

            session()->regenerate();
            session()->set([
                'isLoggedIn' => true,
                'user_id'  => $user['id'],
                'email' => $user['email'],
                'full_name' => $user['first_name'] . ' ' . $user['last_name'],
            ]);

            return redirect()->to('/dashboard');
        }

        return view('login');
    }

    public function logout()
    {
        if (session()->get('isLoggedIn') !== true) {
            return redirect()->to('/login');
        }

        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have been logged out.');
    }

    
}
