<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Subscribe;
use App\Models\Upload;
use Fluent\Auth\Config\Services;

class Video extends BaseController
{
	public function index($id = null)
	{
		if(empty($id))
			return '404';
		$data = [];
		$model = new Upload();
		$video = $model->where('upload_id', $id)->join('users', 'users.id = uploads.user_id')->first();
		if(!$video)
			return '404';
		// dd($video);
		$comment = new Comment();
		$comments = $comment->where('post_id', $id)->join('users', 'users.id = comments.user_id')
		->orderBy('comment_id', 'DESC')
		->findAll();
		$like = new Like();
		$sub = new Subscribe();
		$likes = $like->where('post_id', $id)->countAllResults();
		$like_user = $like->where('post_id', $id)->first();
		$sub_user = $sub->where('post_id', $id)->first();
		$sub_count = $sub->where('post_id', $id)->countAllResults();
		// dd($likes);
		// dd($comments);
		$data = [
			'video' => $video,
			'comments' => $comments,
			'likes' => $likes,
			'like_user' => $like_user,
			'sub_user' => $sub_user,
			'sub_count' => $sub_count,
		];

		if($this->request->getMethod() == 'post'){
			$commentdata = [
				'comment' => $this->request->getVar('comment'),
				'user_id' => $this->request->getVar('user_id'),
				'post_id' => $id
			];

			$model = new Comment();
			$model->save($commentdata);
			$session = session();
			$session->setFlashdata('success', 'Commented');
			return redirect()->back();
		}

		return view('video', $data);
	}

	public function like($id)
	{
		$user_id = Services::auth()->id();
		$likedata = [
			'post_id' => $id,
			'user_id' => $user_id
		];
		$model = new Like();
		$model->save($likedata);
		return redirect()->back();
	}

	public function subscribe($id)
	{
		$user_id = Services::auth()->id();
		$subscribedata = [
			'post_id' => $id,
			'user_id' => $user_id
		];
		$model = new Subscribe();
		$model->save($subscribedata);
		return redirect()->back();
	}
}
