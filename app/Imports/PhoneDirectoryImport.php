<?php

namespace App\Imports;

use App\PhoneDirectory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class PhoneDirectoryImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsOnError{
    use Importable, SkipsFailures, SkipsErrors;

    /**
     * @param \Throwable $e
     */
    public function onError(\Throwable $e){
        // Handle the exception how you'd like.
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row){
        //If extension exists update phonedirectory using extension number
        if (isset($row['ext_no'])) {
            try{
                return PhoneDirectory::updateOrCreate([
                    'ext_no'  =>  $row['ext_no'],
                ],[
                    'name'  =>  $row['name'],
                   'function'  =>  $row['function'],
                   'department'  =>  $row['department'],
                   'duty_station'  =>  $row['duty_station'],
                   'official_mobile_no'  =>  $row['official_mobile_no'],
                   'personal_mobile_no'  =>  $row['personal_mobile_no'],
                   'status'  =>  $row['status'],
                ]);
            }catch(\Throwable $e){
                throw($e);
            }
            
        }else{//If extension doesnt exist update phonedirectory using name
            try{
                return PhoneDirectory::updateOrCreate([
                    'name'  =>  $row['name'],
                ],[
                   'function'  =>  $row['function'],
                   'department'  =>  $row['department'],
                   'duty_station'  =>  $row['duty_station'],
                   'ext_no'  =>  $row['ext_no'],
                   'official_mobile_no'  =>  $row['official_mobile_no'],
                   'personal_mobile_no'  =>  $row['personal_mobile_no'],
                   'status'  =>  $row['status'],
                ]);
            }catch(\Exception $e){
                throw $e;
            }
            
        }
        
    }

    public function rules(): array{
        return [
            '*.name'  =>  'required',
            '*.function'  =>  'required',
            '*.department'  =>  'required',
            '*.duty_station'  =>  'required',
            //'*.ext_no'  => 'nullable|unique:phonedirectories,ext_no',
            //'*.official_mobile_no'  =>  'nullable|unique:phonedirectories,official_mobile_no',
            //'*.personal_mobile_no'  =>  'nullable|unique:phonedirectories,personal_mobile_no',
            '*.status'  =>  'required',
        ];
    }
}

// class PhoneDirectoryImport implements ToCollection, WithHeadingRow, WithBatchInserts{
//     /**
//     * @param array $row
//     *
//     * @return \Illuminate\Database\Eloquent\Model|null
//     */
//     public function collection(Collection $rows){
//         // Validator::make($rows->toArray(), [
//         //     '*.name'  =>  'required',
//         //     '*.function'  =>  'required',
//         //     '*.department'  =>  'required',
//         //     '*.duty_station'  =>  'required',
//         //     '*.ext_no'  => 'unique:phonedirectories,ext_no',
//         //     '*.official_mobile_no'  =>  'unique:phonedirectories,official_mobile_no',
//         //     '*.personal_mobile_no'  =>  'unique:phonedirectories,personal_mobile_no',
//         //     '*.status'  =>  'required',
//         // ])->validate();

//         foreach ($rows as $row){
//             //If extension doesnot exist update phonedirectory using name
//             if (!isset($row['ext_no'])) {
//                 PhoneDirectory::updateOrCreate([
//                     'name'  =>  $row['name'],
//                 ],[
//                     'ext_no'  =>  $row['ext_no'],
//                     'function'  =>  $row['function'],
//                     'department'  =>  $row['department'],
//                     'duty_station'  =>  $row['duty_station'],
//                     'official_mobile_no'  =>  $row['official_mobile_no'],
//                     'personal_mobile_no'  =>  $row['personal_mobile_no'],
//                     'status'  =>  $row['status'],
//                 ]);
//             }else{//If extesnion exists update phone directory using extension
//                 PhoneDirectory::updateOrCreate([
//                     'ext_no'  =>  $row['ext_no'],
//                 ],[
//                     'name'  =>  $row['name'],
//                     'function'  =>  $row['function'],
//                     'department'  =>  $row['department'],
//                     'duty_station'  =>  $row['duty_station'],
//                     'official_mobile_no'  =>  $row['official_mobile_no'],
//                     'personal_mobile_no'  =>  $row['personal_mobile_no'],
//                     'status'  =>  $row['status'],
//                 ]);
//             }
//         }
//     }
    

//     //This batch size determines how many models will be inserted into the database in one time drastically reduce the import duration
//     public function batchSize(): int {
//         return 100;
//     }
// }

