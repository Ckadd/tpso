<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Date</th>

            @if(!empty($formColumns))
                @foreach($formColumns as $valueColumn)
                    <th>{{ $valueColumn }}</th>
                @endforeach
            @endif

        </tr>
    </thead>
    <tbody>
        
        @if(!empty($formValue))
            @foreach($formValue as $keyForm => $valueForm)
                <tr>
                    <td>{{ $keyForm }}</td>

                    @for($i=0; $i < 1; $i++)
                        <td>{{ $valueForm['created_at'][$i] ?? '' }}</td>
                    @endfor

                    @foreach($valueForm['value'] as $keyValue => $value)
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
        @endif

    </tbody>
</table>