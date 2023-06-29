<?php

namespace App\Http\Livewire\TrackingProject;

use App\Enums\Message;
use App\Models\TrackingProject;
use App\Services\TrackingProjectService;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TrackingProjectCreate extends Component
{
    public $start_date, $project_name, $client_name, $user_deadline_accomplish_date, $job, $user_id, $deadline_date, $users;
    public $dynamicForm;
    public $trackingProjects;
    public function mount()
    {
        $this->users = UserService::getAll()->get();
        // $this->trackingProjects = TrackingProject::all();
        $this->dynamicForm = collect();
    }

    protected $rules = [
        'start_date' => ['required', 'date'],
        'project_name' => ['required', 'string', 'max:255'],
        'client_name' => ['required', 'string', 'max:255'],
        'user_deadline_accomplish_date' => ['required', 'date', 'after:start_date'],
        'job' => ['required'],
        'user_id' => ['required', 'integer'],
        'deadline_date' => ['required', 'date', 'after:user_deadline_accomplish_date'],
        'dynamicForm.*.user_deadline_accomplish_date' => ['required', 'date', 'after:start_date', 'before_or_equal:deadline_date'],
        // 'dynamicForm.*.deadline_date' => ['nullable', 'date', 'after:user_deadline_accomplish_date'],
        'dynamicForm.*.job' => ['required'],

    ];

    public function messages()
    {
        return [
            'dynamicForm.*.user_deadline_accomplish_date.required' => 'The job accomplish is required',
            'dynamicForm.*.user_deadline_accomplish_date.after' => 'The user deadline accomplish date must be a date after start date.',
            'dynamicForm.*.user_deadline_accomplish_date.before_or_equal' => 'The user deadline accomplish date must be a date before or equal deadline date.',
            'dynamicForm.*.deadline_date' => 'The deadline date must be a date after user deadline accomplish date.',
            'dynamicForm.*.job' => 'The job is required',
            'dynamicForm.*.user_id' => 'Required',

        ];
    }


    protected $validationAttributes = [
        'user_deadline_accomplish_date' => 'Deadline to Accomplish',
        'user_id' => 'Responsible'
    ];

    public function addForm()
    {
        $this->dynamicForm->push(new TrackingProject());
    }
    public function removeForm($index)
    {
        unset($this->dynamicForm[$index]);
    }

    public function store(TrackingProject $trackingProject)
    {
        try {
            DB::beginTransaction();
            $this->validate();
            if ($this->dynamicForm):

                foreach ($this->dynamicForm as $form):
                    $tracking = new TrackingProject();
                    $tracking->user_id = $form['user_id'];
                    $tracking->start_date = $this->start_date;
                    $tracking->project_name = $this->project_name;
                    $tracking->client_name = $this->client_name;
                    $tracking->user_deadline_accomplish_date = $form['user_deadline_accomplish_date'];
                    $tracking->job = $form['job'];
                    $tracking->deadline_date = $this->deadline_date;
                    $tracking->save();
                endforeach;
            endif;
            $trackingProject->user_id = $this->user_id;
            $trackingProject->start_date = $this->start_date;
            $trackingProject->project_name = $this->project_name;
            $trackingProject->client_name = $this->client_name;
            $trackingProject->user_deadline_accomplish_date = $this->user_deadline_accomplish_date;
            $trackingProject->job = $this->job;
            $trackingProject->deadline_date = $this->deadline_date;
            $trackingProject->save();

            $this->resetExcept(['users']);
            $this->dynamicForm = collect();
            $this->dispatchBrowserEvent(
                'alert',
                [
                    'type' => 'success',
                    'message' => Message::CREATED,
                ]
            );
            DB::commit();
        } catch (\Exception $e) {
            // dd($e);
            DB::rollBack();
            $this->validate();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error', 'message' => Message::FAILED]
            );
        }
    }




    public function render()
    {
        return view('livewire.tracking-project.tracking-project-create');
    }
}