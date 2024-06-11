<?php

namespace App\Http\Services;

use App\Mail\ClinicalRotationChanged;
use App\Models\ClinicalRotation;
use App\Models\Mentorship;
use App\Models\StudentClinicalRotation;
use App\Models\User;
use App\Models\UserProfile;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public static $user;

    public static function fetch()
    {
        return static::$user;
    }

    public static function getAuthenticatedUser($userId)
    {
        static::$user = User::with('userProfile', 'mentor.mentorUser.userProfile', 'activeClinicalRotation.clinicalRotation', 'mentees.menteeUser.userProfile')->find($userId);

        return new static;
    }

    public static function updatePassword($request)
    {
        $user =  static::$user;

        $user->update(
            ['password' => $request->validated()['new_password']]
        );
    }

    public static function storeUser($request, $role)
    {
        $data = Arr::add($request->validated(), 'role_id', $role);
        // dd($data);
        return DB::transaction(function () use ($data, $request, $role) {
            $user = User::create($data);
            if ($role == 2) {
                UserProfile::create([
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'gender' => $request->gender,
                    'student_id' => $request->student_id,
                    'entry_year' => $request->entry_year
                ]);

                StudentClinicalRotation::create([
                    'user_id' => $user->id,
                    'start_date' => Carbon::now(),
                    'clinical_rotation_id' => 1
                ]);

                Mentorship::create([
                    'mentor_user_id' => $data['mentor_user_id'],
                    'mentee_user_id' => $user->id
                ]);

                return true;
            }

            UserProfile::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'gender' => $request->gender,
                'sip_id' => $request->sip_id
            ]);

            return true;
        });
    }

    public static function userIndex($role = null)
    {
        $q = User::where('role_id', '!=', 1);

        if ($role == 'student') {
            return $q->where('role_id', '=', 2)->get();
        } elseif ($role == 'teacher') {
            return $q->where('role_id', '=', 3)->get();
        } else {
            return $q->get();
        }
    }

    public static function userDetail($userId, $teacher = false)
    {
        if ($teacher) {
            static::$user = User::with('mentees.menteeUser.userProfile')->findOrFail($userId);
            return new static;
        }

        static::$user = User::with('userProfile', 'logbooks', 'studentClinicalRotations.clinicalRotation', 'activeClinicalRotation.clinicalRotation', 'activeClinicalRotation.tasks', 'finishedClinicalRotations.clinicalRotation', 'finishedClinicalRotations.tasks', 'mentor.mentorUser.userProfile')
            ->findOrFail($userId);
        // dd(static::$user);
        return new static;
    }

    public static function delete()
    {
        if (static::$user->delete()) {
            return true;
        }

        return false;
    }

    public static function updateUser($request)
    {
        // dd($request->validated());
        $user = static::$user;

        DB::transaction(function () use ($user, $request) {
            $user->userProfile->update(Arr::except($request->validated(), ['email', 'photo']));
            $user->update(Arr::only($request->validated(), ['email']));

            if ($request->has('photo')) {
                // dd($request->photo);

                // delete task file start
                if ($user->userProfile->photo != null) {
                    $filePath = decrypt($user->userProfile->photo);
                    if (Storage::exists($filePath)) {
                        Storage::delete($filePath);
                    }
                }
                // delete task file end

                // Upload user profile picture
                $file = $request->validated()['photo'];
                $filePath = 'ppds/' . $user->id . '/' . 'profile_picture';
                $fileName = $file->getClientOriginalName();
                Storage::putFileAs($filePath, $file, $fileName);
                // Upload user profile picture

                $user->userProfile->update(
                    ['photo' => $filePath . '/' . $fileName]
                );
            }
        });
    }

    public static function changeClinicalRotation($request)
    {
        $data = $request->validate(
            ['clinical_rotation_id' => ['exists:clinical_rotations,id']]
        );

        // dd($data);
        DB::transaction(function () use ($data) {
            // update active clinical rotation
            static::$user->activeClinicalRotation->update([
                'end_date' => Carbon::now(),
                'status' => 'finished'
            ]);
            // update active clinical rotation

            // create new clinical rotation
            StudentClinicalRotation::create([
                'user_id' => static::$user->id,
                'start_date' => Carbon::now(),
                'clinical_rotation_id' => $data['clinical_rotation_id']
            ]);
            // create new clinical rotation

            Mail::to("waskitodamar51@gmail.com")->send(new ClinicalRotationChanged(static::$user, ClinicalRotation::find($data['clinical_rotation_id'])));
        });
    }

    public static function changeMentor($request)
    {
        if (static::$user->role_id != 2) {
            return false;
        }

        DB::transaction(function () use ($request) {
            if (static::$user->mentor == null) {
                Mentorship::create([
                    'mentor_user_id' => $request['mentor_user_id'],
                    'mentee_user_id' => static::$user->id
                ]);
            } else {
                static::$user->mentor->update([
                    'mentor_user_id' => $request['mentor_user_id']
                ]);
            }
        });

        return true;
    }
}
