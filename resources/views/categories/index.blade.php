@extends("layouts._template")

@section("content")
    <div class="container card my-4 py-2 rounded border">
        <div class="text-center m-4">
            <a href="{{ route("category.create") }}">
                <button type="button" class="btn btn-outline-primary btn-lg btn-block">Create new category</button>
            </a>
        </div>
        <div class="list-group" data-parent-id="0">
            @php
                $traverse = function ($categories) use (&$traverse){
                    foreach ($categories as $category) {
            @endphp
            <div data-category-id="{{$category->id}}" class="list-group-item" data-parent-id="{{ $category->parent_id ?? 0 }}">
                <a href="{{ route("category.edit", $category->id) }}">{{$category->name}}</a>
                <div class="d-flex justify-content-center">
                    @if(!$category->trashed())
                        <div class=""><span class="badge badge-success">Active</span></div>
                    @else
                        <div class="mr-1 ml-1"><span class="badge badge-warning">Deleted</span></div>
                        <div class="mr-1 ml-1"><span class="badge badge-secondary">Not active</span></div>
                    @endif
                </div>
                @if($category->getChildrenCount() > 0)
                    <div class="list-group" data-parent-id="{{ $category->id }}">
                        @php
                            $traverse($category->children);
                        @endphp
                    </div>
                @endif
            </div>
            @php
                }
            };
        $traverse($categories);
            @endphp
        </div>
    </div>
    <script type="text/javascript"
            src="{{ asset("js/my_sorts.js") }}?v={{ md5_file(asset("js/my_sorts.js")) }}"></script>
@endsection
