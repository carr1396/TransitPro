<?php
return [
  'theme'=>[
    'folder'=>'themes',
    'active'=>'default'
  ],
  'templates'=>[
    'home'=> TransitPro\Templates\HomeTemplate::class,
    'blog'=> TransitPro\Templates\BlogTemplate::class,
    'map'=> TransitPro\Templates\MapTemplate::class,
    'blog.post'=>TransitPro\Templates\BlogPostTemplate::class,
    'vehicles.show'=>TransitPro\Templates\VehicleShowTemplate::class,
    'vehicles.index'=>TransitPro\Templates\TransitTemplate::class,
  ]
];
