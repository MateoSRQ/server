<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data".
 *
 * @property integer $gid
 * @property integer $objectid
 * @property string $iddist
 * @property string $iddpto
 * @property string $idprov
 * @property string $nombdist
 * @property string $nombprov
 * @property string $nombdep
 * @property string $nom_cap
 * @property string $periodo
 * @property string $PIA
 * @property string $PIM
 */
class Data extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objectid'], 'integer'],
            [['PIA', 'PIM'], 'number'],
            [['iddist'], 'string', 'max' => 8],
            [['iddpto'], 'string', 'max' => 2],
            [['idprov'], 'string', 'max' => 4],
            [['nombdist'], 'string', 'max' => 50],
            [['nombprov', 'nom_cap'], 'string', 'max' => 40],
            [['nombdep'], 'string', 'max' => 25],
            [['periodo'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gid' => 'Gid',
            'objectid' => 'Objectid',
            'iddist' => 'Iddist',
            'iddpto' => 'Iddpto',
            'idprov' => 'Idprov',
            'nombdist' => 'Nombdist',
            'nombprov' => 'Nombprov',
            'nombdep' => 'Nombdep',
            'nom_cap' => 'Nom Cap',
            'periodo' => 'Periodo',
            'PIA' => 'Pia',
            'PIM' => 'Pim',
        ];
    }
}
