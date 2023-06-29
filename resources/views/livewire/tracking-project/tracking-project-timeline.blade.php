@foreach ($tracking_projects as $key => $values)
    <div class="card">
        <div class="card-header justify-content-between">
            <h4>{{ $key }}</h4>
        </div>


        <div class="card-body">
            <div class="container">
                <div class="row" style="margin-left: -75px;">
                    <div class="col-12" style="padding:0px !important">
                        <div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
                            @foreach ($values as $project)
                                @if ($loop->iteration == 1)
                                    <div class="timeline-step">
                                        <div class="timeline-content" data-toggle="popover" data-trigger="hover"
                                            data-placement="top" title="" data-content="Project Start Date"
                                            data-original-title="{{ Carbon\Carbon::parse($project->start_date)->year }}">
                                            <div class="inner-circle bg-secondary"></div>
                                            <p class="h6 mt-3 mb-1">Start Date</p>
                                            <p class="h6 text-muted mb-0 mb-lg-0">{{ $project->start_date }}</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="timeline-step">
                                    <div class="timeline-content " data-toggle="popover" data-trigger="hover"
                                        data-placement="top" title=""
                                        data-content=" @foreach (TrackingProjectStatus::getAllTrackingProjectStatus() as $key => $value)
                                        @if ($project->user_project_status == $value)
                                        {{ $key }}
                                        @endif @endforeach
                                    "
                                        data-original-title="{{ Carbon\Carbon::parse($project->user_deadline_accomplish_date)->year }}">
                                        <div
                                            class="inner-circle
                                    @if ($project->user_project_status == 0) bg-danger
                                    @elseif($project->user_project_status == 1) bg-primary
                                    @else bg-success @endif


                                    ">
                                        </div>
                                        <p class="h6 mt-3 mb-1">
                                            {{ $project->user->fname . ' ' . $project->user->lname }}
                                        </p>
                                        <p class="h6 mt-3 mb-1">{{ $project->job }}
                                        </p>
                                        <p class="h6 text-muted mb-0 mb-lg-0">
                                            {{ $project->user_deadline_accomplish_date }}
                                        </p>
                                    </div>
                                </div>

                                @if ($loop->last)
                                    <div class="timeline-step mb-0">
                                        <div class="timeline-content" data-toggle="popover" data-trigger="hover"
                                            data-placement="top" title="" data-content="Project End Status"
                                            data-original-title="{{ Carbon\Carbon::parse($project->deadline_date)->year }}">
                                            <div
                                                class="inner-circle bg-secondary
                                            {{-- {{ $project->teacking_project_status == 0 ? 'bg-danger' : 'bg-success' }} --}}
                                            ">
                                            </div>
                                            <p class="h6 mt-3 mb-1">End Date Status</p>
                                            <p class="h6 text-muted mb-0 mb-lg-0">{{ $project->deadline_date }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endforeach
@push('css')
    <style>
        /* body{margin-top:20px;} */
        .timeline-steps {
            display: flex;
            justify-content: center;
            flex-wrap: wrap
        }

        .timeline-steps .timeline-step {
            align-items: center;
            display: flex;
            flex-direction: column;
            position: relative;
            margin: 14px;
        }

        @media (min-width:768px) {
            .timeline-steps .timeline-step:not(:last-child):after {
                content: "";
                display: block;
                border-top: .25rem dotted #3b82f6;
                /* width: 3.46rem; */
                width: 9.46rem;

                position:
                    absolute;
                /* left: 7.5rem; */
                /* left: 6rem; */
                left: 100px;

                /* top: .3125rem */
                top: 15px;

            }

            /* .timeline-steps .timeline-step:not(:first-child):before {
                                                                    content: "";
                                                                    display: block;
                                                                    border-top: .25rem dotted #3b82f6;
                                                                    width: 3.8125rem;
                                                                    position: absolute;
                                                                    right:
                                                                        7.5rem;
                                                                    top: .3125rem
                                                                } */
        }

        .timeline-steps .timeline-content {
            width: 10rem;
            text-align: center
        }

        .timeline-steps .timeline-content .inner-circle {
            border-radius: 1.5rem;
            /* height: 1rem;
                                                                width: 1rem; */
            height: 2rem;
            width: 2rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            /* background-color: #3b82f6; */
        }

        .timeline-steps .timeline-content .inner-circle:before {
            content: "";

            display: inline-block;
            height: 3rem;
            width: 3rem;
            min-width: 3rem;
            border-radius: 6.25rem;
            opacity: .5;
        }
    </style>
@endpush
