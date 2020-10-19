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
    protected $unit;
    
    public function __construct($directory,$unit){
        $this->directory = $directory;
        $this->unit = $unit;
    }
    
    public function headings(): array{
        if($this->unit == 'IT'){
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
        }else{
            return [
            'Name',
            'Function',
            'Department',
            'Duty_Station',
            'Ext_No',
            'Official_Mobile_No',
            ];
        }
        
    }
    
    public function columnFormats(): array{
        if($this->unit == 'IT'){
            return [
            'F' => NumberFormat::FORMAT_NUMBER,
            'G' => NumberFormat::FORMAT_NUMBER,
            ];
        }else{
            return [
            'F' => NumberFormat::FORMAT_NUMBER,
            ];
        }
        
    }
    
    public function collection()
    {
        if($this->directory == "all"){
            if($this->unit == 'IT'){
                return PhoneDirectory::orderBy('duty_station','asc')->orderBy('department','asc')->orderBy('ext_no','asc')->get(['name','function','department','duty_station','ext_no','official_mobile_no','personal_mobile_no','status']);
            }else{
                return PhoneDirectory::where('status','Active')->orderBy('duty_station','asc')->orderBy('department','asc')->orderBy('ext_no','asc')->get(['name','function','department','duty_station','ext_no','official_mobile_no']);
            }
            
        }else{
            if($this->unit == 'IT'){
                return PhoneDirectory::where('duty_station',$this->directory)->orderBy('duty_station','asc')->orderBy('department','asc')->orderBy('ext_no','asc')->get(['name','function','department','duty_station','ext_no','official_mobile_no','personal_mobile_no','status']);
            }else{
                return PhoneDirectory::where('duty_station',$this->directory)->where('status','Active')->orderBy('duty_station','asc')->orderBy('department','asc')->orderBy('ext_no','asc')->get(['name','function','department','duty_station','ext_no','official_mobile_no']);
            }
            
        }
    }
}
