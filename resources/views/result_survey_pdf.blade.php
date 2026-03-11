<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Résultat sondage - {{ $survey['name'] }}</h1>
    <hr>

    <h2>Nom du sondage : {{ $survey['name'] }}</h2>
    <h2>Question du sondage : {{ $survey['question'] }}</h2>
    {{-- <h2>Enseignant : {{ $survey['teacher_name'] }}</h2> --}}
    <h2>Classe : {{ $session['class'] }}</h2>
    <h2>Remarque : {{ $session['remark'] }}</h2>

    <h3>Remarques reçues</h3>
    {{-- <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Valeur</th>
                <th>Statut</th>
                <th>Confidentialité</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($remarks as $remark)
                <tr>
                    <td>{{ $remark['value'] }}</td>
                    <td>{{ $remark['status'] }}</td>
                    <td>{{ $remark['private'] ? 'Privé' : 'Public' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
</body>

</html>
