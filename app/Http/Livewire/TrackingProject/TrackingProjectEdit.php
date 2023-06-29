<?php

namespace App\Http\Livewire\TrackingProject;

use App\Enums\Message;
use App\Models\TrackingProject;
use App\Services\TrackingProjectService;
use App\Services\UserService;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class TrackingProjectEdit extends Component
{
    public $start_date, $project_name, $client_name, $user_deadline_accomplish_date, $job, $user_id, $deadline_date, $users;
    public $tracking_project_data;
    public $dynamicForm;
    public $oldForm;
    public $oldProject;
    protected $listeners = ['refresh' => '$refresh'];

    public function mount(TrackingProject $tracking_project_data)
    {

        $this->tracking_project_data = $tracking_project_data;
        $this->start_date = $tracking_project_data->start_date;
        $this->project_name = $tracking_project_data->project_name;
        $this->client_name = $tracking_project_data->client_name;
        $this->deadline_date = $tracking_project_data->deadline_date;
        $this->users = UserService::getAll()->get();
        $this->oldProject = collect(TrackingProjectService::getWhere([['project_name', $tracking_project_data->project_name]])->get());
        $this->dynamicForm = collect();
        $this->oldForm = collect();


    }

    protected $rules = [
        'start_date' => ['required', 'date'],
        'project_name' => ['required', 'string', 'max:255'],
        'client_name' => ['required', 'string', 'max:255'],
        'deadline_date' => ['required', 'date', 'after:user_deadline_accomplish_date'],
        'oldProject.*.job' => ['required'],
        'oldProject.*.user_deadline_accomplish_date' => ['required', 'after:start_date', 'before_or_equal:deadline_date'],
        'oldProject.*.user_id' => ['required'],
        'dynamicForm.*.user_deadline_accomplish_date' => ['required', 'date', 'after:start_date', 'before_or_equal:deadline_date'],
        'dynamicForm.*.deadline_date' => ['date', 'after:user_deadline_accomplish_date'],
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

            'oldProject.*.user_deadline_accomplish_date.required' => 'The job accomplish is required',
            'oldProject.*.user_deadline_accomplish_date.after' => 'The user deadline accomplish date must be a date after start date.',
            'oldProject.*.user_deadline_accomplish_date.before_or_equal' => 'The user deadline accomplish date must be a date before or equal deadline date.',
            'oldProject.*.deadline_date' => 'The deadline date must be a date after user deadline accomplish date.',
            'oldProject.*.job' => 'The job is required',
            'oldProject.*.user_id' => 'Required',
        ];
    }

    public function savedata()
    {
        try {
            $this->validate();
            DB::beginTransaction();
            $this->tracking_project_data->start_date = $this->start_date;
            $this->tracking_project_data->project_name = $this->project_name;
            $this->tracking_project_data->client_name = $this->client_name;
            $this->tracking_project_data->deadline_date = $this->deadline_date;
            $this->tracking_project_data->save();
            foreach ($this->oldProject as $form):
                $data = TrackingProject::findOrFail($form['id']);
                $data->job = $form['job'];
                $data->user_deadline_accomplish_date = $form['user_deadline_accomplish_date'];
                $data->user_id = $form['user_id'];
                $data->save();
            endforeach;
            $this->dispatchBrowserEvent(
                'alert',
                [
                    'type' => 'success',
                    'message' => Message::UPDATED,
                ]
            );
            DB::commit();

        } catch (QueryException $e) {
            $this->validate();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error', 'message' => Message::QUERY_EXCEPTION]
            );
        } catch (Exception $e) {
            $this->validate();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error', 'message' => Message::FAILED]
            );
        }


    }

    protected $validationAttributes = [
        'user_deadline_accomplish_date' => 'Job Deadline Accomplish',
        'user_id' => 'Responsible',
        'deadline_date' => 'Project Deadline'
    ];

    public function addForm()
    {
        $this->dynamicForm->push(new TrackingProject());
    }
    public function removeForm($index)
    {
        unset($this->dynamicForm[$index]);
    }


    public function saveDynamic()
    {
        try {
            $this->validate();
            DB::beginTransaction();
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

            $this->dispatchBrowserEvent(
                'alert',
                [
                    'type' => 'success',
                    'message' => Message::UPDATED,
                ]
            );
            DB::commit();
        } catch (QueryException $e) {
            $this->validate();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error', 'message' => Message::QUERY_EXCEPTION]
            );
        } catch (Exception $e) {
            $this->validate();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error', 'message' => Message::FAILED]
            );
        }
    }

    public function render()
    {
        return view('livewire.tracking-project.tracking-project-edit');
    }
}