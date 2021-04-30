<?php

namespace App\Tables;

use App\User;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;

class AdminUsersTable extends AbstractTable
{
    /**
     * Configure the table itself.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    protected function table(): Table
    {
        return (new Table())->model(User::class)
            ->routes([
                'index'   => ['name' => 'admin.users'],
                'edit'    => ['name' => 'users.edit']
            ]);
    }

    /**
     * Configure the table columns.
     *
     * @param \Okipa\LaravelTable\Table $table
     *
     * @throws \ErrorException
     */
    protected function columns(Table $table): void
    {
        $table->column('id')->title('id')->sortable(true);
        $table->column('name')->title('Name')->sortable()->searchable();
        $table->column('email')->title('Email')->sortable()->searchable();
        $table->column('created_at')->title('Creation')->dateTimeFormat('d/m/Y H:i')->sortable();
        $table->column('updated_at')->title('Update')->dateTimeFormat('d/m/Y H:i')->sortable();
    }

    /**
     * Configure the table result lines.
     *
     * @param \Okipa\LaravelTable\Table $table
     */
    protected function resultLines(Table $table): void
    {
        //
    }
}
