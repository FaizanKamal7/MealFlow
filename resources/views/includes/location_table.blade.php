<table id="location_table" class="table table-striped table-row-bordered gy-5 gs-7">
    <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th class="table-sort-desc">Cities</th>
            <th class="table-sort-desc">States</th>
            <th>Countries</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cities as $city)
            <tr class="">
                <td>
                    <div class="">
                        <b>{{ $city->name }}</b>
                    </div>
                </td>
                <td>
                    <div class="">
                        <b>{{ $city->state->name }}</b>
                    </div>
                </td>
                <td>
                    <div class="">
                        <b>{{ $city->state->country->name }}</b>
                    </div>
                </td>
                <td>
                    <div class="">
                        <a href="{{ route('extract_api_areas_of_city', ['city_name' => $city->name, 'city_id' => $city->id]) }}"
                            class="btn btn-primary text-white activate">Activate</a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="paginator-div">
    {{-- {{ $cities->links() }} --}}

    {{ $cities->appends($_GET)->links() }}
</div>
