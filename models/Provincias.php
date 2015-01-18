<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "provincias".
 *
 * @property integer $gid
 * @property double $count
 * @property string $first_idpr
 * @property string $nombprov
 * @property string $first_nomb
 * @property string $last_dcto
 * @property string $last_ley
 * @property string $first_fech
 * @property string $last_fecha
 * @property string $min_shape_
 * @property string $ha
 * @property string $geom
 */
class Provincias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provincias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['count', 'min_shape_', 'ha'], 'number'],
            [['geom'], 'string'],
            [['first_idpr'], 'string', 'max' => 4],
            [['nombprov'], 'string', 'max' => 40],
            [['first_nomb'], 'string', 'max' => 25],
            [['last_dcto', 'last_ley'], 'string', 'max' => 6],
            [['first_fech', 'last_fecha'], 'string', 'max' => 12]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gid' => 'Gid',
            'count' => 'Count',
            'first_idpr' => 'First Idpr',
            'nombprov' => 'Nombprov',
            'first_nomb' => 'First Nomb',
            'last_dcto' => 'Last Dcto',
            'last_ley' => 'Last Ley',
            'first_fech' => 'First Fech',
            'last_fecha' => 'Last Fecha',
            'min_shape_' => 'Min Shape',
            'ha' => 'Ha',
            'geom' => 'Geom',
        ];
    }
}
