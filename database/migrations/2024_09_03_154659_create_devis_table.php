<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devis', function (Blueprint $table) {
            $table->id();

            // Professional (Pro) details
            $table->string('pro_name');
            $table->string('pro_address');
            $table->string('pro_city');
            $table->string('pro_siret')->nullable();

            // Client details
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_address');
            $table->string('client_city');
            $table->string('client_siret')->nullable(); // SIRET du client (optional)

            // Devis details
            $table->text('description'); // Description du devis
            $table->decimal('amount', 10, 2); // Montant du devis
            $table->date('date_devis'); // Date du devis

            // Timestamps
            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devis');
    }
}