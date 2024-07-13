    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateUsersTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->enum('role', ['admin', 'pembeli', 'wasbitnak', 'keswan', 'ppid', 'kepala', 'bendahara', 'wastukan']);
                $table->string('email')->unique();
                $table->string('password');
                $table->timestamps();
                $table->rememberToken()->nullable();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('users');
        }
    }
