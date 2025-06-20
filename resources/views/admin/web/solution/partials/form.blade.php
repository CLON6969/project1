<div class="mb-3">
    <label>Icon</label>
    <input type="text" name="icon" class="form-control" value="{{ old('icon', $table->icon ?? '') }}">
</div>
<div class="mb-3">
    <label>Title</label>
    <input type="text" name="title1" class="form-control" value="{{ old('title1', $table->title1 ?? '') }}">
</div>
<div class="mb-3">
    <label>Subtitle</label>
    <textarea name="title1_sub_content" class="form-control">{{ old('title1_sub_content', $table->title1_sub_content ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label>Button Name</label>
    <input type="text" name="button1_name" class="form-control" value="{{ old('button1_name', $table->button1_name ?? '') }}">
</div>
<div class="mb-3">
    <label>Button URL</label>
    <input type="text" name="button1_url" class="form-control" value="{{ old('button1_url', $table->button1_url ?? '') }}">
</div>