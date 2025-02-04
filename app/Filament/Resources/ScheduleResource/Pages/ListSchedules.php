<?php

declare(strict_types=1);

namespace Modules\Job\Filament\Resources\ScheduleResource\Pages;

use Filament\Tables;
use Filament\Tables\Columns\Column;
use Illuminate\Support\Carbon;
use Modules\Job\Filament\Columns\ScheduleArguments;
use Modules\Job\Filament\Columns\ScheduleOptions;
use Modules\Job\Filament\Resources\ScheduleResource;
use Modules\Job\Models\Schedule;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListSchedules extends XotBaseListRecords
{
    protected static string $resource = ScheduleResource::class;

    public function getListTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('command')
                ->getStateUsing(function ($record) {
                    if ($record->command === 'custom') {
                        return $record->command_custom;
                    }

                    return $record->command;
                })
                ->searchable()
                ->sortable()
                ->wrap(),
            ScheduleArguments::make('params')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('expression')
                ->searchable()
                ->sortable(),
            Tables\Columns\TagsColumn::make('environments')
                ->separator(',')
                ->searchable()
                ->sortable(),
            ScheduleOptions::make('options')
                ->searchable()
                ->sortable(),
            Tables\Columns\BadgeColumn::make('status')
                ->getStateUsing(fn ($state) => match ($state) {
                    Schedule::STATUS_ACTIVE => static::trans('status.active'),
                    Schedule::STATUS_INACTIVE => static::trans('status.inactive'),
                    Schedule::STATUS_TRASHED => static::trans('status.trashed'),
                    default => $state,
                })
                ->colors([
                    Schedule::STATUS_ACTIVE => 'success',
                    Schedule::STATUS_INACTIVE => 'warning',
                    Schedule::STATUS_TRASHED => 'danger',
                ])
                ->icons([
                    Schedule::STATUS_ACTIVE => 'heroicon-o-check-circle',
                    Schedule::STATUS_INACTIVE => 'heroicon-o-document',
                    Schedule::STATUS_TRASHED => 'heroicon-o-x-circle',
                ])
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('updated_at')
                ->getStateUsing(fn ($record) => $record->created_at == $record->updated_at ? static::trans('fields.never') : $record->updated_at)
                ->dateTime()
                ->formatStateUsing(static function (Column $column, $state): ?string {
                    $format ??= config('tables.date_time_format');
                    if (blank($state) || $state == static::trans('fields.never')) {
                        return $state;
                    }

                    return Carbon::parse($state)
                        ->setTimezone($timezone ?? $column->getTimezone())
                        ->translatedFormat($format);
                })
                ->searchable()
                ->sortable(),
        ];
    }

    public function getListTableActions(): array
    {
        return [
            Tables\Actions\EditAction::make()
                ->hidden(fn ($record) => $record->trashed())
                ->tooltip(__('filament-support::actions/edit.single.label')),
            Tables\Actions\RestoreAction::make()
                ->tooltip(__('filament-support::actions/restore.single.label')),
            Tables\Actions\DeleteAction::make()
                ->tooltip(__('filament-support::actions/delete.single.label')),
            Tables\Actions\ForceDeleteAction::make()
                ->tooltip(__('filament-support::actions/force-delete.single.label')),
            Tables\Actions\ViewAction::make()
                ->icon('history')
                ->color('gray')
                ->tooltip(static::trans('buttons.history')),
        ];
    }

    public function getListTableBulkActions(): array
    {
        return [
            Tables\Actions\DeleteBulkAction::make(),
        ];
    }

    protected function getTableRecordUrlUsing(): ?\Closure
    {
        return static fn (): ?string => null;
    }
}
