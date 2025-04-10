<?php

namespace App\Filament\Resources\TourResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;
use App\Filament\Resources\TourResource\Pages\ViewReview;

class ReviewsRelationManager extends RelationManager
{
    protected static string $relationship = 'reviews';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('comment')
                    ->required()
                    ->maxLength(1000)
                    ->columnSpanFull(),

                Forms\Components\Section::make('Ratings')
                    ->schema([
                        Forms\Components\Select::make('location_rate')
                            ->options([
                                1 => '1 Star',
                                2 => '2 Stars',
                                3 => '3 Stars',
                                4 => '4 Stars',
                                5 => '5 Stars',
                            ])
                            ->required(),

                        Forms\Components\Select::make('amenities_rate')
                            ->options([
                                1 => '1 Star',
                                2 => '2 Stars',
                                3 => '3 Stars',
                                4 => '4 Stars',
                                5 => '5 Stars',
                            ])
                            ->required(),

                        // Repeat for other rating fields
                        Forms\Components\Select::make('price_rate')
                            ->options([
                                1 => '1 Star',
                                2 => '2 Stars',
                                3 => '3 Stars',
                                4 => '4 Stars',
                                5 => '5 Stars',
                            ])
                            ->required(),

                        Forms\Components\Select::make('room_rate')
                            ->options([
                                1 => '1 Star',
                                2 => '2 Stars',
                                3 => '3 Stars',
                                4 => '4 Stars',
                                5 => '5 Stars',
                            ])
                            ->required(),

                        Forms\Components\Select::make('food_rate')
                            ->options([
                                1 => '1 Star',
                                2 => '2 Stars',
                                3 => '3 Stars',
                                4 => '4 Stars',
                                5 => '5 Stars',
                            ])
                            ->required(),

                        Forms\Components\Select::make('tour_operator')
                            ->options([
                                1 => '1 Star',
                                2 => '2 Stars',
                                3 => '3 Stars',
                                4 => '4 Stars',
                                5 => '5 Stars',
                            ])
                            ->required(),
                    ])
                    ->columns(3),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('comment')
                    ->limit(50),

                Tables\Columns\TextColumn::make('location_rate')
                    ->label('Location')
                    ->formatStateUsing(fn(int $state): string => str_repeat('⭐', $state))
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('amenities_rate')
                    ->label('Amenities')
                    ->formatStateUsing(fn(int $state): string => str_repeat('⭐', $state))
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('price_rate')
                    ->label('Price')
                    ->formatStateUsing(fn(int $state): string => str_repeat('⭐', $state))
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('room_rate')
                    ->label('Room')
                    ->formatStateUsing(fn(int $state): string => str_repeat('⭐', $state))
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('food_rate')
                    ->label('Food')
                    ->formatStateUsing(fn(int $state): string => str_repeat('⭐', $state))
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('tour_operator')
                    ->label('Operator')
                    ->formatStateUsing(fn(int $state): string => str_repeat('⭐', $state))
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Rating filters
                Tables\Filters\SelectFilter::make('location_rate')
                    ->options([
                        1 => '1 Star (Location)',
                        2 => '2 Stars (Location)',
                        3 => '3 Stars (Location)',
                        4 => '4 Stars (Location)',
                        5 => '5 Stars (Location)',
                    ]),
                // Add similar filters for other ratings if needed
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'view' => ViewReview::route('/{record}'),
        ];
    }
}
