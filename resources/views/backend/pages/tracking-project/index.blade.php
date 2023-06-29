<x-component::layout>
    <x-slot:title>
        Tracking Project
    </x-slot:title>
    <x-component::breadcrumb>
        <li>
            <span class="text-decoration-none">
                Home
            </span>
        </li>
        <li class=" mx-1">
            <i class="text-center
        fas fa-chevron-right" style="margin-top: 7px; font-size:10px;"></i>
        </li>
        <li>
            <a class="text-decoration-none" href="{{ route('trackingProject.index') }}">
                Tracking Project
            </a>
        </li>
    </x-component::breadcrumb>
    <div class="row">
        <div class="col-12 col-md-12">

            <x-component::card cardHeader="Tracking Project" :hasCreate='true' :route="route('trackingProject.create')"
                ability="tracking_project_create">

                <div class="section-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            @if (auth()->user()->user_type == 1)

                                <x-component::table.table id="trackingProject">

                                    <x-component::table.head>
                                        <x-component::table.heading name="No" />
                                        <x-component::table.heading name="Project Start Date" />
                                        <x-component::table.heading name="Project Name" />
                                        <x-component::table.heading name="Client Name" />
                                        <x-component::table.heading name="Job" />
                                        <x-component::table.heading name="Responsible" />
                                        <x-component::table.heading name="Job Deadline" />

                                        <x-component::table.heading name="Project Deadline" />

                                        @if (auth()->user()->can('tracking_project_edit') ||
                                                auth()->user()->can('tracking_project_delete') ||
                                                auth()->user()->can('tracking_project_update_status'))
                                            <x-component::table.heading name="Action" />
                                        @endif
                                    </x-component::table.head>
                                    <x-component::table.body>

                                        @foreach ($tracking_projects as $trackingKey => $trackingPro)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                @foreach ($trackingPro->take(1) as $trackingProject)
                                                    <td>
                                                        {{ $trackingProject->start_date }}
                                                    </td>
                                                    <td>
                                                        {{ $trackingProject->project_name }}
                                                    </td>
                                                    <td>
                                                        {{ $trackingProject->client_name }}
                                                    </td>
                                                @endforeach
                                                <td>
                                                    @foreach ($trackingPro as $trackingProject)
                                                        <span class="d-block  mb-3">
                                                            {{ $trackingProject->job }}
                                                        </span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($trackingPro as $trackingProject)
                                                        <span class="d-block mb-3">

                                                            {{ $trackingProject->user->fname . ' ' . $trackingProject->user->lname }}
                                                            <x-component::table.trash :route="route('trackingProject.delete', [
                                                                'tracking_project' => $trackingProject,
                                                            ])" />
                                                        </span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($trackingPro as $trackingProject)
                                                        <span class="d-block mb-3">

                                                            {{ $trackingProject->user_deadline_accomplish_date }}
                                                        </span>
                                                    @endforeach
                                                </td>
                                                @foreach ($trackingPro->take(1) as $trackingProject)
                                                    <x-component::modal id="trackingP_{{ $trackingProject->id }}"
                                                        title="Project Status">
                                                        <form method="POST"
                                                            action="{{ route('trackingProject.admin.status', ['tracking_status' => $trackingProject]) }}">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="row align-items-center">
                                                                <div class="col-12 col-md-8">

                                                                    <x-component::form.select name="status"
                                                                        :required='true' label="Project Status">
                                                                        <option value="1"
                                                                            @selected($trackingProject->teacking_project_status == 1)>
                                                                            Completed</option>
                                                                    </x-component::form.select>
                                                                </div>
                                                                <div class="col-12 col-md-4">
                                                                    <button class="btn btn-success px-4"
                                                                        type="submit">Update</button>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </x-component::modal>
                                                    <td>
                                                        {{ $trackingProject->deadline_date }}
                                                    </td>

                                                    @if (auth()->user()->can('tracking_project_edit') ||
                                                            auth()->user()->can('tracking_project_delete') ||
                                                            auth()->user()->can('tracking_project_update_status'))
                                                        <x-component::table.data :hasMultiElement='true'>
                                                            @can('tracking_project_edit')
                                                                <x-component::table.edit :route="route('trackingProject.edit', [
                                                                    'tracking_project' => $trackingProject,
                                                                ])" />
                                                            @endcan
                                                            @can('tracking_project_delete')
                                                                <x-component::table.trash :route="route('trackingProject.delete', [
                                                                    'tracking_project' => $trackingProject,
                                                                ])" />
                                                            @endcan
                                                            @can('tracking_project_update_status')
                                                                <a title="Update Status" href="#" data-toggle="modal"
                                                                    data-target="#trackingP_{{ $trackingProject->id }}">
                                                                    <i class="fas fa-bolt" style="font-size:15px;"></i>
                                                                </a>
                                                            @endcan
                                                        </x-component::table.data>
                                                    @endif
                                                @endforeach

                                            </tr>
                                        @endforeach

                                    </x-component::table.body>
                                </x-component::table.table>
                            @else
                                <x-component::table.table id="userTrackingProject">

                                    <x-component::table.head>
                                        <x-component::table.heading name="No" />
                                        <x-component::table.heading name="Project Start Date" />
                                        <x-component::table.heading name="Project Name" />
                                        <x-component::table.heading name="Client Name" />
                                        <x-component::table.heading name="Job" />
                                        <x-component::table.heading name="Responsible" />
                                        <x-component::table.heading name="Job Deadline" />

                                        <x-component::table.heading name="Project Deadline" />

                                        @if (auth()->user()->can('tracking_project_edit') ||
                                                auth()->user()->can('tracking_project_delete') ||
                                                auth()->user()->can('tracking_project_update_status'))
                                            <x-component::table.heading name="Action" />
                                        @endif
                                    </x-component::table.head>
                                    <x-component::table.body>

                                        @foreach ($tracking_projects as $trackingProject)
                                            <x-component::modal id="trackingP_{{ $trackingProject->id }}"
                                                title="Project Status">
                                                <form method="POST"
                                                    action="{{ route('trackingProject.status', ['tracking_status' => $trackingProject]) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="row align-items-center">
                                                        <div class="col-12 col-md-8">

                                                            <x-component::form.select name="status" :required='true'
                                                                label="Project Status">
                                                                @foreach (TrackingProjectStatus::getAllTrackingProjectStatus() as $key => $value)
                                                                    <option value="{{ $value }}"
                                                                        @selected($value == $trackingProject->user_project_status)>
                                                                        {{ $key }}</option>
                                                                @endforeach
                                                            </x-component::form.select>
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <button class="btn btn-success px-4"
                                                                type="submit">Update</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </x-component::modal>
                                            <x-component::table.row>
                                                <x-component::table.data :value='$loop->iteration' />

                                                <x-component::table.data :value='$trackingProject->start_date' />

                                                <x-component::table.data :value='$trackingProject->project_name' />
                                                <x-component::table.data :value='$trackingProject->client_name' />
                                                <x-component::table.data :value='$trackingProject->job' />
                                                <x-component::table.data :value="$trackingProject->user->fname .
                                                    ' ' .
                                                    $trackingProject->user->lname" />
                                                <x-component::table.data :value='$trackingProject->user_deadline_accomplish_date' />

                                                <x-component::table.data :value='$trackingProject->deadline_date' />


                                                @if (auth()->user()->can('tracking_project_edit') ||
                                                        auth()->user()->can('tracking_project_delete') ||
                                                        auth()->user()->can('tracking_project_update_status'))
                                                    <x-component::table.data :hasMultiElement='true'>
                                                        @can('tracking_project_edit')
                                                            <x-component::table.edit :route="route('trackingProject.edit', [
                                                                'tracking_project' => $trackingProject,
                                                            ])" />
                                                        @endcan
                                                        @can('tracking_project_delete')
                                                            <x-component::table.trash :route="route('trackingProject.delete', [
                                                                'tracking_project' => $trackingProject,
                                                            ])" />
                                                        @endcan
                                                        @can('tracking_project_update_status')
                                                            <a title="Update Status" href="#" data-toggle="modal"
                                                                data-target="#trackingP_{{ $trackingProject->id }}">
                                                                <i class="fas fa-bolt" style="font-size:15px;"></i>
                                                            </a>
                                                        @endcan
                                                    </x-component::table.data>
                                                @endif

                                            </x-component::table.row>
                                        @endforeach

                                    </x-component::table.body>
                                </x-component::table.table>
                            @endif
                        </div>
                    </div>
                </div>
            </x-component::card>


        </div>
    </div>

</x-component::layout>
