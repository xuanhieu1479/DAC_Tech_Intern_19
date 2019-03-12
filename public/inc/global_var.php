<?php

Config::set('categories', DB::table('category')->get());
Config::set('category_names', DB::table('category')->pluck('category_name')->toArray());