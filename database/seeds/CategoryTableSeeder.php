<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shops = [
            [
                'name' => 'Books',
                "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                "slug" => \Illuminate\Support\Str::slug("Books"),
                'children' => [
                    [
                        'name' => 'Comic Book',
                        "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                        "slug" => \Illuminate\Support\Str::slug("Comic Book"),
                        'children' => [
                            [
                                'name' => 'Marvel Comic Book',
                                "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                                "slug" => \Illuminate\Support\Str::slug("Marvel Comic Book"),
                            ],
                            [
                                'name' => 'DC Comic Book',
                                "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                                "slug" => \Illuminate\Support\Str::slug("DC Comic Book"),
                            ],
                            [
                                'name' => 'Action comics',
                                "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                                "slug" => \Illuminate\Support\Str::slug("Action comics"),
                            ],
                        ],
                    ],
                    [
                        'name' => 'Textbooks',
                        "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                        "slug" => \Illuminate\Support\Str::slug("Textbooks"),
                        'children' => [
                            [
                                'name' => 'Business',
                                "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                                "slug" => \Illuminate\Support\Str::slug("Business"),
                            ],
                            [
                                'name' => 'Finance',
                                "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                                "slug" => \Illuminate\Support\Str::slug("Finance"),
                            ],
                            [
                                'name' => 'Computer Science',
                                "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                                "slug" => \Illuminate\Support\Str::slug("Computer Science"),
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Electronics',
                "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                "slug" => \Illuminate\Support\Str::slug("Electronics"),
                'children' => [
                    [
                        'name' => 'TV',
                        "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                        "slug" => \Illuminate\Support\Str::slug("TV"),
                        'children' => [
                            [
                                'name' => 'LED',
                                "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                                "slug" => \Illuminate\Support\Str::slug("LED"),
                            ],
                            [
                                'name' => 'Blu-ray',
                                "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                                "slug" => \Illuminate\Support\Str::slug("Blu-ray"),
                            ],
                        ],
                    ],
                    [
                        'name' => 'Mobile',
                        "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                        "slug" => \Illuminate\Support\Str::slug("Mobile"),
                        'children' => [
                            [
                                'name' => 'Samsung',
                                "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                                "slug" => \Illuminate\Support\Str::slug("Samsung"),
                            ],
                            [
                                'name' => 'iPhone',
                                "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                                "slug" => \Illuminate\Support\Str::slug("iPhone"),
                            ],
                            [
                                'name' => 'Xiomi',
                                "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                                "slug" => \Illuminate\Support\Str::slug("Xiomi"),
                            ],
                        ],
                    ],
                ],
            ],
        ];
        foreach ($shops as $shop) {
            \App\Category::create($shop);
        }
    }
}
