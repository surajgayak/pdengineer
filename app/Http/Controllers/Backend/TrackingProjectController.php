<?php

namespace App\Http\Controllers\Backend;

use App\Enums\Message;
use App\Enums\UserType;
use App\Exports\ExportTrackingProject;
use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Models\TrackingProject;
use App\Models\User;
use App\Notifications\UpdateTrackingProjectStatusToAdmin;
use App\Services\TrackingProjectService;
use App\Services\UserService;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Fluent;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Mail\TrackingProjectSendMailToAdminAndResponsibleUserWhenAdminChangedStatus;
use Illuminate\Support\Facades\Mail;


class TrackingProjectController extends Controller
{
    public function remainder($value)
    {
        return Carbon::parse($value->user_deadline_accomplish_date)->subDays(7)->toDateString();
    }
    public function index()
    {
        try {
            $projects = [];
            if (Auth::user()->user_type == UserType::ADMIN) :
                $this->authorize('tracking_project_view', TrackingProject::class);
                $tracking_projects = collect(TrackingProjectService::getAll())->groupBy('project_name');

            else :
                $tracking_projects = TrackingProjectService::getWhere([['user_id', Auth()->user()->id]])->orderBy('id', 'DESC')->get();

            endif;
            return view('backend.pages.tracking-project.index', compact('tracking_projects'));
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
            $this->authorize('tracking_project_create', TrackingProject::class);
            return view('backend.pages.tracking-project.create');
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function edit(TrackingProject $tracking_project)
    {

        try {
            $this->authorize('tracking_project_edit', $tracking_project);
            return view('backend.pages.tracking-project.edit', compact('tracking_project'));
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }
    public function delete(TrackingProject $tracking_project)
    {
        try {
            $this->authorize('tracking_project_delete', $tracking_project);
            DB::beginTransaction();
            if (!$tracking_project) :
                Toastr::error(Message::NOT_FOUND);
                return back();
            endif;
            $tracking_project->delete();
            DB::commit();
            Toastr::success(Message::DELETED);
            return back();
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function timeline()
    {
        try {
            $this->authorize('tracking_project_timeline', TrackingProject::class);
            return view('backend.pages.tracking-project.timeline');
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function trackingProjectStatus(Request $request, TrackingProject $tracking_status)

    {
        try {
            DB::beginTransaction();
            $admin = User::where('user_type', UserType::ADMIN)->first();
            $this->authorize('tracking_project_update_status', $tracking_status);
            $request->validate(['status' => 'required|numeric']);
            $tracking_project = TrackingProjectService::getById($tracking_status->id);
            $tracking_project->user_project_status = $request->status;
            $tracking_project->save();
            Notification::send($admin, new UpdateTrackingProjectStatusToAdmin($tracking_project));
            DB::commit();
            Toastr::success(Message::UPDATED);
            return back();
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error(Message::FAILED);
            return back();
        }
    }
    public function updateTrackingProjectStatusByAdmin(Request $request, TrackingProject $tracking_status)
    {
       try {

            DB::beginTransaction();
            $responsible_users = TrackingProject::where('project_name', $tracking_status->project_name)->get();
            $responsible_users->load('user');
            $request->validate(['status' => 'required|numeric']);
            TrackingProjectService::getWhere([['project_name', $tracking_status->project_name]])->update(['teacking_project_status' => $request->status]);
            $admins = UserService::getAdmins()->get();
            $tracking_project = TrackingProject::find($tracking_status->id);
            Mail::to($admins)->send(new TrackingProjectSendMailToAdminAndResponsibleUserWhenAdminChangedStatus($tracking_project, $toAdmin = true));
            foreach ($responsible_users as $recipient):
                Mail::to($recipient->user)->send(new TrackingProjectSendMailToAdminAndResponsibleUserWhenAdminChangedStatus($tracking_project, $toAdmin = false));


            endforeach;
            DB::commit();
            Toastr::success(Message::UPDATED);
            return back();
        } catch (Exception $e) {
            
            DB::rollBack();
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function markAllNotificationAsRead()
    {
        try {
            $user = Auth::user();
            $user->unreadNotifications->markAsRead();
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function exportToExcel()
    {
        try {
            return Excel::download(new ExportTrackingProject, 'trackingProject.xlsx');
        } catch (Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function exportToPdf()
    {
        try {
            $tracking_projects = TrackingProject::orderBy('project_name')->get()->all();
            $pdf = PDF::loadview('backend.pages.tracking-project.export-pdf', compact('tracking_projects'))->setPaper('a4', 'landscape');
            return $pdf->download('tracking_projects.pdf');
        } catch (Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function proposal()
    {
        // dd(public_path)
    //    return view('proposal');
       $pdf = PDF::loadview('proposal')->setPaper('a4', 'landscape');
            return $pdf->download('proposal.pdf');

 

    }
}
