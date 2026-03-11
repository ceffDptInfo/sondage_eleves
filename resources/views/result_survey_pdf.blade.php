<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @if (!empty($survey['name']))
        <h1>Résultat sondage - {{ $survey['name'] }}</h1>
        <hr>
        <h3>Nom du sondage : {{ $survey['name'] }}</h3>
    @endif

    @if (!empty($survey['question']))
        <h3>Question du sondage : {{ $survey['question'] }}</h3>
    @endif

    @if (!empty($session['class']))
        <h3>Classe : {{ $session['class'] }}</h3>
    @endif

    @if (!empty($session['remark']))
        <h3>Remarque : {{ $session['remark'] }}</h3>
    @endif

    <h3>Remarques reçues</h3>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Valeur</th>
                <th>Statut</th>
                <th>Confidentialité</th>
                <th>Likes</th>
                <th>Dislikes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($remarks as $remark)
                <tr>
                    <td>{{ $remark['value'] }}</td>
                    <td>{{ $remark['status'] }}</td>
                    <td>{{ $remark['private'] ? 'Privé' : 'Public' }}</td>

                    <td>{{ collect($remark['votes'])->where('type', 'like')->count() }}</td>
                    <td>{{ collect($remark['votes'])->where('type', 'dislike')->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
