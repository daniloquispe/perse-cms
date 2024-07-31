<?php

namespace App;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;

trait HasSeoTagsFormFields
{
	protected static function getFormSectionWithSeoTags(bool $showSlugField = true): Section
	{
		return Section::make('Información para SEO')
			->relationship('seoTags')
			->columns()
			->schema([
				TextInput::make('slug')
					->hidden(!$showSlugField)
					->required($showSlugField)
					->maxLength(255),
				TextInput::make('meta_title')
					->label('Título en el navegador')
					->helperText('Aparece en la pestaña o ventana del navegador web')
					->maxLength(150),
				TextInput::make('meta_description')
					->label('Descripción')
					->maxLength(300),
			]);
	}
}
