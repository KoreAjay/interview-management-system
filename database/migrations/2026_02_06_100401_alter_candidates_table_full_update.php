<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('candidates', function (Blueprint $table) {

            if (!Schema::hasColumn('candidates', 'mobile')) {
                $table->string('mobile', 15)->nullable()->after('email');
            }

            if (!Schema::hasColumn('candidates', 'position')) {
                $table->string('position')->nullable()->after('mobile');
            }

            if (!Schema::hasColumn('candidates', 'experience')) {
                $table->integer('experience')->nullable()->after('position');
            }

            if (!Schema::hasColumn('candidates', 'current_company')) {
                $table->string('current_company')->nullable()->after('experience');
            }

            if (!Schema::hasColumn('candidates', 'notice_period')) {
                $table->integer('notice_period')->nullable()->after('current_company');
            }

            if (!Schema::hasColumn('candidates', 'current_ctc')) {
                $table->decimal('current_ctc', 10, 2)->nullable()->after('notice_period');
            }

            if (!Schema::hasColumn('candidates', 'expected_ctc')) {
                $table->decimal('expected_ctc', 10, 2)->nullable()->after('current_ctc');
            }

            if (!Schema::hasColumn('candidates', 'location')) {
                $table->string('location')->nullable()->after('expected_ctc');
            }

            if (!Schema::hasColumn('candidates', 'applied_at')) {
                $table->timestamp('applied_at')->nullable()->after('status');
            }

        });
    }

    public function down(): void
    {
        Schema::table('candidates', function (Blueprint $table) {

            $table->dropColumn([
                'mobile',
                'position',
                'experience',
                'current_company',
                'notice_period',
                'current_ctc',
                'expected_ctc',
                'location',
                'applied_at',
            ]);

        });
    }
};
