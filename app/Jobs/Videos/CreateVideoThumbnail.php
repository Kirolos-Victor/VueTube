<?php

namespace App\Jobs\Videos;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class CreateVideoThumbnail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $video;
    public function __construct($video)
    {
        $this->video=$video;

    }

    public function handle()
    {
        FFMpeg::fromDisk('local')
            ->open($this->video->path)
            ->getFrameFromSeconds(10)
            ->export()
            ->toDisk('local')
            ->save("public/thumbnails/{$this->video->id}.png");

        //video duration
        $duration=FFMpeg::fromDisk('local')
            ->open($this->video->path)
            ->getDurationInSeconds();

        $this->video->update([
           'thumbnail'=>Storage::url("public/thumbnails/{$this->video->id}.png"),
            'duration'=>$duration,
        ]);
    }
}
