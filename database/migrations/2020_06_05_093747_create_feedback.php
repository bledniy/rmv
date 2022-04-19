<?php

use App\Builders\Migration\MigrationBuilder;
use App\Enum\FeedbackTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedback extends Migration
{

	private $table = 'feedback';
   /**
    * @var MigrationBuilder
   */
   private $builder;


   public function __construct()
   {
       $this->builder = app(MigrationBuilder::class);
   }


   public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $this->builder->setTable($table);

            $table->id();
            $this->builder
                ->createName()
	            ->createType('type', FeedbackTypeEnum::DEFAULT)
	            ->createNullableChar('fio')
	            ->createNullableChar('phone', 20)
	            ->createNullableChar('email')
	            ->createNullableString('message')
	            ->createNullableChar('ip')
	            ->createNullableString('referer', 2048)
				->createNullableText('data')
				->createNullableText('files')
            ;
            $table->timestamps();
        });

    }


    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
