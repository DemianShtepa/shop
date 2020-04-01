@extends("layouts._template")

@section("content")
    <div class="container border rounded flex-column my-4">
        <div class="row py-3">
            <div class="col">
                <a href="{{ route("category.index") }}">
                    <button type="button" class="btn btn-info btn-sm m-1 font-weight-bold text-white">Categories</button>
                </a>
            </div>
            <div class="col">
                <div class="d-flex justify-content-end">
                    <form action="{{ route("category.activate", $currentCategory->id) }}" method="POST">
                        @method("PUT")
                        @csrf
                        <button type="submit"
                                class="btn btn-success btn-sm m-1 font-weight-bold" {{ $currentCategory->is_active || $currentCategory->trashed() ? "disabled" : ""}}>
                            Activate
                        </button>
                    </form>
                    <form action="{{ route("category.deactivate", $currentCategory->id) }}" method="POST">
                        @method("PUT")
                        @csrf
                        <button type="submit"
                                class="btn btn-secondary btn-sm m-1 font-weight-bold" {{ !$currentCategory->is_active ? "disabled" : ""}}>
                            Deactivate
                        </button>
                    </form>
                    <form action="{{ route("category.restore", $currentCategory->id) }}" method="POST">
                        @method("PUT")
                        @csrf
                        <button type="submit"
                                class="btn btn-primary btn-sm m-1 font-weight-bold" {{ !$currentCategory->trashed() ? "disabled" : ""}}>
                            Restore
                        </button>
                    </form>
                    <form action="{{ route("category.delete", $currentCategory->id) }}" method="POST">
                        @method("DELETE")
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm m-1 font-weight-bold" {{ $currentCategory->trashed() ? "disabled" : ""}}>Delete</button>
                    </form>
                    <form action="{{ route("category.forceDelete", $currentCategory->id) }}" method="POST">
                        @method("DELETE")
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm m-1 font-weight-bold">Permanently delete</button>
                    </form>
                </div>
            </div>
        </div>
        <form action="{{ route("category.update", $currentCategory) }}" method="POST" enctype="multipart/form-data">
            @method("PUT")
            @csrf
            <div class="form-group">
                <label for="category_name">Category name</label>
                <input class="form-control" type="text" id="category_name" name="name"
                       value="{{ $currentCategory->name}}" autocomplete="off">
                @error("name")
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="category_desc">Description</label>
                <textarea class="form-control" name="desc" id="category_desc" cols="30"
                          rows="10">{{ old("desc", $currentCategory->desc) }}</textarea>
            </div>

            <div class="form-group">
                <label for="category_parent">Parent category</label>
                <select class="form-control" name="parent_id" id="category_parent">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                                {{ ($currentCategory->parent_id == $category->id) ? "selected":"" }}>{{ $category->name }}</option>
                        @foreach($category->children as $category)
                            <option value="{{ $category->id }}"
                                    {{ ($currentCategory->parent_id == $category->id) ? "selected":"" }}>
                                &#8211; {{ $category->name }}</option>
                            @foreach($category->children as $category)
                                <option value="{{ $category->id }}"
                                        {{ ($currentCategory->parent_id == $category->id) ? "selected":"" }}>
                                    &#8211;&#8211; {{ $category->name }}</option>
                            @endforeach
                        @endforeach
                    @endforeach
                        <option value="" {{ !isset($currentCategory->parent_id) ? "selected": ""}}>None</option>
                </select>
            </div>

            <div class="form-group">
                <label for="category_photo">Image</label>
                <input type="file" name="image" class="form-control-file" value="{{ old("image") }}">
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
