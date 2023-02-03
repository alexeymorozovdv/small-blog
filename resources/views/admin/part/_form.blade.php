@csrf
<div class="form-group mt-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" name="name" placeholder="Name" id="title"
           required maxlength="100" value="{{ old('name') ?? $post->name ?? '' }}">
</div>
<div class="form-group mt-3">
    <label for="slug" class="form-label">Slug</label>
    <input type="text" class="form-control" name="slug" placeholder="Slug" id="slug"
           required maxlength="100" value="{{ old('slug') ?? $post->slug ?? '' }}">
</div>
<div class="form-group mt-3">
    <label for="category" class="form-label">Category</label>
    @php
        $category_id = old('category_id') ?? $post->category_id ?? 0;
    @endphp
    <select name="category_id" class="form-control" title="Category" id="category">
        <option value="0">Choose a category</option>
        @include('admin.part._categories', ['level' => -1, 'parent' => 0])
    </select>
</div>
<div class="form-group mt-3">
    <label for="excerpt" class="form-label">Excerpt</label>
    <textarea class="form-control" name="excerpt" placeholder="Excerpt" id="excerpt"
              required maxlength="500">{{ old('excerpt') ?? $post->excerpt ?? '' }}</textarea>
</div>
<div class="form-group mt-3">
    <label for="content" class="form-label">Content</label>
    <textarea class="form-control" name="content" placeholder="Content" id="content"
              required rows="4">{{ old('content') ?? $post->content ?? '' }}</textarea>
</div>
<div class="form-group mt-3">
    <input type="file" class="form-control-file" name="image" accept="image/png, image/jpeg">
</div>
@isset($post->image)
    <div class="form-group mt-3 form-check">
        <input type="checkbox" class="form-check-input" name="remove" id="remove">
        <label class="form-check-label" for="remove">
            Delete loaded image
        </label>
    </div>
@endisset
<div class="form-group mt-3">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
