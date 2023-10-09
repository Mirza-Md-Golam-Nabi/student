<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exam Result</title>
</head>

<body>
    <h1 style="text-align: center;">Coaching Center</h1>
    <table style="width: 100%">
        <tr>
            <td>
                Subject: {{ $exam_info->subject->name }}
            </td>
            <td colspan="2">
                Exam Name: {{ $exam_info->name }}
            </td>
        </tr>
        <tr>
            <td>
                Class: {{ $exam_info->className->title . ' (' . $exam_info->className->id . ')' }}
            </td>
            <td>
                Exam Date: {{ Carbon\Carbon::parse($exam_info->exam_date)->format('d M Y') }}
            </td>
            <td>
                Total Marks: {{ number_format($exam_info->total_marks, 1) }}
            </td>
        </tr>
    </table>
    <div style="margin-top:50px;">

    </div>
    <table style="width: 100%; border-collapse:collapse;" border="1">
        <tr>
            <th style="padding: 5px;">S.N</th>
            <th>Student Name</th>
            <th>Marks</th>
        </tr>
        @foreach ($results as $result)
            <tr>
                <td style="text-align: center;padding:5px">{{ $loop->iteration }}</td>
                <td>{{ $result->student->name }}</td>
                <td style="text-align: center">{{ number_format($result->get_marks, 1) }}</td>
            </tr>
        @endforeach
    </table>
    <div style="margin-top:5px;">
        <small>Print Time: {{ now() }}</small>
    </div>
</body>

</html>
