@php
    $affixLabelClasses = ['whitespace-nowrap group-focus-within:text-primary-500', 'text-gray-400' => !$errors->has($getStatePath()), 'text-danger-400' => $errors->has($getStatePath())];
@endphp

<x-dynamic-component :component="$getFieldWrapperView()" :id="$getId()" :label="$getLabel()" :label-sr-only="$isLabelHidden()" :helper-text="$getHelperText()"
    :hint="$getHint()" :hint-icon="$getHintIcon()" :required="$isRequired()" :state-path="$getStatePath()">
    <div
        {{ $attributes->merge($getExtraAttributes())->class(['filament-forms-text-input-component flex items-center space-x-2 rtl:space-x-reverse group']) }}>
        @if (($prefixAction = $getPrefixAction()) && !$prefixAction->isHidden())
            {{ $prefixAction }}
        @endif

        @if ($icon = $getPrefixIcon())
            <x-dynamic-component :component="$icon" class="w-5 h-5" />
        @endif

        @if ($label = $getPrefixLabel())
            <span @class($affixLabelClasses)>
                {{ $label }}
            </span>
        @endif

        @php
            if (!empty($getState && is_string($getState))) {
                preg_match('`([0-9]+)([a-zA-Z]+)`', $getState, $matches);
                $count = !empty($matches[1]) ? $matches[1] : '';
                $frequency = !empty($matches[2]) ? $matches[2] : '';
            } else {
                $count = '';
                $frequency = '';
            }
        @endphp

        <div class="flex-1" x-data="{ count: '{{ $count }}', frequency: '{{ $frequency }}', value: @entangle($getStatePath()) }">
            <input type="hidden" {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}" x-model="value">
            <div class="flex">
                <input x-model="count" x-on:change="value = count + frequency" type="number"
                    dusk="filament.forms.{{ $getStatePath() }}" {!! $isAutofocused() ? 'autofocus' : null !!} {!! $isDisabled() ? 'disabled' : null !!}
                    id="{{ $getId() }}"
                    {{ $getExtraInputAttributeBag()->class([
                        'block transition duration-75 rounded-lg shadow-sm focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 w-20',
                        'dark:bg-gray-700 dark:text-white dark:focus:border-primary-500' => config('forms.dark_mode'),
                    ]) }}
                    x-bind:class="{
                        'border-gray-300': !(@js($getStatePath()) in $wire.__instance.serverMemo.errors),
                        'dark:border-gray-600': !(@js($getStatePath()) in $wire.__instance.serverMemo.errors) &&
                            @js(config('forms.dark_mode')),
                        'border-danger-600 ring-danger-600': (@js($getStatePath()) in $wire.__instance.serverMemo.errors),
                    }" />

                <div class="w-1"></div>

                @unless($isSearchable())
                    <select x-on:change="value = count + frequency" {!! $isAutofocused() ? 'autofocus' : null !!} {!! $isDisabled() ? 'disabled' : null !!}
                        id="{{ $getId() }}" x-model="frequency" dusk="filament.forms.{{ $getStatePath() }}"
                        {{ $attributes->merge($getExtraInputAttributes())->merge($getExtraAttributes())->class([
                                'text-gray-900 block w-full transition duration-75 rounded-lg shadow-sm focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70',
                                'dark:bg-gray-700 dark:text-white dark:focus:border-primary-500' => config('forms.dark_mode'),
                                'border-gray-300' => !$errors->has($getStatePath()),
                                'dark:border-gray-600' => !$errors->has($getStatePath()) && config('forms.dark_mode'),
                                'border-danger-600 ring-danger-600' => $errors->has($getStatePath()),
                            ]) }}>
                        @unless($isPlaceholderSelectionDisabled())
                            <option value="">{{ $getPlaceholder() }}</option>
                            @endif

                            @foreach ($getOptions() as $value => $label)
                                <option value="{{ $value }}" {!! $isOptionDisabled($value, $label) ? 'disabled' : null !!}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <div x-model="frequency" x-on:change="value = count + frequency" x-data="selectFormComponent({
                            isHtmlAllowed: @js($isHtmlAllowed()),
                            getOptionLabelUsing: async () => {
                                return await $wire.getSelectOptionLabel(@js($getStatePath()))
                            },
                            getOptionLabelsUsing: async () => {
                                return await $wire.getSelectOptionLabels(@js($getStatePath()))
                            },
                            getOptionsUsing: async () => {
                                return await $wire.getSelectOptions(@js($getStatePath()))
                            },
                            getSearchResultsUsing: async (search) => {
                                return await $wire.getSelectSearchResults(@js($getStatePath()), search)
                            },
                            isAutofocused: @js($isAutofocused()),
                            hasDynamicOptions: @js($hasDynamicOptions()),
                            hasDynamicSearchResults: @js($hasDynamicSearchResults()),
                            loadingMessage: @js($getLoadingMessage()),
                            maxItems: @js($getMaxItems()),
                            noSearchResultsMessage: @js($getNoSearchResultsMessage()),
                            options: @js($getOptions()),
                            optionsLimit: @js($getOptionsLimit()),
                            placeholder: @js($getPlaceholder()),
                            searchingMessage: @js($getSearchingMessage()),
                            searchPrompt: @js($getSearchPrompt()),
                        })" wire:ignore
                            {{ $attributes->merge($getExtraAttributes())->merge($getExtraAlpineAttributes()) }}>
                            <select x-ref="input" id="{{ $getId() }}" {!! $isDisabled() ? 'disabled' : null !!}
                                {{ $getExtraInputAttributeBag() }}></select>
                        </div>
                        @endif
                    </div>
                </div>



                @if ($label = $getSuffixLabel())
                    <span @class($affixLabelClasses)>
                        {{ $label }}
                    </span>
                @endif

                @if ($icon = $getSuffixIcon())
                    <x-dynamic-component :component="$icon" class="w-5 h-5" />
                @endif

                @if (($suffixAction = $getSuffixAction()) && !$suffixAction->isHidden())
                    {{ $suffixAction }}
                @endif
            </div>
        </x-dynamic-component>
