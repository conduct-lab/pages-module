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
class AnomalyModulePagesAddOpengraphFieldsToPages extends Migration
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
        'open_graph_type' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'default_value' => 'website',
                'handler'       => 'Anomaly\PagesModule\Page\Support\OpenGraphTypeSelectOptions@handle',
            ],
        ],
        'open_graph_title' => 'anomaly.field_type.text',
        'open_graph_description' => 'anomaly.field_type.textarea',
        'open_graph_image' => 'anomaly.field_type.file',
        'open_graph_card_type_twitter' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'default_value' => 'website',
                'handler'       => 'Anomaly\PagesModule\Page\Support\OpenGraphTwitterCardSelectOptions@handle',
            ],
        ],
        'open_graph_image_twitter' => 'anomaly.field_type.file',
        'open_graph_raw' => 'anomaly.field_type.textarea',
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
        'open_graph_type',
        'open_graph_title',
        'open_graph_description',
        'open_graph_image',
        'open_graph_card_type_twitter',
        'open_graph_image_twitter',
        'open_graph_raw',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
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
