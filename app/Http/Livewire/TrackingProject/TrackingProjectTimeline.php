<?php

namespace App\Http\Livewire\TrackingProject;

use App\Models\TrackingProject;
use App\Services\TrackingProjectService;
use Livewire\Component;

class TrackingProjectTimeline extends Component
{
    // public $start_date, $deadline_date, $projects, $project_name, $projectSuggestionList;
    // public $showSuggestion = false;
    public $tracking_projects;
    public function mount()
    {
        // $this->start_date;
        // $this->deadline_date;

        // $this->projects = collect();
        // $this->projectSuggestionList = collect();
        $this->tracking_projects=collect(TrackingProjectService::getAll()->sortBy('user_deadline_accomplish_date'))->groupBy('project_name');

    }
    // protected $rules = [
    //     // 'start_date' => 'required|date',
    //     // 'deadline_date' => 'required|date',
    //     'project_name' => 'required'

    // ];

    //HOOKS
    // public function updatedProjectName($value)
    // {
    //     $this->showSuggestion = true;
    //     if ($value) :
    //         $this->projectSuggestionList = TrackingProject::where('project_name', 'like', '%' . $value . '%')->first();
    //     endif;
    // }
    // public function searchProject($name)
    // {
    //     if ($name) :
    //         $this->project_name = $name;
    //         $this->showSuggestion = false;
    //     else :

    //     endif;
    // }
    // public function closeSuggestion()
    // {
    //     $this->showSuggestion = false;
    // }

    // public function submit()
    // {
    //     $this->validate();

    //     $this->projects = TrackingProject::where('project_name', 'like', '%' . $this->project_name . '%')->get();
    // }

    public function render()

    {
        return view(
            'livewire.tracking-project.tracking-project-timeline'
        );
    }
}
