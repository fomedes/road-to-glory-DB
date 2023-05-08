<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('player_prices', function (Blueprint $table) {
        $table->integer('community')->unique();
        $table->integer('40');
        $table->integer('41');
        $table->integer('42');
        $table->integer('43');
        $table->integer('44');
        $table->integer('45');
        $table->integer('46');
        $table->integer('47');
        $table->integer('48');
        $table->integer('49');
        $table->integer('50');
        $table->integer('51');
        $table->integer('52');
        $table->integer('53');
        $table->integer('54');
        $table->integer('55');
        $table->integer('56');
        $table->integer('57');
        $table->integer('58');
        $table->integer('59');
        $table->integer('60');
        $table->integer('61');
        $table->integer('62');
        $table->integer('63');
        $table->integer('64');
        $table->integer('65');
        $table->integer('66');
        $table->integer('67');
        $table->integer('68');
        $table->integer('69');
        $table->integer('70');
        $table->integer('71');
        $table->integer('72');
        $table->integer('73');
        $table->integer('74');
        $table->integer('75');
        $table->integer('76');
        $table->integer('77');
        $table->integer('78');
        $table->integer('79');
        $table->integer('80');
        $table->integer('81');
        $table->integer('82');
        $table->integer('83');
        $table->integer('84');
        $table->integer('85');
        $table->integer('86');
        $table->integer('87');
        $table->integer('88');
        $table->integer('89');
        $table->integer('90');
        $table->integer('91');
        $table->integer('92');
        $table->integer('93');
        $table->integer('94');
        $table->integer('95');
        $table->integer('96');
        $table->integer('97');
        $table->integer('98');
        $table->integer('99');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_prices');
    }
};
