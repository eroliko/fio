@php
    use App\Http\Containers\ActorContainer\Models\Actor;
    use App\Http\Containers\MovieContainer\Models\Movie;
    use App\Http\Core\Mappers\GenderMapper;
@endphp
<table class="table">
    <thead>
    <tr>
        <th scope="col">Movie</th>
        <th scope="col">Year</th>
        <th scope="col">Woman</th>
        <th scope="col">Man</th>
    </tr>
    </thead>
    <tbody>
    @php
        /** @var Movie $movie */
    @endphp
    @foreach($sharedMovies as $movie)
        <tr>
            <td>
                {{ $movie->getName() }}
            </td>
            @php
                $actors = $movie->getActors();
                $men = $actors->filter(fn(Actor $actor) => $actor->getRawGender() === GenderMapper::GENDER_MALE);
                $women = $actors->filter(fn(Actor $actor) => $actor->getRawGender() === GenderMapper::GENDER_FEMALE);
                $year = $men->first()->pivot->year;
            @endphp
            <td>
                {{ $year }}
            </td>
            <td>
                @foreach($women as $actor)
                    <div>{{ $actor->getName() }}</div>
                @endforeach
            </td>
            <td>
                @foreach($men as $actor)
                    <div>{{ $actor->getName() }}</div>
                @endforeach
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<hr>
