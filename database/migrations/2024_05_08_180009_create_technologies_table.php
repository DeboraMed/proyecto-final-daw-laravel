<?php

use App\Enums\TechnologyTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('technologies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
        });

        // Insert some production data
        DB::table('technologies')->insert(['name' => 'JavaScript', 'type' => TechnologyTypeEnum::Programming_Languages]);
        DB::table('technologies')->insert(['name' => 'TypeScript', 'type' => TechnologyTypeEnum::Programming_Languages]);
        DB::table('technologies')->insert(['name' => 'Python', 'type' => TechnologyTypeEnum::Programming_Languages]);
        DB::table('technologies')->insert(['name' => 'Java', 'type' => TechnologyTypeEnum::Programming_Languages]);
        DB::table('technologies')->insert(['name' => 'Kotlin', 'type' => TechnologyTypeEnum::Programming_Languages]);
        DB::table('technologies')->insert(['name' => 'PHP', 'type' => TechnologyTypeEnum::Programming_Languages]);
        DB::table('technologies')->insert(['name' => 'Go', 'type' => TechnologyTypeEnum::Programming_Languages]);
        DB::table('technologies')->insert(['name' => 'C', 'type' => TechnologyTypeEnum::Programming_Languages]);
        DB::table('technologies')->insert(['name' => 'C++', 'type' => TechnologyTypeEnum::Programming_Languages]);
        DB::table('technologies')->insert(['name' => 'C#', 'type' => TechnologyTypeEnum::Programming_Languages]);
        DB::table('technologies')->insert(['name' => 'SQL', 'type' => TechnologyTypeEnum::Programming_Languages]);
        DB::table('technologies')->insert(['name' => 'Ruby', 'type' => TechnologyTypeEnum::Programming_Languages]);
        DB::table('technologies')->insert(['name' => 'Swift', 'type' => TechnologyTypeEnum::Programming_Languages]);
        DB::table('technologies')->insert(['name' => 'Rust', 'type' => TechnologyTypeEnum::Programming_Languages]);
        DB::table('technologies')->insert(['name' => 'Perl', 'type' => TechnologyTypeEnum::Programming_Languages]);
        DB::table('technologies')->insert(['name' => 'R', 'type' => TechnologyTypeEnum::Programming_Languages]);
        DB::table('technologies')->insert(['name' => 'Scala', 'type' => TechnologyTypeEnum::Programming_Languages]);
        DB::table('technologies')->insert(['name' => 'Haskell', 'type' => TechnologyTypeEnum::Programming_Languages]);
        DB::table('technologies')->insert(['name' => 'Lua', 'type' => TechnologyTypeEnum::Programming_Languages]);

        DB::table('technologies')->insert(['name' => 'Spring Boot (Java framework)', 'type' => TechnologyTypeEnum::Frameworks]);
        DB::table('technologies')->insert(['name' => 'Angular', 'type' => TechnologyTypeEnum::Frameworks]);
        DB::table('technologies')->insert(['name' => 'React', 'type' => TechnologyTypeEnum::Frameworks]);
        DB::table('technologies')->insert(['name' => 'Vue', 'type' => TechnologyTypeEnum::Frameworks]);
        DB::table('technologies')->insert(['name' => 'Flutter', 'type' => TechnologyTypeEnum::Frameworks]);
        DB::table('technologies')->insert(['name' => 'WordPress', 'type' => TechnologyTypeEnum::Frameworks]);
        DB::table('technologies')->insert(['name' => 'Django (Python framework)', 'type' => TechnologyTypeEnum::Frameworks]);
        DB::table('technologies')->insert(['name' => 'Flask (Python framework)', 'type' => TechnologyTypeEnum::Frameworks]);
        DB::table('technologies')->insert(['name' => 'Express.js (Node.js framework)', 'type' => TechnologyTypeEnum::Frameworks]);
        DB::table('technologies')->insert(['name' => 'Ruby on Rails (Ruby framework)', 'type' => TechnologyTypeEnum::Frameworks]);
        DB::table('technologies')->insert(['name' => 'Laravel (PHP framework)', 'type' => TechnologyTypeEnum::Frameworks]);
        DB::table('technologies')->insert(['name' => 'Symfony (PHP framework)', 'type' => TechnologyTypeEnum::Frameworks]);
        DB::table('technologies')->insert(['name' => 'ASP.NET (C# framework)', 'type' => TechnologyTypeEnum::Frameworks]);
        DB::table('technologies')->insert(['name' => '.NET Core (C# framework)', 'type' => TechnologyTypeEnum::Frameworks]);

        DB::table('technologies')->insert(['name' => 'AWS (Amazon Web Services)', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'Kubernetes', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'Docker', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'Node.js', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'Linux', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'Windows Server', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'Unity', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'Unreal Engine', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'Apache Kafka', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'TensorFlow', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'PyTorch', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'Spark', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'Hadoop', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'Elasticsearch', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'Redis', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'MongoDB', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'PostgreSQL', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'Microsoft Azure', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'Google Cloud Platform', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'Heroku', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'Jenkins', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'Ansible', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);
        DB::table('technologies')->insert(['name' => 'Terraform', 'type' => TechnologyTypeEnum::Platforms_and_Tools]);

        DB::table('technologies')->insert(['name' => 'MySQL', 'type' => TechnologyTypeEnum::Databases]);
        DB::table('technologies')->insert(['name' => 'PostgreSQL', 'type' => TechnologyTypeEnum::Databases]);
        DB::table('technologies')->insert(['name' => 'MongoDB', 'type' => TechnologyTypeEnum::Databases]);
        DB::table('technologies')->insert(['name' => 'Redis', 'type' => TechnologyTypeEnum::Databases]);
        DB::table('technologies')->insert(['name' => 'Oracle', 'type' => TechnologyTypeEnum::Databases]);
        DB::table('technologies')->insert(['name' => 'Microsoft SQL Server', 'type' => TechnologyTypeEnum::Databases]);
        DB::table('technologies')->insert(['name' => 'SQLite', 'type' => TechnologyTypeEnum::Databases]);
        DB::table('technologies')->insert(['name' => 'Couchbase', 'type' => TechnologyTypeEnum::Databases]);
        DB::table('technologies')->insert(['name' => 'Amazon DynamoDB', 'type' => TechnologyTypeEnum::Databases]);
        DB::table('technologies')->insert(['name' => 'MariaDB', 'type' => TechnologyTypeEnum::Databases]);
        DB::table('technologies')->insert(['name' => 'Firebase', 'type' => TechnologyTypeEnum::Databases]);
        DB::table('technologies')->insert(['name' => 'Neo4j', 'type' => TechnologyTypeEnum::Databases]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technologies');
    }
};
