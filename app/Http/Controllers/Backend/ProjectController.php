<?php

namespace App\Http\Controllers\Backend;

use App\Enums\Message;
use App\Helper\Helper;
use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {

        try {
            $this->authorize('projects_view', Project::class);
            $projects = ProjectService::getAll()->sortByDesc('id');
            return view('backend.pages.projects.index', compact('projects'));
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }

    }
    public function create()
    {

        try {
            $this->authorize('projects_view', Project::class);
            return view('backend.pages.projects.create');
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function edit(Project $project)
    {

        try {
            $this->authorize('projects_view', $project);
            return view('backend.pages.projects.edit', compact('project'));
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function delete(Project $project)
    {
        try {
            $this->authorize('projects_delete', $project);
            if (!$project) :
                Toastr::error(Message::NOT_FOUND);
                return back();
            endif;
            if ($project->image) :
                Helper::deleteOldImage($project->image);
            endif;
            $project->delete($project);
            Toastr::success(Message::DELETED);
            return back();
        }
        catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        }
         catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }
}
