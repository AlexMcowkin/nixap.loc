<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_tree".
 *
 * @property string $id
 * @property string $child_id
 * @property string $parent_id
 *
 * @property Users $parent
 */
class UsersTree extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_tree';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['child_id', 'parent_id'], 'integer'],
            [['parent_id'], 'required'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'child_id' => 'Child ID',
            'parent_id' => 'Parent ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Users::className(), ['id' => 'parent_id']);
    }
}
