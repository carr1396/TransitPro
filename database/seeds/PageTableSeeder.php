<?php

use Illuminate\Database\Seeder;



class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('pages')->truncate();
      DB::table('pages')->insert([
        'title'=>'About',
        'uri'=> 'about',
        'content'=>'About Page',
        'parent_id'=>null,
        'lft'=>3,
        'rgt'=>8,
        'depth'=>0
      ]);
      DB::table('pages')->insert([
        'title'=>'Contact',
        'uri'=> 'contact',
        'content'=>'Contact Page',
        'parent_id'=>1,
        'lft'=>4,
        'rgt'=>5,
        'depth'=>1
      ]);
      DB::table('pages')->insert([
        'title'=>'FAQ',
        'uri'=> 'faq',
        'content'=>'FAQ Page',
        'parent_id'=>1,
        'lft'=>6,
        'rgt'=>7,
        'depth'=>1
      ]);
      // DB::table('pages')->insert([
      //   'title'=>'Media',
      //   'uri'=> 'media',
      //   'content'=>'Media Page',
      //   'parent_id'=>null,
      //   'lft'=>1,
      //   'rgt'=>2,
      //   'depth'=>0
      // ]);
      // DB::table('pages')->insert([
      //   'title'=>'Characters',
      //   'uri'=> 'chracters',
      //   'content'=>'Characters Page',
      //   'parent_id'=>null,
      //   'lft'=>9,
      //   'rgt'=>10,
      //   'depth'=>0
      // ]);
    }
}
