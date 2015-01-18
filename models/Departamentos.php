<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departamentos".
 *
 * @property integer $gid
 * @property string $nombdep
 * @property double $count
 * @property string $first_iddp
 * @property double $hectares
 * @property string $geom
 */
class Departamentos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departamentos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['count', 'hectares'], 'number'],
            [['geom'], 'string'],
            [['nombdep'], 'string', 'max' => 25],
            [['first_iddp'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gid' => 'Gid',
            'nombdep' => 'Nombdep',
            'count' => 'Count',
            'first_iddp' => 'First Iddp',
            'hectares' => 'Hectares',
            'geom' => 'Geom',
        ];
    }

}
