<?php

declare(strict_types=1);

namespace App\Modules\Shared\Lib\Forms\Inputs;

use Illuminate\Support\Collection;

class VirtualSelect extends Select
{

    protected ?string $onServerSearch = null;

    protected array $onServerSearchArguments = [];

    protected int $minSearchTermLength = 2;

    protected string $noOptionsText = 'virtualSelect.noOptionsText';

    protected string $noSearchResultsText = 'virtualSelect.noSearchResultsText';

    protected string $selectAllText = 'virtualSelect.selectAllText';

    protected string $searchPlaceholderText = 'virtualSelect.searchPlaceholderText';

    protected string $optionsSelectedText = 'virtualSelect.optionsSelectedText';

    protected string $optionSelectedText = 'virtualSelect.optionSelectedText';

    protected string $allOptionsSelectedText = 'virtualSelect.allOptionsSelectedText';

    protected string $clearButtonText = 'virtualSelect.clearButtonText';

    protected string $moreText = 'virtualSelect.moreText';

    public static function make(
        string $name,
        ?string $label = null,
        array|Collection $options = [],
        bool $withOptionValidation = true
    ): static
    {
        $input = parent::make($name, $label, $options, $withOptionValidation);
        $input->setView('laravel-livewire-forms::components.virtual-select');

        return $input;
    }

    public function getEventIdForServerSearch(): ?string
    {
        if (!$onServerSearch = $this->onServerSearch) {
            return null;
        }

        return self::generateEventIdForServerSearch($onServerSearch, $this->getOnServerSearchArguments());
    }

    public static function generateEventIdForServerSearch(
        string $onServerSearchHandler,
        array $serverSearchArguments = []
    ): string
    {
        return sha1($onServerSearchHandler . json_encode($serverSearchArguments));
    }

    public function getOnServerSearch(): ?string
    {
        return $this->onServerSearch;
    }

    public function setOnServerSearch(?string $onServerSearch, array $arguments = []): static
    {
        $this->onServerSearch = $onServerSearch;
        $this->onServerSearchArguments = $arguments;

        return $this;
    }

    public function getOnServerSearchArguments(): array
    {
        return $this->onServerSearchArguments;
    }

    public function setOnServerSearchArguments(array $onServerSearchArguments): static
    {
        $this->onServerSearchArguments = $onServerSearchArguments;

        return $this;
    }

    public function getMinSearchTermLength(): int
    {
        return $this->minSearchTermLength;
    }

    public function setMinSearchTermLength(int $minSearchTermLength): static
    {
        $this->minSearchTermLength = $minSearchTermLength;

        return $this;
    }

    public function getNoOptionsText(): string
    {
        return $this->noOptionsText;
    }

    public function setNoOptionsText(string $noOptionsText): static
    {
        $this->noOptionsText = $noOptionsText;

        return $this;
    }

    public function getNoSearchResultsText(): string
    {
        return $this->noSearchResultsText;
    }

    public function setNoSearchResultsText(string $noSearchResultsText): static
    {
        $this->noSearchResultsText = $noSearchResultsText;

        return $this;
    }

    public function getSelectAllText(): string
    {
        return $this->selectAllText;
    }

    public function setSelectAllText(string $selectAllText): static
    {
        $this->selectAllText = $selectAllText;

        return $this;
    }

    public function getSearchPlaceholderText(): string
    {
        return $this->searchPlaceholderText;
    }

    public function setSearchPlaceholderText(string $searchPlaceholderText): static
    {
        $this->searchPlaceholderText = $searchPlaceholderText;

        return $this;
    }

    public function getOptionsSelectedText(): string
    {
        return $this->optionsSelectedText;
    }

    public function setOptionsSelectedText(string $optionsSelectedText): static
    {
        $this->optionsSelectedText = $optionsSelectedText;

        return $this;
    }

    public function getOptionSelectedText(): string
    {
        return $this->optionSelectedText;
    }

    public function setOptionSelectedText(string $optionSelectedText): static
    {
        $this->optionSelectedText = $optionSelectedText;

        return $this;
    }

    public function getAllOptionsSelectedText(): string
    {
        return $this->allOptionsSelectedText;
    }

    public function setAllOptionsSelectedText(string $allOptionsSelectedText): static
    {
        $this->allOptionsSelectedText = $allOptionsSelectedText;

        return $this;
    }

    public function getClearButtonText(): string
    {
        return $this->clearButtonText;
    }

    public function setClearButtonText(string $clearButtonText): static
    {
        $this->clearButtonText = $clearButtonText;

        return $this;
    }

    public function getMoreText(): string
    {
        return $this->moreText;
    }

    public function setMoreText(string $moreText): static
    {
        $this->moreText = $moreText;

        return $this;
    }

}
