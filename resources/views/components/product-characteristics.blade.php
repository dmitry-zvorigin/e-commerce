<div class="col">
    <div class="card mt-4">
        <h3 class="ms-4">Характеристики</h3>
        <div class="card-body">
            @foreach ($product->characteristics as $group => $characteristics)
            <ul>
                <h4>{{ $characteristics->first()->group->name }}</h4>
                @foreach ($characteristics as $characteristic)
                    <ol>
                        <div class="d-flex justify-content-between">
                        <p>{{ $characteristic->attribute->attribute_name }} => {{ $characteristic->value->value }}</p>
                        </div>
                    </ol>
                @endforeach
            </ul>

            @endforeach
        </div>
    </div>
</div>