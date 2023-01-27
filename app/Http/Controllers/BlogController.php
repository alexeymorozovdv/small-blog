<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Contracts\View\View;

class BlogController extends Controller
{
    /**
     * Main page, all posts list
     *
     * @return View
     */
    public function index(): View
    {
        $posts = Post::published()
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('blog.index', compact('posts'));
    }

    /**
     * Show a single post
     *
     * @param Post $post
     * @return View
     */
    public function post(Post $post): View
    {
        $comments = $post->comments()
            ->orderBy('created_at')
            ->paginate();

        return view('blog.post', compact('post', 'comments'));
    }

    /**
     * Show all category's posts
     *
     * @param Category $category
     * @return View
     */
    public function category(Category $category): View
    {
        $posts = $category->posts()
            ->published()
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('blog.category', compact('category', 'posts'));
    }

    /**
     * Show all user's posts
     *
     * @param User $user
     * @return View
     */
    public function author(User $user): View
    {
        $posts = $user->posts()
            ->published()
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('blog.author', compact('user', 'posts'));
    }

    /**
     * Show all tag's posts
     *
     * @param Tag $tag
     * @return View
     */
    public function tag(Tag $tag): View
    {
        $posts = $tag->posts()
            ->published()
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('blog.tag', compact('tag', 'posts'));
    }
}
