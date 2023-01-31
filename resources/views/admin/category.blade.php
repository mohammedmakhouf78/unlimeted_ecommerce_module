@if ($category->subCategories)
    <ul>
        @foreach ($category->subCategories as $subCategory)
            <li>
                {{$subCategory->name}}
                @include('admin.category',[
                    'category' => $subCategory
                ])
            </li>
        @endforeach
    </ul>
@endif