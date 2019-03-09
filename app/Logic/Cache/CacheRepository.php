<?php

namespace App\Logic\Cache;

use App\Logic\Render\PageRender;
use App\Models\Category;
use App\Models\Author;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;

class CacheRepository {

    protected $render;

    public function __construct(PageRender $pageRender) {
	$this->render = $pageRender;
    }

    public function storePage($type='') {
	switch ($type) {
	    case 'posts':
		$this->storePosts();
		break;
	    case 'home':
		$this->storeHome();
		break;
	    case 'about':
		$this->storeAboutUs();
		break;
	    case 'all':		
		$this->storeHome();
		$this->storeAboutUs();
		$this->storeContactUs();
		break;
	    default :
		$this->storeHome();		
		break;
	}
    }

    private function storePosts() {
	$posts = Post::where('status', '=', 'published')->get();

	foreach ($posts as $post) {
	    $this->putInCache($post->slug, $this->render->getPost($post), 'post');
	}
    }

    private function storeHome() {
	return $this->putInCache('index-key', $this->render->getHome(), 'index-tag');
    }
    
    private function storeAboutUs() {
	return $this->putInCache('about', $this->render->getAboutUs(), 'about');
    }
    
    private function storeContactUs() {
	return $this->putInCache('contact', $this->render->getContactUs(), 'contact');
    }

    private function putInCache($key, $content, $tag) {
	\Cache::tags($tag)->put($key, $content, 43200);
    }

}
