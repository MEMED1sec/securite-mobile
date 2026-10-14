<?php
// database/migrations/2025_01_01_000000_create_products_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
  public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('barcode')->unique();
        $table->string('name');
        $table->string('brand')->nullable();
        $table->char('nutriscore_grade', 1)->nullable(); // A B C D E
        $table->string('image_url')->nullable();
        $table->string('serving_size')->nullable();
        $table->text('ingredients')->nullable();
        $table->text('allergens')->nullable();
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
