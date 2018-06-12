<table>
    <thead>
    <tr>
        @foreach($report[0] as $key => $value)
        <th>{{ $key }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach($report as $item)
        <tr>
            @foreach($item as $key => $value)
            <td>{{ $value }}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>