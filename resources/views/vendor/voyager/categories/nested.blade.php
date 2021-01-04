<ol class="dd-list">

    @foreach ($items as $item)
    
        <li class="dd-item" data-id="{{ $item->id }}">
            <div class="pull-right item_actions">
                <div class="btn btn-sm btn-danger pull-right delete" data-id="{{ $item->id }}">
                    <i class="voyager-trash"></i> {{ __('voyager::generic.delete') }}
                </div>
                <a class="btn btn-sm btn-primary pull-right edit"
                    href="categories/{{$item->id}}/edit"
                >
                    <i class="voyager-edit"></i> {{ __('voyager::generic.edit') }}
                </a>
            </div>
            <div class="dd-handle">
                @if(Voyager::translatable($item))
                    @include('voyager::multilingual.input-hidden', [
                        'isModelTranslatable' => true,
                        '_field_name'         => 'title'.$item->id,
                        '_field_trans'        => json_encode($item->getTranslationsOf('title'))
                    ])
                @endif
                <span>{{ $item->title }}</span> 
                <small class="url">
                    @foreach ($item->dataInputs()->get()->sortBy('order') as $index => $input)
                            @if ($index > 0)
                                -   
                            @endif
                            {{$input->display_name}}
                    @endforeach
                </small>
            </div>
            @if(!$item->children->isEmpty())
                @include('voyager::categories.nested', ['items' => $item->children])
            @endif
        </li>
    
    @endforeach
    
</ol>
    