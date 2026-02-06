<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('email')->unique()->after('name');
            $table->string('mobile', 15)->after('email');
            $table->string('position')->after('mobile');
            $table->integer('experience')->nullable()->after('position');
            $table->string('current_company')->nullable()->after('experience');
            $table->integer('notice_period')->nullable()->after('current_company');
            $table->decimal('current_ctc', 10, 2)->nullable()->after('notice_period');
            $table->decimal('expected_ctc', 10, 2)->nullable()->after('current_ctc');
            $table->string('location')->nullable()->after('expected_ctc');
            $table->string('resume')->nullable()->after('location');

            $table->enum('status', ['pending', 'selected', 'rejected'])
                  ->default('pending')
                  ->after('resume');

            $table->timestamp('applied_at')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'email',
                'mobile',
                'position',
                'experience',
                'current_company',
                'notice_period',
                'current_ctc',
                'expected_ctc',
                'location',
                'resume',
                'status',
                'applied_at',
            ]);
        });
    }
};
