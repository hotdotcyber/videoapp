<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoResource\Pages;
use App\Models\Video;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ViewColumn; 
use Illuminate\Support\HtmlString;
class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('channel_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('uid')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('views')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('path')
                    ->label('Video Path')
                    ->required()
                    ->columnSpanFull(),

                // Video preview
            Forms\Components\Placeholder::make('Video Preview')
    ->content(fn ($record) => $record && $record->path
        ? new HtmlString('<video width="300" controls class="rounded-lg shadow-sm">
                <source src="' . asset($record->path) . '" type="video/mp4">
           </video>')
        : new HtmlString('No video uploaded'))
    ->columnSpanFull()
    ->extraAttributes(['class' => 'mt-4']),
            

                Forms\Components\FileUpload::make('image_thumbnail')
                    ->image(),
                Forms\Components\TextInput::make('visibility')
                    ->required(),
                Forms\Components\Toggle::make('processed')
                    ->required(),
                Forms\Components\Toggle::make('allow_likes')
                    ->required(),
                Forms\Components\Toggle::make('allow_comments')
                    ->required(),
                Forms\Components\TextInput::make('processing_percentage')
                    ->required()
                    ->maxLength(255)
                    ->default(0),
            ]);
    }

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('channel_id')
                ->numeric()
                ->sortable(),
            Tables\Columns\TextColumn::make('title')
                ->searchable(),
            Tables\Columns\TextColumn::make('uid')
                ->searchable(),
            Tables\Columns\TextColumn::make('views')
                ->numeric()
                ->sortable(),

            Tables\Columns\ImageColumn::make('image_thumbnail'),
            Tables\Columns\TextColumn::make('visibility'),
            Tables\Columns\IconColumn::make('processed')->boolean(),
            Tables\Columns\IconColumn::make('allow_likes')->boolean(),
            Tables\Columns\IconColumn::make('allow_comments')->boolean(),
            Tables\Columns\TextColumn::make('processing_percentage')
                ->searchable(),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}
