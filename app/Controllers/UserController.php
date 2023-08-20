<?php

namespace App\Controllers;

use App\Models\Users;


class UserController extends BaseController

{
    public function signup()
    {
        return view('Templates/Signup.php');
    }

    public function setData()
    {
        $user = new Users();
        $inputs = $this->validate([
            'firstName' => 'required|max_length[255]|min_length[3]|alpha_space',
            'lastName' => 'required|max_length[30]|min_length[3]|alpha_space',
            'email' => 'required|max_length[255]|valid_email|is_unique[users.email]',
            'password' => 'required|max_length[255]|min_length[6]|alpha_numeric_punct',
            
        ]);

        if (!$inputs) {
            return view('Templates/signup');
        } else {
           
            $userData = [
                'firstName' => $this->request->getPost('firstName'),
                'lastName' => $this->request->getPost('lastName'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];
            $user->save($userData);
            return redirect()->to('/login');
        }
    }

    public function getData()
    {
        $user = new Users();
        // $data['allUsers'] = $user->paginate(10);
        // $data['pager'] = $user->pager;
        $data = [
            'allUsers' => $user->paginate(10),
            'pager' => $user->pager,
        ];
        if (!session('user')) {
            return redirect()->to('login');
        }
        if (session('user')['type'] == 'A') {
            return view('Templates/dashboard', $data);
        } else {
            $curentId = 0;
            if (session('user')) {
                $curentId = session('user')['id'];
            }
            $currentUser['currentUser'] = $user->find($curentId);
            // print_r($currentUser);
            return view('Templates/profile', $currentUser);
        }
    }

    public function delete($id)
    {
        $user = new Users();
        $errMessage = '';
        $result = $user->find($id);
        if ($result['type'] == "A") {
            $errMessage = "You can not delete the admin user account";
            return redirect()->back()->with('Err', $errMessage);
        } else {
            if(file_exists('uploads/'.$result['img']) && is_file('uploads/'.$result['img'])){
                unlink('uploads/'.$result['img']);
            }
            $user->delete($id);
            $errMessage = "User Account Deleted successfully";
            return redirect()->back()->with('Err', $errMessage);
        }
    }

    public function deleteProfile($id)
    {
        $user = new Users();
        $result = $user->find($id);
        if(file_exists('uploads/'.$result['img']) && is_file('uploads/'.$result['img'])){
            unlink('uploads/'.$result['img']);
        }
        $user->delete($id);
        session()->destroy();
        return redirect()->to('login');
    }

    public function edit($id)
    {
        $user = new Users();
        $data['currentUser'] = $user->find($id);
        return view('Templates/edit', $data);
    }

    public function update()
    {
        $user = new Users();
        $id = $this->request->getPost('id');
        $recordDb = $user->find($id);
        $inputEmail = $this->request->getPost('email');
        $file = $this->request->getFile('image');
if(is_uploaded_file($file)){
    if ($recordDb['email'] != $inputEmail) {
        $inputs = $this->validate([
            'firstName' => 'required|max_length[255]|min_length[3]|alpha_space',
            'lastName' => 'required|max_length[30]|min_length[3]|alpha_space',
            'email' => 'required|max_length[255]|valid_email|is_unique[users.email]',
            'image' =>  'uploaded[image]|max_size[image,4096]|is_image[image]|ext_in[image,jpeg,png,gif,jpg]'
        ]);
    } else {
        $inputs = $this->validate([
            'firstName' => 'required|max_length[255]|min_length[3]|alpha_space',
            'lastName' => 'required|max_length[30]|min_length[3]|alpha_space',
            'email' => 'required|max_length[255]|valid_email',
            'image' =>  'uploaded[image]|max_size[image,4096]|is_image[image]|ext_in[image,jpeg,png,gif,jpg]'
        ]);
    }
}else{
    if ($recordDb['email'] != $inputEmail) {
        $inputs = $this->validate([
            'firstName' => 'required|max_length[255]|min_length[3]|alpha_space',
            'lastName' => 'required|max_length[30]|min_length[3]|alpha_space',
            'email' => 'required|max_length[255]|valid_email|is_unique[users.email]',
        ]);
    } else {
        $inputs = $this->validate([
            'firstName' => 'required|max_length[255]|min_length[3]|alpha_space',
            'lastName' => 'required|max_length[30]|min_length[3]|alpha_space',
            'email' => 'required|max_length[255]|valid_email',
        ]);
    }
}    
        if (!$inputs) {
            return $this->edit($id);
        } else {
            $old_imageName = $recordDb['img'];
            $imageName ='';
            
                if(is_uploaded_file($file) && $file->isValid() && !$file->hasMoved()){             
                    if(file_exists('uploads/'.$old_imageName) && is_file('uploads/'.$old_imageName)){
                        unlink('uploads/'.$old_imageName);
                    }
                    $imageName = $file->getRandomName();
                    $file->move('uploads',$imageName);
                  
                }else{
                    $imageName = $old_imageName;
                }
            
            
            $userData = [
                'firstName' => $this->request->getPost('firstName'),
                'lastName' => $this->request->getPost('lastName'),
                'email' => $this->request->getPost('email'),
                'img' => $imageName
            ];
            $user->update($id, $userData); 
            if($user->find($id)['type']=='A'){
                session()->set('user', $user->find($id));
            }

            $errMessage = "The User account updated successfully";
            return redirect()->to('/dashboard')->with('Err', $errMessage);;
        }
    }

    public function editPassword($id)
    {
        $user = new Users();
        $record['currentUser'] = $user->find($id);
        return view('Templates/changePass', $record);
    }

    public function updatePassword()
    {
        $user = new Users();
        $id = $this->request->getPost('id');
        $record = $user->find($id);
        $password = $this->request->getVar('currentPass');
       
        $newPass = password_hash($this->request->getVar('newPass'), PASSWORD_DEFAULT);
        $inputs = $this->validate([
            'currentPass' => 'required|max_length[255]|min_length[6]|alpha_numeric_punct',
            'newPass'  => 'required|max_length[255]|min_length[6]|alpha_numeric_punct',
            'confirmPass' => 'required|max_length[255]|min_length[6]|alpha_numeric_punct',
        ]);
        if (!password_verify($password, $record['password'])) {
            return redirect()->to('editPassword/' . $id)->with('Err', 'Incorrect current password');
        }
        if (!$inputs) {
            return $this->editPassword($id);
        } else {
            $userData = [
                'currentPass' => $this->request->getPost('currentPass'),
                'newPass' => $this->request->getPost('newPass'),
                'confirmPass' => $this->request->getPost('confirmPass'),
            ];
            
            if ($userData['newPass'] != $userData['confirmPass']) {
                return redirect()->to('editPassword/' . $id)->with('Err', 'The password not match');
            } else {

                $user->update($id, ['password' => $newPass]);
                return redirect()->to('dashboard');
            }
        }
    }

    public function logedin()
    {
        $user_table = new Users();

        $inputs = $this->validate([
            'userName' => 'required|valid_email',
            'password' => 'required|max_length[255]|min_length[6]|alpha_numeric_punct',
        ]);
        if (!$inputs) {
            return view('Templates/Login');
        }
        $userName = $this->request->getPost('userName');
        $password = $this->request->getVar('password');
        $result = $user_table->where('email', $userName)->first();
        if ($result) {

            if (password_verify($password, $result['password'])) {
                //    echo('session setted successfully');
                session()->set('user', $result);
                return redirect()->to('dashboard');
            } else {
                return redirect()->back()->with('Err', "Invalid Email or password");
            }
        } else {
            return redirect()->back()->with('Err', "Invalid Email or password");
        }
    }
    public function logOut()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}