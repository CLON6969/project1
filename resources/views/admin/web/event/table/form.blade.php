@php
    $editing = isset($table);
@endphp

<div class="mb-3">
    <label>Picture</label><br>
    @if($editing && $table->picture)
        <img src="{{ asset('/public/storage/uploads/events/' . $table->picture) }}" width="100"><br>
    @endif
    <input type="file" name="picture" class="form-control">
</div>

<div class="mb-3">
    <label>Title 1</label>
    <input type="text" name="title1" class="form-control" value="{{ old('title1', $table->title1 ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Title 1 Content</label>
    <textarea name="title1_content" class="form-control">{{ old('title1_content', $table->title1_content ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Country</label>
    <input type="text" name="country" class="form-control" value="{{ old('country', $table->country ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Town</label>
    <input type="text" name="town" class="form-control" value="{{ old('town', $table->town ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Main Title</label>
    <input type="text" name="main_tittle" class="form-control" value="{{ old('main_tittle', $table->main_tittle ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Main Title Content</label>
    <textarea name="main_tittle_content" class="form-control">{{ old('main_tittle_content', $table->main_tittle_content ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Day</label>
    <input type="text" name="day" class="form-control" value="{{ old('day', $table->day ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Date</label>
    <input type="date" name="date" class="form-control" value="{{ old('date', $table->date ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Start Time</label>
    <input type="time" name="start_time" class="form-control" value="{{ old('start_time', $table->start_time ?? '') }}" required>
</div>

<div class="mb-3">
    <label>End Time</label>
    <input type="time" name="end_time" class="form-control" value="{{ old('end_time', $table->end_time ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Button 1 Name</label>
    <input type="text" name="button1_name" class="form-control" value="{{ old('button1_name', $table->button1_name ?? '') }}">
</div>

<div class="mb-3">
    <label>Button 1 URL</label>
    <input type="url" name="button1_url" class="form-control" value="{{ old('button1_url', $table->button1_url ?? '') }}">
</div>
