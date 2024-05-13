<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_plan_payments', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id', 30)->unique();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('subscription_plan_id')->constrained();
            $table->float('amount');
            $table->timestamp('expire_at')->nullable();
            $table->string('payment_id', 60);
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_plan_payments');
    }
};
