<div class="form-group">
    <label for="title">Title:</label>
    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $conference->title ?? '') }}">
</div>

<div class="form-group">
    <label for="description">Description:</label>
    <textarea class="form-control" id="description" name="description">{{ old('description', $conference->description ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="date">Date:</label>
    <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $conference->date ?? '') }}">
</div>

<div class="form-group">
    <label for="address">Address:</label>
    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $conference->address ?? '') }}">
</div>

<div class="form-group">
    <label for="participants">Participants:</label>
    <input type="number" class="form-control" id="participants" name="participants" value="{{ old('participants', $conference->participants ?? '') }}">
</div>
