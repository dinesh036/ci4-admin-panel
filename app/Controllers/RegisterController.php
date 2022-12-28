<?php namespace App\Controllers;

use App\Models\UserModel;
 use CodeIgniter\Controller;
class RegisterController extends BaseController
{
    public function index()
    {
        //include helper form
        helper(['form']);
        $data = [];
        echo view('register', $data);
    }
 
    public function save()
    {

        //include helper form
        helper(['form']);
        //set rules validation form
        $rules = [
            'name'          => 'required|min_length[3]|max_length[20]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.user_email]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'confpassword'  => 'matches[password]'
        ]; 

        if($this->validate($rules)){
    	echo 'hi dinesh...'; die();
            $model = new UserModel();
            $data = [
                'first_name'     => $this->request->getVar('name'),
                'email_id'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $model->save($data);
            return redirect()->to('/login');
        }else{
        	echo 'dddddddddd'; die;
            $data['validation'] = $this->validator;
            return view('register', $data);
        }
         
    }
 
}
