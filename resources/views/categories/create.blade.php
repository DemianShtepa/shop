@extends("layouts._template")

@section("content")
    <div class="container border rounded flex-column my-4">
        <div class="row py-3">
            <div class="col">
                <a href="{{ route("category.index") }}">
                    <button type="button" class="btn btn-info btn-sm m-1 font-weight-bold text-white">Categories</button>
                </a>
            </div>
        </div>
        <form action="{{ route("category.store") }}"  method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="category_name">Category name</label>
                <input class="form-control" type="text" id="category_name" name="name" value="{{ old("name") }}" autocomplete="off">
                @error("name")
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="category_desc">Description</label>
                <textarea class="form-control" name="desc" id="category_desc" cols="30" rows="10">{{ old("desc") }}</textarea>
            </div>

            <div class="form-group">
                <label for="category_parent">Parent category</label>
                <select class="form-control" name="parent_id" id="category_parent">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @foreach($category->children as $category)
                            <option value="{{ $category->id }}">&#8211; {{ $category->name }}</option>
                            @foreach($category->children as $category)
                                <option value="{{ $category->id }}"> &#8211;&#8211; {{ $category->name }}</option>
                            @endforeach
                        @endforeach
                    @endforeach
                        <option value="" selected >None</option>
                </select>
            </div>

            <div class="form-group">
                <label for="category_photo">Image</label>
                <input type="file" name="image" class="form-control-file">
                @error("photo")
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
