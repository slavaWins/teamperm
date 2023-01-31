<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableTeamsCreate extends Migration
{
    
    public function up()
    {
        
        Schema::create('teams', function(Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            $table->string("name")->default(0) ;
            $table->integer("owner_id")->default(0) ;
            $table->string("projectType")->default("portfolio")->comment("Для чего будет использоваться проект.") ;
        });
        
    }
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}