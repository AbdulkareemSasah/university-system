<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <title>Lectures Schedule</title>
    <meta charset="utf-8" />
    <style>
        @font-face {
            font-family: "Cairo";
            src: url("../../public/fonts/Cairo-Regular.ttf") format("truetype");
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: "Arial", sans-serif;
            direction: rtl;
            /* اتجاه النص من اليمين إلى اليسار */
            text-align: right;
        }
    </style>
</head>

<body>
    <header>
        <div>العمود الأول للرأس</div>
        <div>العمود الثاني للرأس</div>
        <div>العمود الثالث للرأس</div>
    </header>

    <table>
        <thead>
            <tr>
                <th>المستوى</th>
                @foreach ($days as $day)
                    <th>{{ $day }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($groupedLectures as $levelId => $levelLectures)
                <tr>
                    <td>{{ $levelNames[$levelId] }}</td>
                    @foreach ($days as $day)
                        <td>
                            @if (isset($levelLectures[$day]))
                                @foreach ($levelLectures[$day] as $lecture)
                                    <div>
                                        {{ $lecture['subject_name'] }} - {{ $lecture['doctor_name'] }} <br>
                                        {{ $lecture['start'] }} - {{ $lecture['end'] }} <br>
                                        {{ $lecture['classroom_name'] }}
                                    </div>
                                @endforeach
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        <div>العمود الأول للذيل</div>
        <div>العمود الثاني للذيل</div>
        <!-- إضافة المزيد من الأعمدة حسب الحاجة -->
    </footer>
</body>

</html>
