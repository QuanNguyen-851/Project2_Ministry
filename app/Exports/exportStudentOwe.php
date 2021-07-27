<?php

namespace App\Exports;

use App\Models\Classroom;
use App\Models\Student as ModelsStudent;
use App\Student;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class exportStudentOwe implements FromArray, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public function __construct($month, $class)
    {
        $this->month = $month;
        $this->class = $class;
    }

    public function map($student): array
    {
        $date = date_create($student->dateBirth);
        if ($student->owe <= 0) {
            $student->owe = 0;
        } else if ($student->owesub <= 0) {
            $student->owesub = 0;
        }
        $data = [
            "BKC" . sprintf("%03d",  $student->id),
            $student->class,
            $student->name,
            $student->gender == 1 ? "Nam" : "Nữ",
            date_format($date, "d/m/Y"),
            number_format($student->scholarship) . "VNĐ",
            $student->payment,
            $student->fee,
            $student->owe,
            $student->owesub,
            $student->owe + $student->owesub,
        ];
        return $data;
    }
    public function headings(): array
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('d/m/Y H:i', time());
        if ($this->month == 5) {
            $head = 'danh sách sinh viên bị CẤM THI lớp ' . Classroom::where("id", $this->class)->value('name');
        } elseif ($this->month == 6) {
            $head = 'danh sách sinh viên bị ĐÌNH CHỈ HỌC 30 NGÀY lớp ' . Classroom::where("id", $this->class)->value('name');
        } elseif ($this->month == 7) {
            $head = 'danh sách sinh viên bị BUỘC THÔI HỌC lớp ' . Classroom::where("id", $this->class)->value('name');
        } else {

            $head = 'danh sách sinh viên nợ học phí lớp ' . Classroom::where("id", $this->class)->value('name');
        }

        return [
            [$head],
            [
                'Mã',
                'Lớp',
                'Họ tên',
                'Giới tính',
                'Ngày sinh',
                'Học bổng',
                'Hình thức đóng',
                'Học phí mỗi đợt',
                'Học phí nợ tính đến ' . $date,
                'Phụ phí nợ tính đến' . $date,
                'Tổng nợ tính đến' . $date,
            ]

        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {
        // if ($this->month == 5) {
        //     //từ 1 đến 5 tháng
        //     $fee =  DB::select('select DISTINCT `student`.`id` from `student` inner join `fee` on `Student`.`id` = `fee`.`idStudent` inner join `classbk` on `student`.`idClass` = `classbk`.`id` inner join `course` on `course`.`id` = `classbk`.`idCourse` where `course`.`countMustPay` - fee.countPay >0  and `course`.`countMustPay` - fee.countPay <=5 and `student`.`fee` > ? and `student`.`disable` != ?  and classbk.id = ?', ['0', '1', $this->class]);
        // } else if ($this->month == 6) {
        //     //6 tháng
        //     $fee =  DB::select('select DISTINCT `student`.`id` from `student` inner join `fee` on `Student`.`id` = `fee`.`idStudent` inner join `classbk` on `student`.`idClass` = `classbk`.`id` inner join `course` on `course`.`id` = `classbk`.`idCourse` where `course`.`countMustPay` - fee.countPay =6   and `student`.`fee` > ? and `student`.`disable` != ?  and classbk.id = ?', ['0', '1', $this->class]);
        // } else if ($this->month == 7) {
        //     //6 tháng
        //     $fee =  DB::select('select DISTINCT `student`.`id` from `student` inner join `fee` on `Student`.`id` = `fee`.`idStudent` inner join `classbk` on `student`.`idClass` = `classbk`.`id` inner join `course` on `course`.`id` = `classbk`.`idCourse` where `course`.`countMustPay` - fee.countPay >= 7   and `student`.`fee` > ? and `student`.`disable` != ? and classbk.id = ?', ['0', '1', $this->class]);
        // } else {
        //     //tất cả
        //     $fee =  DB::select('select DISTINCT `student`.`id` from `student` inner join `fee` on `Student`.`id` = `fee`.`idStudent` inner join `classbk` on `student`.`idClass` = `classbk`.`id` inner join `course` on `course`.`id` = `classbk`.`idCourse` where `course`.`countMustPay` - fee.countPay >0 and `student`.`fee` > ? and `student`.`disable` != ?  and classbk.id = ?', ['0', '1', $this->class]);
        // }

        // // $fee =  DB::select('select DISTINCT `student`.`id` from `student` inner join `fee` on `Student`.`id` = `fee`.`idStudent` inner join `classbk` on `student`.`idClass` = `classbk`.`id` inner join `course` on `course`.`id` = `classbk`.`idCourse` where `course`.`countMustPay` - fee.countPay >0  and `course`.`countMustPay` - fee.countPay <5 and `student`.`fee` > ? and `student`.`disable` != ? and `fee`.`disable` != ? and classbk.id = ? and classbk.id = ?', ['0', '1', '1', $this->class]);


        // $studentowefee = [];
        // foreach ($fee as $item) {
        //     $owefee = ModelsStudent::where('student.id', '=', $item->id)
        //         ->join('classbk', 'student.idClass', '=', 'classbk.id')
        //         ->join('course', 'course.id', '=', 'classbk.idCourse')
        //         ->join('fee', 'fee.idStudent', '=', 'student.id')
        //         ->join('payment', 'payment.id', '=', 'fee.idMethod')
        //         ->join('scholarship', 'scholarship.id', '=', 'student.idStudentShip')
        //         ->join('subfee', 'subfee.idStudent', '=', 'student.id')
        //         ->select(
        //             'Student.id',
        //             'classbk.name as class',
        //             'Student.name',
        //             'Student.gender',
        //             'Student.dateBirth',
        //             'scholarship.scholarship as scholarship',
        //             'payment.name as payment',
        //             'student.fee',
        //             DB::raw('
        //             (course.countMustPay - fee.countPay) * student.fee - (course.countMustPay - fee.countPay) * student.fee * payment.sale /100   as owe,
        //             (course.countSubFeeMustPay - subfee.countPay)* 1000000 as owesub')
        //         )
        //         ->orderBy('fee.countPay', 'DESC')
        //         ->first();
        //     array_push($studentowefee, $owefee);
        // }
        $month = $this->month;
        if ($month == 5) {
            $studentowefee = DB::select('SELECT student.id ,classbk.name as class,student.name,student.gender,student.dateBirth,scholarship.scholarship as scholarship,payment.name as payment, student.fee,(course.countMustPay - fee.countPay) * student.fee - (course.countMustPay - fee.countPay) * student.fee * payment.sale /100   as owe,(course.countSubFeeMustPay - subfee.countPay)* 1000000 as owesub FROM `fee`INNER JOIN student on student.id = fee.idStudent INNER JOIN classbk on student.idClass = classbk.id INNER JOIN course on classbk.idCourse = course.id INNER join subfee on subfee.idStudent = student.id INNER join scholarship on scholarship.id = student.idStudentShip INNER JOIN payment ON fee.idMethod = payment.id where student.disable !=1 and fee.id = (SELECT max(fee.id) from fee where idStudent = student.id )  and subfee.id = ( SELECT MAX(subfee.id ) FROM subfee WHERE subfee.idStudent = student.id) and (`course`.`countMustPay` - fee.countPay >0  and `course`.`countMustPay` - fee.countPay <=5 and `student`.`fee` > ? and `student`.`disable` != ?) and classbk.id = ?', ['0', '1', $this->class]);
        } else if ($month == 6) {
            $studentowefee = DB::select('SELECT student.id ,classbk.name as class,student.name,student.gender,student.dateBirth,scholarship.scholarship as scholarship,payment.name as payment, student.fee,(course.countMustPay - fee.countPay) * student.fee - (course.countMustPay - fee.countPay) * student.fee * payment.sale /100   as owe,(course.countSubFeeMustPay - subfee.countPay)* 1000000 as owesub FROM `fee`INNER JOIN student on student.id = fee.idStudent INNER JOIN classbk on student.idClass = classbk.id INNER JOIN course on classbk.idCourse = course.id INNER join subfee on subfee.idStudent = student.id INNER join scholarship on scholarship.id = student.idStudentShip INNER JOIN payment ON fee.idMethod = payment.id where student.disable !=1 and fee.id = (SELECT max(fee.id) from fee where idStudent = student.id )  and subfee.id = ( SELECT MAX(subfee.id ) FROM subfee WHERE subfee.idStudent = student.id) and  (`course`.`countMustPay` - fee.countPay =6   and `student`.`fee` > ? and `student`.`disable` != ? ) and classbk.id = ?', ['0', '1', $this->class]);
        } else if ($month == 7) {
            $studentowefee = DB::select('SELECT student.id ,classbk.name as class,student.name,student.gender,student.dateBirth,scholarship.scholarship as scholarship,payment.name as payment, student.fee,(course.countMustPay - fee.countPay) * student.fee - (course.countMustPay - fee.countPay) * student.fee * payment.sale /100   as owe,(course.countSubFeeMustPay - subfee.countPay)* 1000000 as owesub FROM `fee`INNER JOIN student on student.id = fee.idStudent INNER JOIN classbk on student.idClass = classbk.id INNER JOIN course on classbk.idCourse = course.id INNER join subfee on subfee.idStudent = student.id INNER join scholarship on scholarship.id = student.idStudentShip INNER JOIN payment ON fee.idMethod = payment.id where student.disable !=1 and fee.id = (SELECT max(fee.id) from fee where idStudent = student.id )  and subfee.id = ( SELECT MAX(subfee.id ) FROM subfee WHERE subfee.idStudent = student.id) and  (`course`.`countMustPay` - fee.countPay >= 7   and `student`.`fee` > ? and `student`.`disable` != ?) and classbk.id = ?', ['0', '1', $this->class]);
        } else {
            $studentowefee = DB::select('SELECT student.id ,classbk.name as class,student.name,student.gender,student.dateBirth,scholarship.scholarship as scholarship,payment.name as payment, student.fee,(course.countMustPay - fee.countPay) * student.fee - (course.countMustPay - fee.countPay) * student.fee * payment.sale /100   as owe,(course.countSubFeeMustPay - subfee.countPay)* 1000000 as owesub
            FROM `fee`INNER JOIN student on student.id = fee.idStudent
            INNER JOIN classbk on student.idClass = classbk.id 
            INNER JOIN course on classbk.idCourse = course.id 
            INNER join subfee on subfee.idStudent = student.id
            INNER JOIN payment ON fee.idMethod = payment.id
            INNER join scholarship on scholarship.id = student.idStudentShip
            where student.disable !=1 and fee.id = (SELECT max(fee.id) from fee where idStudent = student.id  )  and subfee.id = ( SELECT MAX(subfee.id ) FROM subfee WHERE subfee.idStudent = student.id) and ( course.countMustPay- fee.countPay>0 or `course`.`countSubFeeMustPay` - subfee.countPay > 0 ) and classbk.id = ?', [$this->class]);
        }

        return $studentowefee;
    }
}
