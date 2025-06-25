<div class="mb-3">
    <label>Icon</label>
    <input type="text" name="icon" value="{{ old('icon', $table->icon ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label>Title 1</label>
    <input type="text" name="title1" value="{{ old('title1', $table->title1 ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label>Title 1 Sub Content</label>
    <textarea name="title1_sub_content" class="form-control">{{ old('title1_sub_content', $table->title1_sub_content ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Title 2</label>
    <input type="text" name="title2" value="{{ old('title2', $table->title2 ?? '') }}" class="form-control">
</div>

<div class="mb-3">
    <label>Title 2 Content</label>
    <textarea name="title2_content" class="form-control">{{ old('title2_content', $table->title2_content ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Title 2 Sub Content</label>
    <textarea name="title2_sub_content" class="form-control">{{ old('title2_sub_content', $table->title2_sub_content ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Button 1 Name</label>
    <input type="text" name="button1_name" value="{{ old('button1_name', $table->button1_name ?? '') }}" class="form-control">
</div>

<div class="mb-3">
    <label>Button 1 URL</label>
    <input type="url" name="button1_url" value="{{ old('button1_url', $table->button1_url ?? '') }}" class="form-control">
</div>
