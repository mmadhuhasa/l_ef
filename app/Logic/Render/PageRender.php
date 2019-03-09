<?php

namespace App\Logic\Render;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use File;

class PageRender
{
    public function getHome()
    {
//        $posts = Post::where('status', '=', 'published')
//            ->orderBy('created_at', 'desc')
//            ->get();
//
//        return view('pages.home', compact('posts'))->render();
	
	return view('new_index')->render();
    }
    
    public function getAboutUs(){
	return view('home.about_us')->render();
    }
    
    public function getContactUs(){
	return view('home.contact_us')->render();
    }

    public function getPost(Post $post)
    {
        $post_content = html_entity_decode($post->long_content);
        $page_title = $post->title . ' | Codingo Tuts';
        $page_meta_description = $post->meta_description;

        $post_url = env('APP_URL') . '/' . $post->slug . '/';
        $post_title = $post->title;
        $view = 'pages.post';
        return view($view, compact(
            'post',
            'post_content',
            'page_title',
            'page_meta_description',
            'post_url',
            'post_title'
        ))->render();
    }
    
}