@php
    $parsedown = new Parsedown();
    $parseString = $project->description;
    echo $parsedown->text($parseString)
@endphp
