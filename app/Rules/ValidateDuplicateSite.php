<?php
namespace App\Rules;

use App\Models\Domain;
use App\Models\Operator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Validation\Rule;

// class UniqueByAtributteType implements Rule
class ValidateDuplicateSite implements Rule
{
    private $nroId;

    public function __construct(int $nroId = 0)
    {
        $this->nroId = $nroId;
    }

    public function passes($attribute, $value): bool
    {
        $publisherId = Auth::user()->publisher_id;
        $allOperatorPublishers = Operator::where('publisher_id', $publisherId)->pluck('id');

        $sites = Domain::whereIn('operator_id', $allOperatorPublishers)
            ->where('domain', $value);

        if ($this->nroId > 0 ){
            $sites->where('id', '!=', $this->nroId);
        }

        $total = $sites->get()->count();

        return $total == 0;
    }

    public function message()
    {
        return 'Verifique, el sitio ya existe';
    }
}