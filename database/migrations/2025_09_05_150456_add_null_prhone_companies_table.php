<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddNullPrhoneCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Yeni nullable sütun əlavə et
        Schema::table('companies', function (Blueprint $table) {
            $table->string('phone_new')->nullable();
        });

        // 2. Köhnə sütundakı məlumatları köçür
        DB::table('companies')->update([
            'phone_new' => DB::raw('phone')
        ]);

        // 3. Köhnə sütunu sil
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('phone');
        });

        // 4. Yeni sütunu 'phone' adı ilə əlavə et
        Schema::table('companies', function (Blueprint $table) {
            $table->string('phone')->nullable();
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->string('phone')->nullable(false);
        });
    }
}
