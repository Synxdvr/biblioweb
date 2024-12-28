<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowingRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('borrowing_records', function (Blueprint $table) {
            $table->id('record_id');
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->date('borrow_date');
            $table->date('return_date')->nullable();
            $table->string('status'); // e.g., 'borrowed', 'returned'
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('borrowing_records');
    }
}
