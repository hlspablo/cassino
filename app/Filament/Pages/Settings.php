<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\GameExclusive;
use Filament\Support\Exceptions\Halt;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Cache;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.settings';

    protected static ?string $navigationLabel = 'Configurações';

    protected static ?string $modelLabel = 'Configurações';

    protected static ?string $title = 'Configurações';

    protected static ?string $slug = 'configuracoes';

    public ?array $data = [];
    public Setting $setting;

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->setting = \Helper::getSetting();
        $this->form->fill($this->setting->toArray());
    }

    /**
     * @param Form $form
     * @return Form
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detalhes')
                    ->schema([
                        TextInput::make('software_name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(191),
                        TextInput::make('software_description')
                            ->label('Descrição')
                            ->maxLength(191),
                        Select::make('game_level')
                            ->label('Dificuldade de Ganhar')
                            ->default('medium')
                            ->selectablePlaceholder(false)
                            ->options([
                                'custom' => 'Customizada',
                                'pay' => 'Pagando',
                                'medium' => 'Balanceada',
                                'hard' => 'Difícil',
                            ]),


                    ])->columns(2),
                Section::make('Visual')
                    ->schema([
                        FileUpload::make('software_logo_white')
                            ->label('Logo')
                            ->placeholder('Carregue a logo do seu cassino')
                            ->directory('logos')
                            ->disk('public')
                            ->image(),
                        FileUpload::make('promo_banner')
                            ->label('Banner Promocional (1920x540)')
                            ->placeholder('Clique para selecionar')
                            ->directory('banners')
                            ->disk('public')
                            ->image(),
                        TextInput::make('promo_link')
                            ->label('Link do Banner')
                            ->maxLength(191),
                        TextInput::make('promo_text')
                            ->label('Texto Promocional')
                            ->maxLength(191),
                    ])->columns(2),
                Section::make('Depósitos e Saques')
                    ->schema([
                        TextInput::make('min_deposit')
                            ->label('Min Depósito')
                            ->numeric()
                            ->maxLength(191),
                        TextInput::make('max_deposit')
                            ->label('Max Depósito')
                            ->numeric()
                            ->maxLength(191),
                        TextInput::make('min_withdrawal')
                            ->label('Min Saque')
                            ->numeric()
                            ->maxLength(191),
                        TextInput::make('max_withdrawal')
                            ->label('Max Saque')
                            ->numeric()
                            ->maxLength(191),
                        TextInput::make('initial_bonus')
                            ->label('Bônus Primeiro Depósito (%)')
                            ->numeric()
                            ->suffix('%')
                            ->maxLength(191),
                        TextInput::make('min_rollover')
                            ->label('Gasto Mínimo para Saque')
                            ->numeric()
                            ->maxLength(191),
                    ])->columns(4),
                // Section::make('Taxas')
                //     ->description('Configurações de Ganhos da Plataforma')
                //     ->schema([
                //         TextInput::make('revshare_percentage')
                //             ->label('RevShare (%)')
                //             ->numeric()
                //             ->suffix('%')
                //             ->maxLength(191),
                //         TextInput::make('ngr_percent')
                //             ->label('NGR (%)')
                //             ->numeric()
                //             ->suffix('%')
                //             ->maxLength(191),
                //     ])->columns(3),

                Section::make('Social')
                    ->description('Redes Sociais')
                    ->schema([
                        TextInput::make('instagram')
                            ->label('Instagram')
                            ->placeholder('Digite o seu @fulano')
                            ->maxLength(191),
                    TextInput::make('whatsapp')
                            ->label('Whatsapp')
                            ->placeholder('Digite o número de Whatsapp')
                            ->maxLength(191),
                    ])->columns(2),
                Section::make('SMTP')
                    ->description('Ajustes de credenciais para a SMTP')
                    ->schema([
                        TextInput::make('software_smtp_type')
                            ->label('Mailer')
                            ->placeholder('Digite o mailer (smtp)')
                            ->maxLength(191),
                        TextInput::make('software_smtp_mail_host')
                            ->label('Host')
                            ->placeholder('Digite seu mail host')
                            ->maxLength(191),
                        TextInput::make('software_smtp_mail_port')
                            ->label('Porta')
                            ->placeholder('Digite a porta')
                            ->maxLength(191),
                        TextInput::make('software_smtp_mail_username')
                            ->label('Usuário')
                            ->placeholder('Digite o usuário')
                            ->maxLength(191),
                        TextInput::make('software_smtp_mail_password')
                            ->label('Senha')
                            ->placeholder('Digite a senha')
                            ->maxLength(191),
                        TextInput::make('software_smtp_mail_encryption')
                            ->label('Encryption')
                            ->placeholder('Digite a criptografia')
                            ->maxLength(191),
                        TextInput::make('software_smtp_mail_from_address')
                            ->label('E-mail Cabeçalho')
                            ->placeholder('Digite o endereço de E-mail de Cabeçalho')
                            ->maxLength(191),
                        TextInput::make('software_smtp_mail_from_name')
                            ->label('Nome Cabeçalho')
                            ->placeholder('Digite o nome de Cabeçalho')
                            ->maxLength(191)
                    ])->columns(4),
                // Section::make('Slotegrator API')
                //     ->description('Ajustes de credenciais para a Slotegrator')
                //     ->schema([
                //         TextInput::make('merchant_url')
                //             ->label('Merchant URL')
                //             ->placeholder('Digite aqui a URL da API')
                //             ->maxLength(191)
                //             ->columnSpanFull(),
                //         TextInput::make('merchant_id')
                //             ->label('Merchant ID')
                //             ->placeholder('Digite aqui a Merchant ID')
                //             ->maxLength(191),
                //         TextInput::make('merchant_key')
                //             ->placeholder('Digite aqui a Merchant Key')
                //             ->label('Merchant Key')
                //             ->maxLength(191),
                //     ])
                //     ->columns(2),
                Section::make('Suitpay')
                    ->description('Ajustes de credenciais para a Suitpay')
                    ->schema([
                        TextInput::make('suitpay_uri')
                            ->label('Client URI')
                            ->placeholder('Digite a url da api')
                            ->maxLength(191)
                            ->columnSpanFull(),
                        TextInput::make('suitpay_cliente_id')
                            ->label('Client ID')
                            ->placeholder('Digite o client ID')
                            ->maxLength(191)
                            ->columnSpanFull(),
                        TextInput::make('suitpay_cliente_secret')
                            ->label('Client Secret')
                            ->placeholder('Digite o client secret')
                            ->maxLength(191)
                            ->columnSpanFull(),
                    ])
            ])
            ->statePath('data');
    }


    protected function setGameLevel()
    {

        if (isset($this->data['game_level']) && $this->data['game_level'] === 'custom') {
            return;
        }

        $this->setting->game_level = $this->data['game_level'];

        $uuids = [
            'fortunetiger',
            'fortuneox',
            'fortunemouse',
            'fortunepanda',
            'phoenixrises',
            'queenofbounty',
            'treasuresofaztec',
            'bikiniparadise',
            'hoodvswoolf',
            'jackfrost',
            'songkranparty',
            'fortunerabbit'

        ];

        $min_max = [
            [14,36], // fortunetiger
            [7,36], // fortuneox
            [14,72], // fortunemouse
            [7,36], // fortunepanda
            [14,36], // phoenixrises
            [1,999], // queenofbounty
            [1,999], // treasuresofaztec
            [7,36], // bikiniparadise
            [14,36], // hoodvswoolf
            [14,36], // jackfrost
            [7,36], // songkranparty
            [14,36], // fortunerabbit
        ];

        $probabilities = [
            'custom' => 0.025,
            'pay' => 0.08,
            'medium' => 0.05,
            'hard' => 0.025
        ];

        if (isset($this->data['game_level']) && isset($probabilities[$this->data['game_level']])) {
            $targetProbability = $probabilities[$this->data['game_level']];
        } else {
            // Handle case where game level is not found in the probabilities array
            $targetProbability = 0.025; // Default value or handle error
        }

        $new_min_max = array_map(function ($pair) use ($targetProbability) {
            return $this->findClosestMinMax($pair[0], $pair[1], $targetProbability);
        }, $min_max);

        // Map UUIDs to their new min and max values
        $uuid_to_min_max = array_combine($uuids, $new_min_max);

        // Update each GameExclusive model
        foreach ($uuid_to_min_max as $uuid => $values) {
            [$winLength, $loseLength] = $values;

            GameExclusive::where('uuid', $uuid)->update([
                'winLength' => $winLength,
                'loseLength' => $loseLength,
            ]);
        }

    }

    protected function findClosestMinMax($minRange, $maxRange, $targetProbability)
    {
        $closestMin = $minRange;
        $closestMax = $maxRange;
        $closestDifference = PHP_FLOAT_MAX;

        for ($max = 1; $max <= $maxRange; $max++) {
            $min = round($max * $targetProbability);
            if ($min <= $minRange && $min >= 1) {
                $currentProbability = $min / $max;
                $difference = abs($currentProbability - $targetProbability);

                if ($difference < $closestDifference) {
                    $closestMin = $min;
                    $closestMax = $max;
                    $closestDifference = $difference;
                }
            }
        }

        return [$closestMin, $closestMax];
    }

    /**
     * @return void
     */
    public function submit(): void
    {
        try {
            $setting = Setting::first();
            if(!empty($setting)) {

                $dataToFill = collect($this->data)->except(['software_logo_white'])->toArray();
                $setting->fill($dataToFill);

                // Check if software_logo_white data is set and is an array
                if (isset($this->data['software_logo_white']) && is_array($this->data['software_logo_white'])) {
                    foreach ($this->data['software_logo_white'] as $key => $value) {
                        if ($value instanceof TemporaryUploadedFile) {
                            // It's an uploaded file, process it
                            $storedPath = $value->store('logos', 'public');
                            $setting->software_logo_white = $storedPath;
                        } elseif (is_string($value)) {
                            // It's already a path string, just use it directly
                            $setting->software_logo_white = $value;
                        }
                    }
                }

                // Check if software_logo_white data is set and is an array
                if (isset($this->data['promo_banner']) && is_array($this->data['promo_banner'])) {
                    foreach ($this->data['promo_banner'] as $key => $value) {
                        if ($value instanceof TemporaryUploadedFile) {
                            // It's an uploaded file, process it
                            $storedPath = $value->store('banners', 'public');
                            $setting->promo_banner = $storedPath;
                        } elseif (is_string($value)) {
                            // It's already a path string, just use it directly
                            $setting->promo_banner = $value;
                        }
                    }
                }

                if(!empty($this->data['software_smtp_type'])) {
                    $envs = DotenvEditor::load(base_path('.env'));

                    $envs->setKeys([
                        'MAIL_MAILER' => $this->data['software_smtp_type'],
                        'MAIL_HOST' => $this->data['software_smtp_mail_host'],
                        'MAIL_PORT' => $this->data['software_smtp_mail_port'],
                        'MAIL_USERNAME' => $this->data['software_smtp_mail_username'],
                        'MAIL_PASSWORD' => $this->data['software_smtp_mail_password'],
                        'MAIL_ENCRYPTION' => $this->data['software_smtp_mail_encryption'],
                        'MAIL_FROM_ADDRESS' => $this->data['software_smtp_mail_from_address'],
                        'MAIL_FROM_NAME' => $this->data['software_smtp_mail_from_name'],
                    ]);

                    $envs->save();
                }


                if($setting->save()) {
                    Cache::put('setting', $setting);
                    $this->setGameLevel();

                    Notification::make()
                        ->title('Dados alterados')
                        ->body('Dados alterados com sucesso!')
                        ->success()
                        ->send();
                }
            }


        } catch (Halt $exception) {
            Notification::make()
                ->title('Erro ao alterar dados!')
                ->body('Erro ao alterar dados!')
                ->danger()
                ->send();
        }
    }

}
