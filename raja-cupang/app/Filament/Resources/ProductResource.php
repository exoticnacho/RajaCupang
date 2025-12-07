<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\Action;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'Produk';
    protected static ?string $label = 'Ikan Cupang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Nama Ikan')->required(),
                Textarea::make('description')->label('Deskripsi'),
                TextInput::make('price')->label('Harga')->numeric()->required(),
                TextInput::make('stock')->label('Stok')->numeric()->required(),
                FileUpload::make('image')
                    ->label('Gambar')
                    ->image()
                    ->directory('products')
                    ->nullable(),
                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Gambar'),
                TextColumn::make('name')->label('Nama')->searchable(),
                TextColumn::make('price')->label('Harga')->money('IDR'),
                TextColumn::make('stock')->label('Stok'),
                TextColumn::make('category.name')->label('Kategori'),
            ])
            ->actions([
                \Filament\Tables\Actions\EditAction::make(),
                \Filament\Tables\Actions\DeleteAction::make(),
                Action::make('export_pdf')
                    ->label('Export PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn (Product $record) => route('product.pdf', ['product' => $record->id]))
                    ->openUrlInNewTab(), // opsional: agar buka di tab baru
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
