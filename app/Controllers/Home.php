<?php

namespace App\Controllers;

use App\Models\Upload;
use Fluent\Auth\Config\Services;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function dashboard()
    {
        $data = [];
        $user_id = Services::auth()->id();


        $model = new Upload();

        $videos = $model->findAll(6);
        $data = [
            'videos' => $videos
        ];
        // echo $user_id;
        if($this->request->getMethod() == "post")
        {
            $rules = [
                'video' => [
                    'rules' => 'ext_in[video,mp4]',
                    'label' => 'Video'
                ],
                'image' => [
                    'rules' => 'uploaded[image]',
                    'label' => 'Thumbnail'
                ],
                'description' => [
                    'rules' => 'required|min_length[3]|max_length[225]',
                    'label' => 'Description'
                ],
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
                $model = new Upload();

                if(!empty($this->request->getFile('video'))){
                    $data['video'] = $this->request->getFile('video');
                }

                if(!empty($this->request->getFile('image'))){
                    $data['thumbnail'] = $this->request->getFile('image');
                }

                if ($data['video']->isValid() && !$data['video']->hasMoved()) {
                    $data['video']->move('uploads/videos', $data['video']->getRandomName());
                }

                if ($data['thumbnail']->isValid() && !$data['thumbnail']->hasMoved()) {
                    $data['thumbnail']->move('uploads/thumbnails', $data['thumbnail']->getRandomName());
                }

                $newData = [
                    'user_id' => $user_id,
                    'video' => $data['video']->getName(),
                    'thumbnail' => $data['thumbnail']->getName(),
                    'description' => $this->request->getVar('description')
                ]; 

                $model->save($newData);
                $session = session();
                $session->setFlashdata('success', 'Video has been uploaded');
                return redirect()->back();
            }
        }
        return view('dashboard', $data);
    }

    public function confirm()
    {
        return 'granted password';
    }
}
