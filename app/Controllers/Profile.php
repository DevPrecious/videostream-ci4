<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Upload;
use App\Models\UserModel;
use Fluent\Auth\Config\Services;

class Profile extends BaseController
{
	public function index($id = null)
	{
		$data = [];
		$model = new UserModel();
		$user = $model->find($id);
		$data = [
			'user' => $user
		];
		if($this->request->getMethod() == 'post')
		{
			$rules = [
				'username' => 'required',
				'email' => 'required|valid_email',
			];

			if(!$this->validate($rules)){
				$data['validation'] = $this->validator;
			}else{
				$model = new UserModel();
				

				$newData = [

					'username' => $this->request->getVar('username'),
					'email' => $this->request->getVar('email'),

				];

				if(!empty($this->request->getFile('image'))){
					$rules['image'] = 'uploaded[image]';
                    $data['image'] = $this->request->getFile('image');
                }

				if ($data['image']->isValid() && !$data['image']->hasMoved()) {
                    $data['image']->move('uploads/profile', $data['image']->getRandomName());
					$newData['avatar'] = $data['image']->getName();
                }

				if(!empty($this->request->getVar('password'))){
					$newData['password'] = $this->request->getVar('password');
				}

				$model->update($id, $newData);
				session()->setFlashdata('success', 'Updated');
				return redirect()->back();
			}
		}
		return view('profile', $data);
	}

	public function videos()
	{
		$id = Services::auth()->id();
		$data = [];
		$video = new Upload();
		$videos = $video->where('user_id', $id)->findAll();
		$data = [
			'videos' => $videos
		];
		return view('myvideos', $data);
	}

	public function edit($id)
	{
		$data = [];
		$videomodel = new Upload();
		$video = $videomodel->where('upload_id', $id)->first();
		$data = [
			'video' => $video
		];
		if($this->request->getMethod() == 'post')
		{
			$rules = [
				'description' => 'required|min_length[3]|max_length[225]'
			];

			if(!$this->validate($rules)){
				$data['validation'] = $this->validator;
			}else{
				$model = new Upload();
				$upData = [
					'description' => $this->request->getVar('description')
				];
				$model->update($id, $upData);
				return redirect()->to('/myvideos');
			}
		}
		return view('edit', $data);
	}

	public function delete($id = null)
	{
		$videomodel = new Upload();
		$video = $videomodel->delete($id);
		return redirect()->to('/myvideos');
	}
}
