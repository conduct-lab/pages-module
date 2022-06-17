<?php

return [
    'title'            => [
        'name'         => 'Title',
        'instructions' => 'Specify a short descriptive name for this page.',
    ],
    'slug'             => [
        'name'         => 'Slug',
        'instructions' => [
            'types' => 'The slug is used in making the database table for pages of this type.',
            'pages' => 'The slug is used in building the page\'s URL.',
        ],
    ],
    'meta_title'       => [
        'name'         => 'Meta Title',
        'instructions' => 'Specify the SEO title.',
        'warning'      => 'The page title will be used by default.',
    ],
    'meta_description' => [
        'name'         => 'Meta Description',
        'instructions' => 'Specify the SEO description.',
    ],
    'structured_data' => [
        'name'         => 'Structured data',
    ],
    'name'             => [
        'name'         => 'Name',
        'instructions' => 'Specify a short descriptive name for this page type.',
    ],
    'description'      => [
        'name'         => 'Description',
        'instructions' => 'Briefly describe this page type.',
    ],
    'theme_layout'     => [
        'name'         => 'Theme Layout',
        'instructions' => 'Specify the theme layout to wrap the <strong>page layout</strong> with.',
    ],
    'layout'           => [
        'name'         => 'Page Layout',
        'instructions' => 'The layout is used for displaying the page\'s content.',
    ],
    'allowed_roles'    => [
        'name'         => 'Allowed Roles',
        'instructions' => 'Specify which user roles can access this page.',
        'warning'      => 'If no roles are specified then everyone can access this page.',
    ],
    'visible'          => [
        'name'         => 'Visible',
        'label'        => 'Display this page in navigation?',
        'instructions' => 'Disable to hide this page from page based navigation <strong>structure</strong>.',
        'warning'      => 'This may or may not have an effect depending on how your website was built.',
    ],
    'exact'            => [
        'name'         => 'Exact URI',
        'label'        => 'Require an exact URI match?',
        'instructions' => 'Disable to allow custom parameters following the URI for this page.',
    ],
    'enabled'          => [
        'name'         => 'Published',
        'label'        => 'Is this page published?',
        'instructions' => 'If disabled, you can still access a secure preview link in the control panel.',
        'warning'      => 'This page must be enabled before it can be viewed <strong>publicly</strong>.',
    ],
    'publish_at'       => [
        'name'         => 'Published at',
        'instructions' => 'Specify the published at for this page.',
        'warning'      => 'If set to the future, this page will not be visible until then.',
    ],
    'auto_update_modified_at'       => [
        'name'         => 'Auto update modified at',
        'instructions' => 'Auto update the modified at date for this page.',
        'options' => [
            'follow' => 'Follow global setting',
            'no' => 'No',
            'yes' => 'Yes',
        ]
    ],
    'modified_at'       => [
        'name'         => 'Modified at',
        'instructions' => 'Specify the modified at date for this page.',
    ],
    'display_modified_at'       => [
        'name'         => 'Display modified at',
        'instructions' => 'Display modified at date on the site.',
    ],
    'home'             => [
        'name'         => 'Home Page',
        'label'        => 'Is this the home page?',
        'instructions' => 'The home page is the default landing page for your website.',
    ],
    'parent'           => [
        'name'         => 'Parent Page',
        'instructions' => 'Specify a parent page to organize it within the parent\'s URI structure.',
    ],
    'handler'          => [
        'name'         => 'Handler',
        'instructions' => 'The page handler is responsible for building the entire HTTP response for a page.',
    ],
    'status'           => [
        'name'   => 'Status',
        'option' => [
            'live'      => 'Live',
            'draft'     => 'Draft',
            'scheduled' => 'Scheduled',
        ],
    ],
    'content'          => [
        'name' => 'Content',
        'instructions' => ''
    ],
    'path'             => [
        'name' => 'Path',
    ],
    'type'             => [
        'name' => 'Type',
    ],
    'route_name'       => [
        'name'         => 'Route Name',
        'instructions' => 'This is the page\'s immutable route name.',
    ],

    'share' => [
        'name' => 'Display share options',
    ],

    'open_graph_type' => [
        'name' => 'Open Graph Type',
        'instructions' => "Best practices:<br>- Use article for articles, blog for blogposts and website for the rest of your pages.",
    ],
    'open_graph_title' => [
        'name' => 'Open Graph Title',
        'instructions' => 'Best practices:<br>
- Recommended Length: 60 characters<br>
- Focus on accuracy, value, and clickability.<br>
- Keep it short to prevent overflow.<br>
- There’s no official guidance on this, but 40 characters for mobile and 60 for desktop is roughly the sweet spot.<br>
- Use the raw title. Don’t include branding (e.g., your site name).',
        'warning' => 'If the field is not filled in, the content from SEO - Meta Title or Page Title will be used by default.',
    ],
    'open_graph_description' => [
        'name' => 'Open Graph Description',
        'instructions' => 'Best practices:<br>
- Recommended Length: 155 - 160 characters<br>
- Complement the title to make the snippet as appealing and click-worthy as possible.<br>
- Keep it short and sweet. Facebook recommends 2–4 sentences, but that often truncates.',
        'warning' => 'If the field is not filled in, the content from SEO Meta Description will be used by default.',
    ],
    'open_graph_image' => [
        'name' => 'Open Graph Image',
        'instructions' => 'Best practices:<br>
- Use custom images for “shareable” pages (e.g., homepage, articles, etc.)<br>
- Use images with a 1.91:1 ratio and minimum recommended dimensions of 1200x627 for optimal clarity across all devices.<br>
The most frequently recommended resolution for the image is 1200 pixels x 627 pixels (1.91/1 ratio). At this size, your thumbnail will be big and stand out from the crowd. Just don’t exceed the 5MB size limit.<br>
If you use an image that is smaller than 400 pixels x 209 pixels, it will render as a much smaller thumbnail. It’s nowhere nearly as eye-catching.',
    ],
    'open_graph_card_type_twitter' => [
        'name' => 'Twitter Card Type',
    ],
    'open_graph_image_twitter' => [
        'name' => 'Twitter Image',
        'instructions' => 'Twitter allows two options, a card with a smaller or a larger picture.<br>
You decide which one you want in Twitter Card Type.<br>
If you go for the large option, make sure it has a resolution of at least 280x150 pixels and that the file size is not more than 1MB.',
        'warning' => 'If no image is selected, the image from above will be used by default.',
    ],
    'open_graph_raw' => [
        'name' => 'Raw Open Graph values',
        'instructions' => 'Enter entries below in a "Property: Value" format. Enter each entry on a new line.',
    ],

];
