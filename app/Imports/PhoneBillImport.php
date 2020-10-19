<?php

namespace App\Imports;

use App\PhoneDirectory;
use App\PhoneBill;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class PhoneBillImport implements ToModel, WithHeadingRow, WithBatchInserts, WithValidation, SkipsOnFailure, SkipsOnError{
    use Importable, SkipsFailures, SkipsErrors;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row){
        //Find the username from  PhoneDirectory
        $user_name = PhoneDirectory::where('ext_no', $row['ext'])->firstOrFail()->name;

        return new PhoneBill([
            'ext_no'  =>  $row['ext'],
            'line'  =>  $row['t'],
            'number'  =>  $row['number'],
            'date_time'  =>  $row['datetime'],
            'duration'  =>  $row['duration'],
            'cost'  =>  $row['cost'],
            'user_name'  =>  $user_name,
        ]);        
    }

    public function rules(): array{
        return [
            '*.ext'  =>  'required',
            '*.t'  =>  'required',
            '*.number'  =>  'required',
            '*.datetime'  =>  'required',
            '*.duration'  =>  'required',
            '*.cost'  =>  'required',
        ];
    }

    //This batch size determines how many models will be inserted into the database in one time drastically reduce the import duration
    public function batchSize(): int {
         return 100;
    }

}
