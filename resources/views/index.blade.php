<div class="container">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Location</th>
            <th scope="col">Time</th>
            <th scope="col">Wx</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($weeks as $data)
        <tr>
            <th scope="row">{{ $data->id }}</th>
            <td>{{ $data->location }}</td>
            <td>{{ $data->date }}</td>
            <td>{{ $data->wx }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
</div>