<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #111827;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }

        .header {
            margin-bottom: 30px;
        }

        .title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: -0.5px;
        }

        .accent-bar {
            height: 5px;
            width: 60px;
            background-color: #f59e0b;
            border-radius: 10px;
        }

        .meta-container {
            margin-bottom: 40px;
        }

        .meta-item {
            margin-bottom: 8px;
            font-size: 14px;
        }

        .label {
            font-weight: bold;
            color: #4b5563;
            min-width: 150px;
            display: inline-block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }

        th {
            background-color: #f9fafb;
            border-bottom: 2px solid #f59e0b;
            color: #111827;
            font-weight: bold;
            text-align: left;
            padding: 12px 10px;
        }

        td {
            border-bottom: 1px solid #e5e7eb;
            padding: 10px;
            color: #374151;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .badge-amber {
            background-color: #fef3c7;
            color: #92400e;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1 class="title">Rapport de Sondage</h1>
        <div class="accent-bar"></div>
    </div>

    <div class="meta-container">
        @if (!empty($survey['name']))
            <div class="meta-item"><span class="label">Sondage :</span> {{ $survey['name'] }}</div>
        @endif

        <div class="meta-item"><span class="label">Date :</span> {{ $date }}</div>

        @if (!empty($survey['question']))
            <div class="meta-item"><span class="label">Question :</span> {{ $survey['question'] }}</div>
        @endif

        @if (!empty($session['class']))
            <div class="meta-item"><span class="label">Classe :</span> <span
                    class="badge badge-amber">{{ $session['class'] }}</span></div>
        @endif

        @if (!empty($session['remark']))
            <div class="meta-item"><span class="label">Note enseignant :</span> <em>{{ $session['remark'] }}</em></div>
        @endif
    </div>

    <h2 style="font-size: 18px; border-left: 4px solid #f59e0b; padding-left: 10px;">Remarques reçues</h2>

    <table>
        <thead>
            <tr>
                <th>Valeur</th>
                <th>Statut</th>
                <th>Confidentialité</th>
                <th style="text-align: center;">Likes</th>
                <th style="text-align: center;">Dislikes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($remarks as $remark)
                <tr>
                    <td style="font-weight: semibold">{{ $remark['value'] }}</td>
                    <td>{{ $remark['status'] }}</td>
                    <td>{{ $remark['private'] ? 'Privé' : 'Public' }}</td>
                    @if ($remark['private'] == false)
                        <td style="text-align: center; color: #059669;">
                            {{ collect($remark['votes'])->where('type', 'like')->count() }}</td>
                        <td style="text-align: center; color: #dc2626;">
                            {{ collect($remark['votes'])->where('type', 'dislike')->count() }}</td>
                    @else
                        <td style="text-align: center">-</td>
                        <td style="text-align: center">-</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
