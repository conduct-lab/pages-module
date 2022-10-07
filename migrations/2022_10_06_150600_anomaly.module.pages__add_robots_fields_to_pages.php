<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class AnomalyModulePagesAddRobotsFieldsToPages
 *
 * @link   http://pyrocms.com/
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class AnomalyModulePagesAddRobotsFieldsToPages extends Migration
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
        'robots_no_index'             => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => false,
            ],
        ],
        'robots_no_follow'             => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => false,
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
        'robots_no_index' => [
            'translatable' => false,
            'required' => false,
        ],
        'robots_no_follow' => [
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
