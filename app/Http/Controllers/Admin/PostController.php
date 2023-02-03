<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('perm:manage-posts')->only(['index', 'category', 'show']);
        $this->middleware('perm:edit-post')->only(['edit', 'update']);
        $this->middleware('perm:publish-post')->only(['enable', 'disable']);
        $this->middleware('perm:delete-post')->only('destroy');
    }

    /**
     * All posts
     *
     * @return View
     */
    public function index(): View
    {
        $roots = Category::where('parent_id', 0)->get();
        $posts = Post::orderBy('created_at', 'desc')->paginate();

        return view('admin.post.index', compact('roots', 'posts'));
    }

    /**
     * Category's posts
     *
     * @param Category$category
     * @return View
     */
    public function category(Category $category): View
    {
        $posts = $category->posts()->paginate();

        return view('admin.post.category', compact('category', 'posts'));
    }

    /**
     * Show one post
     *
     * @param Post $post
     * @return View
     */
    public function show(Post $post): View
    {
        // Indicates that this is a preview mode
        session()->flash('preview', 'yes');

        return view('admin.post.show', compact('post'));
    }

    /**
     * Enable publication
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function enable(Post $post): RedirectResponse
    {
        $post->enable();

        return back()->with('success', 'Post has been published');
    }

    /**
     * Disable a post
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function disable(Post $post): RedirectResponse
    {
        $post->disable();

        return back()->with('success', 'Post has been disabled');
    }

    /**
     * Show post's edit form
     *
     * @param Post $post
     * @return View
     */
    public function edit(Post $post): View
    {
        // We need to save a flash variable that signals that the edit button was pressed in the preview mode
        session()->keep('preview');

        return view('admin.post.edit', compact('post' ));
    }

    /**
     * Updates a post
     *
     * @param PostRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $post->update($request->all());
        $post->tags()->sync($request->tags);
        $route = 'admin.post.index';
        $param = [];
        // The edit button can be clicked in preview mode or in the blog dashboard, so the redirect will be different
        if (session('preview')) {
            $route = 'admin.post.show';
            $param = ['post' => $post->id];
        }

        return redirect()
            ->route($route, $param)
            ->with('success', 'The post has been updated');
    }

    /**
     * Deletes a post
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        $route = 'admin.post.index';
        // The post can be deleted in preview mode or from the control panel, so the redirect after deletion will be different
        if (session('preview')) {
            $route = 'blog.index';
        }

        return redirect()
            ->route($route)
            ->with('success', 'The post has been deleted.');
    }
}
