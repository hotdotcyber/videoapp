<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Video;
use Illuminate\Support\Facades\DB;

class VideoStats extends BaseWidget
{
    protected function getStats(): array
    {
        $mostViewed = Video::orderByDesc('views')->first();
        $mostLiked = Video::withCount('likes')->orderByDesc('likes_count')->first();
        $mostDisliked = Video::withCount('dislikes')->orderByDesc('dislikes_count')->first();

        $topChannel = DB::table('channels')
            ->select('channels.id', 'channels.name', DB::raw('SUM(videos.views) as total_views'))
            ->join('videos', 'channels.id', '=', 'videos.channel_id')
            ->groupBy('channels.id', 'channels.name')
            ->orderByDesc('total_views')
            ->limit(1)
            ->first();

        return [
           Stat::make('Most Viewed Video', $mostViewed?->title ?? '—')
            ->description(number_format($mostViewed?->views ?? 0) . ' views')
            ->descriptionIcon('heroicon-o-eye')
            ->color('success')
            ->extraAttributes([
                'style' => '--tw-text-opacity: 1; font-size: 0.875rem;', // 14px
            ]),


            Stat::make('Most Liked Video', $mostLiked?->title ?? '—')
                ->description(number_format($mostLiked?->likes_count ?? 0) . ' likes')
                ->descriptionIcon('heroicon-o-hand-thumb-up')
                ->color('primary'),

            Stat::make('Most Disliked Video', $mostDisliked?->title ?? '—')
                ->description(number_format($mostDisliked?->dislikes_count ?? 0) . ' dislikes')
                ->descriptionIcon('heroicon-o-hand-thumb-down')
                ->color('danger'),

            Stat::make('Top Channel', $topChannel?->name ?? '—')
                ->description(number_format($topChannel?->total_views ?? 0) . ' total views')
                ->descriptionIcon('heroicon-o-fire')
                ->color('warning'),
        ];
    }
}
