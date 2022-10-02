@php
    use App\Http\Containers\ActorContainer\Models\Actor;
    use App\Http\Core\Mappers\GenderMapper;
@endphp
<table class="table">
    <thead>
    <tr>
        <th scope="col">Year</th>
        <th scope="col">Women</th>
        <th scope="col">Men</th>
    </tr>
    </thead>
    <tbody>
    @php
        /** @var Actor $femaleActor */
    @endphp
    @foreach($groups as $year => $group)
        <tr>
            <td>
                {{ $year }}
            </td>
            <td>
                @foreach($group[GenderMapper::GENDER_FEMALE] as $data)
                    <div>
                        {{ $data['actor'] }} ({{ $data['age'] }})<br>
                        {{ $data['movie'] }}
                    </div>
                @endforeach
            </td>
            <td>
                @foreach($group[GenderMapper::GENDER_MALE] as $data)
                    <div>
                        {{ $data['actor'] }} ({{ $data['age'] }})<br>
                        {{ $data['movie'] }}
                    </div>
                @endforeach
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<hr>
