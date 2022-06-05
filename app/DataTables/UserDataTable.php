<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
            ->editColumn('role_id', function ($user) {
                return $user->role->name;
            })
            ->editColumn('name', function ($user) {
                return $user->name;
            })
            ->editColumn('image', function ($user) {
                $folder = "img/avatar/" . $user->id . "/";
                $image =  "<img src='" . Storage::url($folder . $user->image) . "' width='100px'>";
                return $user->image ? $image : '-';
            })
            ->editColumn('email', function ($user) {
                return $user->email;
            })
            ->editColumn('phone_num', function ($user) {
                return $user->phone_num;
            })
            ->editColumn('sex', function ($user) {
                return $user->sex == "male" ? "L" : "P";
            })
            ->addColumn('action', function ($row) {
                $showGate       = 'user_show';
                $editGate       = 'user_edit';
                $deleteGate     = 'user_delete';
                $crudRoutePart  = 'users';

                return view('partials.datatables-action', compact(
                    'showGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row',
                ));
            })->rawColumns(['action', 'image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1, 'asc')
            ->addCheckbox(['className' => 'select-checkbox', 'printable' => false], true)
            ->buttons(
                Button::make('export')->text('<i class="fas fa-download"></i> Ekspor'),
                Button::make('print')->text('<i class="fas fa-print"></i> Cetak'),
                Button::make([
                    'text' => 'Pilih Semua',
                    'action' => 'function(e, dt, node, config){
                                dt.rows().select();
                                $(`input[type="checkbox"]`).prop(`checked`, true);
                            }',
                ]),
                Button::make([
                    'text' => 'Batal Pilih Semua',
                    'action' => 'function(e, dt, node, config){
                                dt.rows().deselect();
                            }',
                ]),
                Button::make([
                    'text' => 'Hapus yang Dipilih',
                    'className' => 'btn-danger',
                    'extend' => 'selected',
                    'attr' => ['id' => 'massDeleteUser']
                ]),
            )->parameters([
                'paging' => true,
                'select' => [
                    'style' => 'multi',
                    'selector' => 'td:first-child',
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
            Column::make('role_id')->title('Peran'),
            Column::make('name')->title('Nama'),
            Column::make('image')->title('Gambar'),
            Column::make('email')->title('Email'),
            Column::make('phone_num')->title('No. Telepon'),
            Column::make('sex')->title('Jenis Kelamin'),
            Column::computed('action')->title('Aksi')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
