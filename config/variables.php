<?php

return [
    'menu' => [
        // 'hệ_thống' => [
        //     'submenu' => [
        //         'hệ thống' => 'url',
        //         'danh mục' => 'url',
        //         'cấu hình' => 'url',
        //     ],
        //     'icon' => 'fa-cog',
        //     'url' => 'system'
        // ],
        'thành_viên' => [
            'submenu' => [
                // 'nhóm thành viên' => 'url',
                'thành viên' => 'admin/user'
            ],
            'icon' => 'fa-user-o',
            'url' => 'user'
        ],
        'bài_viết' => [
            'submenu' => [
                'danh mục bài viết' => 'admin/article/catalogue',
                'bài viết' => 'admin/article/post',
                'Câu hỏi thường gặp' => 'admin/article/question',
                'tags' => 'admin/article/tag',
            ],
            'icon' => 'fa-pencil-square-o',
            'url' => 'article'
        ],
        'menu' => [
            'submenu' => [
                'vị trí' => 'admin/menu/menu-location',
                'menu' => 'admin/menu/menus',
            ],
            'icon' => 'fa-th',
            'url' => 'menu'
        ],
        // 'bất_động_sản' => [
        //     'submenu' => [
        //         'danh mục bất động sản' => 'admin/product/product-type',
        //         'bất động sản' => 'admin/realestate/estate',
        //     ],
        //     'icon' => 'fa fa-university',
        //     'url' => 'estate'
        // ],
        'sản_phẩm' => [
            'submenu' => [
                'danh mục sản phẩm' => 'admin/product/product-type',
                'sản phẩm' => 'admin/product/products',
                // 'màu sản phẩm' => 'admin/product/color',
                'size sản phẩm' => 'admin/product/size',
                'hãng sản xuất' => 'admin/product/brands'

            ],
            'icon' => 'fa-shopping-bag',
            'url' => 'product'
        ],
        'đối_tác_-_KH' => [
            'submenu' => [
                'đối tác' => 'admin/partner/partners',
                'thêm đối tác' => 'admin/partner/partners/create'
            ],
            'icon' => 'fa-users',
            'url' => 'partner'
        ],
        'video' => [
            'submenu' => [
                'video' => 'admin/video/videos',
                'thêm video' => 'admin/video/videos/create'
            ],
            'icon' => 'fa-film',
            'url' => 'video'
        ],
        // 'bình_luận' => [
        //     'submenu' => [],
        //     'icon' => 'fa-comments',
        //     'url' => 'comment'
        // ],
        'hình_ảnh' => [
            'submenu' => [
                'thư viện ảnh' => 'admin/gallery/galleries',
                'ảnh slide' => 'admin/gallery/slides'
            ],
            'icon' => 'fa-picture-o',
            'url' => 'gallery'
        ],
        'sitemap' => [
            'submenu' => [],
            'icon' => 'fa-sitemap',
            'url' => 'admin/re-sitemap'
        ],
    ],

    'page_type' => [
        'Mặc định', //0
        'Liên lạc', //1
        'Trang chủ', //2
        'Thư viện ảnh', //3
        'Giới thiệu', //4
        'Giỏ hàng', //5
        'Thanh toán', //6
        'Tin tức', //7
        'Dịch vụ', //8
        'Dự án', //9
        'Chính sách', //10
        'Banner', // 11
        'Khuyến mãi', //12
        'Kiến thức' //13
    ],

    'add_quick' => [
        'add_catalogue' => [
            'title' => 'Thêm danh mục bài viết',
            'url' => 'catalogue.create',
            'icon' => 'fa fa-list-ul'
        ],
        'add_post' => [
            'title' => 'Thêm bài viết',
            'url' => 'post.create',
            'icon' => 'fa fa-edit'
        ],
        'add_product_type' => [
            'title' => 'Thêm danh mục sản phẩm',
            'url' => 'product-type.create',
            'icon' => 'fa fa-list-ul'
        ],
        'add_brand' => [
            'title' => 'Thêm hãng sản xuất',
            'url' => 'brands.create',
            'icon' => 'fa fa-list-ul'
        ],
        'add_product' => [
            'title' => 'Thêm sản phẩm',
            'url' => 'products.create',
            'icon' => 'fa fa-shopping-cart'
        ],
        'add_partner' => [
            'title' => 'Thêm đối tác',
            'url' => 'partners.create',
            'icon' => 'fa fa-users'
        ],
        'add_video' => [
            'title' => 'Thêm video',
            'url' => 'videos.create',
            'icon' => 'fa fa-film'
        ],
        'add_gallery' => [
            'title' => 'Thêm ảnh thư viện',
            'url' => 'galleries.create',
            'icon' => 'fa fa-image'
        ],
        'add_slide' => [
            'title' => 'Thêm ảnh slide',
            'url' => 'slides.create',
            'icon' => 'fa fa-image'
        ]
    ],

    'modules' => [
        'product_catalogua' => 'Sản phẩm',
        'article_catalogua' => 'Bài viêt'
    ],

    'module_item' => [
        'product_catalogua' => 'Hiện các sản phẩm',
        'article_catalogua' => 'Hiện các bài viết'
    ],

    'sessionKey' => 'fy+TPoiljmLj2ZgJouUR1lSWNQu58Fnhekzu9IJ2K9g=',


    'region' => [
        '' => '-- Chọn vùng miền --',
        '1' => 'Miền Bắc',
        '2' => 'Miền Trung',
        '3' => 'Miền Nam'
    ],

    'acreage' => [
        '' => '-- Chọn diện tích --',
        '0' => 'Chưa xác định',
        '1' => '<= 30 m2',
        '2' => '30 - 50 m2',
        '3' => '50 - 80 m2',
        '4' => '80 - 100 m2',
        '5' => '100 - 150 m2',
        '6' => '150 - 200 m2',
        '7' => '200 - 250 m2',
        '8' => '250 - 300 m2',
        '9' => '300 - 500 m2',
        '10' => '>= 500 m2'
    ],

    'price_range' => [
        '' => '-- Chọn giá bán --',
        '0' => 'Thỏa thuận',
        '1' => '< 1 triệu',
        '2' => '1 - 3 triệu',
        '3' => '3 - 5 triệu',
        '4' => '5 - 10 triệu',
        '5' => '10 - 40 triệu',
        '6' => '40 - 70 triệu',
        '7' => '70 - 100 triệu',
        '8' => '> 100 triệu'
    ],

    'choose_form_estate' => [
        '' => '-- Chọn thể loại bất động sản --',
        'f-dat-cong-nghiep' => 'Đất công nghiệp',
        'f-nha-xuong' => 'Nhà xưởng, nhà kho',
    ],

    'price_unit' => [
        1 => 'VND',
        2 => 'VND/m2'
    ],

    'acreage_unit' => [
        1 => 'm2',
        2 => 'ha'
    ],

    'type_partner' => [
        0 => '-- Chọn loại --',
        1 => 'Đối tác',
        2 => 'Khách hàng'
    ],

    'show_paginate' => [
        0,10,20,30,50
    ],

    'service_home' => [
        
    ],
];
