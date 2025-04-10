<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Tour;
use Filament\Tables;
use Filament\Forms\Form;
use App\Traits\ModelCount;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Repeater;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\TourResource\Pages;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Filament\Resources\TourResource\RelationManagers\ExtrasRelationManager;
use App\Filament\Resources\TourResource\RelationManagers\ImagesRelationManager;
use App\Filament\Resources\TourResource\RelationManagers\ReviewsRelationManager;
use App\Filament\Resources\TourResource\RelationManagers\AmenitiesRelationManager;
use App\Filament\Resources\TourResource\RelationManagers\ItinerariesRelationManager;
use App\Filament\Resources\TourResource\RelationManagers\TicketPricesRelationManager;

class TourResource extends Resource
{
    use ModelCount;
    
    protected static ?string $model = Tour::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->image(),

                Forms\Components\Select::make('type')
                    ->options([
                        'trending' => 'Trending',
                        'popular' => 'Popular'
                    ])
                    ->required(),
                Forms\Components\TextInput::make('duration')
                    ->minValue(1)
                    ->maxValue(30)
                    ->numeric(),
                Forms\Components\TextInput::make('initial_price')
                    ->required()
                    ->minValue(100)
                    ->maxValue(1000000)
                    ->numeric(),
                Forms\Components\Select::make('tour_category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->label('Tour Category'),
                Forms\Components\Select::make('destination_id')
                    ->relationship('destination', 'name')
                    ->required()
                    ->label('Destination'),
                Forms\Components\TextInput::make('group_size')
                    ->label('Group Size')
                    ->numeric(),
                Forms\Components\TextInput::make('ages')
                    ->label('Ages')
                    ->maxLength(255),
                Forms\Components\TextInput::make('languages')
                    ->label('Languages')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->columnSpanFull(),


                Repeater::make('highlights')
                    ->label('Tour Highlights')
                    ->simple(
                        TextInput::make('highlight')
                            ->label('Highlight')
                            ->required()
                            ->disableLabel()
                    )
                    ->defaultItems(1)
                    ->addActionLabel('Add Highlight')
                    ->reorderable()
                    ->collapsible()
                    ->collapsed()
                    ->grid(2)
                    ->columnSpanFull(),

                Forms\Components\Toggle::make('bestseller')
                    ->label('Bestseller')
                    ->required(),
                Forms\Components\Toggle::make('free_cancellation')
                    ->label('Free Cancellation')
                    ->required(),
                Forms\Components\TextInput::make('map')
                    ->label('Map')
                    ->url()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),

                Tables\Columns\ImageColumn::make('images.image')
                    ->label('Preview')
                    ->stacked()
                    ->limit(3)
                    ->circular(),

                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('duration')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('initial_price')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable()
                    ->label('Tour Category'),
                Tables\Columns\TextColumn::make('destination.name')
                    ->sortable()
                    ->label('Destination'),
                Tables\Columns\TextColumn::make('group_size')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ages')
                    ->searchable(),

                Tables\Columns\IconColumn::make('bestseller')
                    ->boolean(),
                Tables\Columns\IconColumn::make('free_cancellation')
                    ->boolean(),
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            ImagesRelationManager::class,
            AmenitiesRelationManager::class,
            ItinerariesRelationManager::class,
            ReviewsRelationManager::class,
            TicketPricesRelationManager::class,
            ExtrasRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTours::route('/'),
            'create' => Pages\CreateTour::route('/create'),
            'edit' => Pages\EditTour::route('/{record}/edit'),
        ];
    }
}
