<?php

/**
 * @see https://github.com/protonemedia/laravel-ffmpeg
 */

declare(strict_types=1);

namespace Modules\Media\Actions\Video;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Modules\Media\Datas\ConvertData;
use Modules\Media\Models\MediaConvert;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Spatie\QueueableAction\QueueableAction;

class ConvertVideoByMediaConvertAction
{
    use QueueableAction;

    /**
     * Execute the action.
     */
    public function execute(MediaConvert $record): ?string
    {
        $data = ConvertData::from($record);
        dddx($data);
        if (! $data->exists()) {
            return '';
        }
        $format = $data->getFFMpegFormat();
        $file_new = $data->getConvertedFilename();
        Notification::make()
        ->title('Start')
        ->success()
        ->send();

        /**
         * -preset ultrafast.
         */
        $res = FFMpeg::fromDisk($data->disk)
            ->open($data->file)
            ->export()
            // ->addFilter(function (VideoFilters $filters) {
            //    $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));
            // })
            // ->resize(640, 480)
             ->onProgress(function ($percentage, $remaining, $rate) {
                 $msg = "{$percentage}% transcoded";
                 $msg .= "{$remaining} seconds left at rate: {$rate}";
                 Notification::make()
                 ->title($msg)
                 ->success()
                 ->send();
             })
            ->addFilter('-preset', 'ultrafast')
            // ->addFilter('-crf', 22)
            ->toDisk($data->disk)
            ->inFormat($format)
            ->save($file_new);

        return Storage::disk($data->disk)->url($file_new);
    }
}
