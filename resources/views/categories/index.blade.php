@extends("layouts._template")

@section("content")
    <div class="container card my-4 rounded border">
        <div class="text-center m-4">
            <a href="{{ route("category.create") }}">
                <button type="button" class="btn btn-outline-primary btn-lg btn-block">Create new category</button>
            </a>
        </div>
        {{--<table class="table table-striped">
            <thead>
            <tr class="text-center table-bordered">
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
            </tr>
            </thead>
                <tbody class="items">
                @php
                    $traverse = function ($categories, $prefix = "-") use (&$traverse){
                        foreach ($categories as $category) {
                @endphp
                <tr data-category-id="{{ $category->id }}" data-category-parent="{{ $category->parent_id }}">
                    <th data-category-id="1" class="text-center" scope="row">{{ $category->id }}</th>
                    <td>
                        {{ $prefix }} <a href="{{ route("category.edit", $category->id) }}">{{ $category->name }}</a>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            @if(!$category->trashed())
                                <div class="mr-1 ml-1"><span class="badge badge-success">Active</span></div>
                            @else
                                <div class="mr-1 ml-1"><span class="badge badge-warning">Deleted</span></div>
                                <div class="mr-1 ml-1"><span class="badge badge-secondary">Not active</span></div>
                            @endif
                        </div>
                    </td>
                    <td class="text-center">
                        {{ \Illuminate\Support\Str::limit($category->desc, 15) }}
                    </td>
                    <td class="text-center">
                        @if($category->image)
                            <div>
                                <a href="{{ asset("storage/" . $category->image) }}" target="_blank">
                                    <img src="{{ asset("storage/" . $category->image) }}" style="height: 50px" alt="image">
                                </a>
                            </div>
                        @else
                            No image
                        @endif
                    </td>
                </tr>
                @php
                    $traverse($category->children, $prefix . "-");
                        }
                    };
                $traverse($categories);
                @endphp

                </tbody>
            </table>--}}
        <div class="list-group">
            @php
                $traverse = function ($categories) use (&$traverse){
                    foreach ($categories as $category) {
            @endphp
            <div data-category-id="{{$category->id}}" data-parent-id="{{$category->parent_id}}" class="list-group-item">
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
                    <div class="list-group">
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
        <script type="text/javascript" src="{{ asset("js/my_sorts.js") }}"></script>
@endsection
