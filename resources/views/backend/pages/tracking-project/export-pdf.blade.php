<!DOCTYPE html>
<html>

<head>

    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 20px;
            text-align: left;
        }
    </style>
</head>

<body>
    {{-- <div>
        <img src="{{ public_path('frontend/img/logo_sticky.png') }}" alt="" style="padding:10px;" width="200px" />
    </div> --}}

    <table style="width:100%">



        <tr>
            <th>Project Start Date</th>
            <th>Project Name:</th>
            <th>Client Name</th>
            <th>Job</th>
            <th>Responsible</th>
            <th>Job Deadline</th>
            <th>Project Deadline</th>
        </tr>
        @foreach ($tracking_projects as $tracking_project)
            <tr>
                <td>{{ $tracking_project->start_date }}</td>
                <td>{{ $tracking_project->project_name }}</td>
                <td>{{ $tracking_project->client_name }}</td>
                <td>{{ $tracking_project->job }}</td>
                <td>{{ $tracking_project->user->fname . ' ' . $tracking_project->user->lname }}</td>
                <td>{{ $tracking_project->user_deadline_accomplish_date }}</td>
                <td>{{ $tracking_project->deadline_date }}</td>
            </tr>
        @endforeach




    </table>

</body>

</html>
