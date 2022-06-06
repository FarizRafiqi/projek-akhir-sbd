<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ActivityLogDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ActivityLogController extends Controller
{
    public function index(ActivityLogDataTable $dataTable)
    {
        abort_if(Gate::denies("activity_log_access"), Response::HTTP_FORBIDDEN, "Forbidden");
        return $dataTable->render("pages.admin.activity-logs");
    }
}
