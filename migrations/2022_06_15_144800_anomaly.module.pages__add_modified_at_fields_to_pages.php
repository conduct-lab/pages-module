<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class BehaviorLabModulePagesAddPublishAtFieldToPages
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModulePagesAddModifiedAtFieldsToPages extends Migration
{

    /**
     * Don't delete the stream
     * in this migration.
     *
     * @var bool
     */
    protected $delete = false;

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'auto_update_modified_at' => [
            'type' => 'anomaly.field_type.select',
            "config" => [
                "options" => [
                    'follow' => 'anomaly.module.pages::field.auto_update_modified_at.options.follow',
                    'no' => 'anomaly.module.pages::field.auto_update_modified_at.options.no',
                    'yes' => 'anomaly.module.pages::field.auto_update_modified_at.options.yes',
                ],
                "mode" => "buttons",
                "default_value" => 'follow',
            ],
        ],
        'modified_at' => [
            'type' => 'anomaly.field_type.datetime',
        ],
        'display_modified_at' => [
            'type' => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => true,
            ],
        ],
    ];

    /**
     * The field's stream.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'pages',
    ];

    /**
     * The field's assignment.
     *
     * @var array
     */
    protected $assignments = [
        'auto_update_modified_at' => [
            'translatable' => false,
            'required' => false,
        ],
        'modified_at' => [
            'translatable' => false,
            'required' => false,
        ],
        'display_modified_at' => [
            'translatable' => false,
            'required' => false,
        ],
    ];

//    /**
//     * Run the migrations.
//     *
//     * @return void
//     */
//    public function up()
//    {
//        $this->schema()->table(
//            'streams_streams',
//            function (Blueprint $table) {
//                $table->boolean('versionable')->default(0)->after('translatable');
//            }
//        );
//    }
//
//    /**
//     * Reverse the migrations.
//     *
//     * @return void
//     */
//    public function down()
//    {
//        $this->schema()->table(
//            'streams_streams',
//            function (Blueprint $table) {
//                $table->dropColumn('versionable');
//            }
//        );
//    }
}
