<div class="container">
    <h1>Print Label with Logo</h1>

    {{-- Display the selected delivery data --}}
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <!-- Add other table headers as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach ($selectedDeliveries as $delivery)
            <tr>


                <td>{{ $delivery->id }}</td>
                <td> <img class="m-4" src="{{ asset($delivery->qr_code) }}" width="100px" alt="image" /></td>
                <td>{{ $delivery->customer->user->name }}</td>
                <td>{{ $delivery->customerAddress->address }}</td>
                <td>{{ $delivery->id }}</td>
                <td>{{ $delivery->id }}</td>
                <td>{{ $delivery->id }}</td>
                <td>{{ $delivery->id }}</td>

                <!-- Add other table cells for delivery data -->
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Add printing functionality or any other content you need --}}
</div>