<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="charset=utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <table style="width: 100%" border="1">
        <tbody>
            <tr>
                <td colspan="2" align="center">
                    <b>CENTRO ESCOLAR UNIVERSITY</b><br>
                    <b>Manila*Makati*Malolos</b><br>
                    <i>Human Resource Department</i><br><br>
                    <b>HUMAN RESOURCE POST-TRAINING ASSESSMENT</b>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Title: {{ $internaltraining->title }} </b>
                </td>
            </tr>
            <tr>
                <td style="width: 50%"><b>Office/School/Department: {{ $department . " | " . $schoolcollege}} </b></td>
                <td style="width: 50%"><b>Date: {{ $date_start . " - " . $date_end }} </b></td>
            </tr>
            <tr>
                <td><b>Participants: </b></td>
                <td><b>Venue: {{ $internaltraining->venue }} </b></td>
            </tr>
            <tr>
                <td colspan="2" align="center">Human Resource Development Activity Evaluation Report</td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <table style="width: 100%" border="1">
                        <thead>
                            <tr>
                                <th rowspan="2" style="width: 50%">Criterion</th>
                                <th colspan="4" style="width: 50%">N = 14</th>
                            </tr>
                            <tr>
                                <th>Mean</th>
                                <th>S.D.</th>
                                <th>Verbal Interpretation</th>
                                <th>Rank</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--SAMPLE CRITERIA-->
                            @foreach ($assessment_items as $item)
                                <tr align="center">
                                    <td align="left">{{ $item["name"] }}</td>
                                    <td>{{ number_format($item["mean"], 2) }}</td>
                                    <td>{{ number_format($item["stddev"], 2) }}</td>
                                    <td>{{ $item["verbalinterpretation"] }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td align="right"><b><i>Overall</td>
                                    <td><center><b><i>{{ number_format($overall_mean, 2) }}</b></i></td></center>
                                    <td><center><b><i>{{ number_format($overall_stddev, 2) }}</b></i></td></center>
                                    <td><center><b><i>{{ $overall_verbalinterpretation }}</b></i></td></center>
                                    <td></td>
                                </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="left" style="margin-left: 500px">
                    <br><br>
                    4.5 - 5   Very Extensive Knowledge/ Very Skillful/ Highly Positive Attitude<br>
                    3.5 - 4 Extensive Knowledge/ Skillful/ Positive Attitude<br>
                    2.5 - 3 Adequate Knowledge/ Adequately Skillful/ Neutral Attitude<br>
                    1.5 - 2 Inadequate Knowledge/ Lacks Skill/ Ambivalent<br>
                    0.5 - 1 No Knowledge/ No Skill/ Unfavorable Attitude
                    <br><br>
                </td>
            </tr>
            <tr>
                <td colspan="2"><u><b>Summary of comments/suggestions:</b></u></td>
            </tr>
            <tr>
                <td colspan="6">
                    <br>
                    {{ "Evaluation Narrative: " . $evaluation_and_recomendations_array["evaluation"] }}
                    <br>
                    <br>
                    {{ "Recommendations: " . $evaluation_and_recomendations_array["recommendation"] }}
                    <br>
                </td>
            </tr>
            <tr>
                <td style="width: 50%"><b>Processed by:</b><br><br><br>
                                    Ludwella Z. Tambiloc<br>
                                    HRD Assistant<br>
                                    Date:
                </td>
                <td style="width: 50%"><b>Noted by:</b><br><br><br>
                                    Miss Ana Marie T. Afortunado<br>
                                    Head, Human Resource Department<br>
                                    Date:
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>