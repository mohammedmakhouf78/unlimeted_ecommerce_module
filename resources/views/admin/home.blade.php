@extends('admin.master')

@push('css')
@endpush

@section('content')
    <div class="container">

        {{-- <ul>
            @foreach ($categories as $category)
                <li>
                    {{$category->name}}

                    @include('admin.category',[
                        'category' => $category
                    ])
                </li>
            @endforeach
        </ul> --}}

        {!! $categoriesView !!}

    </div>


{{-- 
<ul id="myUL">
    <li>
        <span class="caret">Parent Node</span>
        <ul class="nested active">
            <li>
                <span class="caret caret-down">img</span>
                <ul class="nested">
                </ul>
            </li>
            <li>
                <span class="caret caret-down">css</span>
                <ul class="nested">
                    <li>style.css</li>
                </ul>
            </li>
            <li>
                <span class="caret caret-down">js</span>
                <ul class="nested">
                    <li>script.js</li>
                </ul>
            </li>
            <li>
                <li>index.html</li>
            </li>
        </ul>
    </li>
</ul>
 --}}


    {{-- <ul class="file-tree">
        <li class="file-tree-folder">CSS
            <ul>
                <li>style.css</li>
            </ul>
        </li>
        <li class="file-tree-folder empty">Images</li>
        <li class="file-tree-folder">HTML
            <ul>
                <li class="file-tree-folder">PAGES
                    <ul>
                        <li>file name </li>
                        <li>file name </li>
                        <li>file name </li>
                    </ul>
                </li>
                <li>file name </li>
                <li>file name </li>
            </ul>
        </li>
        <li>index.html </li>
        <li>components.html </li>
    </ul> --}}
@endsection

@push('js')
@endpush