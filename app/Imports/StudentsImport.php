<?php

namespace App\Imports;

use App\Http\Enums\GenderEnum;
use App\Http\Enums\RoleEnum;
use App\Models\StudentClinicalRotation;
use App\Models\User;
use App\Models\UserProfile;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;

class StudentsImport implements ToModel, WithHeadingRow, OnEachRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            // 'name' => $row['name'],
            'email' => $row['email'],
            'role_id' => RoleEnum::value($row['jenis_akun']),
            'password' => bcrypt('password'),
        ]);
    }

    public function onRow(Row $row)
    {
        $row = $row->toArray();

        UserProfile::create([
            'user_id' => User::where('email', $row['email'])->pluck('id')->first(),
            'name' => $row['nama'],
            'gender' => $row['jenis_kelamin'],
            'origin_address' => $row['alamat_asal'],
            'residence_address' => $row['alamat_tempat_tinggal'],
            'phone' => $row['no_telp'],
            'emergency_phone' => $row['no_telp_darurat'],
            'student_id' => $row['nim'],
            'entry_year' => $row['angkatan'],
            'sip_id' => $row['no_sip'],
            'str_id' => $row['no_str'],
            'bpjs_id' => $row['no_bpjs'],
            'bank_account' => $row['no_rekening'],
            'age' => $row['umur'],
        ]);

        StudentClinicalRotation::create([
            'user_id' => User::where('email', $row['email'])->pluck('id')->first(),
            'clinical_rotation_id' => 1,
            'start_date' => Carbon::now(),
        ]);
    }

    public function rules(): array
    {
        return [
            // 'email' => ['required', 'unique:users,email'],
            // 'jenis_kelamin' => [Rule::enum('laki-laki', 'perempuan')],
        ];
    }
}
