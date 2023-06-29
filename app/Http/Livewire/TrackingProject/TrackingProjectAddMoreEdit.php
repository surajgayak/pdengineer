<?php

namespace App\Http\Livewire\TrackingProject;

use App\Models\TrackingProject;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TrackingProjectAddMoreEdit extends Component
{
    public $user_deadline_accomplish_date, $job, $user_id, $users;
    public $dynamicForm;
    public $trackingProjectData;
    public function mount(TrackingProject $trackingProjectData)
    {
        $this->trackingProjectData = $trackingProjectData;
        $this->users = UserService::getAll()->get();
        $this->dynamicForm = collect();
    }

    protected $rules = [
        'user_deadline_accomplish_date' => ['required', 'date', 'after:start_date'],
        'job' => ['required'],
        'user_id' => ['required', 'integer'],
    ];


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
                    $tracking->start_date = $this->trackingProjectData->start_date;
                    $tracking->project_name = $this->trackingProjectData->project_name;
                    $tracking->client_name = $this->trackingProjectData->client_name;
                    $tracking->user_deadline_accomplish_date = $form['user_deadline_accomplish_date'];
                    $tracking->job = $form['job'];
                    $tracking->deadline_date = $this->trackingProjectData->deadline_date;
                    $tracking->save();
                endforeach;
            endif;
            // $trackingProject->user_id = $this->user_id;
            // $trackingProject->start_date = $this->start_date;
            // $trackingProject->project_name = $this->project_name;
            // $trackingProject->client_name = $this->client_name;
            // $trackingProject->user_deadline_accomplish_date = $this->user_deadline_accomplish_date;
            // $trackingProject->job = $this->job;
            // $trackingProject->deadline_date = $this->deadline_date;
            // $trackingProject->save();

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
        return view('livewire.tracking-project.tracking-project-add-more-edit');
    }
}