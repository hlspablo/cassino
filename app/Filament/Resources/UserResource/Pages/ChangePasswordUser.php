<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ChangePasswordUser extends Page implements HasForms
{
    use HasPageSidebar;
    use InteractsWithForms;

    public User $record;
    public ?array $data = [];


    protected static string $resource = UserResource::class;

    protected static string $view = 'filament.resources.user-resource.pages.change-password-user';

    protected static ?string $title = 'Alterar Senha';

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->form->fill();
    }

    /**
     * @param Form $form
     * @return Form
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getFormSchema())
            ->statePath('data');
    }

    public function save()
    {
        $this->validate();
        $data = $this->data['data'];

        try {
            $user = User::find($this->record->id);
            $user->update([
                    'password' => Hash::make($data['password']),
                ]);

            Notification::make()
                ->title('Senha Alterada')
                ->body('A senha foi alterada com sucesso!')
                ->success()
                ->send();

        } catch (Halt $exception) {
            Notification::make()
             ->title('Erro')
             ->body('Ocorreu um erro ao alterar a senha.')
             ->danger()
             ->send();
        }
    }

    /**
     * @return array|\Filament\Forms\Components\Component[]
     */
    public function getFormSchema(): array
    {
        return [
            Section::make('Mude sua senha')
                ->description('Formulário para alterar a nova senha')
                ->schema([
                   TextInput::make('password')
                        ->label('Senha')
                        ->placeholder('Digite a senha')
                        ->password()
                        ->required()
                        ->maxLength(191),
                    TextInput::make('confirm_password')
                        ->label('Confirme Senha')
                        ->placeholder('Confirme sua senha')
                        ->password()
                        ->same('password')
                        ->maxLength(191),
                ])
                ->columns(2)
                ->statePath('data')

        ];
    }
}
