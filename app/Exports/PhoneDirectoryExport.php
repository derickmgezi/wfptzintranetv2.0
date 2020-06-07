<?php

namespace App\Exports;

use App\PhoneDirectory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PhoneDirectoryExport implements FromCollection, WithHeadings, WithColumnFormatting, ShouldAutoSize{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $directory;
    
    public function __construct($directory){
        $this->directory = $directory;
    }
    
    public function headings(): array{
        return [
            'Name',
            'Function',
            'Department',
            'Duty_Station',
            'Ext_No',
            'Official_Mobile_No',
            'Personal_Mobile_No',
            'Status',
        ];
    }
    
    public function columnFormats(): array{
        return [
            'F' => NumberFormat::FORMAT_NUMBER,
            'G' => NumberFormat::FORMAT_NUMBER,
        ];
    }
    
    public function collection()
    {
        if($this->directory == "all"){
            return PhoneDirectory::all('name','function','department','duty_station','ext_no','official_mobile_no','personal_mobile_no','status');
        }else{
            return PhoneDirectory::where('duty_station',$this->directory)->get(['name','function','department','duty_station','ext_no','official_mobile_no','personal_mobile_no','status']);
        }
    }
}
