@foreach ($product->productSpecification->groupBy('spec_type') as $specType => $specifications)
    <label for="{{ $specType }}">{{ $specType }}:</label>
    <select name="{{ $specType }}" id="{{ $specType }}">
        @foreach ($specifications as $specification)
            <option value="{{ $specification->id }}">{{ $specification->spec_value }} ({{ $specification->unit }})
            </option>
        @endforeach
    </select>
    <br>
@endforeach
