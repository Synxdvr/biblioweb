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
        Schema::create('borrowing_records', function (Blueprint $table) {
            $table->id('record_id'); // Primary Key
            $table->unsignedBigInteger('book_id'); // Foreign Key referencing books table
            $table->unsignedBigInteger('member_id'); // Foreign Key referencing members table
            $table->date('borrow_date'); // The date the book is borrowed
            $table->date('return_date')->nullable(); // The date the book is returned (nullable)
            $table->enum('status', ['borrowed', 'returned']); // The status of the borrowing
            $table->timestamps(); // created_at and updated_at columns

            // Define the foreign keys
            $table->foreign('book_id')->references('book_id')->on('books')->onDelete('cascade');
            $table->foreign('member_id')->references('member_id')->on('members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowing_records');
    }
};
