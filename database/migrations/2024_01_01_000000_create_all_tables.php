<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAllTables extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('usersjob')) {
            Schema::create('usersjob', function (Blueprint $table) {
                $table->increments('jobid');
                $table->string('jobname', 250);
            });
        }

        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('jobid')->unsigned()->nullable();
                $table->string('username', 50)->nullable();
                $table->string('password', 20)->nullable();
                $table->foreign('jobid')->references('jobid')->on('usersjob')->onDelete('set null')->onUpdate('cascade');
            });
        }

        // Insert data only if empty
        if (DB::table('usersjob')->count() === 0) {
            DB::table('usersjob')->insert([
                ['jobid' => 1, 'jobname' => 'Programmer'],
                ['jobid' => 2, 'jobname' => 'Teacher'],
                ['jobid' => 3, 'jobname' => 'Doctor'],
                ['jobid' => 4, 'jobname' => 'Engineer'],
                ['jobid' => 5, 'jobname' => 'Accountant'],
                ['jobid' => 6, 'jobname' => 'Scientist'],
            ]);
        }

        if (DB::table('users')->count() === 0) {
            DB::table('users')->insert([
                ['id' => 1, 'jobid' => 3, 'username' => 'Aronn12', 'password' => '341223'],
                ['id' => 2, 'jobid' => 1, 'username' => 'bob_coder', 'password' => 'secure987'],
                ['id' => 3, 'jobid' => 2, 'username' => 'charlie_mgr', 'password' => 'admin2026'],
                ['id' => 4, 'jobid' => 3, 'username' => 'dana_design', 'password' => 'creative456'],
                ['id' => 5, 'jobid' => 2, 'username' => 'edward_lead', 'password' => 'password000'],
                ['id' => 6, 'jobid' => 2, 'username' => 'Bruh', 'password' => '4444444'],
            ]);
        }
    }

    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('usersjob');
    }
}