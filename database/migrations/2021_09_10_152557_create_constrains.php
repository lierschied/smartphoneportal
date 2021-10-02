<?php

use App\Models\Brand;
use App\Models\Comment;
use App\Models\Currency;
use App\Models\Rating;
use App\Models\Smartphone;
use App\Models\SmartphonePrice;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstrains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smartphones', function (Blueprint $table) {
            $table->foreignIdFor(Brand::class)->after('id')->nullable()->constrained()->onDelete('set null');
        });

        Schema::table('smartphone_prices', function (Blueprint $table) {
            $table->foreignIdFor(Currency::class)->after('id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(Smartphone::class)->after('id')->constrained()->onDelete('cascade');
            $table->unique(['smartphone_id','currency_id']);
        });

        Schema::table('smartphone_images', function (Blueprint $table) {
            $table->foreignIdFor(Smartphone::class)->after('id')->constrained()->onDelete('cascade');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->bigInteger('commentable_id')->after('id');
            $table->string('commentable_type')->after('id');
            $table->foreignIdFor(User::class)->after('id')->constrained()->onDelete('cascade');
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->foreignIdFor(Comment::class)->after('id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class)->after('id')->nullable()->constrained()->onDelete('set null');
            $table->unique(['comment_id','user_id']);
        });

        Schema::table('ratings', function (Blueprint $table) {
            $table->foreignIdFor(Smartphone::class)->after('id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class)->after('id')->nullable()->constrained()->onDelete('set null');
            $table->unique(['smartphone_id','user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('constrains');
    }
}
