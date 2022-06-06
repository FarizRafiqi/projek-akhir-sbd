<?php

namespace App\DataTables;

use App\Models\ActivityLog;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ActivityLogDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('user_id', function ($item) {
                return $item->user->name ?? "-";
            })
            ->editColumn('reference_table', function ($item) {
                return $item->reference_table ?? "-";
            })
            ->editColumn('reference_id', function ($item) {
                return $item->reference_id ?? "-";
            })
            ->editColumn('description', function ($item) {
                return $item->description ?? "-";
            })
            ->editColumn('created_at', function ($item) {
                return $item->created_at ?? "-";
            })
            ->editColumn('updated_at', function ($item) {
                return $item->updated_at ?? "-";
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ActivityLog $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ActivityLog $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('activityLogsDataTable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1, 'asc')
            ->parameters([
                'paging' => true,
                'lengthMenu' => [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All'],
                ],
                'responsive' => true,
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('user_id')->title('Nama User'),
            Column::make('reference_table')->title('Tabel Referensi'),
            Column::make('reference_id')->title('Id Referensi'),
            Column::make('description')->title('Deskripsi'),
            Column::make('created_at')->title('Dibuat Pada'),
            Column::make('updated_at')->title('Diubah Pada'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ActivityLog_' . date('YmdHis');
    }
}
